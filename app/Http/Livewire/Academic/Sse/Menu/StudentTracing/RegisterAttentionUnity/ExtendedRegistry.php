<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use App\Http\Utils\Database\Student\RegisterAttentionUnit\ExtendedRegistryUtil;
use App\Http\Utils\Database\Student\RegisterAttentionUnit\FaultsUtils;
use Livewire\Component;

class ExtendedRegistry extends Component
{
    use AttentionUnitUtils, ExtendedRegistryUtil;

    public $estpId;
    public $dataStudent;
    public $periods;

    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->periods = $this->getPeriodsOfRegistry($estpId);
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.extended-registry')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }

    public function getDetailRegistry($peunId)
    {
       return $this->getDetailByEstpIdAndPeriod($this->estpId,$peunId);
    }
}
