<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use Livewire\Component;

class CaseStudent extends Component
{
    use AttentionUnitUtils;

    public $estpId;
    public $dataStudent;
    public $ceId;
    public $dataCase;
    public $caseHistory;
    public $typeAttention;
    public $selectedTypeAttention;
    public $attentionWays;
    public $solutionCase;
    public $dependencyToValue;
    public $attentionWaysValue;
    public $caseStatus;
    public $dependecyTo;
    public $studentCase;

    protected $rules = [
        'selectedTypeAttention' => 'required',
        'solutionCase' => 'required',
        'dependencyToValue' => 'required',
        'attentionWaysValue' => 'required',
        'caseStatus' => 'required',
    ];
    protected $messages = [
        'selectedTypeAttention.required' => 'es requerido',
        'solutionCase.required' => 'es requerido',
        'dependencyToValue.required' => 'es requerido',
        'attentionWaysValue.required' => 'es requerido',
        'caseStatus.required' => 'es requerido',
    ];



    public function mount ($estpId,$ceId)
    {
        $this->estpId = $estpId;
        $this->ceId = $ceId;
        $this->dependecyTo = [];
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->dataCase = $this->getCaseInformation($ceId)->first();
        $this->caseHistory = json_decode(json_encode($this->getCaseHistory($ceId)),true);
        $this->studentCase = json_decode(json_encode($this->getStudentCase($ceId)),true);
        $this->typeAttention = $this->getTypeAttentionByCaseId($this->studentCase);
        $this->attentionWays = $this->getAttetionWays();

    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.case-student')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }

    public function setTypeAttention()
    {
        $this->dependecyTo = $this->getAddressedTo($this->selectedTypeAttention);
    }

    public function saveSolution(){
        $this->validate();

        $arrayToSave=[
            "selectedTypeAttention"=>$this->selectedTypeAttention,
            "solutionCase"=>$this->solutionCase,
            "dependencyToValue"=>$this->dependencyToValue,
            "attentionWaysValue"=>$this->attentionWaysValue,
            "caseStatus"=>$this->caseStatus,
            "estpId" => $this->estpId,
            "ceId" => $this->ceId,
            "pegeId" => $this->dataStudent["pege_id"]
        ];
        $save = $this->insertSolutionCase($arrayToSave);
        $this->caseHistory = json_decode(json_encode($this->getCaseHistory($this->ceId)),true);
        if($save){
            session()->flash('caseDependencyUpdated', 'Caso Registrado correctamente');
        }else{
            session()->flash('caseDependencyUpdatedFailed', 'No existe un una respuesta pendiente');
        }

    }
}
