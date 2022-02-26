<?php

namespace App\Http\Livewire\Academic\Administrator\EvaluationSystem;

use App\Http\Utils\Session\SessionMock;
use App\Models\Academic\SistemaEvaluacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EditEvaluationSystem extends Component
{
    public SistemaEvaluacion $evaluationSystem;
    public int $evaluationSystemId;
    public bool $confirmingSave = false;
    public bool $showWeights = false;
    public string $description;
    public string $passingQualification;
    public string $nonPassingQualification;
    public ?string $weightFinalScore;
    public ?string $weightEnabling;

    public array $passingQualifications = [];
    public array $nonPassingQualifications = [];

    const DEFAULT_NORG_ID = 1007;

    protected array $rules = [
        'description' => 'required',
        'passingQualification' => 'required',
        'nonPassingQualification' => 'required'
    ];
    const VALIDATOR_NAMES = [
        'description' => 'Descripción',
        'passingQualification' => 'Habilitación Aprobatoria',
        'nonPassingQualification' => 'Habilitación no Aprobatoria',
        'weightFinalScore' => 'Peso nota Final o Práctica',
        'weightEnabling' => 'Peso Habilitación',
    ];


    public function mount(int $evaluationSystemId) {
        $this->passingQualifications = [
            'APROBATORIA' => 'NOTA APROBATORIA',
            'HABILITACION' => 'NOTA HABILITACIÓN',
            'PROMEDIO' => 'PROMEDIO',
            'PROMEDIO CON NOTA PRACTICA' => 'PROMEDIO CON NOTA PRÁCTICA',
        ];

        $this->nonPassingQualifications = [
            'FINAL' => 'NOTA FINAL',
            'MAYOR' => 'NOTA MAYOR',
            'HABILITACION' => 'NOTA HABILITACIÓN',
            'PROMEDIO' => 'PROMEDIO',
            'PROMEDIO CON NOTA PRACTICA' => 'PROMEDIO CON NOTA PRÁCTICA',
        ];
        $this->evaluationSystem = SistemaEvaluacion::find($evaluationSystemId);
        $this->evaluationSystemId = $evaluationSystemId;
        $this->mapGettedEvaluationSystem();
    }

    public function render()
    {
        return view('livewire.academic.administrator.evaluation-system.create-evaluation-system')
        ->extends('layouts.mainLayout', ['title' => 'Editar Sistema de Evaluación', 'rol' => 'Administrador'])
        ->section('content');
    }

    public function canShowWeights() {
        if(str_contains($this->nonPassingQualification, 'PROMEDIO') || str_contains($this->passingQualification, 'PROMEDIO')) {
            $this->showWeights = true;
        } else {
            $this->weightFinalScore = 0;
            $this->weightEnabling = 0;
            $this->showWeights = false;
        }

    }

    public function saveEvaluationSystem() {
        try {
            DB::beginTransaction();
            //ToDo: Delete mock session
            SessionMock::setMockSession();
            $this->validate(NULL, NULL, self::VALIDATOR_NAMES);
            if(!$this->validateWeights()) {
                $this->evaluationSystem = SistemaEvaluacion::find($this->evaluationSystemId);
                $this->mapEvaluationSystem();
                $this->evaluationSystem->save();
                DB::commit();
                session()->flash('successSaved', 'El registro fue editado exitosamente');
                return redirect(route('administrator.detailEvaluationSystem', ['evaluationSystemId' => $this->evaluationSystemId]));
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    private function mapEvaluationSystem(): void {
        $this->evaluationSystem->siev_descripcion = $this->description;
        $this->evaluationSystem->siev_parhabapr = $this->passingQualification;
        $this->evaluationSystem->siev_parhabnapr = $this->nonPassingQualification;
        $this->evaluationSystem->siev_pesodefinitiva = ($this->weightFinalScore > 0) ? $this->weightFinalScore : null;
        $this->evaluationSystem->siev_pesohabilitacion = ($this->weightEnabling > 0) ? $this->weightEnabling : null;
        $this->evaluationSystem->siev_registradopor = Session::get('pegeId');
        $this->evaluationSystem->siev_fechacambio = Carbon::now();
    }

    private function validateWeights(): bool {
        if($this->showWeights) {
            $this->resetValidation();
            $validator = Validator::make(['weightFinalScore' => $this->weightFinalScore, 'weightEnabling' => $this->weightEnabling], [
                'weightFinalScore' => 'required|numeric|min:1',
                'weightEnabling' => 'required|numeric|min:1',
            ]);
            $validator->setAttributeNames(self::VALIDATOR_NAMES);
            $this->setErrorBag($validator->errors()->messages());
            return $validator->fails();
        }
        return false;
    }

    private function mapGettedEvaluationSystem() {
        $this->description = $this->evaluationSystem->siev_descripcion;
        $this->passingQualification = $this->evaluationSystem->siev_parhabapr;
        $this->nonPassingQualification = $this->evaluationSystem->siev_parhabnapr;
        $this->weightFinalScore = $this->evaluationSystem->siev_pesodefinitiva ?? 0;
        $this->weightEnabling = $this->evaluationSystem->siev_pesohabilitacion ?? 0;
        $this->canShowWeights();
    }
}
