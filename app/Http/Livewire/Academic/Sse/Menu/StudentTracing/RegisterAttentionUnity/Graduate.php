<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use App\Http\Utils\Database\Student\RegisterAttentionUnit\GraduateUtil;
use Livewire\Component;

class Graduate extends Component
{
    use AttentionUnitUtils, GraduateUtil;

    public $estpId;
    public $dataStudent;
    public $dataGraduate;

    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->dataGraduate = $this->getDataGraduate($estpId)->first();
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.graduate')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }
}
