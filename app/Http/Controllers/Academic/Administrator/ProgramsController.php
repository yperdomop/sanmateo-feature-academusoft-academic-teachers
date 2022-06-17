<?php

namespace App\Http\Controllers\Academic\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academic\Programa;
use App\Models\Academic\Metodologia;
use App\Models\Academic\Modalidad;
use App\Models\Academic\Jornada;
use App\Models\Academic\TipoPeriodoAcademico;
use Illuminate\Support\Facades\Session;
use App\Http\Utils\Session\SessionMock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


class ProgramsController extends Controller
{
    public function index()
    {
        $programs = Programa::orderBy('prog_id')->get();
        $title = 'Programas';
        $rol = 'Administrador';
        return view('academic.programs.index', compact('title', 'rol', 'programs'));
    }

    public function create()
    {
        //variable de tipo de programas
        $programTypes = [
            'NORMAL' => 'NORMAL',
            'OFERTAMATERIA' => 'OFERTA DE MATERIAS',
            'PREUNIVERSITARIO' => 'PREUNIVERSITARIO',
        ];
        //variable desde BD
        $modalities = Modalidad::orderBy('moda_id')->get();
        $methodologies = Metodologia::all();
        $workingDays = Jornada::all();
        $academicPeriodTypes = TipoPeriodoAcademico::all();
        //variables para la vista
        $title = 'Crear programa';
        $rol = 'Administrador';
        return view('academic.programs.create', compact('title', 'rol', 'programTypes', 'methodologies', 'modalities', 'workingDays', 'academicPeriodTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'period' => ['required', 'integer'],
        ]);
        try {
            DB::beginTransaction();
            SessionMock::setMockSession();
            Programa::create([
                'prog_codigoicfes' => $request->IcfesCode,
                'prog_numperiodos' => $request->period,
                'prog_registradopor' => Session::get('pegeId'),
                'prog_fechacambio' => Carbon::now(),
                'moda_id' => $request->modality,
                'meto_id' => $request->methodology,
                'prog_complejidad' => Str::upper($request->complexity),
                'prog_titulootorga' => Str::upper($request->titleAwarded),
                'prog_tieneconvenio' => $request->agreement,
                'jorn_id' => $request->workingDay,
                'tppa_id' => $request->typeAcademicPeriod,
                'prog_fechaaprobacionicfes' => Carbon::parse($request->approvalDate),
                'prog_estado' => ($request->status == 'on') ? 1 : 0,
                'prog_codigoprograma' => $request->programCode,
                'prog_nombre' => Str::upper($request->programName),
                'prom_id' => null,
                'prog_tipoprograma' => Str::upper($request->programType),
                'prog_abreviatura' => Str::upper($request->abbreviation),
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect()->route('administrador.programs.create')->with('info', 'El registro fue guardado exitosamente');
    }


    public function show(Programa $programa)
    {
        //variables para la vista
        $title = 'Detalle programa';
        $rol = 'Administrador';
        return view('academic.programs.show', compact('title', 'rol', 'programa'));
    }

    public function edit(Programa $programa)
    {
        //variable de tipo de programas
        $programTypes = [
            'NORMAL' => 'NORMAL',
            'OFERTAMATERIA' => 'OFERTA DE MATERIAS',
            'PREUNIVERSITARIO' => 'PREUNIVERSITARIO',
        ];
        //variable desde BD
        $modalities = Modalidad::orderBy('moda_id')->get();
        $methodologies = Metodologia::all();
        $workingDays = Jornada::all();
        $academicPeriodTypes = TipoPeriodoAcademico::all();
        //variables para la vista
        $title = 'Editar programa';
        $rol = 'Administrador';
        return view('academic.programs.edit', compact('title', 'rol', 'programTypes', 'methodologies', 'modalities', 'workingDays', 'academicPeriodTypes', 'programa'));
    }


    public function update(Request $request, Programa $programa)
    {
        $request->validate([
            'period' => ['required', 'integer'],
        ]);
        try {
            DB::beginTransaction();
            SessionMock::setMockSession();
            $programa->update([
                'prog_codigoicfes' => $request->IcfesCode,
                'prog_numperiodos' => $request->period,
                'prog_registradopor' => Session::get('pegeId'),
                'prog_fechacambio' => Carbon::now(),
                'moda_id' => $request->modality,
                'meto_id' => $request->methodology,
                'prog_complejidad' => Str::upper($request->complexity),
                'prog_titulootorga' => Str::upper($request->titleAwarded),
                'prog_tieneconvenio' => $request->agreement,
                'jorn_id' => $request->workingDay,
                'tppa_id' => $request->typeAcademicPeriod,
                'prog_fechaaprobacionicfes' => Carbon::parse($request->approvalDate),
                'prog_estado' => ($request->status == 'on') ? 1 : 0,
                'prog_codigoprograma' => $request->programCode,
                'prog_nombre' => Str::upper($request->programName),
                'prom_id' => null,
                'prog_tipoprograma' => Str::upper($request->programType),
                'prog_abreviatura' => Str::upper($request->abbreviation),
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->route('administrador.programs.edit', $programa)->with('info', 'El registro fue actualizado exitosamente');
    }

    public function destroy(programa $programa)
    {
        try {
            DB::beginTransaction();
            SessionMock::setMockSession();
            $programa->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->route('administrador.programs.index')->with('info', 'El registro fue eliminado exitosamente');
    }
}
