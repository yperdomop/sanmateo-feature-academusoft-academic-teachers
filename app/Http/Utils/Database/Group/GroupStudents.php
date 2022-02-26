<?php

namespace App\Http\Utils\Database\Group;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Boolean;

trait GroupStudents
{
    public function getStudentsByGroup(int $groupId): Collection {
        return DB::table('')->selectRaw('distinct
        p.pege_documentoidentidad as documentNumber, p.tidg_abreviatura as documentType, ep.estp_id as estpId, p.nombre as name,
        gm.grma_id as grmaId, gm.GRMA_FINAL as grmaFinal, ma.MAAC_ID as maacId')
        ->fromRaw('general.v_persona p, general.personageneral pg,  general.personanaturalgeneral pn,
        academico.estudiantepensum ep,
        academico.unidadprograma up,
        academico.programa pr, academico.jornada jo,
        academico.situacionestudiante site,
        academico.categoria cate,
        academico.matriculaacademica ma,
        academico.grupomatriculado gm,
        academico.grupo gr, academico.materia mat, mesa.HOMOLOGANTE hom, BSTAR.ENTIDAD ent')
        ->whereRaw('
        p.pege_id=ep.pege_id and p.pege_id=pg.pege_id and p.pege_id=pn.pege_id
        and ep.unpr_id=up.unpr_id and ep.ESTP_ID=hom.ESTP_ID(+) and hom.ENT_ID=ent.ENT_ID(+)
        and up.prog_id=pr.prog_id
        and ep.site_id=site.site_id
        and ep.cate_id=cate.cate_id
        and ep.estp_id=ma.estp_id
        and pr.jorn_id=jo.jorn_id
        and ma.maac_id=gm.maac_id and gm.grup_id=gr.grup_id and gr.mate_codigomateria=mat.mate_codigomateria')
        ->where('ma.peun_id', 1027)
        ->where('gm.grma_estado', 1)
        ->where('gm.grup_id', $groupId)->get()->fromStdToArray();
    }

    public function getGroupRatings(int $groupId, int $takeOptionals = 0): Collection {
        return DB::table('')->selectRaw('ea.evac_id,
        ea.evac_peso,
        ea.EVAC_ORDEN, ea.EVAC_DESCRIPCION, no.nota_id')->fromRaw('academico.grupo gr,
        academico.sistemaevaluacion se,
        academico.evaluacionacademico ea,
        academico.nota no')
        ->whereRaw('gr.siev_id=se.siev_id
        and se.siev_id=ea.siev_id
        and no.evac_id=ea.evac_id
        and no.grup_id=gr.grup_id')
        ->where('gr.grup_id', $groupId)
        ->where('ea.evac_opcional', $takeOptionals)
        ->orderBy('ea.EVAC_ORDEN')
        ->get()->fromStdToArray();
    }

    public function getGroupSubject(int $groupId): Collection {
        return DB::table('')->selectRaw("NVL(SUBSTR(gr.GRUP_NOMBRE, 0, INSTR(gr.GRUP_NOMBRE, '<')-1), gr.GRUP_NOMBRE) AS groupId,
        mat.mate_codigomateria as subjectId, mat.mate_nombre as subjectName")
        ->fromRaw('ACADEMICO.grupo gr, ACADEMICO.materia mat')
        ->whereRaw('gr.mate_codigomateria = mat.mate_codigomateria')
        ->where('gr.grup_id', $groupId)
        ->get()->fromStdToArray();
    }

    public function getGroupDates(int $groupId): Collection {
        return DB::table('')->selectRaw("nota.evac_id as evacid,
        nota.nota_id as notaid,
        ea.evac_peso as evacweight,
        ea.EVAC_ORDEN as evacorder, ea.EVAC_DESCRIPCION as evacdescription,  min(fg.FEGR_FECHAINICIO) as mindate, max(fg.FEGR_FECHAFIN) as maxdate")
        ->fromRaw('academico.grupo gr,
        academico.nota nota,
        academico.evaluacionacademico ea,
        academico.FECHAEVALUACIONGRUPO fg')
        ->whereRaw('gr.grup_id = nota.grup_id
        and nota.evac_id=ea.evac_id
        and gr.GRUP_ID=fg.GRUP_ID
        and ea.EVAC_ID=fg.EVAC_ID')
        ->whereRaw('ea.evac_id in (select ea.evac_id from
        academico.grupo gr2,
        academico.sistemaevaluacion se,
        academico.evaluacionacademico ea
        where
        gr2.siev_id=se.siev_id
        and se.siev_id=ea.siev_id
        and gr2.grup_id='.$groupId.'
        and ea.evac_opcional = 0)')
        ->where('gr.grup_id', $groupId)
        ->groupByRaw('nota.evac_id,nota.nota_id, ea.evac_id,
        ea.evac_peso,
        ea.EVAC_ORDEN, ea.EVAC_DESCRIPCION')
        ->get()->fromStdToArray();
    }
}
