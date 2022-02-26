<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManageCovenantsUtils;
use Livewire\Component;

class ManageCovenantEdit extends Component
{
    use ManageCovenantsUtils;

    public $conId;
    public $coven;

    public $nameToSave = "";


    protected $rules = [
        'nameToSave' => 'required'
    ];
    protected $messages = [
        'nameToSave.required' => 'es requerido'
    ];

    public function mount($conId)
    {
        $this->conId = $conId;
        $this->coven = $this->getCovenById($conId);

        if(count($this->coven)>0){
            $this->nameToSave = $this->coven["con_nombre"];
        }

    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision-data-management.manage-covenant-edit')
            ->extends('layouts.mainLayout', ['title' => 'Administrar datos admisión', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function editCoven(){
        $this->validate();
        $saved = $this->updateCoven($this->conId,$this->nameToSave);
        if($saved){
            session()->flash('covenSaved', 'Registrado correctamente');
        }else{
            session()->flash('covenSavedFail', 'No se registro correctamente');
        }
    }

}
