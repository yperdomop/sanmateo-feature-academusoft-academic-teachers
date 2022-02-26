<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManagePaymentMethodUtils;
use Livewire\Component;

class ManagePayMethodEdit extends Component
{
    use ManagePaymentMethodUtils;

    /**
     * @var mixed
     */
    public $paId;
    public $pay;
    public $nameToSave = "";

    protected $rules = [
        'nameToSave' => 'required'
    ];
    protected $messages = [
        'nameToSave.required' => 'es requerido'
    ];

    public function mount($paId)
    {
        $this->paId = $paId;
        $this->pay = $this->getPayMethodById($paId);

        if(count($this->pay)>0){
            $this->nameToSave = $this->pay["pa_nombre"];
        }
    }


    public function render()
    {
        return view('livewire.academic.sse.menu.admision-data-management.manage-pay-method-edit')
            ->extends('layouts.mainLayout', ['title' => 'Administrar datos admisión', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function edit(){
        $this->validate();
        $saved = $this->updatePayMethod($this->paId,$this->nameToSave);
        if($saved){
            session()->flash('paySaved', 'Registrado correctamente');
        }else{
            session()->flash('paySavedFail', 'No se registro correctamente');
        }
    }
}
