<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait DisciplinatyUtil
{
    public function getDisciplinary($estpId)
    {
        return DB::table("")->select(DB::raw("
                EP.ESTP_ID,
                SAN.SANC_ID DISCIPLINE_EVENT_CODE,
                SAN.SANC_FECHA,
                SAN.SANC_ESTADO,
                NVL(SAN.SANC_NUMEROPERIODOS, '0') as SANC_NUMEROPERIODOS,
                NVL(TS.TIPS_DESCRIPCION, '-') as TIPS_DESCRIPCION,
                NVL(TS.TIPS_IMPLICAEXPULSION, '-') as TIPS_IMPLICAEXPULSION,
                NVL(FR.FARE_DESCRIPCION, '-') as FARE_DESCRIPCION
         "))
            ->fromRaw("ACADEMICO.SANCION SAN,
                ACADEMICO.TIPOSANCION TS,
                ACADEMICO.FALTAREGLAMENTO FR,
                ACADEMICO.ESTUDIANTEPENSUM EP,
                ACADEMICO.PROGRAMA PR,
                ACADEMICO.UNIDADPROGRAMA UN,
                academico.relacionunidad ru")
            ->whereRaw("
                TS.TIPS_ID = SAN.TISA_ID
                AND SAN.FARE_ID = FR.FARE_ID
                AND SAN.PEGE_ID = EP.PEGE_ID
                AND EP.UNPR_ID = UN.UNPR_ID
                AND PR.PROG_ID = UN.PROG_ID
                and un.unid_id = ru.unid_id(+)
                ")
            ->where("ep.estp_id","=",$estpId)
            ->get()->fromStdToArray();
    }
}
