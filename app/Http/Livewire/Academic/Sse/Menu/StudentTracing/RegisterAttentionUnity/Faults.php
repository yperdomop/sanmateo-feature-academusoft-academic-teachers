<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use App\Http\Utils\Database\Student\RegisterAttentionUnit\FaultsUtils;
use Livewire\Component;

class Faults extends Component
{
    use AttentionUnitUtils, FaultsUtils;

    public $estpId;
    public $dataStudent;
    public $faults;
    public $faultsDeleted;

    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->faults = $this->getFaults($estpId);
        $this->faultsDeleted = $this->getFaultsDeletedByExcuses($estpId);
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.faults')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }
}
