<?php

namespace App\Http\Livewire\Academic\Administrator\Programs;

use App\Http\Utils\Session\SessionMock;
use App\Models\Academic\Programa;
use App\Models\Academic\Modalidad;
use App\Models\Academic\Metodologia;
use App\Models\Academic\Jornada;
use App\Models\Academic\TipoPeriodoAcademico;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Livewire\Component;

class CreateProgram extends Component
{
    //declaración variables
    public bool $confirmingSave = false;
    public string $IcfesCode;
    public string $approvalDate;
    public string $programCode;
    public bool $status = true;
    public bool $agreement;
    public string $programName;
    public string $complexity;
    public int $period;
    public string $abbreviation;
    public string $titleAwarded;
    public string $typeAcademicPeriod;
    public string $average;//no esta la tabla
    public string $modality;
    public string $methodology;
    public string $workingDay;
    public string $programType;
    //declaración arreglo
    public array $programTypes = [];
    //declaración llaves foráneas
    public $academicPeriodTypes;
    public $averages;//no esta la tabla
    public $modalities;
    public $methodologies;
    public $workingDays;

    //función para montar datos
    public function mount()
    {
        $this->programTypes = [
            'NORMAL' => 'NORMAL',
            'OFERTAMATERIA' => 'OFERTA DE MATERIAS',
            'PREUNIVERSITARIO' => 'PREUNIVERSITARIO',
        ];

        $this->modalities = Modalidad::orderBy('moda_id')->get();
        $this->methodologies = Metodologia::get();
        $this->workingDays = Jornada::get();
        $this->academicPeriodTypes = TipoPeriodoAcademico::get();

        $this->IcfesCode = '';
        $this->approvalDate = '';
        $this->programCode = '';
        $this->status = true;
        $this->agreement = '';
        $this->programName = '';
        $this->complexity = '';
        $this->period = 0;
        $this->abbreviation = '';
        $this->titleAwarded = '';
        $this->typeAcademicPeriod = '';
        $this->average = '';
        $this->modality = '';
        $this->methodology = '';
        $this->workingDay = '';
        $this->programType = '';

    }


    public function render()
    {
        return view('livewire.academic.administrator.programs.create-program')
        ->extends('layouts.mainLayout', ['title' => 'Crear Programa', 'rol' => 'Administrador'])
        ->section('content');
    }

    public function saveProgram(){
        try {
            DB::beginTransaction();
            //ToDo: Delete mock session
            SessionMock::setMockSession();
            $program = $this->mapPrograma();
            $program->save();
            //dd($program);//ojo
            $this->addError('successSaved', 'El registro fue guardado exitosamente');
            DB::commit();
            $this->mount();

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    private function mapPrograma(): Programa {
        $program = new Programa();
        $program->fill([
            'prog_codigoicfes' => strtoupper($this->IcfesCode),
            'prog_numperiodos' => $this->period,
            'prog_registradopor' => Session::get('pegeId'),
            'prog_fechacambio' => Carbon::now(),
            'moda_id' => $this->modality,
            'meto_id' => $this->methodology,
            'prog_complejidad' =>strtoupper ($this->complexity),
            'prog_titulootorga' => strtoupper ($this->titleAwarded),
            'prog_tieneconvenio' => $this->agreement,
            'jorn_id' => $this->workingDay,
            'tppa_id' => $this->typeAcademicPeriod,
            'prog_fechaaprobacionicfes' => Carbon::parse($this->approvalDate),
            'prog_estado' => $this->status,
            'prog_codigoprograma' => $this->programCode,
            'prog_nombre' => strtoupper ($this->programName),
            'prom_id' => $this->average,
            'prog_tipoprograma' =>strtoupper ($this->programType),
            'prog_abreviatura' => strtoupper ($this->abbreviation),
        ]);

        return $program;
    }
}
