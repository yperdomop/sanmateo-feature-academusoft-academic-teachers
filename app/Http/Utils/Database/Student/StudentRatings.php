<?php

namespace App\Http\Utils\Database\Student;

use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Yajra\Oci8\Query\OracleBuilder;

trait StudentRatings
{
    public function getStudentRatingsByGroup(array $estpId, int $groupId, int $evacId = null): Collection
    {
        return DB::table('')->selectRaw('ea.evac_id as evacid, ea.evac_orden as evacorder,
        ep.ESTP_ID as estpid, gm.grma_id as grmaid, gm.grma_definitiva as grmatotal,
        ea.evac_peso as evacweight, ea.EVAC_DESCRIPCION as evacdesc, cal.CALF_VALOR as ratingvalue, cal.NOTA_ID as ratingid, cal.calf_id as calfid')
        ->fromRaw('
        academico.grupo gr, academico.MATERIA mat,
        academico.grupomatriculado gm,
        academico.calificacion cal,
        academico.nota nota,
        academico.evaluacionacademico ea,
        academico.matriculaacademica ma,
        academico.estudiantepensum ep, academico.UNIDADPROGRAMA up, academico.PROGRAMA pr,
        general.personageneral pg, general.personanaturalgeneral pn')
        ->whereRaw('gr.grup_id = gm.grup_id
        and gr.MATE_CODIGOMATERIA=mat.MATE_CODIGOMATERIA
        and gm.grma_id=cal.grma_id
        and cal.nota_id=nota.nota_id
        and nota.evac_id=ea.evac_id
        and gm.maac_id=ma.maac_id
        and ma.ESTP_ID=ep.ESTP_ID and ep.UNPR_ID=up.UNPR_ID and up.PROG_ID=pr.PROG_ID
        and ep.PEGE_ID=pg.pege_id and pg.pege_id=pn.pege_id
        ')
        ->where('gr.peun_id', 1027)
        ->where('gm.grma_estado', 1)
        ->where('gr.grup_id', $groupId)
        ->whereIn('ep.estp_id', $estpId)
        ->when(!is_null($evacId), function(OracleBuilder $query) use($evacId) {
            return $query->where('ea.evac_id', $evacId);
        })
        ->orderBy('evacorder')
        ->get()->fromStdToArray();
        //ToDo: CAMBIAR ESTADO PEUN

    }

    public function saveStudentRating() {

    }

    public function getTotalRatingByStudents(int $estpId, int $grmaId): Collection {
        return DB::table('')->selectRaw('ep.ESTP_ID as estpid,
        mat.MATE_CODIGOMATERIA as codigomateria,
        pr.PROG_COMPLEJIDAD  as programa,
        gr.grup_id as grupid, gm.grma_id as grmaid, gm.grma_definitiva as grmatotal,
        round((sum (ea.evac_peso * cal.CALF_VALOR )  / 100), 1) as totalRating')
        ->fromRaw('
        academico.grupo gr, academico.MATERIA mat,
        academico.grupomatriculado gm,
        academico.calificacion cal,
        academico.nota nota,
        academico.evaluacionacademico ea,
        academico.matriculaacademica ma,
        academico.estudiantepensum ep, academico.UNIDADPROGRAMA up, academico.PROGRAMA pr
        ')
        ->whereRaw('
        gr.grup_id = gm.grup_id
        and gr.MATE_CODIGOMATERIA=mat.MATE_CODIGOMATERIA
        and gm.grma_estado=1
        and gm.grma_id=cal.grma_id
        and cal.nota_id=nota.nota_id
        and nota.evac_id=ea.evac_id
        and gm.maac_id=ma.maac_id
        and ma.ESTP_ID=ep.ESTP_ID and ep.UNPR_ID=up.UNPR_ID and up.PROG_ID=pr.PROG_ID
        ')
        ->where('ma.ESTP_ID', $estpId)
        ->where('gm.grma_id', $grmaId)
        ->groupByRaw('ep.ESTP_ID,
        mat.MATE_CODIGOMATERIA,
        pr.PROG_COMPLEJIDAD, gr.grup_id, gm.grma_id, gm.grma_definitiva')
        ->get()->fromStdToArray();
    }
}
