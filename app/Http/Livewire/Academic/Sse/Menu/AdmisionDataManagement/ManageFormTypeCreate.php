<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManageTypeFormUtils;
use Livewire\Component;

class ManageFormTypeCreate extends Component
{
    use ManageTypeFormUtils;

    public $nameToSave = "";

    protected $rules = [
        'nameToSave' => 'required'
    ];
    protected $messages = [
        'nameToSave.required' => 'es requerido'
    ];

    public function render()
    {
        return view('livewire.academic.sse.menu.admision-data-management.manage-form-type-create')
            ->extends('layouts.mainLayout', ['title' => 'Administrar datos admisión', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function insert(){
        $this->validate();
        $saved = $this->createRegister($this->nameToSave);
        if($saved){
            session()->flash('typeSaved', 'Registrado correctamente');
        }else{
            session()->flash('typeSavedFail', 'No se registro correctamente');
        }
    }
}
