<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait ActualScoresUtil
{

    public function getScores($estpId)
    {
        $first = DB::table("")->select(DB::raw("
                H.GRUP_NOMBRE,
                I.MATE_CODIGOMATERIA,
                I.MATE_NOMBRE,
                I.MATE_PONDERACIONACADEMICA,
                nvl(ROUND(SUM((K.EVAC_PESO * 0.01) * G.GRMA_FINAL), 1), -1)                   ACUMULADO,
                SUM(K.EVAC_PESO * (CASE (nvl(G.GRMA_FINAL, 100)) when 100 then 0 else 1 END)) PESO,
                nvl(ROUND((SUM((K.EVAC_PESO * 0.01) * G.GRMA_FINAL) * 100) /
                          SUM(K.EVAC_PESO * (CASE (nvl(G.GRMA_FINAL, 100)) when 100 then 0 else 1 END)), 1), -1) as definitiva,
                tcc.TICL_DESCRIPCION,
                G.GRMA_APROBADO
         "))
            ->fromRaw("
                GENERAL.V_PERSONA A,
                 GENERAL.PERSONAGENERAL B,
                 GENERAL.PERSONANATURALGENERAL D,
                 ACADEMICO.ESTUDIANTEPENSUM E,
                 ACADEMICO.MATRICULAACADEMICA F,
                 ACADEMICO.GRUPOMATRICULADO G,
                 ACADEMICO.GRUPO H,
                 ACADEMICO.MATERIA I,
                 ACADEMICO.SISTEMAEVALUACION J,
                 ACADEMICO.EVALUACIONACADEMICO K,
                 ACADEMICO.NOTA L,
                 ACADEMICO.CALIFICACION M,
                 academico.TIPOCALIFICACIONCUALITATIVA tcc
            ")
            ->whereRaw("A.PEGE_ID = E.PEGE_ID
                    AND A.PEGE_ID = B.PEGE_ID
                    AND A.PEGE_ID = D.PEGE_ID
                    AND E.ESTP_ID = F.ESTP_ID
                    AND F.MAAC_ID = G.MAAC_ID
                    AND G.GRUP_ID = H.GRUP_ID
                    AND H.MATE_CODIGOMATERIA = I.MATE_CODIGOMATERIA
                    AND G.GRMA_ESTADO = 1
                    AND H.SIEV_ID = J.SIEV_ID(+)
                    AND J.SIEV_ID = K.SIEV_ID(+)
                    AND K.EVAC_ID = L.EVAC_ID(+)
                    AND L.NOTA_ID = M.NOTA_ID
                    AND G.GRMA_ID = M.GRMA_ID(+)
                    and tcc.ticl_id(+) = g.grma_finalncl_id ")
            ->where("E.ESTP_ID","=",$estpId)
            ->groupByRaw("H.GRUP_NOMBRE, I.MATE_CODIGOMATERIA, I.MATE_NOMBRE, I.MATE_PONDERACIONACADEMICA, tcc.TICL_DESCRIPCION,
                G.GRMA_APROBADO,E.ESTP_ID");


        $data = DB::table("")->select(DB::raw("
                         H.GRUP_NOMBRE,
                I.MATE_CODIGOMATERIA,
                I.MATE_NOMBRE,
                I.MATE_PONDERACIONACADEMICA,
                0 ACUMULADO,
                0 PESO,
                0 definitiva,
                '-',
                '-'"))
            ->fromRaw("GENERAL.V_PERSONA A,
                GENERAL.PERSONAGENERAL B,
                GENERAL.PERSONANATURALGENERAL D,
                ACADEMICO.ESTUDIANTEPENSUM E,
                ACADEMICO.MATRICULAACADEMICA F,
                ACADEMICO.GRUPOMATRICULADO G,
                ACADEMICO.GRUPO H,
                ACADEMICO.MATERIA I")
            ->whereRaw(" A.PEGE_ID = E.PEGE_ID
  AND A.PEGE_ID = B.PEGE_ID
  AND A.PEGE_ID = D.PEGE_ID
  AND E.ESTP_ID = F.ESTP_ID
  AND F.MAAC_ID = G.MAAC_ID
  AND G.GRUP_ID = H.GRUP_ID
  AND H.MATE_CODIGOMATERIA = I.MATE_CODIGOMATERIA
  AND G.GRMA_ESTADO = 1
  and g.grma_id not in (SELECT G.grma_id
                        FROM GENERAL.V_PERSONA A,
                             GENERAL.PERSONAGENERAL B,
                             GENERAL.PERSONANATURALGENERAL D,
                             ACADEMICO.ESTUDIANTEPENSUM E,
                             ACADEMICO.MATRICULAACADEMICA F,
                             ACADEMICO.GRUPOMATRICULADO G,
                             ACADEMICO.GRUPO H,
                             ACADEMICO.MATERIA I,
                             ACADEMICO.SISTEMAEVALUACION J,
                             ACADEMICO.EVALUACIONACADEMICO K,
                             ACADEMICO.NOTA L,
                             ACADEMICO.CALIFICACION M
                        WHERE A.PEGE_ID = E.PEGE_ID
                          AND A.PEGE_ID = B.PEGE_ID
                          AND A.PEGE_ID = D.PEGE_ID
                          AND E.ESTP_ID = F.ESTP_ID
                          AND F.MAAC_ID = G.MAAC_ID
                          AND G.GRUP_ID = H.GRUP_ID
                          AND H.MATE_CODIGOMATERIA = I.MATE_CODIGOMATERIA
                          AND G.GRMA_ESTADO = 1
                          AND H.SIEV_ID = J.SIEV_ID(+)
                          AND J.SIEV_ID = K.SIEV_ID(+)
                          AND K.EVAC_ID = L.EVAC_ID(+)
                          AND L.NOTA_ID = M.NOTA_ID
                          AND G.GRMA_ID = M.GRMA_ID(+)
                          AND E.ESTP_ID = ".$estpId.")")
            ->where("E.ESTP_ID","=",$estpId)
            ->union($first)
            ->get()->fromStdToArray();

        return ($data == null)?[]:$data;
    }

}
