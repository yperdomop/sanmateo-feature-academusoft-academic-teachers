<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use App\Http\Utils\Database\Student\RegisterAttentionUnit\MayoredPetitionsUtils;
use Livewire\Component;

class MayoredPetitions extends Component
{
    use AttentionUnitUtils, MayoredPetitionsUtils;

    public $estpId;
    public $dataStudent;
    public $requests;
    public $statusRequest;

    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->requests = $this->getPetitions($estpId)->first();
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.mayored-petitions')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }
}
