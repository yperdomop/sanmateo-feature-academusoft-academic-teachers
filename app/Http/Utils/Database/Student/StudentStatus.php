<?php

namespace App\Http\Utils\Database\Student;

use Illuminate\Support\Facades\DB;

trait StudentStatus
{
    public function getStudentListBySubjectAndGroup()
    {
        return DB::select("select distinct
        p.pege_documentoidentidad,  ep.estp_id, p.nombre, pr.prog_codigoprograma, pr.prog_nombre,jo.jorn_descripcion,
        site.site_descripcion, cate.cate_descripcion, ep.estp_periodoacademico sem, ma.maac_estado,
        pg.PEGE_MAIL, pn.PENG_EMAILINSTITUCIONAL, pg.pege_telefonocelular,
        gm.grma_id, gr.grup_id, gr.grup_nombre, mat.MATE_CODIGOMATERIA, mat.mate_nombre,
        ep.UNID_ID, gm.GRMA_ID, gm.GRMA_BANCOMATERIA, gm.GRMA_FINAL, ma.MAAC_ID, hom.ENT_ID, ent.ENT_NOMBRE
        from
        general.v_persona p, general.personageneral pg,  general.personanaturalgeneral pn,
        academico.estudiantepensum ep,
        academico.unidadprograma up,
        academico.programa pr, academico.jornada jo,
        academico.situacionestudiante site,
        academico.categoria cate,
        academico.matriculaacademica ma,
        academico.grupomatriculado gm,
        academico.grupo gr, academico.materia mat, mesa.HOMOLOGANTE hom, BSTAR.ENTIDAD ent
        where
        p.pege_id=ep.pege_id and p.pege_id=pg.pege_id and p.pege_id=pn.pege_id
        and ep.unpr_id=up.unpr_id and ep.ESTP_ID=hom.ESTP_ID(+) and hom.ENT_ID=ent.ENT_ID(+)
        and up.prog_id=pr.prog_id
        and ep.site_id=site.site_id
        and ep.cate_id=cate.cate_id
        and ep.estp_id=ma.estp_id
        and ma.peun_id=827
        and pr.jorn_id=jo.jorn_id
        and ma.maac_id=gm.maac_id and gm.grup_id=gr.grup_id and gr.mate_codigomateria=mat.mate_codigomateria
        and gm.grma_estado=1
        order by pr.prog_nombre, ep.estp_periodoacademico, cate.cate_descripcion, site.site_descripcion");
    }
}
