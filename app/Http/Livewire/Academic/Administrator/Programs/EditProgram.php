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

class EditProgram extends Component
{  
    //declaración variables
    public $programSystem;
    public int $programId;

    public bool $confirmingSave = false;
    public string $IcfesCode;
    public string $approvalDate;
    public string $programCode;
    public bool $status;
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
    public $date;
    //declaración arreglo
    public array $programTypes = [];
    //declaración llaves foráneas
    public $academicPeriodTypes;
    public $averages;//no esta la tabla
    public $modalities;
    public $methodologies;
    public $workingDays;

    public function mount(int $programId) {
        $this->programTypes = [
            'NORMAL' => 'NORMAL',
            'OFERTAMATERIA' => 'OFERTA DE MATERIAS',
            'PREUNIVERSITARIO' => 'PREUNIVERSITARIO',
        ];

        $this->modalities = Modalidad::orderBy('moda_id')->get();
        $this->methodologies = Metodologia::get();
        $this->workingDays = Jornada::get();
        $this->academicPeriodTypes = TipoPeriodoAcademico::get();
        $this->programSystem = Programa::find($programId);
        $this->programId = $programId;
        $this->mapGettedProgram();
    }

    public function render()
    {
        return view('livewire.academic.administrator.programs.create-program')
        ->extends('layouts.mainLayout', ['title' => 'Editar Programa', 'rol' => 'Administrador'])
        ->section('content');
    }

    public function saveProgram(){
        try {
            DB::beginTransaction();
            //ToDo: Delete mock session
            SessionMock::setMockSession();
            $this->programSystem = Programa::find($this->programId);
            $this->mapPrograma();
            $this->programSystem->save();
            DB::commit();
            //dd($this->programSystem);//ojo
            session()->flash('successSaved', 'El registro fue editado exitosamente');
            redirect(route('administrator.detailProgram', ['programId' => $this->programId]));

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    private function mapPrograma(): Void {
            $this->programSystem->prog_codigoicfes = strtoupper($this->IcfesCode);
            $this->programSystem->prog_codigoprograma = $this->period;
            $this->programSystem->prog_registradopor = Session::get('pegeId');
            $this->programSystem->prog_fechacambio = carbon::now();
            $this->programSystem->moda_id = $this->modality;
            $this->programSystem->meto_id = $this->methodology;
            $this->programSystem->prog_complejidad =strtoupper ($this->complexity);
            $this->programSystem->prog_titulootorga = strtoupper ($this->titleAwarded);
            $this->programSystem->prog_tieneconvenio = $this->agreement;
            $this->programSystem->jorn_id = $this->workingDay;
            $this->programSystem->tppa_id = $this->typeAcademicPeriod;
            $this->programSystem->prog_fechaaprobacionicfes = carbon::parse($this->approvalDate);
            $this->programSystem->prog_estado = $this->status;
            $this->programSystem->prog_codigoprograma = $this->programCode;
            $this->programSystem->prog_nombre = strtoupper ($this->programName);
            $this->programSystem->prog_tipoprograma =strtoupper ($this->programType);
            $this->programSystem->prog_abreviatura = strtoupper ($this->abbreviation);
            $this->programSystem->prog_numperiodos = $this->period;
            $this->programSystem->prom_id = '';
    }

    private function mapGettedProgram() {
        $this->IcfesCode = $this->programSystem->prog_codigoicfes;
        $this->date = Carbon::parse($this->programSystem->prog_fechaaprobacionicfes);
        $this->approvalDate = $this->date->format('Y-m-d');
        $this->programCode = $this->programSystem->prog_codigoprograma;
        $this->status = $this->programSystem->prog_estado;
        //validar si tieneconvenio esta null
        if ($this->programSystem->prog_tieneconvenio == null) {
            $this->agreement = 0;
        } else {
            $this->agreement = $this->programSystem->prog_tieneconvenio;
        }
        
        $this->programName = $this->programSystem->prog_nombre;
        $this->complexity = $this->programSystem->prog_complejidad;
        $this->period = $this->programSystem->prog_numperiodos;
        $this->abbreviation = $this->programSystem->prog_abreviatura;
        $this->titleAwarded = $this->programSystem->prog_titulootorga;
        $this->typeAcademicPeriod = $this->programSystem->tppa_id;
        $this->modality = $this->programSystem->moda_id;
        $this->methodology = $this->programSystem->meto_id;
        $this->workingDay = $this->programSystem->jorn_id;
        $this->programType = $this->programSystem->prog_tipoprograma;
    }
}
