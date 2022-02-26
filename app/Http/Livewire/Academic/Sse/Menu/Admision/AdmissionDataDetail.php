<?php

namespace App\Http\Livewire\Academic\Sse\Menu\Admision;

use App\Http\Utils\Database\Student\AdmissionData\AdmissionDataUtil;
use Livewire\Component;

class AdmissionDataDetail extends Component
{
    use AdmissionDataUtil;

    public $foinId;
    public $generalData;
    public $listPayments;
    public $covenantList;

    public $selectedPaId;
    /**
     * @var array
     */
    public $selectedCoId;
    public $fullSemesterAmount;
    public $grantPercentaje;
    public $discountPercentaje;

    protected $rules = [
        'selectedPaId' => 'required',
        'selectedCoId' => 'required',
        'fullSemesterAmount' => 'required',
        'grantPercentaje' => 'required',
        'discountPercentaje' => 'required',
    ];
    protected $messages = [
        'selectedPaId.required' => 'es requerido',
        'selectedCoId.required' => 'es requerido',
        'fullSemesterAmount.required' => 'es requerido',
        'grantPercentaje.required' => 'es requerido',
        'discountPercentaje.required' => 'es requerido'
    ];


    public function mount($foinId){
        $this->foinId = $foinId;
        $this->generalData = $this->getGeneralDataByFoinId($foinId)->first();
        $this->listPayments = $this->getPayment();
        $this->covenantList = $this->getCovenants();

    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision.admission-data-detail')
            ->extends('layouts.academic.sse.mainLayoutSseAdmission', ['title' => 'Admision', 'rol' => 'por definir',
            'logoPath' => 'images/sse/logos/logoSSE.png', 'generalData' => $this->generalData])
            ->section('contentAdmission');
    }

    public function savePayment(){
        $this->validate();
        $timezone = new \DateTimeZone('America/Bogota');
        $dateNow = new \DateTime();
        $dateNow->setTimezone($timezone);
        $array=[
            "PA_ID" => $this->selectedPaId,
            "CON_ID" => $this->selectedCoId,
            "PE_VALOR" => $this->fullSemesterAmount,
            "PA_DESCUENTO" => $this->grantPercentaje,
            "PE_DESCUENTOPRIMERCUOTA" => $this->discountPercentaje,
            "PE_FECHACAMBIO" => $dateNow
        ];
        if($this->saveStudentPayment($array,$this->foinId)){
            session()->flash('payStudentSaved', 'Registrado correctamente');
        }else{
            session()->flash('payStudentSavedFail', 'No se registro correctamente');
        }

    }
}
