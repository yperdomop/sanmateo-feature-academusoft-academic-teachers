<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use Livewire\Component;

class RegisterAttention extends Component
{
    use AttentionUnitUtils;


    public $estpId;
    public $attentionsByEstpId;
    public $dataStudent;
    public $attentionWays;
    public $typeAttention;
    public $dependecyTo;
    public $selectedTypeAttention;
    public $observationCase;
    public $requirementType;
    public $dependencyToValue;
    public $attentionWaysValue;
    public $caseStatus;


    protected $rules = [
        'selectedTypeAttention' => 'required',
        'observationCase' => 'required',
        'requirementType' => 'required',
        'dependencyToValue' => 'required',
        'attentionWaysValue' => 'required',
        'caseStatus' => 'required',
    ];
    protected $messages = [
        'selectedTypeAttention.required' => 'es requerido',
        'observationCase.required' => 'es requerido',
        'requirementType.required' => 'es requerido',
        'dependencyToValue.required' => 'es requerido',
        'attentionWaysValue.required' => 'es requerido',
        'caseStatus.required' => 'es requerido',
    ];

    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->attentionWays = $this->getAttetionWays();
        $this->typeAttention = $this->getTypesAttention();
        $this->attentionsByEstpId = $this->getAttentionsByEstpId($estpId);
        $this->dependecyTo = [];
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.register-attention',[
            'dataStudent'=>$this->dataStudent,
            'typeAttention'=>$this->typeAttention,
            'dependecyTo' => $this->dependecyTo,
            'attentionWays' => $this->attentionWays,
            'attentionsByEstpId' => $this->attentionsByEstpId
            ])
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
            'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }

    public function setTypeAttention()
    {
        $this->dependecyTo = $this->getAddressedTo($this->selectedTypeAttention);
//        dump($this->dependecyTo);
    }

    public function saveCase()
    {
        $this->validate();
        $arrayToSave=[
            "selectedTypeAttention"=>$this->selectedTypeAttention,
            "observationCase"=>$this->observationCase,
            "requirementType"=>$this->requirementType,
            "dependencyToValue"=>$this->dependencyToValue,
            "attentionWaysValue"=>$this->attentionWaysValue,
            "caseStatus"=>$this->caseStatus,
            "estpId" => $this->estpId,
            "pege_id" => $this->dataStudent["pege_id"]
        ];
        $save = $this->insertCase($arrayToSave);
//        $save = true;
        //se setea una unidad por defecto mietras se soluciona lo del login
        $this->insertCaseDependencyStudent($arrayToSave,$save,3556);
        if($save){
            session()->flash('messageSaved', 'Registrado correctamente');
        }
        $this->attentionsByEstpId = $this->getAttentionsByEstpId($this->estpId);

    }
}
