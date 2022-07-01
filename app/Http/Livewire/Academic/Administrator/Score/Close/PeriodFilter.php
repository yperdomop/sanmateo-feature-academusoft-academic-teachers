<?php

namespace App\Http\Livewire\Academic\Administrator\Score\Close;

use Livewire\Component;
use App\Models\Academic\Unidad;
use App\Models\Academic\PeriodoUniversidad;
use App\Models\Academic\PeriodoProgramaUnidad;

class PeriodFilter extends Component
{
    public $ur;
    public $per;
    public function render()
    {
        $programas = PeriodoProgramaUnidad::where('unid_id', $this->ur)->where('peun_id', $this->per)->get();
        $unidadesRegionales = Unidad::where('unid_regional', 1)->orderBy('unid_id')->get();
        $periodos = PeriodoUniversidad::orderBy('peun_ano', 'desc')->orderBy('peun_periodo', 'desc')->get();
        return view('livewire.academic.administrator.score.close.period-filter', compact('unidadesRegionales', 'periodos', 'programas'));
    }

    public function Hydrate()
    {
        $this->emit('sel2');
    }
}
