<?php

namespace App\Http\Livewire\Academic\Administrator\Programs;

use App\Models\Academic\Programa;
use App\Models\Academic\Jornada;
use App\Models\Academic\Metodologia;
use App\Models\Academic\Unidad;
use App\Models\Academic\UnidadPrograma;
use App\Models\Academic\CubrimientoPrograma;
use App\Models\Academic\TipoCubrimientosNies;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\Http\Utils\Session\SessionMock;

class EditUnitProgram extends Component
{
    public $unitProgram;
    public $unitProgramId;
    public $programId;
    public $programSystem;
    public $workDayDescription;
    public $relationType;
    public string $methodology;
    public $unit;
    public $isFaculty;
    public $coveringType;
    //arreglo
    public $relationTypes = [];
    //declaración llaves foráneas
    public $methodologies;
    public $units;
    public $coveringTypes;

    public function mount($programId, $unitProgramId)
    {
        $this->relationTypes = [
            'A' => 'ACADEMICO',
            'L' => 'LOCALIDAD',
        ];
        $this->unitProgram = UnidadPrograma::find($unitProgramId);
        $this->unitProgramId = $unitProgramId;
        $this->programId = $programId;
        $this->methodologies = Metodologia::get();
        $this->units = Unidad::get();
        $this->programSystem = Programa::find($programId);
        $workDay = Jornada::find($this->programSystem->jorn_id);
        $this->workDayDescription = $workDay->jorn_descripcion;
        $this->methodology = $this->programSystem->meto_id;
        $this->mapGettedUnitProgram();
        $this->coveringTypes  = TipoCubrimientosNies::get();
        $findCoveringType = CubrimientoPrograma::where('unpr_id', '=' , $unitProgramId)->get();
        if ($findCoveringType->count() > 0) {
            $this->coveringType = $findCoveringType[0]->tcsn_id;
        }
    }

    public function render()
    {
        return view('livewire.academic.administrator.programs.associate-unit')
        ->extends('layouts.mainLayout', ['title' => 'Editar Relación con Unidad', 'rol' => 'Administrador'])
        ->section('content');
    }

    private function mapGettedUnitProgram() {
        $this->unit = $this->unitProgram->unid_id;
        $this->relationType = $this->unitProgram->unpr_relacion;
        if ($this->unitProgram->unpr_esfacultad == 0){
            $this->isFaculty = null;
        } else {
            $this->isFaculty = $this->unitProgram->unpr_esfacultad;
        }
    }

    public function saveUnitProgram(){
        try {
            DB::beginTransaction();
            //ToDo: Delete mock session
            SessionMock::setMockSession();
            $this->unitProgram = UnidadPrograma::find($this->unitProgramId);
            $this->mapUnitProgram();
            $this->unitProgram->save();
            //dd($this->unitProgram);//ojo
            DB::commit();
            session()->flash('successSaved', 'El registro fue editado exitosamente');
            redirect(route('administrator.detailProgram', ['programId' => $this->programId]));

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function mapUnitProgram(): Void{
        $unpr_esfacultad;
        if ($this->isFaculty == null){
            $unpr_esfacultad = 0;
        } else {
            $unpr_esfacultad = $this->isFaculty;
        }

        $this->unitProgram->unpr_relacion = $this->relationType;
        $this->unitProgram->unpr_fechacambio = Carbon::now();
        $this->unitProgram->unpr_registradopor = Session::get('pegeId');
        $this->unitProgram->prog_id = $this->programId;
        $this->unitProgram->unid_id = $this->unit;
        $this->unitProgram->unpr_esfacultad = $unpr_esfacultad;
        $this->unitProgram->unpr_cupominimo = null;
        $this->unitProgram->unpr_cupomaximo = null;
        $this->unitProgram->unpr_numeroopcionados = null;
    }    
}

