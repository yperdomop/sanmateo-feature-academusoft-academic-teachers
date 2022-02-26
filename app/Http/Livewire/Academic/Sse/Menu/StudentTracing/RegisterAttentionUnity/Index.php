<?php

namespace App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity;

use App\Http\Utils\Database\Student\RegisterAttentionUnit\AttentionUnitUtils;
use Livewire\Component;

class Index extends Component
{
    use AttentionUnitUtils;


    public $document;

    public $name;

    public $students;

    public function mount()
    {
        $this->students=[];
    }


    public function render()
    {
        return view('livewire.academic.sse.menu.student-tracing.register-attention-unity.index')
            ->extends('layouts.mainLayout', ['title' => 'Registro unidad de atención', 'rol' => 'por definir',
                'logoPath' => 'images/sse/logos/logoSSE.png'])
            ->section('content');
    }

    public function getListStudents(){
//        $this->dispatchBrowserEvent('contentChanged');
//        $this->students = $this->getListStudentsByDocAndName($this->document,$this->name);
        $this->students = $this->getListStudentsSplitName($this->document,$this->name);
    }
}
