<?php

namespace App\Http\Livewire\Academic\Teacher;

use App\Http\Utils\Database\Teacher\TeacherSchedule;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class GetSchedule extends Component
{
    use TeacherSchedule;
    public Collection $teacherSchedule;


    public function mount() {
        $pegeId = Session::get('pegeId');
        $this->teacherSchedule = $this->getTeacherSchedule($pegeId)->sortBy('classnumberday')->groupBy('classday')->forget('');
    }

    public function render()
    {
        return view('livewire.academic.teacher.get-schedule')
        ->extends('layouts.mainLayout', ['title' => 'Mis horarios', 'rol' => 'Docente'])
        ->section('content');
    }
}
