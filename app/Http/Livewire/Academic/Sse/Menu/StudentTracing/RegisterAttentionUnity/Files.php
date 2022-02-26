<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use App\Http\Utils\Database\Student\RegisterAttentionUnit\FilesUtils;
use Livewire\Component;

class Files extends Component
{
    use AttentionUnitUtils, FilesUtils;

    public $estpId;
    public $dataStudent;
    public $typeCases;

    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->typeCases = $this->getTypeCase($estpId);
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.files')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }

    public function getFilesByCeId($ceId)
    {
        return $this->getTypeCaseByCaseId($this->estpId,$ceId);
    }
}
