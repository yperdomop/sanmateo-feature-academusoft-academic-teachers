<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManageTypeFormUtils;
use Livewire\Component;

class ManageFormType extends Component
{
    use ManageTypeFormUtils;

    public $form ;

    public function mount()
    {
        $this->form = $this->getList();
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision-data-management.manage-form-type')
            ->extends('layouts.mainLayout', ['title' => 'Administrar datos admisión', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function redirectCreate()
    {
        $this->redirectRoute("administrarTipoFormularioCrear");
    }

    public function deleteData($conId)
    {
        $this->deleteRegistrer($conId);
        $this->redirectRoute("administrarTipoFormulario");
    }
}
