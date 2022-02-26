<?php

namespace App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement;

use App\Http\Utils\Database\Student\AdmisionDataManagement\ManagePaymentMethodUtils;
use Livewire\Component;

class ManagePayMethod extends Component
{
    use ManagePaymentMethodUtils;

    public $pay;

    public function mount()
    {
        $this->pay = $this->getPayMethod();
    }

    public function render()
    {
        return view('livewire.academic.sse.menu.admision-data-management.manage-pay-method')
            ->extends('layouts.mainLayout', ['title' => 'Administrar datos admisión', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function redirectCreatePayMethod()
    {
        $this->redirectRoute("administrarPagosCrear");
    }

    public function deleteData($conId)
    {
        $this->deletePayMethod($conId);
        $this->redirectRoute("administrarPagos");
    }
}
