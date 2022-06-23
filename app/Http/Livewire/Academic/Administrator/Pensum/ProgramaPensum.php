<?php

namespace App\Http\Livewire\Academic\Administrator\Pensum;

use Livewire\Component;
use App\Models\Academic\Programa;
use App\Models\Academic\Pensum;

class ProgramaPensum extends Component
{
    public $programa = '';
    public function render()
    {
        $programs = Programa::orderBy('prog_nombre')->get();
        $pensums = Pensum::where('prog_id', $this->programa)->get();
        return view('livewire.academic.administrator.pensum.programa-pensum', compact('programs', 'pensums'));
    }
}
