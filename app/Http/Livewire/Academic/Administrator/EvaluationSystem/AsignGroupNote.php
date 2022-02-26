<?php

namespace App\Http\Livewire\Academic\Administrator\EvaluationSystem;

use App\Http\Utils\Database\Group\GroupAcademicSystem;
use App\Http\Utils\Session\SessionMock;
use App\Models\Academic\Nota;
use App\Models\Academic\SistemaEvaluacion;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AsignGroupNote extends Component
{
    const DEFAULT_WEIGHT = 100;

    use GroupAcademicSystem;
    public int $selectedEvaluationSystem;
    public array $evaluationSystems;
    public array $groupsWithSubjects;
    public array $selectedGroups;
    public Collection $academicEvaluations;

    public function mount() {
        $this->selectedEvaluationSystem = 0;
        $this->evaluationSystems = SistemaEvaluacion::all()->pluck('siev_descripcion', 'siev_id')->toArray();
        $this->groupsWithSubjects = [];
        $this->selectedGroups = [];
    }

    public function render()
    {
        return view('livewire.academic.administrator.evaluation-system.asign-group-note')
        ->extends('layouts.mainLayout', ['title' => 'Asignar Grupo nota', 'rol' => 'Administrador'])
        ->section('content');
    }

    public function selectEvaluationSystem() {
        $groupsWithSubjects = $this->getUnrolledGroupsToAcademicSystem($this->selectedEvaluationSystem);
        $this->selectedGroups = $groupsWithSubjects->pluck(true, 'groupid')->transform(function ($value, $key){
            return true;
        })->toArray();
        $this->groupsWithSubjects = $groupsWithSubjects->toArray();
    }

    public function asignGroupNote() {
        //ToDo: Delete session mock
        DB::beginTransaction();
        try {
            SessionMock::setMockSession();
            $this->academicEvaluations = SistemaEvaluacion::find($this->selectedEvaluationSystem)->evaluacionAcademico()->get();
            $notesToAdd = [];
            foreach ($this->groupsWithSubjects as $key => $group) {
                $wasChecked = $this->selectedGroups[$group['groupid']];
                if($wasChecked) {
                    foreach ($this->academicEvaluations as $key => $academicEvaluation) {
                        array_push($notesToAdd, [
                            'NOTA_DESCRIPCION' => $academicEvaluation->evac_descripcion,
                            'NOTA_PESO' => self::DEFAULT_WEIGHT,
                            'NOTA_REGISTRADOPOR' => Session::get('pegeId'),
                            'NOTA_FECHACAMBIO' => Carbon::now()->format('Y-m-d H:i:s'),
                            'EVAC_ID' => $academicEvaluation->evac_id,
                            'GRUP_ID' => $group['groupid']
                        ]);
                    }
                }
            }
            Nota::insert($notesToAdd);
            $this->addError('successSaved', 'Las notas fueron registradas exitósamente');
            $this->mount();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->addError('errorSaved', 'Ocurrió un problema al guardar el registro');

        }

    }
}
