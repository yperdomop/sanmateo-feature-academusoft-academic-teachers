<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManageTypeFormUtils;
use Livewire\Component;

class ManageFormTypeEdit extends Component
{
    use ManageTypeFormUtils;

    public $tfId;
    public $type;
    public $nameToSave = "";

    protected $rules = [
        'nameToSave' => 'required'
    ];
    protected $messages = [
        'nameToSave.required' => 'es requerido'
    ];

    public function mount($tfId)
    {
        $this->tfId = $tfId;
        $this->type = $this->getDataById($tfId);

        if(count($this->type)>0){
            $this->nameToSave = $this->type["tf_nombre"];
        }
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision-data-management.manage-form-type-edit')
            ->extends('layouts.mainLayout', ['title' => 'Administrar datos admisión', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function edit(){
        $this->validate();
        $saved = $this->updateRegister($this->tfId,$this->nameToSave);
        if($saved){
            session()->flash('typeSaved', 'Registrado correctamente');
        }else{
            session()->flash('typeSavedFail', 'No se registro correctamente');
        }
    }
}
