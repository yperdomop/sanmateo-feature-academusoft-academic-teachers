<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManageCausesUtils;
use Livewire\Component;

class ManageCauses extends Component
{
    use ManageCausesUtils;

    public $causes;

    public function mount()
    {
        $this->causes = $this->getCausesList();
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision-data-management.manage-causes')
            ->extends('layouts.mainLayout', ['title' => 'Menu', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function redirectCreateCause()
    {
        $this->redirectRoute("administrarDatosAtencionCreated");
    }
}
