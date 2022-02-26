<?php

namespace App\Http\Livewire\Academic\Teacher;

use App\Http\Utils\Data\FilterTrait;
use Livewire\Component;
use App\Http\Utils\Database\Teacher\TeacherGroups;
use App\Http\Utils\Session\SessionMock;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;

class GetClasses extends Component
{
    use AuthorizesRequests;
    use TeacherGroups;
    use FilterTrait;

    public $originalClasses;
    public $classes = [];
    public $groupFilter;
    public $classNameFilter;
    public $codeFilter;


    public function render()
    {
        return view('livewire.academic.teacher.get-classes')
            ->extends('layouts.mainLayout', ['title' => 'Mis clases', 'rol' => 'Docente'])
            ->section('content');
    }


    public function mount()
    {
        SessionMock::setMockSession();
        $pegeID = Session::get('pegeId');
        $this->classes = $this->getTeacherActiveGroups($pegeID);
        $this->originalClasses = $this->classes;
    }

    public function getGroupScore($groupId) {
        session()->flash('groupId', $groupId);
        return redirect(route('teacher.getStudentScore'));
    }

    public function setGroupScore($groupId) {
        session()->flash('groupId', $groupId);
        return redirect(route('teacher.setStudentScore'));
    }

    public function search()
    {
        $this->classes = $this->originalClasses;
        $this->getFilter();
    }

    private function getFilter(): void {
        if($this->codeFilter) {
            $this->classes = $this->filterStringCollection($this->originalClasses, 'classcode', $this->codeFilter);
        }

        if($this->classNameFilter) {
            $this->classes = $this->filterStringCollection($this->classes, 'classname', $this->classNameFilter);
        }

        if($this->groupFilter) {
            $this->classes = $this->filterStringCollection($this->classes, 'groupname', $this->groupFilter);
        }
    }
}
