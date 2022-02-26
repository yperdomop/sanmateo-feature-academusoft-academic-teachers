<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

//pestaña Horario
use Illuminate\Support\Facades\DB;

trait ScheduleUtil
{
    /**
     * obtiene el horario por estpId
     * @param int $estpId
     * @return mixed
     */
    public function getScheduleList(int $estpId)
    {
        return DB::table("")->select(DB::raw("
                DISTINCT JO.JORN_DESCRIPCION                                                                            JORNADA,
                EP.ESTP_PERIODOACADEMICO                                                                       SEM,
                nvl(TR.TIRF_DESCRIPCION, 'N/A')                                                                 tirf_descripcion ,
                nvl(A.REFI_NOMENCLATURA, 'N/A')                                                                 refi_nomenclatura,
                GR.MATE_CODIGOMATERIA ,
                MA.MATE_NOMBRE,
                GR.GRUP_NOMBRE,
                NVL(DECODE(CS.CLSE_DIA, 1, 'LUNES', 2, 'MARTES', 3, 'MIERCOLES', 4, 'JUEVES', 5, 'VIERNES', 6, 'SABADO',
                           7, 'DOMINGO'), 'Z') AS                                                              DIA,
                nvl(BH.BLHO_HORAINICIO, '0000')                                                                inicio,
                nvl(BH2.BLHO_HORAFINAL, '0000')                                                                final,
                nvl(CS.CLSE_DIA, 0)                                                                            ORDEN,
                NVL(EF.ESFI_NOMBRE, '-')                                                                       ESFI_NOMBRE,
                to_char(cs.clse_fechainicio, 'dd/mm/yyyy') || '-' || to_char(cs.clse_fechafinal, 'dd/mm/yyyy') fechas
         "))
            ->fromRaw("GENERAL.V_PERSONA P,
                ACADEMICO.ESTUDIANTEPENSUM EP,
                ACADEMICO.UNIDADPROGRAMA UP,
                ACADEMICO.PROGRAMA PR,
                ACADEMICO.JORNADA JO,
                ACADEMICO.SITUACIONESTUDIANTE SITE,
                ACADEMICO.CATEGORIA CATE,
                ACADEMICO.MATRICULAACADEMICA MA,
                ACADEMICO.GRUPOMATRICULADO GM,
                ACADEMICO.RECURSOFISICO A,
                ACADEMICO.TIPORECURSOFISICO TR,
                ACADEMICO.ESPACIOFISICO EF,
                ACADEMICO.LOCALIDAD LO,
                ACADEMICO.CLASESEMANAL CS,
                ACADEMICO.GRUPO GR,
                ACADEMICO.MATERIA MA,
                ACADEMICO.RESERVARECURSOFISICO RRF,
                ACADEMICO.BLOQUEHORAS BH,
                ACADEMICO.BLOQUEHORAS BH2,
                ACADEMICO.PERIODOUNIVERSIDAD PU")
            ->whereRaw("
                P.PEGE_ID = EP.PEGE_ID
                AND EP.UNPR_ID = UP.UNPR_ID
                AND UP.PROG_ID = PR.PROG_ID
                AND EP.SITE_ID = SITE.SITE_ID
                AND EP.CATE_ID = CATE.CATE_ID
                AND EP.ESTP_ID = MA.ESTP_ID
                AND MA.PEUN_ID = PU.PEUN_ID
                AND SITE.SITE_ID = 5
                AND PR.JORN_ID = JO.JORN_ID
                AND MA.MAAC_ID = GM.MAAC_ID(+)
                AND GM.GRMA_ESTADO(+) = 1
                AND GM.GRUP_ID = GR.GRUP_ID
                AND RRF.REFI_ID = A.REFI_ID(+)
                AND CS.CLSE_ID = RRF.CLSE_ID(+)
                AND GR.GRUP_ID = CS.GRUP_ID(+)
                AND GR.PEUN_ID = PU.PEUN_ID
                AND GR.MATE_CODIGOMATERIA = MA.MATE_CODIGOMATERIA
                AND CS.BLHO_IDINICIAL = BH.BLHO_ID(+)
                AND CS.BLHO_IDFINAL = BH2.BLHO_ID(+)
                AND EF.ESFI_ID(+) = A.ESFI_ID
                AND TR.TIRF_ID(+) = A.TIRF_ID
                AND LO.LOCA_ID(+) = EF.LOCA_ID
                AND 1 = (select activado from sse.activarhorario)
            ")
            ->where("EP.ESTP_ID","=",$estpId)
            ->orderByRaw("MA.MATE_NOMBRE, ORDEN, inicio")
            ->get()->fromStdToArray();
    }

}
