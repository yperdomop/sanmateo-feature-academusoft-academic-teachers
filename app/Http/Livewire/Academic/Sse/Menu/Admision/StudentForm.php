<?php

namespace App\Http\Livewire\Academic\Sse\Menu\Admision;

use App\Http\Utils\Database\Student\AdmissionData\AdmissionDataUtil;
use Livewire\Component;

class StudentForm extends Component
{
    use AdmissionDataUtil;

    public $generalData;
    public $foinId;
    public $typeFormList;

    public $selectedTypeForm;

    protected $rules = [
        'selectedTypeForm' => 'required',
    ];
    protected $messages = [
        'selectedTypeForm.required' => 'es requerido'
    ];

    public function mount($foinId){
        $this->foinId = $foinId;
        $this->generalData = $this->getGeneralDataByFoinId($foinId)->first();
        $this->typeFormList = $this->getTypeFormLIst();
    }
    public function render()
    {
        return view('livewire.academic.sse.menu.admision.student-form')
            ->extends('layouts.academic.sse.mainLayoutSseAdmission', ['title' => 'Admision', 'rol' => 'por definir',
            'logoPath' => 'images/sse/logos/logoSSE.png', 'generalData' => $this->generalData])
            ->section('contentAdmission');
    }

    public function saveTypeForm(){
        $this->validate();
        $timezone = new \DateTimeZone('America/Bogota');
        $dateNow = new \DateTime();
        $dateNow->setTimezone($timezone);

        $data = [
            "TF_ID" => $this->selectedTypeForm,
//            "FOR_NUMERO" => "", /*TODO valdiar que dato va aqui*/
//            "FOR_REGISTRADOPOR" => "", /*TODO falta la sesion*/
            "FOR_FECHACAMBIO" => $dateNow,
        ];
        if($this->saveTypeFormSelected($data, $this->foinId)){
            session()->flash('typeFormFoinSaved', 'Registrado correctamente');
        }else{
            session()->flash('typeFormFoinFail', 'No se registro correctamente');
        }
    }
}
