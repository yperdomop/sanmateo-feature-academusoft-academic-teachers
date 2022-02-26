<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use App\Http\Utils\Database\Student\RegisterAttentionUnit\PendingSubjectsUtils;
use Livewire\Component;

class PendingSubjects extends Component
{
    use AttentionUnitUtils, PendingSubjectsUtils;

    public $estpId;
    public $dataStudent;
    public $pendingSub;

    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->pendingSub = $this->getPendingSubjects($estpId);
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.pending-subjects')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }
}
