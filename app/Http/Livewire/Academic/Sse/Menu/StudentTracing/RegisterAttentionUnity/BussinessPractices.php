<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use App\Http\Utils\Database\Student\RegisterAttentionUnit\BussinessPracticesUtil;
use Livewire\Component;

class BussinessPractices extends Component
{
    use AttentionUnitUtils, BussinessPracticesUtil;

    public $estpId;
    public $dataStudent;
    public $practice;
    public $socialLabor;

    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->practice = $this->getPractice($estpId)->first();
        $this->socialLabor = $this->getSocialLabor($estpId)->first();
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.bussiness-practices')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }
}
