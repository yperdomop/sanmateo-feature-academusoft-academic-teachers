<?php

namespace App\Http\Utils\Database\Teacher;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait TeacherSchedule
{
    public function getTeacherSchedule(int $pegeId): Collection {
        return DB::table('')->selectRaw("DISTINCT
        GR.MATE_CODIGOMATERIA as subjectid, MA.MATE_NOMBRE as subjectname, NVL(SUBSTR(GR.GRUP_NOMBRE, 0, INSTR(GR.GRUP_NOMBRE, '<')-1), GR.GRUP_NOMBRE) AS groupName,
        EF.ESFI_DESCRIPCION as locationDescription,
        A.REFI_NOMENCLATURA as locationClassRoom,
        DECODE (CS.CLSE_DIA, 1, 'LUNES', 2, 'MARTES', 3, 'MIERCOLES', 4, 'JUEVES', 5, 'VIERNES',  6, 'SABADO', 7, 'DOMINGO' ) AS classDay,
        BH.BLHO_HORAINICIO as classInit, BH2.BLHO_HORAFINAL as classFinish, CS.CLSE_DIA as classNumberDay")
        ->fromRaw('ACADEMICO.RECURSOFISICO A,
        ACADEMICO.TIPORECURSOFISICO TR,
         ACADEMICO.ESPACIOFISICO EF,
         ACADEMICO.LOCALIDAD LO,
         ACADEMICO.CLASESEMANAL CS,
         ACADEMICO.GRUPO GR,
         ACADEMICO.MATERIA MA,
         ACADEMICO.RESERVARECURSOFISICO RRF,
         ACADEMICO.BLOQUEHORAS BH,
         ACADEMICO.BLOQUEHORAS BH2,
         academico.unidadprograma up,
         general.v_persona pd, general.PERSONANATURALGENERAL pn,
         academico.docentegrupo dg,
         academico.docenteunidad du')
        ->whereRaw('MA.MATE_CODIGOMATERIA=GR.MATE_CODIGOMATERIA(+)
        and gr.GRUP_ACTIVO=1
        and up.unid_id in (2193,2876)
        AND GR.GRUP_ID = CS.GRUP_ID(+)
        AND CS.CLSE_ID = RRF.CLSE_ID(+)
        AND RRF.REFI_ID = A.REFI_ID(+)
        AND CS.BLHO_IDINICIAL = BH.BLHO_ID(+)
        AND CS.BLHO_IDFINAL = BH2.BLHO_ID(+)
        AND A.ESFI_ID=EF.ESFI_ID(+)
        AND A.TIRF_ID=TR.TIRF_ID(+)
        AND EF.LOCA_ID=LO.LOCA_ID(+)
        AND du.pege_id=pd.pege_id(+)
        and pd.pege_id=pn.pege_id(+)
        and dg.doun_id=du.doun_id(+)
        and gr.grup_id=dg.grup_id(+)')
        ->where('GR.PEUN_ID', 1027)
        ->where('pd.pege_id', $pegeId)->get()->fromStdToArray();
    }
}
