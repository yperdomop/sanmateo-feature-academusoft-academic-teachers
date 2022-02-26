<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait OfferUtil
{

    public function getDataGraduate($estpId)
    {
        $data = DB::table("")->select(DB::raw("
               d.mate_id, m.mate_nombre, u.unid_nombre, d.dema_numeroveces
         "))
            ->fromRaw("
               academico.demanda d,
                academico.materia m,
                academico.unidad u
            ")
            ->whereRaw("d.mate_id = m.mate_codigomateria
            and d.peun_id in
                (select peun_id from academico.periodouniversidad where peun_fechainicio < sysdate and peun_fechafin > sysdate)
            and d.unid_idregional = u.unid_id ")
            ->where("d.estp_id","=",$estpId)
            ->get()->fromStdToArray();

        return ($data == null)?[]:$data;
    }

}
