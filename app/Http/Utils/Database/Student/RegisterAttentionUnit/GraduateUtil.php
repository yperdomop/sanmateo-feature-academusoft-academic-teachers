<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait GraduateUtil
{

    public function getDataGraduate($estpId)
    {
        $data = DB::table("")->select(DB::raw("
                distinct p.pege_documentoidentidad DOCUMENTO,
                ep.estp_id,
                p.nombre,
                pr.prog_codigoprograma    COD,
                pr.prog_nombre            PROGRAMA,
                jo.jorn_descripcion       JORNADA,
                jo.jorn_descripcion,
                jo.jorn_descripcion,
                ep.estp_periodoacademico,
                pn.peng_emailinstitucional,
                en.*,
                pet.PETI_TIPO
         "))
            ->fromRaw("
                general.v_persona p,
                general.personageneral pg,
                general.personanaturalgeneral pn,
                academico.estudiantepensum ep,
                academico.unidadprograma up,
                academico.programa pr,
                academico.jornada jo,
                egresado.encuestaegresado en,
                mesa.peticion pet
            ")
            ->whereRaw("p.pege_id = ep.pege_id
                and p.pege_id = pg.pege_id
                and p.pege_id = pn.pege_id
                and ep.unpr_id = up.unpr_id
                and up.prog_id = pr.prog_id
                and pr.jorn_id = jo.jorn_id
                and en.estp_id = ep.estp_id
                and ep.estp_id = pet.estp_id(+) ")
            ->where("ep.estp_id","=",$estpId)
            ->get()->fromStdToArray();

        return ($data == null)?[]:$data;
    }

}
