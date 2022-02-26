<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManageCovenantsUtils;
use Livewire\Component;

class ManageCovenantCreate extends Component
{
    use ManageCovenantsUtils;

    public $nameToSave = "";

    protected $rules = [
        'nameToSave' => 'required'
    ];
    protected $messages = [
        'nameToSave.required' => 'es requerido'
    ];

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision-data-management.manage-covenant-create')
            ->extends('layouts.mainLayout', ['title' => 'Administrar datos admisión', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function insert(){
        $this->validate();
        $saved = $this->createCoven($this->nameToSave);
        if($saved){
            session()->flash('covenSaved', 'Registrado correctamente');
        }else{
            session()->flash('covenSavedFail', 'No se registro correctamente');
        }
    }
}
