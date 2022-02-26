<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use App\Http\Utils\Database\Student\RegisterAttentionUnit\PensumUtils;
use Livewire\Component;

class Pensum extends Component
{
    use AttentionUnitUtils, PensumUtils;

    public $estpId;
    public $dataStudent;
    public $periods;

    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->periods = $this->getPeriodByEstpId($estpId);

    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.pensum')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }

    public function getPensumByEstpIdAndPeriod($period){
       return $this->getDetailPensumByEstpIdAndPeriod($this->estpId,$period);
    }
}
