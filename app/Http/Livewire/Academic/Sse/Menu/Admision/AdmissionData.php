<?php

namespace App\Http\Livewire\Academic\Sse\Menu\Admision;

use App\Http\Utils\Database\Student\AdmissionData\AdmissionDataUtil;
use Livewire\Component;

class AdmissionData extends Component
{
    use AdmissionDataUtil;

    public $dataAspirant;
    public $documentNumber;

    protected $rules = [
        'documentNumber' => 'required'
    ];
    protected $messages = [
        'documentNumber.required' => 'es requerido'
    ];

    public function mount(){
        $this->dataAspirant = [];
        $this->documentNumber = '';
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision.admission-data')
            ->extends('layouts.mainLayout', ['title' => 'Admision', 'rol' => 'por definir',
            'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function getDataAspirant(){
        $this->validate();
        $this->dataAspirant = $this->findAdmissionDataByDocument($this->documentNumber);
    }
}
