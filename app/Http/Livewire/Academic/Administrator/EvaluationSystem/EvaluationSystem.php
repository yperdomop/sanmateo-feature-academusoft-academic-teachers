<?php

namespace App\Http\Livewire\Academic\Administrator\EvaluationSystem;

use App\Models\Academic\EvaluacionAcademico;
use App\Models\Academic\SistemaEvaluacion;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EvaluationSystem extends Component
{

    public Collection $evaluationSystems;
    public int $deletingId = 0;

    public function mount() {
        $this->evaluationSystems = SistemaEvaluacion::orderBy('siev_descripcion')->get();
    }

    public function render()
    {
        return view('livewire.academic.administrator.evaluation-system.evaluation-system')
        ->extends('layouts.mainLayout', ['title' => 'Sistema de Evaluación', 'rol' => 'Administrador'])
        ->with(['evaluationSystems' => $this->evaluationSystems])
        ->section('content');
    }

    public function createEvaluationSystem() {
        return redirect(route('administrator.createEvaluationSystem'));
    }

    public function detailEvaluationSystem(int $evaluationSystemId) {
        return redirect(route('administrator.detailEvaluationSystem', ['evaluationSystemId' => $evaluationSystemId]));
    }

    public function confirmingDelete(int $evaluationSystemId) {
        $this->deletingId = $evaluationSystemId;
    }


    public function deleteEvaluationSystem() {
        try {
            $evaluationSystemToDelete = SistemaEvaluacion::find($this->deletingId);
            DB::beginTransaction();
            $this->deleteScoreCualitative($evaluationSystemToDelete->siev_id);
            $evaluationSystemToDelete->delete();
            $this->mount();
            DB::commit();
            $this->addError('successMessage', 'Se eliminó exitosamente el sistema de evaluación : '.$evaluationSystemToDelete->siev_descripcion);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->addError('errorMessage', 'Lo sentimos, el sistema de evaluación ya tiene otros registros asociados, no se puede eliminar.');
        }
    }

    private function deleteScoreCualitative(int $evaluationSystemId): bool {
        return EvaluacionAcademico::where('siev_id', $evaluationSystemId)->delete();
    }
}
