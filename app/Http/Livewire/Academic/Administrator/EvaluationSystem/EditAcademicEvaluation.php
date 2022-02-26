<?php

namespace App\Http\Livewire\Academic\Administrator\EvaluationSystem;

use App\Http\Utils\Session\SessionMock;
use App\Models\Academic\EvaluacionAcademico;
use App\Models\Academic\SistemaEvaluacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class EditAcademicEvaluation extends Component
{
    public EvaluacionAcademico $academicEvaluation;
    public SistemaEvaluacion $evaluationSystem;
    public int $evaluationSystemId;
    public int $academicEvaluationId;
    public string $description = '';
    public string $weight = '';
    public string $order = '';
    public string $target = '';
    public string $type = '';
    public bool $isOptional = false;
    public bool $isFinal = false;


    public array $academicEvaluationTargets = [
        'INSTITUCION',
        'GRUPO'
    ];

    public array $academicEvaluationTypes = [
        'PARCIAL TEORICO',
        'PARCIAL PRACTICO',
        'HABILITACION'
    ];

    protected array $rules = [
        'description' => 'required',
        'weight' => 'required',
        'order' => 'required',
        'target' => 'required',
        'type' => 'required',
    ];

    public array $academicEvaluationNames = [
        'description' => 'Descripción',
        'weight' => 'Peso',
        'order' => 'Orden',
        'target' => 'Alcance',
        'type' => 'Tipo Evaluación',
    ];

    public array $orders = [
        1,2,3,4,5,6,7,8,9,10,11,12,13,14,15
    ];

    public function mount($evaluationSystemId, $academicEvaluationId) {
        $this->evaluationSystem = SistemaEvaluacion::find($evaluationSystemId);
        $this->academicEvaluation = EvaluacionAcademico::find($academicEvaluationId);
        $this->mapExistentAcademicEvaluation();
        $savedOrders = $this->evaluationSystem->evaluacionAcademico()->get()->pluck('evac_orden');

        $this->orders = collect($this->orders)->diff($savedOrders)->toArray();
        $this->orders[$this->academicEvaluation->evac_orden] = $this->academicEvaluation->evac_orden;
        $this->evaluationSystemId = $evaluationSystemId;
        $this->academicEvaluationId = $academicEvaluationId;
    }

    public function render()
    {
        return view('livewire.academic.administrator.evaluation-system.create-academic-evaluation')
        ->extends('layouts.mainLayout', ['title' => 'Crear Sistema de Evaluación', 'rol' => 'Administrador'])
        ->section('content');
    }

    public function saveAcademicEvaluation() {
        try {
            //ToDO: eliminar mock
            SessionMock::setMockSession();
            DB::beginTransaction();
            $this->validate(NULL, NULL, $this->academicEvaluationNames);
            $this->academicEvaluation = EvaluacionAcademico::find($this->academicEvaluationId);
            $this->mapAcademicEvaluation();
            $this->academicEvaluation->save();

            $this->addError('successSaved', 'El registro fue editado exitosamente');
            DB::commit();
            return redirect(route('administrator.detailEvaluationSystem', ['evaluationSystemId' => $this->evaluationSystemId]));
        } catch(\Throwable $th) {
            $this->addError('errorSaved', 'Ocurrió un problema al guardar el registro');
            DB::rollBack();
            dd($th);
            throw $th;
        }
    }

    private function mapExistentAcademicEvaluation() {
        $this->description = $this->academicEvaluation->evac_descripcion;
        $this->weight = $this->academicEvaluation->evac_peso;
        $this->isOptional = $this->academicEvaluation->evac_opcional;
        $this->order = $this->academicEvaluation->evac_orden;
        $this->target = $this->academicEvaluation->evac_alcance;
        $this->type = $this->academicEvaluation->evac_tipo;
        $this->isFinal = $this->academicEvaluation->evac_esfinal;
    }

    public function mapAcademicEvaluation() {
        $this->academicEvaluation->evac_descripcion = strtoupper($this->description);
        $this->academicEvaluation->evac_peso = $this->weight;
        $this->academicEvaluation->evac_opcional = $this->isOptional;
        $this->academicEvaluation->evac_registradopor = Session::get('pegeId');
        $this->academicEvaluation->evac_fechacambio = Carbon::now();
        $this->academicEvaluation->evac_orden = $this->order;
        $this->academicEvaluation->evac_alcance = $this->target;
        $this->academicEvaluation->evac_tipo = $this->type;
        $this->academicEvaluation->evac_esfinal = $this->isFinal;
    }
}
