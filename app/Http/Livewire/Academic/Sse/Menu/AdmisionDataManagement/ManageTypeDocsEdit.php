<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManageTypeDocsUtils;
use Livewire\Component;

class ManageTypeDocsEdit extends Component
{
    use ManageTypeDocsUtils;

    public $tiId;
    public $type;
    public $nameToSave = "";

    protected $rules = [
        'nameToSave' => 'required'
    ];
    protected $messages = [
        'nameToSave.required' => 'es requerido'
    ];

    public function mount($tiId)
    {
        $this->tiId = $tiId;
        $this->type = $this->getDataById($tiId);

        if(count($this->type)>0){
            $this->nameToSave = $this->type["ti_nombre"];
        }
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision-data-management.manage-type-docs-edit')
            ->extends('layouts.mainLayout', ['title' => 'Administrar datos admisión', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function edit(){
        $this->validate();
        $saved = $this->updateRegister($this->tiId,$this->nameToSave);
        if($saved){
            session()->flash('typeSaved', 'Registrado correctamente');
        }else{
            session()->flash('typeSavedFail', 'No se registro correctamente');
        }
    }
}
