<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait MayoredPetitionsUtils
{
    public function getPetitions($estpId)
    {
        return DB::table("")->select(DB::raw("
                distinct ep.estp_id,
                P.PEGE_ID,
                pe.peti_id,
                td.tidg_abreviatura,
                p.pege_documentoidentidad,
                pg.PEGE_LUGAREXPEDICION,
                pn.PENG_PRIMERNOMBRE || ' ' || pn.PENG_SEGUNDONOMBRE || ' ' || pn.PENG_PRIMERAPELLIDO || ' ' ||
                pn.PENG_SEGUNDOAPELLIDO NOMBRES,
                pr.prog_codigoicfes,
                pr.prog_codigoprograma  PROGRAMA,
                pn.PENG_EMAILINSTITUCIONAL,
                pg.PEGE_MAIL,
                pg.PEGE_TELEFONOCELULAR,
                pg.PEGE_TELEFONO,
                pr.moda_id,
                pe.PETI_TIPO,
                perg.PEGR_NOMBRE
         "))
            ->fromRaw("
            general.v_persona p,
            general.personanaturalgeneral pn,
            general.personageneral pg,
            general.tipodocumentogeneral td,
            academico.estudiantepensum ep,
            academico.unidadprograma up,
            academico.programa pr,
            academico.jornada jo,
            academico.situacionestudiante site,
            academico.categoria cate,
            mesa.peticion pe,
            mesa.periodogrado perg
            ")
            ->whereRaw("p.pege_id = ep.pege_id
                and p.pege_id = pn.pege_id
                and p.pege_id = pg.pege_id
                and pg.tidg_id = td.tidg_id
                and ep.unpr_id = up.unpr_id
                and up.prog_id = pr.prog_id
                and ep.site_id = site.site_id
                and ep.cate_id = cate.cate_id
                and pr.jorn_id = jo.jorn_id
                and ep.estp_id = pe.estp_id
                and pe.PEGR_ID = perg.PEGR_ID
                ")
            ->where("ep.estp_id", "=", $estpId)
            ->orderByRaw("pn.PENG_PRIMERNOMBRE || ' ' || pn.PENG_SEGUNDONOMBRE || ' ' || pn.PENG_PRIMERAPELLIDO || ' ' ||
                 pn.PENG_SEGUNDOAPELLIDO")
            ->get()->fromStdToArray();
    }

    public function getStatusPetitions($estpId,$petiId)
    {
        return DB::table("")->select(DB::raw("
                distinct ep.estp_id,
                P.PEGE_ID,
                pe.peti_id,
                td.tidg_abreviatura,
                p.pege_documentoidentidad,
                pg.PEGE_LUGAREXPEDICION,
                pn.PENG_PRIMERNOMBRE || ' ' || pn.PENG_SEGUNDONOMBRE || ' ' || pn.PENG_PRIMERAPELLIDO || ' ' ||
                pn.PENG_SEGUNDOAPELLIDO NOMBRES,
                pr.prog_codigoicfes,
                pr.prog_codigoprograma  PROGRAMA,
                pn.PENG_EMAILINSTITUCIONAL,
                pg.PEGE_MAIL,
                pg.PEGE_TELEFONOCELULAR,
                pg.PEGE_TELEFONO,
                pr.moda_id,
                pe.PETI_TIPO,
                perg.PEGR_NOMBRE
         "))
            ->fromRaw("
            general.v_persona p,
            general.personanaturalgeneral pn,
            general.personageneral pg,
            general.tipodocumentogeneral td,
            academico.estudiantepensum ep,
            academico.unidadprograma up,
            academico.programa pr,
            academico.jornada jo,
            academico.situacionestudiante site,
            academico.categoria cate,
            mesa.peticion pe,
            mesa.periodogrado perg
            ")
            ->whereRaw("p.pege_id = ep.pege_id
                and p.pege_id = pn.pege_id
                and p.pege_id = pg.pege_id
                and pg.tidg_id = td.tidg_id
                and ep.unpr_id = up.unpr_id
                and up.prog_id = pr.prog_id
                and ep.site_id = site.site_id
                and ep.cate_id = cate.cate_id
                and pr.jorn_id = jo.jorn_id
                and ep.estp_id = pe.estp_id
                and pe.PEGR_ID = perg.PEGR_ID
                ")
            ->where("ep.estp_id", "=", $estpId)
            ->orderByRaw("pn.PENG_PRIMERNOMBRE || ' ' || pn.PENG_SEGUNDONOMBRE || ' ' || pn.PENG_PRIMERAPELLIDO || ' ' ||
                 pn.PENG_SEGUNDOAPELLIDO")
            ->get()->fromStdToArray();
    }
}
