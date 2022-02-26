<?php

namespace App\Http\Livewire\Academic\Administrator;

use App\Models\Academic\TipoCalificacion;
use App\Models\Academic\TipoCalificacionCualitativa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ScoreType extends Component
{
    public Collection $scoreTypes;
    public int $deletingId = 0;

    public function mount()
    {
        $this->scoreTypes = TipoCalificacion::all();
    }

    public function render()
    {
        return view('livewire.academic.administrator.score-type')
        ->extends('layouts.mainLayout', ['title' => 'Tipo de Calificaciones', 'rol' => 'Administrador'])
        ->with(['scoreTypes' => $this->scoreTypes])
        ->section('content');
    }

    public function createScoreType(){
        return redirect(route('administrator.createScoreType'));
    }

    public function editScoreType(int $scoreTypeId){
        return redirect(route('administrator.editScoreType', ['scoreTypeId' => $scoreTypeId]));
    }

    public function confirmingDelete(int $scoreTypeId) {
        $this->deletingId = $scoreTypeId;
        $this->mount();
    }

    public function deleteScoreType() {
        try {
            $scoreToDelete = TipoCalificacion::find($this->deletingId);
            DB::beginTransaction();
            $this->deleteScoreCualitative($scoreToDelete->tica_id);
            $scoreToDelete->delete();
            $this->mount();
            DB::commit();
            $this->addError('successDelete', 'Se eliminó exitosamente el tipo de calificación : '.$scoreToDelete->tica_descripcion);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->addError('dependencyError', 'Lo sentimos, el tipo de calificación ya tiene asociadas notas, no se puede eliminar.');
        }

    }

    private function deleteScoreCualitative(int $scoreTypeId): bool {
        return TipoCalificacionCualitativa::where('TICA_ID', $scoreTypeId)->delete();
    }
}
