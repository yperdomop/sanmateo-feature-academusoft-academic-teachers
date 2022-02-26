<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManageTypeDocsUtils;
use Livewire\Component;

class ManageTypeDocs extends Component
{
    use ManageTypeDocsUtils;

    public $doc;

    public function mount(){
        $this->doc = $this->getList();
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision-data-management.manage-type-docs')
            ->extends('layouts.mainLayout', ['title' => 'Administrar datos admisión', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function redirectCreate()
    {
        $this->redirectRoute("administrarTipoDocCrear");
    }

    public function deleteData($conId)
    {
        $this->deleteRegistrer($conId);
        $this->redirectRoute("administrarTipoDoc");
    }
}
