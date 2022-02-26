<?php

namespace App\Http\Livewire\Academic\Teacher;

use App\Http\Utils\Database\Group\GroupStudents;
use App\Http\Utils\Database\Student\StudentRatings;
use Livewire\Component;

class GetStudentScore extends Component
{
    use GroupStudents;
    use StudentRatings;

    public $students;
    public $groupId;
    public $ratings;
    public $studentRatings;
    public $groupSubjectInfo;

    public function mount() {
        $this->groupId = session()->get('groupId');
        $this->ratings = $this->getGroupRatings($this->groupId);
        $this->students = $this->getStudentsByGroup($this->groupId)->keyBy('estpid');
        $studentEstpId = $this->students->pluck('estpid')->toArray();
        $this->studentRatings = $this->getStudentRatingsByGroup($studentEstpId, $this->groupId)->groupBy('estpid');
        $this->students = $this->students->groupByKeys($this->studentRatings, 'ratings');
        $this->groupSubjectInfo = $this->getGroupSubject($this->groupId);
    }

    public function render()
    {
        return view('livewire.academic.teacher.get-student-score')
        ->extends('layouts.mainLayout', ['title' => 'Ver notas', 'rol' => 'Docente'])
        ->section('content');
    }
}
