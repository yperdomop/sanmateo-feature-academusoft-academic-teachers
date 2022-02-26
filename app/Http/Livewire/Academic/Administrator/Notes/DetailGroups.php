<?php

namespace App\Http\Livewire\Academic\Administrator\Notes;

use App\Http\Utils\Database\Teacher\TeacherGroups;
use App\Models\Academic\Materia;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class DetailGroups extends Component
{
    use TeacherGroups;

    public int $selectedSubject;
    public array $activeSubjects;
    public array $classes;
    public int $activePeriod;


    public function mount() {
        // ToDo: obtener periodo activo de session
        $this->selectedSubject = 0;
        $this->activePeriod = 1027;
        $this->classes = [];
        $this->activeSubjects = Materia::whereHas('grupos', function (Builder $query) {
            $query->where('ACADEMICO.GRUPO.peun_id', $this->activePeriod);
        })->select('MATE_CODIGOMATERIA', 'MATE_NOMBRE')->orderBy('MATE_NOMBRE', 'asc')->get()->toArray();
    }


    public function render()
    {
        return view('livewire.academic.administrator.notes.detail-groups')
        ->extends('layouts.mainLayout', ['title' => 'Seleccionar grupo a calificar', 'rol' => 'Administrador'])
        ->section('content');
    }

    public function showGroups(int $subjectId) {
        $this->classes = $this->getSubjectActiveGroups($subjectId, $this->activePeriod)->toArray();
    }

    public function setGroupScore(int $groupId) {
        session()->flash('groupId', $groupId);
        return redirect(route('administrator.assignScore'));
    }
}
