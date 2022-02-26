<?php

namespace App\Http\Livewire\Academic\Administrator\EvaluationSystem;

use App\Http\Utils\Session\SessionMock;
use App\Models\Academic\SistemaEvaluacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateEvaluationSystem extends Component
{
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


    public function mount() {
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
        $this->description = '';
        $this->passingQualification = '';
        $this->nonPassingQualification = '';
        $this->weightFinalScore = 0;
        $this->weightEnabling = 0;
        $this->showWeights = false;

    }

    public function render()
    {
        return view('livewire.academic.administrator.evaluation-system.create-evaluation-system')
        ->extends('layouts.mainLayout', ['title' => 'Crear Sistema de Evaluación', 'rol' => 'Administrador'])
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
                $evaluationSystem = $this->mapEvaluationSystem();
                $evaluationSystem->save();
                $this->addError('successSaved', 'El registro fue guardado exitosamente');
                $this->mount();
                DB::commit();
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    private function mapEvaluationSystem(): SistemaEvaluacion {
        $evaluationSystem =  new SistemaEvaluacion;
        $evaluationSystem->fill([
            'SIEV_DESCRIPCION' => strtoupper($this->description),
            'SIEV_REGISTRADOPOR' => Session::get('pegeId'),
            'SIEV_FECHACAMBIO' => Carbon::now(),
            'NORG_ID' => self::DEFAULT_NORG_ID,
            'SIEV_PESODEFINITIVA' => ($this->weightFinalScore > 0) ? $this->weightFinalScore : null,
            'SIEV_PESOHABILITACION' => ($this->weightEnabling > 0) ? $this->weightEnabling : null,
            'SIEV_PARHABAPR' => $this->passingQualification,
            'SIEV_PARHABNAPR' => $this->nonPassingQualification,
        ]);
        return $evaluationSystem;

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
}
