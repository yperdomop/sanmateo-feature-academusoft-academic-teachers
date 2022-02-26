<?php

namespace App\Http\Livewire\Academic\Sse\Menu\Admision;

use Livewire\Component;

class MenuAdmissionGeneral extends Component
{
    public $foinId;
    public $activeMenu;
    public function mount($tab = "",$foinId)
    {
        $this->foinId = $foinId;
        $this->activeMenu = $tab;
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision.menu-admission-general');
    }
}
