<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use App\Http\Utils\Database\Student\RegisterAttentionUnit\DisciplinatyUtil;
use Livewire\Component;

class Disciplinary extends Component
{
    use AttentionUnitUtils, DisciplinatyUtil;

    public $estpId;
    public $dataStudent;
    public $disciplinary;

    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->disciplinary = $this->getDisciplinary($estpId);
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.disciplinary')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }
}
