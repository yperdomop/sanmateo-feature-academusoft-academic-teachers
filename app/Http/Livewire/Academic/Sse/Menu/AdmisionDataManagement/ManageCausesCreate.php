<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManageCausesUtils;
use Livewire\Component;

class ManageCausesCreate extends Component
{
    use ManageCausesUtils;

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
        return view('livewire.academic.sse.menu.admision-data-management.manage-causes-create')
            ->extends('layouts.mainLayout', ['title' => 'Administrar datos admisión', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function insertCause(){
        $this->validate();
        $saved = $this->createCause($this->nameToSave);
        if($saved){
            session()->flash('causeSaved', 'Registrado correctamente');
        }else{
            session()->flash('causeSavedFail', 'No se registro correctamente');
        }
    }
}
