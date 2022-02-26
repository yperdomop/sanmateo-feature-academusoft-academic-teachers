<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;
use function Symfony\Component\VarDumper\Dumper\esc;

trait ExtendedRegistryUtil
{
    public function getPeriodsOfRegistry($estpId)
    {
        $first = DB::table("")->select(DB::raw("
                 distinct I.PEUN_ID,
                 E.PENS_DESCRIPCION,
                 I.PEUN_ANO || ' ' || I.PEUN_PERIODO as periodo,
                 D.ESTP_PERIODOACADEMICO,
                 K.MAAC_PROMEDIOGENERAL as PROACUMULADO,
                 K.MAAC_PROMEDIO as PROPERIODO
         "))
            ->fromRaw("GENERAL.PERSONAGENERAL A,
                GENERAL.PERSONANATURALGENERAL B,
                ACADEMICO.ESTUDIANTEPENSUM D,
                ACADEMICO.PENSUM E,
                ACADEMICO.PROGRAMA F,
                ACADEMICO.REGISTROACADEMICO G,
                ACADEMICO.MATERIA H,
                ACADEMICO.PERIODOUNIVERSIDAD I,
                ACADEMICO.GRUPO J,
                ACADEMICO.HIS_MATRICULAACADEMICA K")
            ->whereRaw("A.PEGE_ID = B.PEGE_ID
                AND B.PEGE_ID = D.PEGE_ID
                AND E.PENS_ID = D.PENS_ID
                AND F.PROG_ID = E.PROG_ID
                AND G.ESTP_ID = D.ESTP_ID
                AND G.MATE_CODIGOMATERIA = H.MATE_CODIGOMATERIA
                AND I.PEUN_ID = G.PEUN_ID
                AND J.GRUP_ID(+) = G.GRUP_ID
                AND K.ESTP_ID(+) = G.ESTP_ID
                AND G.PEUN_ID = K.PEUN_ID(+)
                and G.REAC_NOTAFINALCL is null")
            ->where("D.ESTP_ID","=",$estpId);


                return DB::table("")->select(DB::raw("
                distinct I.PEUN_ID,
                E.PENS_DESCRIPCION,
                I.PEUN_ANO || ' ' || I.PEUN_PERIODO as periodo,
                D.ESTP_PERIODOACADEMICO,
                K.MAAC_PROMEDIOGENERAL as PROACUMULADO,
                 K.MAAC_PROMEDIO as PROPERIODO"))
                    ->fromRaw("GENERAL.PERSONAGENERAL A,
                        GENERAL.PERSONANATURALGENERAL B,
                        ACADEMICO.ESTUDIANTEPENSUM D,
                        ACADEMICO.PENSUM E,
                        ACADEMICO.PROGRAMA F,
                        ACADEMICO.REGISTROACADEMICO G,
                        ACADEMICO.MATERIA H,
                        ACADEMICO.PERIODOUNIVERSIDAD I,
                        ACADEMICO.GRUPO J,
                        ACADEMICO.HIS_MATRICULAACADEMICA K,
                        academico.TIPOCALIFICACIONCUALITATIVA tcc")
                    ->whereRaw(" A.PEGE_ID = B.PEGE_ID
                        AND B.PEGE_ID = D.PEGE_ID
                        AND E.PENS_ID = D.PENS_ID
                        AND F.PROG_ID = E.PROG_ID
                        AND G.ESTP_ID = D.ESTP_ID
                        AND G.MATE_CODIGOMATERIA = H.MATE_CODIGOMATERIA
                        AND I.PEUN_ID = G.PEUN_ID
                        AND J.GRUP_ID(+) = G.GRUP_ID
                        AND K.ESTP_ID(+) = G.ESTP_ID
                        AND G.PEUN_ID = K.PEUN_ID(+)
                        and tcc.TICL_ID = G.REAC_NOTAFINALCL
                        AND D.ESTP_ID = ".$estpId."")
                    ->union($first)
                    ->orderByRaw("ESTP_PERIODOACADEMICO")

            ->get()->fromStdToArray();
    }



    public function getDetailByEstpIdAndPeriod($estpId,$peunId)
    {
        $first = DB::table("")->select(DB::raw("
                 E.PENS_DESCRIPCION,
                H.MATE_CODIGOMATERIA,
                H.MATE_NOMBRE,
                G.REAC_PONDERACIONACADEMICA,
                nvl(J.GRUP_NOMBRE, '-') as GRUPO,
                I.PEUN_ID,
                I.PEUN_ANO || ' ' || I.PEUN_PERIODO,
                to_char(G.reac_notafinal) as reac_notafinal,
                nvl(G.REAC_HABILITACION, 0) as REAC_HABILITACION,
                nvl(G.REAC_NOTAANTESHAB, G.reac_notafinal) as definitiva,
                D.ESTP_PERIODOACADEMICO,
                K.MAAC_PROMEDIOGENERAL     PROACUMULADO,
                K.MAAC_PROMEDIO            PROPERIODO,
                h.tica_id,
                to_char(G.reac_notafinal),
                g.reac_aprobado,
                G.REAC_NOTAFINALCL
         "))
            ->fromRaw("GENERAL.PERSONAGENERAL A,
                GENERAL.PERSONANATURALGENERAL B,
                ACADEMICO.ESTUDIANTEPENSUM D,
                ACADEMICO.PENSUM E,
                ACADEMICO.PROGRAMA F,
                ACADEMICO.REGISTROACADEMICO G,
                ACADEMICO.MATERIA H,
                ACADEMICO.PERIODOUNIVERSIDAD I,
                ACADEMICO.GRUPO J,
                ACADEMICO.HIS_MATRICULAACADEMICA K")
            ->whereRaw("A.PEGE_ID = B.PEGE_ID
                AND B.PEGE_ID = D.PEGE_ID
                AND E.PENS_ID = D.PENS_ID
                AND F.PROG_ID = E.PROG_ID
                AND G.ESTP_ID = D.ESTP_ID
                AND G.MATE_CODIGOMATERIA = H.MATE_CODIGOMATERIA
                AND I.PEUN_ID = G.PEUN_ID
                AND J.GRUP_ID(+) = G.GRUP_ID
                AND K.ESTP_ID(+) = G.ESTP_ID
                AND G.PEUN_ID = K.PEUN_ID(+)
                and G.REAC_NOTAFINALCL is null")
        ->where("D.ESTP_ID","=",$estpId)
        ->where("I.PEUN_ID","=",$peunId);


        return DB::table("")->select(DB::raw("
                E.PENS_DESCRIPCION,
                H.MATE_CODIGOMATERIA,
                H.MATE_NOMBRE,
                G.REAC_PONDERACIONACADEMICA,
                nvl(J.GRUP_NOMBRE, '-') as GRUPO,
                I.PEUN_ID,
                I.PEUN_ANO || ' ' || I.PEUN_PERIODO,
                to_char(G.reac_notafinal) as reac_notafinal,
                nvl(G.REAC_HABILITACION, 0) as REAC_HABILITACION,
                G.REAC_NOTAANTESHAB,
                D.ESTP_PERIODOACADEMICO,
                K.MAAC_PROMEDIOGENERAL PROACUMULADO,
                K.MAAC_PROMEDIO        PROPERIODO,
                h.tica_id,
                tcc.TICL_DESCRIPCION,
                g.reac_aprobado,
                G.REAC_NOTAFINALCL"))
            ->fromRaw("GENERAL.PERSONAGENERAL A,
                        GENERAL.PERSONANATURALGENERAL B,
                        ACADEMICO.ESTUDIANTEPENSUM D,
                        ACADEMICO.PENSUM E,
                        ACADEMICO.PROGRAMA F,
                        ACADEMICO.REGISTROACADEMICO G,
                        ACADEMICO.MATERIA H,
                        ACADEMICO.PERIODOUNIVERSIDAD I,
                        ACADEMICO.GRUPO J,
                        ACADEMICO.HIS_MATRICULAACADEMICA K,
                        academico.TIPOCALIFICACIONCUALITATIVA tcc")
            ->whereRaw(" A.PEGE_ID = B.PEGE_ID
                        AND B.PEGE_ID = D.PEGE_ID
                        AND E.PENS_ID = D.PENS_ID
                        AND F.PROG_ID = E.PROG_ID
                        AND G.ESTP_ID = D.ESTP_ID
                        AND G.MATE_CODIGOMATERIA = H.MATE_CODIGOMATERIA
                        AND I.PEUN_ID = G.PEUN_ID
                        AND J.GRUP_ID(+) = G.GRUP_ID
                        AND K.ESTP_ID(+) = G.ESTP_ID
                        AND G.PEUN_ID = K.PEUN_ID(+)
                        and tcc.TICL_ID = G.REAC_NOTAFINALCL")
            ->where("D.ESTP_ID","=",$estpId)
            ->where("I.PEUN_ID","=",$peunId)
            ->union($first)
            ->orderByRaw("6,3")
            ->get()->fromStdToArray();
    }
}
