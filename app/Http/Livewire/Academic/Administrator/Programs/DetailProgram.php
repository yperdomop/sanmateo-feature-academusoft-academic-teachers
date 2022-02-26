<?php

namespace App\Http\Livewire\Academic\Administrator\Programs;

use App\Models\Academic\Programa;
use App\Models\Academic\Modalidad;
use App\Models\Academic\Metodologia;
use App\Models\Academic\Jornada;
use App\Models\Academic\TipoPeriodoAcademico;
use App\Models\Academic\Unidad;
use App\Models\Academic\UnidadPrograma;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class DetailProgram extends Component
{
    public $programSystem;
    public $programId;
    public $date;
    public $modalityDescription;
    public $methodDescription;
    public $workDayDescription;
    public $typeAcademicPeriod;
    public array $unitPrograms;
    public $nameUnit;
    public $deletingId;

    public function mount(int $programId)
    {
        $this->programId = $programId;
        $this->deletingId = 0;
        $this->programSystem = Programa::find($programId);
        //formatear fecha
        $this->date = Carbon::parse($this->programSystem->prog_fechaaprobacionicfes);
        $this->date = $this->date->format('Y-m-d');

        //buscar nombre por ID
        $modality = Modalidad::find($this->programSystem->moda_id);
        $this->modalityDescription = $modality->moda_descripcion;

        $method = Metodologia::find($this->programSystem->meto_id);
        $this->methodDescription = $method->meto_descripcion;

        $workDay = Jornada::find($this->programSystem->jorn_id);
        $this->workDayDescription = $workDay->jorn_descripcion;

        $academicPeriodType = TipoPeriodoAcademico::find($this->programSystem->tppa_id);
        $this->typeAcademicPeriod = $academicPeriodType->tppa_descripcion;

        $this->deletingId = 0;
        $this->loadUnitProgram();
    }

    public function render()
    {
        return view('livewire.academic.administrator.programs.detail-program')
        ->extends('layouts.mainLayout', ['title' => 'Detalle Programa', 'rol' => 'Administrador'])
        ->section('content');
    }

    public function editProgram(){
        return redirect(route('administrator.editProgram', ['programId' => $this->programId]));
    }

    public function associateUnit()
    {
        return redirect(route('administrator.associateUnit', ['programId' => $this->programId]));
    }

    public function editUnitProgram(int $unitprogramId)
    {
        return redirect()->route('administrator.editunitprogram', ['programId' => $this->programId, 'unitProgramId' => $unitprogramId]);
    }

    //Confirma eliminación
    public function confirmingDelete(int $unitprogramId) {
        $this->loadUnitProgram();
        $this->deletingId = $unitprogramId;
    }

    //Eliminar registro
    public function deleteUnitProgram() {
        try {
            $UnitProgramToDelete = UnidadPrograma::find($this->deletingId);
            DB::beginTransaction();
            $UnitProgramToDelete->delete();
            DB::commit();
            $this->mount($this->programId);
            $this->addError('successMessage', 'La relación con la unidad se eliminó correctamente');

        } catch (\Throwable $th) {
            $this->addError('errorMessage', 'Ocurrió un error al eliminar el registro, existen asociaciones al mismo.');
            DB::rollBack();
        }
    }

    public function loadUnitProgram()
    {
        $this->unitPrograms = $this->programSystem->unidadPrograma($this->programId);
    }
}
