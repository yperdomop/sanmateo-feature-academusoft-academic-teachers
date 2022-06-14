<?php

namespace App\Http\Controllers\Academic\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academic\Programa;
use App\Models\Academic\Metodologia;
use App\Models\Academic\Modalidad;
use App\Models\Academic\Jornada;
use App\Models\Academic\TipoPeriodoAcademico;

class ProgramsController extends Controller
{
    public function index()
    {
        $programs = Programa::all();
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
        $title = 'Programas';
        $rol = 'Administrador';
        return view('academic.programs.create', compact('title', 'rol', 'programTypes', 'methodologies', 'modalities', 'workingDays', 'academicPeriodTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'period' => ['required', 'integer'],
        ]);
        return $request->all();
        //return redirect()->route('administrador.programs.create')->with('info', 'El registro fue guardado exitosamente');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
