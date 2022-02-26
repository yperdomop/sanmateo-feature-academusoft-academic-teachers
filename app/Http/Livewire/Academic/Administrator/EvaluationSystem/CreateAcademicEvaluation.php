<?php

namespace App\Http\Livewire\Academic\Administrator\EvaluationSystem;

use App\Http\Utils\Session\SessionMock;
use App\Models\Academic\EvaluacionAcademico;
use App\Models\Academic\SistemaEvaluacion;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CreateAcademicEvaluation extends Component
{
    public SistemaEvaluacion $evaluationSystem;
    public int $evaluationSystemId;
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

    public function mount($evaluationSystemId) {
        $this->evaluationSystem = SistemaEvaluacion::find($evaluationSystemId);
        $savedOrders = $this->evaluationSystem->evaluacionAcademico()->get()->pluck('evac_orden');
        $this->orders = collect($this->orders)->diff($savedOrders)->toArray();
        $this->evaluationSystemId = $evaluationSystemId;
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
            $academicEvaluation = $this->mapAcademicEvaluation();
            $academicEvaluation->save();
            $this->addError('successSaved', 'El registro fue agregado exitosamente');
            DB::commit();
            return redirect(route('administrator.detailEvaluationSystem', ['evaluationSystemId' => $this->evaluationSystemId]));
        } catch(\Throwable $th) {
            $this->addError('errorSaved', 'Ocurrió un problema al guardar el registro');
            DB::rollBack();
            throw $th;
        }
    }

    public function mapAcademicEvaluation(): EvaluacionAcademico {
        $academicEvaluation = new EvaluacionAcademico;
        $academicEvaluation->fill([
            'EVAC_DESCRIPCION' => strtoupper($this->description),
            'EVAC_PESO' => $this->weight,
            'EVAC_OPCIONAL' => $this->isOptional,
            'SIEV_ID' => $this->evaluationSystemId,
            'EVAC_REGISTRADOPOR' => Session::get('pegeId'),
            'EVAC_FECHACAMBIO' => Carbon::now(),
            'EVAC_ORDEN' => $this->order,
            'EVAC_ALCANCE' => $this->target,
            'EVAC_TIPO' => $this->type,
            'EVAC_ESFINAL' => $this->isFinal,
        ]);
        return $academicEvaluation;
    }
}
