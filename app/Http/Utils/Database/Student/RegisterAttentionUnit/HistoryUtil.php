<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait HistoryUtil
{
    public function getOpenCases($estpId){
        return DB::table("")->select(DB::raw("
                A.CE_ID, A.CASO_ID, D.CASO_NOMBRE, A.CE_FECHA_IN ,A.CE_FECHA_MAX
         "))
            ->fromRaw("SSE.CASO_ESTUDIANTE A, ACADEMICO.ESTUDIANTEPENSUM B, SSE.TIPO_CASO D")
            ->whereRaw("A.ESTP_ID=B.ESTP_ID AND D.CASO_ID=A.CASO_ID AND A.CE_ESTADO='Pendiente'")
            ->where("A.ESTP_ID","=",$estpId)
            ->orderByRaw("A.CE_ID")
            ->get()->fromStdToArray();
    }

    public function getClosedCases($estpId){
        return DB::table("")->select(DB::raw("
                A.CE_ID, A.CASO_ID, D.CASO_NOMBRE, A.CE_FECHA_IN, A.CE_FECHA_MAX, A.CE_FECHA_FIN
         "))
            ->fromRaw("SSE.CASO_ESTUDIANTE A, ACADEMICO.ESTUDIANTEPENSUM B, SSE.TIPO_CASO D")
            ->whereRaw("A.ESTP_ID=B.ESTP_ID AND D.CASO_ID=A.CASO_ID AND
            A.CE_ESTADO in ('Cerrado','Cerrado Con Aprobacion','Cerrado Sin Aprobacion','Cerrado Parcialmente Aprobado')")
            ->where("A.ESTP_ID","=",$estpId)
            ->orderByRaw("A.CE_ID")
            ->get()->fromStdToArray();
    }

}
