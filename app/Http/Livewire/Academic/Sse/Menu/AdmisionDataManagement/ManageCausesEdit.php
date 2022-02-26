<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManageCausesUtils;
use Livewire\Component;

class ManageCausesEdit extends Component
{
    use ManageCausesUtils;

    public $causeId;
    public $cause;

    public $nameToSave = "";


    protected $rules = [
        'nameToSave' => 'required'
    ];
    protected $messages = [
        'nameToSave.required' => 'es requerido'
    ];

    public function mount($cauId)
    {
        $this->causeId = $cauId;
        $this->cause = $this->getCauseById($cauId);

        if(count($this->cause)>0){
            $this->nameToSave = $this->cause["cau_nombre"];
        }

    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision-data-management.manage-causes-edit')
            ->extends('layouts.mainLayout', ['title' => 'Administrar datos admisión', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function editCause(){
        $this->validate();
        $saved = $this->updateCause($this->causeId,$this->nameToSave);
        if($saved){
            session()->flash('causeSaved', 'Registrado correctamente');
        }else{
            session()->flash('causeSavedFail', 'No se registro correctamente');
        }
    }
}
