<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait HomologationUtil
{
    public function getPeriodsHomo($estpId){
        return DB::table("")->select(DB::raw("
               distinct pu.PEUN_ID,
                pu.PEUN_ANO || '-' || pu.PEUN_PERIODO as periodo
         "))
            ->fromRaw("
                 mesa.homologante h,
                 mesa.homologacion_materia hm,
                 academico.tipocalificacioncualitativa tcc,
                 academico.MATERIA m,
                 academico.PERIODOUNIVERSIDAD pu
            ")
            ->whereRaw(" h.HOMO_ID = hm.HOMO_ID
                    and hm.MATE_CODIGOMATERIA = m.MATE_CODIGOMATERIA
                    and hm.HOMA_NOTACL = tcc.TICL_ID(+)
                    and h.PEUN_ID = pu.PEUN_ID
                    and h.ESTP_ID is not null
                ")
            ->where("h.ESTP_ID", "=", $estpId)
            ->get()
            ->fromStdToArray();
    }

    public function getHomologation($estpId,$peunId)
    {
        $result = DB::table("")->select(DB::raw("
                h.HOMO_ID,
                pu.PEUN_ANO || '-' || pu.PEUN_PERIODO as periodo,
                m.mate_codigomateria,
                m.MATE_NOMBRE,
                h.ESTP_ID,
                NVL(tcc.TICL_DESCRIPCION, hm.HOMA_NOTA) as TICL_DESCRIPCION
         "))
            ->fromRaw("
                 mesa.homologante h,
                 mesa.homologacion_materia hm,
                 academico.tipocalificacioncualitativa tcc,
                 academico.MATERIA m,
                 academico.PERIODOUNIVERSIDAD pu
            ")
            ->whereRaw(" h.HOMO_ID = hm.HOMO_ID
                    and hm.MATE_CODIGOMATERIA = m.MATE_CODIGOMATERIA
                    and hm.HOMA_NOTACL = tcc.TICL_ID(+)
                    and h.PEUN_ID = pu.PEUN_ID
                    and h.ESTP_ID is not null
                ")
            ->where("h.ESTP_ID", "=", $estpId)
            ->where("pu.PEUN_ID", "=", $peunId)
            ->get()
            ->fromStdToArray();

        if($result == null){
            return [];
        }
        return $result;
    }

}
