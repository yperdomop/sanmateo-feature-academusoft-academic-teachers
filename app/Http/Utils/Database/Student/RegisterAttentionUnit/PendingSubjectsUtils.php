<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait PendingSubjectsUtils
{
    public function getPendingSubjects($estpId)
    {
        return DB::table("")->select(DB::raw("
              distinct pr.PROG_NOMBRE,
                jorn.JORN_DESCRIPCION,
                pm.pema_periodo           Periodo,
                pm.mate_codigomateria     Codigo,
                ma.mate_nombre            Materia,
                MATE_PONDERACIONACADEMICA Creditos,
                decode(pema_obligatoria, '1', 'Si', '0', 'No') as pema_obligatoria,
                NVL(nf.nufo_descripcion, '-')
         "))
            ->fromRaw("academico.programa pr,
                 academico.pensum pe,
                 academico.unidadprograma up,
                 academico.unidad un,
                 academico.pensummateria pm,
                 academico.materia ma,
                 academico.bancodematerias bm,
                 ACADEMICO.JORNADA jorn,
                 academico.NUCLEOFUNDAMENTACION nf")
            ->whereRaw("pr.prog_id = pe.prog_id(+)
  and pe.espE_id in (1, 2, 3)
  and pr.prog_id = up.prog_id
  and up.unpr_relacion = 'L'
  and up.unid_id = un.unid_id
  and pe.pens_id = pm.pens_id
  and pm.mate_codigomateria = ma.mate_codigomateria
  and pm.PEMA_ESTADO = 1
  and pm.NUFO_ID = nf.NUFO_ID(+)
  and ma.mate_codigomateria = bm.BAMA_CODIGOMATERIA(+)
  AND pr.JORN_ID = jorn.JORN_ID
  and pe.pens_id in (select pens_id from academico.estudiantepensum where estp_id = ".$estpId.")
  and pm.mate_codigomateria not in
      (select mate_codigomateria from academico.registroacademico where estp_id = ".$estpId." and reac_aprobado = 1)
  and pm.mate_codigomateria not in (select gr.mate_codigomateria
                                    from academico.MATRICULAACADEMICA ma,
                                         academico.GRUPOMATRICULADO gm,
                                         academico.GRUPO gr
                                    where ma.maac_id = gm.maac_id
                                      and gm.grup_id = gr.grup_id
                                      and gm.grma_estado = 1
                                      and ma.estp_id = ".$estpId.")
                ")
            ->orderByRaw("pm.pema_periodo")
            ->get()->fromStdToArray();
    }

}
