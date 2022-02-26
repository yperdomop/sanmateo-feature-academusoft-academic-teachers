<?php

namespace App\Http\Utils\Database\Group;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait GroupAcademicSystem
{
    public function getUnrolledGroupsToAcademicSystem(int $sievId): Collection {
        return DB::table('')->selectRaw('DISTINCT g.grup_id as groupId, g.grup_nombre as groupName,
        g.grup_fechainicial as groupStartDate, g.grup_fechafinal as groupEndDate,
        m.mate_codigomateria as subjectCode, m.mate_nombre as subjectName, m.mate_esopcional as subjectOptional,
        nat.natu_descripcion as subjectType, UN.unid_nombre as subjectUnity, se.siev_descripcion as academicSystemName, g.peun_id as periodId')
        ->fromRaw('ACADEMICO.GRUPO G, ACADEMICO.MATERIA M, ACADEMICO.sistemaevaluacion SE, ACADEMICO.NATURALEZA NAT, academico.unidad UN, academico.nota NO')
        ->whereRaw('g.mate_codigomateria = m.mate_codigomateria
        AND se.siev_id = g.siev_id
        And G.UNID_IDREGIONAL=UN.unid_id
        AND NO.GRUP_ID(+) = G.GRUP_ID
        AND m.natu_id = nat.natu_id
        ')
        ->where(function ($query) {
            $query->whereNull('no.grup_id')
                ->orWhereNotIn('g.siev_id', function ($query) {
                    $query->selectRaw('DISTINCT(EVAC.SIEV_ID)')
                    ->fromRaw('ACADEMICO.NOTA NOT2, ACADEMICO.GRUPO G2, ACADEMICO.EVALUACIONACADEMICO EVAC')
                    ->whereRaw('G2.GRUP_ID = NOT2.GRUP_ID
                    AND EVAC.EVAC_ID = not2.evac_id
                    AND G2.GRUP_ID = g.grup_id');
                });
        })
        ->where('g.peun_id', function($query) {
            $query->selectRaw('MAX(PEUN.PEUN_ID)')
            ->from('academico.periodouniversidad PEUN')
            ->whereRaw('CURRENT_TIMESTAMP BETWEEN peun_fechainicio and peun_fechafin
            AND TPPA_ID = 1');
        })
        ->where('se.siev_id', $sievId)
        ->get()->fromStdToArray();
    }
}
