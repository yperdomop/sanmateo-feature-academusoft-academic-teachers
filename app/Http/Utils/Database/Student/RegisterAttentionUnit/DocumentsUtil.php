<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait DocumentsUtil
{
    public function getStudentDocuments($estpId)
    {
        return DB::table("")->select(DB::raw("
                A.TDOC_ID, A.TDOC_DESCRIPCION, NVL(B.TDOC_ID, 0) as exist_doc
         "))
            ->fromRaw("(select tda.tdoc_id, tda.tdoc_descripcion
      from ACADEMICO.TIPODOCUMENTOANEXO tda,
           ACADEMICO.TIPODOCUMENTOUNIDADPROGRAMA tdp
      where tda.tdoc_id not in (851, 856, 895, 914)
        and tda.tdoc_id = tdp.tdoc_id
        and tdp.unpr_id = (select unpr_id from academico.estudiantepensum where estp_id = ".$estpId.")) a,
     (select tda.tdoc_id, tda.tdoc_descripcion
      from ACADEMICO.TIPODOCUMENTOANEXO tda,
           ACADEMICO.TIPODOCUMENTOUNIDADPROGRAMA tdp,
           ACADEMICO.ESTUDIANTEDOCUMENTOPROGRAMA edp
      where tda.tdoc_id not in (856)
        and tda.tdoc_id = tdp.tdoc_id
        and tdp.unpr_id = (select unpr_id from academico.estudiantepensum where estp_id = ".$estpId.")
        and tda.tdoc_id = edp.tdoc_id
        and edp.estp_id = ".$estpId.") b")
            ->whereRaw("A.TDOC_ID = B.TDOC_ID(+)")
            ->orderByRaw("a.tdoc_descripcion")
            ->get()->fromStdToArray();
    }

    public function getFormDocs($estpId)
    {
        return DB::table("")->select(DB::raw("
               ad.asdo_nombre, da.doas_url
         "))
            ->fromRaw("mesa.documentoxaspirante da,
                academico.estudiantepensum ep,
                academico.formularioinscripcion fi,
                mesa.aspirante_documento ad")
            ->whereRaw("da.foin_id = fi.foin_id
                    and fi.estp_id = ep.estp_id
                    and ad.asdo_id = da.asdo_id
                ")
            ->where("ep.ESTP_ID","=",$estpId)
            ->get()->fromStdToArray();
    }

    public function getHomoDocs($estpId)
    {
        return DB::table("")->select(DB::raw("
              hd.homo_id, htd.nombre_documento, hd.url
         "))
            ->fromRaw(" MESA.HOMOL_DOCUMENTOS HD,
                MESA.HOMOLOGANTE H,
                MESA.HOMOLO_TOTAL_DOCUMENTO htd")
            ->whereRaw("HD.DOCUMENTO != 12
                and HD.HOMO_ID = H.HOMO_ID
                and htd.htd_id = hd.documento
                ")
            ->where("H.ESTP_ID","=",$estpId)
            ->get()->fromStdToArray();
    }

}
