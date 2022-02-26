<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use \App\Http\Utils\Database\Student\RegisterAttentionUnit\DocumentsUtil;
use Livewire\Component;

class Documents extends Component
{
    use AttentionUnitUtils, DocumentsUtil;

    public $estpId;
    public $dataStudent;
    public $studentDocs;
    public $formDocs;
    public $homoDocs;

    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->studentDocs = $this->getStudentDocuments($estpId);
        $this->formDocs = $this->getFormDocs($estpId);
        $this->homoDocs = $this->getHomoDocs($estpId);
        dump($this->formDocs);
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.documents')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }
}
