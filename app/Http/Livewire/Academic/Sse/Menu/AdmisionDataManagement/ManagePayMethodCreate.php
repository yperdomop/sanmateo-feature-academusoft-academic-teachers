<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManagePaymentMethodUtils;
use Livewire\Component;

class ManagePayMethodCreate extends Component
{
    use ManagePaymentMethodUtils;

    public $nameToSave = "";

    protected $rules = [
        'nameToSave' => 'required'
    ];
    protected $messages = [
        'nameToSave.required' => 'es requerido'
    ];

    public function render()
    {
        return view('livewire.academic.sse.menu.admision-data-management.manage-pay-method-create')
            ->extends('layouts.mainLayout', ['title' => 'Administrar datos admisión', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function insert(){
        $this->validate();
        $saved = $this->createPayMethod($this->nameToSave);
        if($saved){
            session()->flash('covenSaved', 'Registrado correctamente');
        }else{
            session()->flash('covenSavedFail', 'No se registro correctamente');
        }
    }
}
