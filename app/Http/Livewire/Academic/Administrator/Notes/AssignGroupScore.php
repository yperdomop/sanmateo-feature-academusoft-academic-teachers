<?php

namespace App\Http\Livewire\Academic\Administrator\Notes;

use App\Http\Livewire\Academic\Teacher\SetStudentScore;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class AssignGroupScore extends SetStudentScore
{
    public string $menu;

    public function mount() {
        $this->groupId = session()->get('groupId');
        $this->subjectRatingWithDates = $this->getGroupDates($this->groupId);
        $this->groupSubjectInfo = $this->getGroupSubject($this->groupId);
        $this->studentsWithRate = [];
        $this->students = new Collection();
        $this->editingNotes = [];
        $this->newNotes = [];
        $this->menu = '<li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador/calificar">Calificar</a></li>
        <li class="breadcrumb-item active" aria-current="page">Calificar grupo</li>';
    }

    public function render()
    {
        return view('livewire.academic.teacher.set-student-score')
        ->extends('layouts.mainLayout', ['title' => 'Calificar Grupo', 'rol' => 'Administrador'])
        ->section('content');
    }
}
