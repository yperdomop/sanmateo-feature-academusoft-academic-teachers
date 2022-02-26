<?php

namespace App\Http\Livewire\Academic\Administrator\Programs;

use App\Models\Academic\Programa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListProgram extends Component
{
    public $programSystems;
    public int $deletingId = 0;
    
    //asigna valores de la BD
    public function mount() {
        $this->programSystems = Programa::orderBy('PROG_ID')->get();
    }

    //Renderiza la vista
    public function render()
    {
        return view('livewire.academic.administrator.programs.list-program')
        ->extends('layouts.mainLayout', ['title' => 'Programas', 'rol' => 'Administrador'])
        ->with([['programaSystems' => $this->programSystems]])
        ->section('content');
    }

    //Llama el controlador de creación
    public function createProgram() {
        return redirect(route('administrator.createProgram'));
    }

    //Llama el controlador de detalle
    public function detailProgram(int $programId)
    {
        redirect(route('administrator.detailProgram', ['programId' => $programId]));
    }

    //Confirma eliminación
    public function confirmingDelete(int $programId) {
        $this->deletingId = $programId;
    }

    //Eliminar registro
    public function deleteProgram() {
        try {
            $programToDelete = Programa::find($this->deletingId);
            DB::beginTransaction();
            $programToDelete->delete();
            $this->mount();
            DB::commit();
            $this->addError('successMessage', 'Se eliminó exitosamente el programa : '.$programToDelete->prog_nombre);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->addError('errorMessage', 'Lo sentimos, el programa ya tiene otros registros asociados, no se puede eliminar.');
        }
    }

}
