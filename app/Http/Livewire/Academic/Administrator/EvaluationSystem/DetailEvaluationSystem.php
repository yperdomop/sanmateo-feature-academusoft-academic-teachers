<?php

namespace App\Http\Livewire\Academic\Administrator\EvaluationSystem;

use App\Models\Academic\EvaluacionAcademico;
use App\Models\Academic\SistemaEvaluacion;
use App\Models\General\NormaGeneral;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetailEvaluationSystem extends Component
{
    public int $evaluationSystemId;
    public int $deletingId;
    public string $ruleName;
    public SistemaEvaluacion $evaluationSystem;
    public NormaGeneral $generalRule;
    public Collection $academicEvaluations;


    public function mount(int $evaluationSystemId) {
        $this->evaluationSystem = SistemaEvaluacion::find($evaluationSystemId);
        $this->academicEvaluations = $this->evaluationSystem->evaluacionAcademico()->get()->sortBy('evac_orden');
        $this->generalRule = $this->evaluationSystem->normaGeneral()->get()->first();
        $this->ruleName = $this->generalRule->norg_numero. ' - '. $this->generalRule->norg_descripcion;
        $this->evaluationSystemId = $evaluationSystemId;
        $this->deletingId = 0;
        $this->addingEvaluation = false;
        $this->editingEvaluations = false;
    }

    public function render()
    {
        return view('livewire.academic.administrator.evaluation-system.detail-evaluation-system')
        ->extends('layouts.mainLayout', ['title' => 'Detalle Sistema de Evaluación', 'rol' => 'Administrador'])
        ->section('content');
    }

    public function editEvaluationSystem() {
        return redirect(route('administrator.editEvaluationSystem', ['evaluationSystemId' => $this->evaluationSystemId]));
    }

    public function addEvaluation() {
        return redirect(route('administrator.createAcademicEvaluation', ['evaluationSystemId' => $this->evaluationSystemId]));
    }

    public function editEvaluation(int $academicEvaluationId) {
        return redirect(route('administrator.editAcademicEvaluation', ['evaluationSystemId' => $this->evaluationSystemId, 'academicEvaluationId' => $academicEvaluationId ]));
    }

    public function confirmingDelete(int $academicEvaluationId) {
        $this->deletingId = $academicEvaluationId;
    }

    public function deleteAcademicEvaluation() {
        try {
            DB::beginTransaction();
            EvaluacionAcademico::destroy($this->deletingId);
            DB::commit();
            $this->mount($this->evaluationSystemId);
            $this->addError('successMessage', 'La evaluación se eliminó correctamente');
        } catch (\Throwable $th) {
            $this->addError('errorMessage', 'Ocurrió un error al eliminar el registro, existen asociaciones al mismo.');
            DB::rollBack();
        }
    }

}
