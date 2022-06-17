<?php

namespace App\Http\Controllers\Academic\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Utils\Session\SessionMock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
//modelos
use App\Models\Academic\Programa;
use App\Models\Academic\Unidad;
use App\Models\Academic\TipoCubrimientosNies;
use App\Models\Academic\Metodologia;
use App\Models\Academic\UnidadPrograma;


class UnitProgramsController extends Controller
{
    public function create(Programa $programa)
    {
        $relationTypes = [
            'A' => 'ACADEMICO',
            'L' => 'LOCALIDAD',
        ];
        $title = 'Asociar unidad';
        $rol = 'Administrador';
        $unidades = Unidad::all();
        $tipoCubrimientos = TipoCubrimientosNies::all();
        $metodologias = Metodologia::all();
        return view('academic.unitprograms.create', compact('title', 'rol', 'programa', 'unidades', 'relationTypes', 'tipoCubrimientos', 'metodologias'));
    }

    public function store(Request $request, Programa $programa)
    {
        $request->validate([
            'unit' => ['required'],
            'relationType' => ['required']
        ]);
        try {
            DB::beginTransaction();
            SessionMock::setMockSession();
            $unidadPrograma = UnidadPrograma::create([
                'unid_id' => $request->unit,
                'unpr_relacion' => $request->relationType,
                'unpr_fechacambio' => Carbon::now(),
                'prog_id' => $programa->prog_id,
                'unpr_cupominimo' => null,
                'unpr_cupomaximo' => null,
                'unpr_numeroopcionados' => null,
                'unpr_registradopor' => Session::get('pegeId'),
                'unpr_esfacultad' => $request->isFaculty == 1 ? '1' : '0',
            ]);
            if ($request->coveringType != 00) {
                $unidadPrograma->cubrimiento()->attach($request->coveringType, [
                    'cupr_registradopor' => Session::get('pegeId'),
                    'cupr_fechacambio' => Carbon::now(),
                    'meto_id' => $request->methodology
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect()->route('administrador.programs.show', $programa)->with('info', 'Se ha asociado la unidad exitosamente');
    }

    public function edit(Programa $programa, UnidadPrograma $unidadPrograma)
    {
        $relationTypes = [
            'A' => 'ACADEMICO',
            'L' => 'LOCALIDAD',
        ];
        $title = 'Asociar unidad';
        $rol = 'Administrador';
        $unidades = Unidad::all();
        $tipoCubrimientos = TipoCubrimientosNies::all();
        $metodologias = Metodologia::all();
        return view('academic.unitprograms.edit', compact('title', 'rol', 'programa', 'unidadPrograma', 'unidades', 'relationTypes', 'tipoCubrimientos', 'metodologias'));
    }

    public function update(Request $request, Programa $programa, UnidadPrograma $unidadPrograma)
    {
        $request->validate([
            'unit' => ['required'],
            'relationType' => ['required']
        ]);
        try {
            DB::beginTransaction();
            SessionMock::setMockSession();
            $unidadPrograma->update([
                'unid_id' => $request->unit,
                'unpr_relacion' => $request->relationType,
                'unpr_fechacambio' => Carbon::now(),
                'prog_id' => $programa->prog_id,
                'unpr_cupominimo' => null,
                'unpr_cupomaximo' => null,
                'unpr_numeroopcionados' => null,
                'unpr_registradopor' => Session::get('pegeId'),
                'unpr_esfacultad' => $request->isFaculty == 1 ? '1' : '0',
            ]);
            $data = [];
            if ($request->coveringType != 00) {
                $data = [$request->coveringType => [
                    'cupr_registradopor' => Session::get('pegeId'),
                    'cupr_fechacambio' => Carbon::now(),
                    'meto_id' => $request->methodology
                ]];
            }
            $unidadPrograma->cubrimiento()->sync($data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect()->route('administrador.programs.show', $programa)->with('info', 'Se ha actualizado la relación con unidad exitosamente');
    }

    public function destroy(Programa $programa, UnidadPrograma $unidadPrograma)
    {
        try {
            DB::beginTransaction();
            SessionMock::setMockSession();
            $unidadPrograma->cubrimiento()->detach();
            $unidadPrograma->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect()->route('administrador.programs.show', $programa)->with('info', 'Se ha eliminado la relación con unidad exitosamente');
    }
}
