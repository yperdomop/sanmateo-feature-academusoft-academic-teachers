<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use Livewire\Component;

class MenuRegisterAttention extends Component
{
    public $estpId;
    public $activeMenu;
    public function mount($tab = "",$estpId)
    {
        $this->estpId = $estpId;
        $this->activeMenu = $tab;
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention');
    }
}
