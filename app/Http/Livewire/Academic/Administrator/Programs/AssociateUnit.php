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

class AssociateUnit extends Component
{
    public $programId;
    public $programSystem;
    public $workDayDescription;
    public $relationType;
    public string $methodology;
    public string $unit;
    public $isFaculty;
    public $coveringType;
    //arreglo
    public $relationTypes = [];
    //declaración llaves foráneas
    public $methodologies;
    public $units;
    public $coveringTypes;

    public function mount($programId)
    {
        $this->relationTypes = [
            'A' => 'ACADEMICO',
            'L' => 'LOCALIDAD',
        ];
        $this->programId = $programId;
        $this->methodologies = Metodologia::get();
        $this->units = Unidad::get();
        $this->coveringTypes  = TipoCubrimientosNies::get();
        $this->programSystem = Programa::find($programId);
        $workDay = Jornada::find($this->programSystem->jorn_id);
        $this->workDayDescription = $workDay->jorn_descripcion;
        $this->methodology = $this->programSystem->meto_id; 
    
        $this->relationType = '';
        $this->unit = '';
        $this->isFaculty = '';
        $this->coveringType = '';
    }

    public function render()
    {
        return view('livewire.academic.administrator.programs.associate-unit')
        ->extends('layouts.mainLayout', ['title' => 'Asociar Unidad', 'rol' => 'Administrador'])
        ->section('content');
    }

    public function saveUnitProgram(){
        try {
            DB::beginTransaction();
            //ToDo: Delete mock session
            SessionMock::setMockSession();
            $unitProgram = $this->mapUnitProgram();
            $unitProgram->save();
            //dd($program);//ojo
            $this->addError('successSaved', 'El registro fue guardado exitosamente');
            DB::commit();
            $this->mount($this->programId);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function mapUnitProgram(): UnidadPrograma{
        $unitProgram = new UnidadPrograma();
        $unpr_esfacultad;
        if ($this->isFaculty == null){
            $unpr_esfacultad = 0;
        } else {
            $unpr_esfacultad = $this->isFaculty;
        }

        $unitProgram->fill([
            'unpr_relacion' => $this->relationType,
            'unpr_fechacambio' => Carbon::now(),
            'unpr_registradopor' => Session::get('pegeId'),
            'prog_id' => $this->programId,
            'unid_id' => $this->unit,
            'unpr_esfacultad' => $unpr_esfacultad,
        ]);
        return $unitProgram;
    }    
}
