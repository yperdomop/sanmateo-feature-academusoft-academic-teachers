<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait FilesUtils
{
    public function getTypeCase($estpId)
    {
        return DB::table("")->select(DB::raw("
               distinct caes.ce_id,
                tc.caso_nombre,
                caes.ce_fecha_in,
                caes.ced_tipo_requerimiento
         "))
            ->fromRaw("sse.caso_estudiante caes,
                sse.tipo_caso tica,
                sse.tipo_caso_documento tcdo,
                sse.caso_documento cado,
                sse.tipo_caso tc")
            ->whereRaw("caes.caso_id = tica.caso_id
                and tica.caso_id = tcdo.caso_id
                and tcdo.cado_id = cado.cado_id
                and caes.ced_tipo_requerimiento in ('Tramite','Consulta')
                and caes.caso_id=tc.caso_id
                ")
            ->where("caes.estp_id","=",$estpId)
            ->orderByRaw("caes.ce_id")
            ->get()->fromStdToArray();
    }

    public function getTypeCaseByCaseId($estpId,$caseId)
    {
        return DB::table("")->select(DB::raw("
               cado.cado_nombre,
       tica.caso_id,
       cado.cado_id,
       nvl((select cado_id from sse.documento_caso where cado_id = cado.cado_id and ce_id = caes.ce_id),
           '0')                                                                                      as entrego,
       (select doca_url from sse.documento_caso where cado_id = cado.cado_id and ce_id = caes.ce_id) as url
         "))
            ->fromRaw("sse.caso_estudiante caes,
                sse.tipo_caso tica,
                sse.tipo_caso_documento tcdo,
                sse.caso_documento cado,
                sse.tipo_caso tc")
            ->whereRaw("caes.caso_id = tica.caso_id
                and tica.caso_id = tcdo.caso_id
                and tcdo.cado_id = cado.cado_id
                and caes.ced_tipo_requerimiento in ('Tramite','Consulta')
                and caes.caso_id=tc.caso_id
                ")
            ->where("caes.estp_id","=",$estpId)
            ->where("caes.ce_id","=",$caseId)
            ->orderByRaw("caes.ce_id , cado.cado_id")
            ->get()->fromStdToArray();
    }

}
