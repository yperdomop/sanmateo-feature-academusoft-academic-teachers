<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\ActualScoresUtil;
use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use Livewire\Component;

class ActualScores extends Component
{
    use AttentionUnitUtils, ActualScoresUtil;

    public $estpId;
    public $dataStudent;
    public $scores;

    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->scores = $this->getScores($estpId);
        dump($this->scores);
    }


    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.actual-scores')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }
}
