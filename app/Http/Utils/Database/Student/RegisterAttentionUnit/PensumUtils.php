<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait PensumUtils
{
    public function getPeriodByEstpId($estpId)
    {
        return DB::table("")->select(DB::raw("
                DISTINCT
                D.PROG_NOMBRE,
                F.PEMA_PERIODO,
                JORN_DESCRIPCION,
                B.PENS_NUMPERIODOS
         "))
            ->fromRaw("ACADEMICO.ESTUDIANTEPENSUM A,
                ACADEMICO.PENSUM B,
                ACADEMICO.PROGRAMA D,
                ACADEMICO.JORNADA E,
                ACADEMICO.PENSUMMATERIA F,
                ACADEMICO.REQUISITO H,
                ACADEMICO.MATERIA G,
                academico.NUCLEOFUNDAMENTACION nf")
            ->whereRaw("A.PENS_ID = B.PENS_ID
                AND B.PROG_ID = D.PROG_ID
                AND D.JORN_ID = E.JORN_ID
                AND F.PENS_ID = B.PENS_ID
                AND G.MATE_CODIGOMATERIA = F.MATE_CODIGOMATERIA
                AND F.PENS_ID = B.PENS_ID
                AND F.PEMA_ESTADO = '1'
                and f.NUFO_ID = nf.NUFO_ID(+)
                and F.PENS_ID = H.PENS_ID(+)
                AND F.MATE_CODIGOMATERIA = H.MATE_CODIGOMATERIA(+)
                ")
            ->where("A.ESTP_ID","=",$estpId)
            ->orderByRaw("F.PEMA_PERIODO")
            ->get()->fromStdToArray();
    }

    public function getDetailPensumByEstpIdAndPeriod($estpId,$periodo)
    {
        return DB::table("")->select(DB::raw("
               DISTINCT D.PROG_NOMBRE,
                E.JORN_DESCRIPCION,
                B.PENS_NUMPERIODOS,
                F.PEMA_PERIODO,
                G.MATE_CODIGOMATERIA,
                G.MATE_NOMBRE,
                G.MATE_HORASTEORICAS,
                G.MATE_HORASPRACTICAS,
                G.MATE_HORASTEORICOPRACTICAS,
                G.MATE_PONDERACIONACADEMICA,
                F.PEMA_CREDITOREQUISITO,
                NVL(H.MATE_CODIGOMATERIAREQUISITO, '-') REQUISITO,
                NVL(nf.nufo_descripcion, '-') as NUFO_DESCRIPCION,
                decode(f.pema_obligatoria, '1', 'Si', '0', 'No') AS PEMA_OBLIGATORIA
         "))
            ->fromRaw("ACADEMICO.ESTUDIANTEPENSUM A,
                ACADEMICO.PENSUM B,
                ACADEMICO.PROGRAMA D,
                ACADEMICO.JORNADA E,
                ACADEMICO.PENSUMMATERIA F,
                ACADEMICO.REQUISITO H,
                ACADEMICO.MATERIA G,
                academico.NUCLEOFUNDAMENTACION nf")
            ->whereRaw("A.PENS_ID = B.PENS_ID
                AND B.PROG_ID = D.PROG_ID
                AND D.JORN_ID = E.JORN_ID
                AND F.PENS_ID = B.PENS_ID
                AND G.MATE_CODIGOMATERIA = F.MATE_CODIGOMATERIA
                AND F.PENS_ID = B.PENS_ID
                AND F.PEMA_ESTADO = '1'
                and f.NUFO_ID = nf.NUFO_ID(+)
                and F.PENS_ID = H.PENS_ID(+)
                AND F.MATE_CODIGOMATERIA = H.MATE_CODIGOMATERIA(+)
                ")
            ->where("A.ESTP_ID","=",$estpId)
            ->where("F.PEMA_PERIODO","=",$periodo)
            ->orderByRaw("F.PEMA_PERIODO")
            ->get()->fromStdToArray();
    }

}
