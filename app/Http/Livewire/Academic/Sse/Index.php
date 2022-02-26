<?php

namespace App\Http\Livewire\Academic\Sse;

use App\Http\Utils\Database\Student\StudentStatus;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Index extends Component
{
    use StudentStatus;

    public $listStudents;

    public function mount(){
//        $this->listStudents = $this->getStudentListBySubjectAndGroup();
    }

    public function render()
    {   
        $user = Auth::user();
        $apli_id = 121;
        $functions = User::getFunctionsUserApliId($user->usua_id, $apli_id);
        return view('livewire.academic.sse.index')
            ->extends('layouts.mainLayout', ['title' => 'Menu', 'rol' => 'por definir',
            'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content')->with('functions', $functions);
    }
}
