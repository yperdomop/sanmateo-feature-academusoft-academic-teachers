<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use App\Http\Utils\Database\Student\RegisterAttentionUnit\LiquidationUtils;
use Livewire\Component;

class Liquidation extends Component
{
    use AttentionUnitUtils, LiquidationUtils;

    public $estpId;
    public $dataStudent;
    //saldo
    public $balance;
    public $liquidation;

    public function mount($estpId)
    {
        $this->estpId = $estpId;
        $this->dataStudent = $this->getListStudentsByDocAndName(null, null, $estpId)->first();
        $this->balance = $this->getBalance($estpId);
        $this->liquidation = $this->getLiquidation($estpId);
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.liquidation')
            ->extends('layouts.academic.sse.mainLayoutSse', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png','dataStudent'=>$this->dataStudent])
            ->section('contentRegisterAttention');
    }

    public function getDetailLiqu($liquId)
    {
       return $this->getLiquidationDetail($this->estpId,$liquId);
    }
}
