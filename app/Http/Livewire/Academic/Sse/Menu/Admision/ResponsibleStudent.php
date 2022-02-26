<?php

namespace App\Http\Livewire\Academic\Sse\Menu\Admision;

use App\Http\Utils\Database\Student\AdmissionData\AdmissionDataUtil;
use Livewire\Component;

class ResponsibleStudent extends Component
{
    use AdmissionDataUtil;

    public $generalData;
    public $foinId;
    public $adviserList;

    public $selectedResponsible;

    protected $rules = [
        'selectedResponsible' => 'required',
    ];
    protected $messages = [
        'selectedResponsible.required' => 'es requerido',
    ];

    public function mount($foinId)
    {
        $this->foinId = $foinId;
        $this->generalData = $this->getGeneralDataByFoinId($foinId)->first();
        $this->adviserList = $this->getAdviserList();
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision.responsible-student')
            ->extends('layouts.academic.sse.mainLayoutSseAdmission', ['title' => 'Admision', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png', 'generalData' => $this->generalData])
            ->section('contentAdmission');
    }

    public function saveResponsible(){
        $this->validate();
        $timezone = new \DateTimeZone('America/Bogota');
        $dateNow = new \DateTime();
        $dateNow->setTimezone($timezone);
        $array=[
            "PEGE_ID" => $this->selectedResponsible,
//            "RE_REGISTRADOPOR" => , //TODO se deve validar con la sesion
            "RE_FECHACAMBIO" => $dateNow,
        ];
        if($this->saveStudentPayment($array,$this->foinId)){
            session()->flash('responsibleSaved', 'Registrado correctamente');
        }else{
            session()->flash('responsibleFail', 'No se registro correctamente');
        }
    }
}
