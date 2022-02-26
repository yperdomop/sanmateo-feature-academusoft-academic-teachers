<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManageCovenantsUtils;
use Livewire\Component;

class ManageCovenant extends Component
{
    use ManageCovenantsUtils;

    public $coven;

    public function mount()
    {
        $this->coven = $this->getCovenants();
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision-data-management.manage-covenant')
            ->extends('layouts.mainLayout', ['title' => 'Administrar datos admisión', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function redirectCreateCovenant()
    {
        $this->redirectRoute("administrarConveniosCrear");
    }

    public function deleteData($conId)
    {
        $this->deleteCoven($conId);
        $this->redirectRoute("administrarConvenios");
    }
}
