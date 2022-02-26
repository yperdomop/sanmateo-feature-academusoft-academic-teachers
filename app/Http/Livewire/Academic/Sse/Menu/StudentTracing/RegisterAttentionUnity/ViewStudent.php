<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use Livewire\Component;

class ViewStudent extends Component
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





    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
//        $this->attentionWays = $this->getAttetionWays();
//        $this->typeAttention = $this->getTypesAttention();
//        $this->attentionsByEstpId = $this->getAttentionsByEstpId($estpId);
//        $this->attentionsByEstpId = [];
//        dd($this->attentionsByEstpId);
//        $this->dependecyTo = [];
    }


    public function render()
    {
         //        dump($this->dataStudent);
         //        dump($this->typeAttention);
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.view-student')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }

}
