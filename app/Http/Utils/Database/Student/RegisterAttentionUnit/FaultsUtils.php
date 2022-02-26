<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait FaultsUtils
{
    public function getFaults($estpId)
    {
        $data = DB::table("")->select(DB::raw("
               distinct pr.PROG_COMPLEJIDAD,
                H.peng_primerapellido || ' ' || H.peng_segundoapellido apellidos,
                H.peng_primernombre || ' ' || H.peng_segundonombre     nombres,
                C.MATE_CODIGOMATERIA,
                D.MATE_DURACION,
                D.NATU_ID,
                mate_nombre,
                 l.CSFE_FECHA,
                c.grup_id,
                c.grup_nombre
         "))
            ->fromRaw("
               SSE.FALLAS_MOBILE A,
                ACADEMICO.GRUPOMATRICULADO B,
                ACADEMICO.GRUPO C,
                ACADEMICO.MATERIA D,
                ACADEMICO.MATRICULAACADEMICA E,
                ACADEMICO.ESTUDIANTEPENSUM F,
                GENERAL.PERSONAGENERAL G,
                GENERAL.PERSONANATURALGENERAL H,
                ACADEMICO.DOCENTEGRUPO I,
                ACADEMICO.DOCENTEUNIDAD J,
                GENERAL.V_PERSONA K,
                ACADEMICO.CLASESEMANAL_FECHAS L,
                academico.UNIDADPROGRAMA up,
                academico.PROGRAMA pr
            ")
            ->whereRaw("A.GRMA_ID = B.GRMA_ID
                AND C.GRUP_ID = B.GRUP_ID
                AND D.MATE_CODIGOMATERIA = C.MATE_CODIGOMATERIA
                AND E.MAAC_ID = B.MAAC_ID
                AND E.ESTP_ID = F.ESTP_ID
                AND F.PEGE_ID = G.PEGE_ID
                AND G.PEGE_ID = H.PEGE_ID
                AND B.GRUP_ID = I.GRUP_ID
                AND J.DOUN_ID = I.DOUN_ID
                AND J.PEGE_ID = K.PEGE_ID
                AND L.CSFE_ID = A.CSFE_ID
                and f.unpr_id = up.UNPR_ID
                and up.PROG_ID = pr.PROG_ID
                and C.peun_id in (select peun_id
                    from academico.periodouniversidad
                    where peun_fechainicio < sysdate
                      and peun_fechafin > sysdate
                      and tppa_id = 1
                      and rownum <= '1')
                ")
            ->where("f.estp_id","=",$estpId)
            ->orderByRaw("pr.PROG_COMPLEJIDAD, apellidos, nombres ")
            ->get()->fromStdToArray();

        return ($data == null)?[]:$data;
    }


    public function getFaultsDeletedByExcuses($estpId)
    {
        $data = DB::table("")->select(DB::raw("
             distinct pr.PROG_COMPLEJIDAD,
                H.peng_primerapellido || ' ' || H.peng_segundoapellido apellidos,
                H.peng_primernombre || ' ' || H.peng_segundonombre     nombres,
                C.MATE_CODIGOMATERIA,
                D.MATE_DURACION,
                D.NATU_ID,
                mate_nombre,
                  l.CSFE_FECHA,
                c.grup_id,
                c.grup_nombre
         "))
            ->fromRaw("
               SSE.FALLAS_EXCUSAS A,
                ACADEMICO.GRUPOMATRICULADO B,
                ACADEMICO.GRUPO C,
                ACADEMICO.MATERIA D,
                ACADEMICO.MATRICULAACADEMICA E,
                ACADEMICO.ESTUDIANTEPENSUM F,
                GENERAL.PERSONAGENERAL G,
                GENERAL.PERSONANATURALGENERAL H,
                ACADEMICO.DOCENTEGRUPO I,
                ACADEMICO.DOCENTEUNIDAD J,
                GENERAL.V_PERSONA K,
                ACADEMICO.CLASESEMANAL_FECHAS L,
                academico.UNIDADPROGRAMA up,
                academico.PROGRAMA pr
            ")
            ->whereRaw("A.GRMA_ID = B.GRMA_ID
                AND C.GRUP_ID = B.GRUP_ID
                AND D.MATE_CODIGOMATERIA = C.MATE_CODIGOMATERIA
                AND E.MAAC_ID = B.MAAC_ID
                AND E.ESTP_ID = F.ESTP_ID
                AND F.PEGE_ID = G.PEGE_ID
                AND G.PEGE_ID = H.PEGE_ID
                AND B.GRUP_ID = I.GRUP_ID
                AND J.DOUN_ID = I.DOUN_ID
                AND J.PEGE_ID = K.PEGE_ID
                AND L.CSFE_ID = A.CSFE_ID
                and f.unpr_id = up.UNPR_ID
                and up.PROG_ID = pr.PROG_ID
                and C.peun_id in (select peun_id
                    from academico.periodouniversidad
                    where peun_fechainicio < sysdate
                      and peun_fechafin > sysdate
                      and tppa_id = 1
                      and rownum <= '1')
                ")
            ->where("f.estp_id","=",$estpId)
            ->orderByRaw("pr.PROG_COMPLEJIDAD, apellidos, nombres")
            ->get()->fromStdToArray();

        return ($data == null)?[]:$data;
    }
}
