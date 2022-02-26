<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait BussinessPracticesUtil
{
    public function getPractice($estpId)
    {
        return DB::table("")->select(DB::raw("
                ep.estpr_id,
            pu.peun_ano || '-' || pu.peun_periodo as periodAno,
            ep.estpr_estadopractica,
            mp.mopr_id,
            mp.mopr_nombre,
            ep.estpr_fechainicio,
            ep.estpr_fechafin,
            ep.TUPR_ID,
            p.pege_id,
            p.nombre,
            pu2.peun_ano || '-' || pu2.peun_periodo,
            tp.tupr_numerohoras,
            ep.ESTPR_ID,
            pu.peun_id,
            ep.ESTPR_NOTADEFINITIVA,
            ep.ESTPR_OBSCOORD,
            ep.ESTPR_NOTADOCENTE,
            ep.ESTPR_NOTAENTIDAD,
            ep.ESTPR_OBSVISITA,
            ep.ESTPR_FORTALEZAS,
            ep.ESTPR_ASPMEJORAR,
            ep.ESTPR_ASPECTOSMEJORARPROG,
            pu.peun_id,
            ep.ent_id,
            e.ent_nombre,
            ep.ESTPR_OPCION,
            ep.ESTPR_INDUCCION,
            ep.ESTPR_HOJAVIDA,
            ep.ESTPR_FECHARADICACION,
            ep.ESTPR_JEFEINMEDIATO,
            ep.ESTPR_MAILJEFEINMEDIATO,
            ep.ESTPR_DIRECCION,
            ep.ESTPR_TELEFONO,
            ep.ESTPR_DEPENDENCIA,
            ep.ESTPR_ZONA,
            ep.ESTPR_OBSCOORDINACION,
            ep.ESTPR_NOTACOORD,
            pr.moda_id,
            ep.estpr_fechavisita
         "))
            ->fromRaw("bstar.estudiantepractica ep,
                bstar.entidad e,
                academico.periodouniversidad pu,
                bstar.modalidadpractica mp,
                bstar.tutorpractica tp,
                general.v_persona p,
                academico.periodouniversidad pu2,
                academico.estudiantepensum epe,
                academico.unidadprograma up,
                academico.programa pr")
            ->whereRaw("ep.peun_id = pu.peun_id
                and e.ent_id = ep.ent_id
                and mp.mopr_id = ep.mopr_id
                and tp.tupr_id(+) = ep.tupr_id
                and p.pege_id(+) = tp.pege_id
                and pu2.peun_id(+) = tp.peun_id
                and ep.estp_id = epe.estp_id
                and epe.unpr_id = up.unpr_id
                and pr.prog_id = up.prog_id
                ")
            ->where("ep.estp_id","=",$estpId)
            ->get()->fromStdToArray();
    }

    public function getSocialLabor($estpId)
    {
        return DB::table("")->select(DB::raw("
                ls.LABSO_ID,
                ls.PEUN_ID,
                pu.peun_ano || ' ' || pu.peun_periodo as periodo,
                to_char(ls.LABSO_FECHAINICIO, 'DD-MON-YYYY') as LABSO_FECHAINICIO,
                to_char(ls.LABSO_FECHAFIN, 'DD-MON-YYYY') as LABSO_FECHAFIN,
                ls.LABSO_RADICOCERTIFICADO,
                ls.LABSO_CERTIFICADOVALIDADO,
                ls.LABSO_ESTADO,
                ls.ENT_ID,
                e.ent_nombre,
                ls.LABSO_OBSERVACIONES,
                ls.estp_id,
                LABSO_CANTHORAS
         "))
            ->fromRaw("bstar.laborsocial ls,
                academico.unidadprograma up,
                academico.programa pr,
                academico.periodouniversidad pu,
                bstar.entidad e,
                academico.estudiantepensum ep,
                general.v_persona p")
            ->whereRaw("ls.estp_id = ep.estp_id
                and ep.pege_id = p.pege_id
                and ep.unpr_id = up.unpr_id
                and pr.prog_id = up.prog_id
                and ls.ent_id = e.ent_id
                and ls.peun_id = pu.peun_id
                ")
            ->where("ls.estp_id","=",$estpId)
            ->get()->fromStdToArray();
    }
}
