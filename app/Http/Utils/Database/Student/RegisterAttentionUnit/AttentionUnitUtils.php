<?php


namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use App\Models\academic\sse\CasoEstudiante;
use App\Models\academic\sse\CasoEstudianteDependencia;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

trait AttentionUnitUtils
{
    public function getListStudentsByDocAndName($document, $name, $estpId = null)
    {
        return DB::table("")->select(DB::raw("distinct
        un.UNID_NOMBRE,
        p.pege_id, td.TIDG_ABREVIATURA, p.pege_documentoidentidad,
        td.TIDG_ABREVIATURA||p.pege_documentoidentidad,
        p.pege_id, pr.PROG_ID,
        ep.estp_codigomatricula,
        ep.estp_id, ep.peun_id, pu.peun_ano||'-'||pu.peun_periodo,
        pn.peng_primerapellido, pn.peng_segundoapellido, pn.peng_primernombre, pn.peng_segundonombre,
        p.nombre,
        pr.prog_codigoprograma, pr.prog_nombre, pr.PROG_CODIGOICFES,pr.PROG_ABREVIATURA,
        jo.jorn_descripcion, site.site_descripcion, cate.cate_descripcion, ep.estp_periodoacademico sem,
        to_char (ep.estp_fechaingreso, 'yyyy-mm-dd') as fecha_ingreso,
        to_char (pn.peng_fechanacimiento, 'yyyy-mm-dd') as fecha_nacimiento,
        pn.peng_sexo,
        ep.estp_promediogeneral,
        pr.PROG_CODIGOICFES,PAGE_IDNACIONALIDAD,
        pn.peng_emailinstitucional, pg.pege_mail, PG.PEGE_TELEFONOCELULAR  , PG.PEGE_TELEFONO, PG.PEGE_DIRECCION,
        ep.PENS_ID, ep.UNPR_ID, pr.PROG_ID, ep.UNID_ID, pr.PROG_CODIGOICFES"))
            ->fromRaw("general.v_persona p, general.personanaturalgeneral pn, general.personageneral pg,
        general.TIPODOCUMENTOGENERAL td,
        academico.estudiantepensum ep,
        academico.unidadprograma up,
        academico.programa pr, academico.jornada jo,
        academico.situacionestudiante site,
        academico.categoria cate, academico.periodouniversidad pu,
        academico.HIS_MATRICULAACADEMICA hm,
        mesa.HOMOLOGANTE hom, academico.UNIDAD un")
            ->whereRaw("p.pege_id=ep.pege_id(+) and p.pege_id=pn.pege_id and p.pege_id=pg.pege_id and ep.peun_id=pu.peun_id(+)
        and pg.tidg_id=td.tidg_id
        and ep.unpr_id=up.unpr_id(+)
        and up.prog_id=pr.prog_id(+)
        and ep.site_id=site.site_id(+)
        and ep.cate_id=cate.cate_id(+)
        and pr.jorn_id=jo.jorn_id(+)
        and ep.estp_id=hm.ESTP_ID(+)
        and hm.ESTP_ID=hom.ESTP_ID(+) and ep.UNID_ID=un.UNID_ID")
            ->when($document, function ($query, $document) {
                return $query->where('p.pege_documentoidentidad', "like", '%' . $document . '%');
            })
            ->when($name, function ($query, $name) {
                return $query->where('p.nombre', "like", "%" . str_replace(' ', '%', $name) . "%");
            })->when($estpId, function ($query, $estpId) {
                return $query->where('ep.estp_id', "=", $estpId);
            })->get()->fromStdToArray();
    }


    public function getListStudentsSplitName($document, $name)
    {
        $splitName = explode(" ",$name);
        $query = $this->splitNameQuery($splitName);

        return DB::table("")->select(DB::raw(" NVL(p.pege_documentoidentidad, '-') DOCUMENTO,
       NVL(ep.estp_id, 0),
       NVL(p.nombre, '-') as nombre,
       NVL(pr.prog_nombre, '-')            PROGRAMA,
       NVL(jo.jorn_descripcion, '-')       JORNADA,
       NVL(site.site_descripcion, '-') site_descripcion,
       NVL(cate.cate_descripcion, '-'),
       NVL(ep.estp_periodoacademico, 0)    sem,
       NVL(site.SITE_DESCRIPCION, '-'),
       NVL(pr.prog_id, 0),
       NVL(pg.pege_mail, '-'),
       NVL(md.MODA_DESCRIPCION, '-'),
       NVL(pg.pege_direccion, '-'),
       (pn.peng_fechanacimiento),
       NVL(pn.peng_sexo, '-'),
       NVL(pg.PEGE_TELEFONO, '-'),
       NVL(pg.PEGE_TELEFONOCELULAR, '-'),
       NVL(ep.ESTP_PERIODOACADEMICO, 0),
       NVL(ep.PEGE_ID, 0) ,
     NVL(ep.ESTP_ID, 0) ESTP_ID"))
            ->fromRaw("general.v_persona p,
                general.personageneral pg,
                general.personanaturalgeneral pn,
                academico.estudiantepensum ep,
                academico.unidadprograma up,
                academico.programa pr,
                ACADEMICO.MODALIDAD md,
                academico.jornada jo,
                academico.situacionestudiante site,
                academico.categoria cate,
                (SELECT PENG_PRIMERNOMBRE || ' ' || PENG_SEGUNDONOMBRE || ' ' || PENG_PRIMERAPELLIDO || ' ' ||
                        PENG_SEGUNDOAPELLIDO NOMBRE,
                        PEGE_ID
                 FROM GENERAL.PERSONANATURALGENERAL) BUSCAR")
            ->whereRaw("md.MODA_ID = pr.MODA_ID
                AND p.pege_id = ep.pege_id
                and p.pege_id = pg.pege_id
                and p.pege_id = pn.pege_id
                and ep.unpr_id = up.unpr_id
                and up.prog_id = pr.prog_id
                and ep.site_id = site.site_id
                and ep.cate_id = cate.cate_id
                and pr.jorn_id = jo.jorn_id
                and BUSCAR.PEGE_ID = p.pege_id
                and replace(replace(replace(p.pege_documentoidentidad, ',', ''), '.', ''), ' ', '') LIKE '%". $document ."%'
                ".$query)
            ->orderByRaw("p.nombre, site.SITE_DESCRIPCION")
            ->get()->fromStdToArray();
    }

    public function splitNameQuery(array $splitName)
    {
        $query = "";
        foreach ($splitName as  $segment){
            $query = $query . "AND upper(BUSCAR.NOMBRE) LIKE upper('%".$segment."%') ";
        }
        return $query;
    }


    public function getAttetionWays()
    {
        return DB::table("")->select(DB::raw("FOAT_ID, FOAT_NOMBRE    "))
            ->fromRaw("SSE.FORMA_ATENCION")
            ->whereRaw("FOAT_ESTADO='1' ORDER BY FOAT_NOMBRE")
            ->get()->fromStdToArray();
    }

    public function getTypesAttention()
    {
        return DB::table("")->select(DB::raw("tc.caso_id, tc.caso_nombre"))
            ->fromRaw("sse.tipo_caso tc, sse.tipo_caso_dependencia tcd")
            ->whereRaw("
               tc.caso_id = tcd.caso_id
  and (tc.CASO_ESTADO != 'INACTIVO' or tc.CASO_ESTADO is null or tc.CASO_ESTADO = 'ACTIVO')
  and tc.CASO_MODALIDAD =
      (select decode(pr.meto_id, '1', 'PRESENCIAL', '2', 'PRESENCIAL', '3', 'VIRTUAL', '4', 'VIRTUAL',
                     'PRESENCIAL') meto
       from academico.estudiantepensum ep,
            academico.unidadprograma up,
            academico.programa pr
       where
             ep.unpr_id = up.unpr_id
         and up.prog_id = pr.prog_id
         and rownum <= 1)
            order by tc.caso_nombre")
            ->get()->fromStdToArray();
        /*ep.estp_id = '322965' and*/
    }

    public function getTypeAttentionByCaseId(array $dataCases)
    {
        if($dataCases!=null && count($dataCases) > 0){
            $caseId = $dataCases[0]['caso_id'];
            return DB::table("")->select(DB::raw("CASO_ID, CASO_NOMBRE"))
                ->fromRaw("SSE.TIPO_CASO")
                ->whereRaw("(CASO_ESTADO != 'INACTIVO' or CASO_ESTADO is null or CASO_ESTADO = 'ACTIVO')")
                ->where("CASO_ID", '>','99')
                ->whereIn("CASO_ID",[$caseId])
                ->get()->fromStdToArray();
        }
        return [];

    }

    /**direccionado a **/
    public function getAddressedTo($caseId)
    {
        return DB::table("")->select(DB::raw("A.UNID_ID, B.UNID_NOMBRE"))
            ->fromRaw("SSE.ATENCION_UNIDAD A, ACADEMICO.UNIDAD B, sse.caso_dependencia c")
            ->whereRaw("A.UNID_ID = B.UNID_ID  and c.caso_id =  " . $caseId . "   and c.unid_id = a.unid_id
                order by b.unid_nombre desc")
            ->get()->fromStdToArray();
    }

    public function getMaxCaseId()
    {
        return DB::table("")->select(DB::raw("max(ce_id) as max"))
            ->fromRaw("SSE.CASO_ESTUDIANTE")
            ->get()->fromStdToArray()->first();
    }

    public function getMaxTime($caseId)
    {
        return DB::table("")->select(DB::raw("caso_tiempo"))
            ->fromRaw("SSE.TIPO_CASO")
            ->where("caso_id", '=', $caseId)
            ->get()->fromStdToArray()->first();
    }

    public function getAttentionsByEstpId($estpId)
    {
        return DB::table("")->select(DB::raw("A.CE_ID, A.CASO_ID, D.CASO_NOMBRE, A.CE_FECHA_IN, A.CE_FECHA_MAX"))
            ->fromRaw("SSE.CASO_ESTUDIANTE A,
                ACADEMICO.ESTUDIANTEPENSUM B,
                SSE.TIPO_CASO D")
            ->whereRaw("A.ESTP_ID = B.ESTP_ID AND D.CASO_ID = A.CASO_ID")
            ->where("A.CE_ESTADO", '=', 'Pendiente')
            ->where("A.ESTP_ID", '=', $estpId)
            ->orderBy("A.CE_ID","DESC")
            ->get()->fromStdToArray();
    }

    public function insertCase($arrayInsert)
    {
        $maxCeId = $this->getMaxCaseId();
        $maxCeIdPlusOne = ($maxCeId["max"] + 1);
        $maxTime = $this->getMaxTime(($arrayInsert["selectedTypeAttention"]));
        $timezone = new \DateTimeZone('America/Bogota');
        $dateNow = new \DateTime();
        $dateNow->setTimezone($timezone);
        $time = (is_array($maxTime)) ? $maxTime["caso_tiempo"] : null;
        $dateTimeAttention = new \DateTime();
        $dateTimeAttention->setTimezone($timezone);
        $dateTimeAttention->add(new \DateInterval('P'.$time.'D'));

        $studentCase = CasoEstudiante::create([
            'CE_ID' => $maxCeIdPlusOne,
            'CASO_ID' => $arrayInsert["selectedTypeAttention"],
            'ESTP_ID' => $arrayInsert["estpId"],
            'CE_ESTADO' => $arrayInsert["caseStatus"],
            'CE_FECHA_IN' => $dateNow,
            'CE_FECHA_FIN' => null,
            'CE_FECHA_CAMBIO' => $dateNow,
            'CE_REGISTRADO_POR' => $arrayInsert["pege_id"],
            'CE_FECHA_MAX' => $dateTimeAttention,
            'CED_TIPO_REQUERIMIENTO' => null,
        ]);
        $studentCase->save();

        return $maxCeIdPlusOne;
    }


    public function insertCaseDependencyStudent(array $arrayInsert, $savedCeId, $unidId)
    {
        try {
            $maxCedId = $this->getMaxCaseStudentDependencyId();
            $dateNow = new \DateTime();
            $timezone = new \DateTimeZone('America/Bogota');
            $dateNow->setTimezone($timezone);
            $studentDependencyCase = CasoEstudianteDependencia::create([
                "CED_ID" => ($maxCedId["max"]+1),
                "CE_ID" => $savedCeId,
                "CED_FECHA" =>$dateNow,
                "UNID_ID" => $unidId,
                "PEGE_ID" => $arrayInsert["pege_id"],
                "CED_NO_ATENDIDO" => '',
                "FOAT_ID" => $arrayInsert['attentionWaysValue'],
                "CED_RESPUESTA" => $arrayInsert["observationCase"],
                "CED_DIRECCIONADO_A" => $arrayInsert['dependencyToValue'],
                "CED_REGISTRADO_POR" => $arrayInsert["pege_id"],
                "CED_FECHA_CAMBIO" => $dateNow
            ]);
            $studentDependencyCase->save();

            $this->insertSecondCaseDependencyStudent($arrayInsert, $savedCeId, $unidId);

            return true;
        } catch (\Exception $exception) {
            dd($exception);
        }

    }

    public function insertSecondCaseDependencyStudent(array $arrayInsert, $savedCeId, $unidId)
    {
        $maxCedId = $this->getMaxCaseStudentDependencyId();
         $dateNow = new \DateTime();
        $timezone = new \DateTimeZone('America/Bogota');
         $dateNow->setTimezone($timezone);

        $studentDependencyCase = CasoEstudianteDependencia::create([
            "CED_ID" => ($maxCedId["max"]+1),
            "CE_ID" => $savedCeId,
            "CED_FECHA" => $dateNow,
            "UNID_ID" => $arrayInsert['dependencyToValue'],
            "PEGE_ID" => null,
            "CED_NO_ATENDIDO" => '',
            "FOAT_ID" => null,
            "CED_RESPUESTA" => '-',
            "CED_DIRECCIONADO_A" => null,
            "CED_REGISTRADO_POR" => null,
            "CED_FECHA_CAMBIO" => $dateNow
        ]);
        $studentDependencyCase->save();

    }


    public function getCaseInformation($ceId)
    {
        return DB::table("")->select(DB::raw("DISTINCT A.UNID_NOMBRE,
                B.UNID_NOMBRE,
                D.CE_FECHA_IN,
                E.CASO_NOMBRE,
                D.CE_ID,
                D.CED_TIPO_REQUERIMIENTO,
                D.CE_FECHA_FIN"))
            ->fromRaw("(SELECT A.UNID_ID, B.UNID_NOMBRE
      FROM SSE.CASO_ESTUDIANTE_DEPENDENCIA A,
           ACADEMICO.UNIDAD B
      WHERE A.UNID_ID = B.UNID_ID
        AND A.CED_ID IN (SELECT MAX(CED_ID)
                         FROM SSE.CASO_ESTUDIANTE_DEPENDENCIA A,
                              SSE.CASO_ESTUDIANTE B
                         WHERE A.CE_ID = B.CE_ID
                           AND B.CE_ID = " . $ceId . ")) A,
     (SELECT A.UNID_ID, B.UNID_NOMBRE
      FROM SSE.CASO_ESTUDIANTE_DEPENDENCIA A,
           ACADEMICO.UNIDAD B
      WHERE A.UNID_ID = B.UNID_ID
        AND A.CED_ID IN (SELECT MIN(CED_ID)
                         FROM SSE.CASO_ESTUDIANTE_DEPENDENCIA A,
                              SSE.CASO_ESTUDIANTE B
                         WHERE A.CE_ID = B.CE_ID
                           AND B.CE_ID = " . $ceId . ")) B,
     SSE.CASO_ESTUDIANTE D,
     SSE.TIPO_CASO E,
     SSE.CASO_ESTUDIANTE_DEPENDENCIA F")
            ->whereRaw("E.CASO_ID = D.CASO_ID AND F.CE_ID = D.CE_ID")
            ->where("F.CE_ID", '=', $ceId)
            ->get()->fromStdToArray();
    }

    public function getCaseHistory($ceId)
    {
        return DB::select("SELECT B.UNID_NOMBRE,
       A.CED_FECHA_CAMBIO,
       A.CED_RESPUESTA,
       A.CED_DIRECCIONADO_A,
       A.CE_ID,
       '-' DIRECCIONADO,
       A.CED_ID,
       D.FOAT_NOMBRE
FROM SSE.CASO_ESTUDIANTE_DEPENDENCIA A,
     ACADEMICO.UNIDAD B,
     SSE.FORMA_ATENCION D
WHERE A.UNID_ID = B.UNID_ID
  AND A.CE_ID = " . $ceId . "
  AND D.FOAT_ID = A.FOAT_ID
  AND CED_ID NOT IN (SELECT A.CED_ID
                     FROM SSE.CASO_ESTUDIANTE_DEPENDENCIA A,
                          ACADEMICO.UNIDAD B,
                          ACADEMICO.UNIDAD D
                     WHERE A.UNID_ID = B.UNID_ID
                       AND A.CED_DIRECCIONADO_A = D.UNID_ID
                       AND A.CE_ID = " . $ceId . ")
UNION
SELECT B.UNID_NOMBRE,
       A.CED_FECHA_CAMBIO,
       A.CED_RESPUESTA,
       A.CED_DIRECCIONADO_A,
       A.CE_ID,
       D.UNID_NOMBRE,
       A.CED_ID,
       E.FOAT_NOMBRE
FROM SSE.CASO_ESTUDIANTE_DEPENDENCIA A,
     ACADEMICO.UNIDAD B,
     ACADEMICO.UNIDAD D,
     SSE.FORMA_ATENCION E
WHERE A.UNID_ID = B.UNID_ID
  AND A.CED_DIRECCIONADO_A = D.UNID_ID
  AND E.FOAT_ID = A.FOAT_ID
  AND A.CE_ID = " . $ceId . "
order by ced_id");
    }

    public function getStudentCase($ceId)
    {
        return DB::select("SELECT DISTINCT A.UNID_NOMBRE,
                B.UNID_NOMBRE,
                D.CE_FECHA_IN,
                E.CASO_NOMBRE,
                E.CASO_ID,
                D.CE_ID,
                D.CED_TIPO_REQUERIMIENTO,
                D.CE_FECHA_FIN
FROM (SELECT A.UNID_ID, B.UNID_NOMBRE
      FROM SSE.CASO_ESTUDIANTE_DEPENDENCIA A,
           ACADEMICO.UNIDAD B
      WHERE A.UNID_ID = B.UNID_ID
        AND A.CED_ID IN (SELECT MAX(CED_ID)
                         FROM SSE.CASO_ESTUDIANTE_DEPENDENCIA A,
                              SSE.CASO_ESTUDIANTE B
                         WHERE A.CE_ID = B.CE_ID
                           AND B.CE_ID =  ".$ceId.")) A,
     (SELECT A.UNID_ID, B.UNID_NOMBRE
      FROM SSE.CASO_ESTUDIANTE_DEPENDENCIA A,
           ACADEMICO.UNIDAD B
      WHERE A.UNID_ID = B.UNID_ID
        AND A.CED_ID IN (SELECT MIN(CED_ID)
                         FROM SSE.CASO_ESTUDIANTE_DEPENDENCIA A,
                              SSE.CASO_ESTUDIANTE B
                         WHERE A.CE_ID = B.CE_ID
                           AND B.CE_ID =  ".$ceId.")) B,
     SSE.CASO_ESTUDIANTE D,
     SSE.TIPO_CASO E,
     SSE.CASO_ESTUDIANTE_DEPENDENCIA F
WHERE E.CASO_ID = D.CASO_ID
  AND F.CE_ID = D.CE_ID
  AND F.CE_ID = " . $ceId);
    }


    public function getMaxCaseStudentDependencyId()
    {
        return DB::table("")->select(DB::raw("max(ced_id) as max"))
            ->fromRaw("SSE.CASO_ESTUDIANTE_DEPENDENCIA")
            ->get()->fromStdToArray()->first();
    }

    public function getAnswerCase($ceId, $unidId)
    {
        return DB::table("")->select(DB::raw("ced_id,unid_id"))
            ->fromRaw("SSE.CASO_ESTUDIANTE_DEPENDENCIA")
            ->whereRaw("CE_ID=" . $ceId . " and PEGE_ID is null and UNID_ID=" . $unidId . " order by ced_id")
            ->get()->fromStdToArray();
    }

    public function updateCaseStudentStatus(int $ceId,string $caseStatus):bool {
        dump($caseStatus);
        CasoEstudiante::where('CE_ID','=',$ceId)
            ->update(['CE_ESTADO' => $caseStatus]);
        return true;
    }


    public function insertSolutionCase($arrayInsert) : string
    {
        $answerCase = $this->getAnswerCase($arrayInsert["ceId"], $arrayInsert["dependencyToValue"]);

        $dateNow = new \DateTime();
        $timezone = new \DateTimeZone('America/Bogota');
        $dateNow->setTimezone($timezone);
        if ($answerCase!=null && count($answerCase) > 0) {
            $answerCed = $answerCase->first();
            CasoEstudianteDependencia::where('CED_ID','=',$answerCed['ced_id'])->update([
                'PEGE_ID' => $arrayInsert["pegeId"],
                'CED_NO_ATENDIDO' => '',
                'FOAT_ID' => $arrayInsert["attentionWaysValue"],
                'CED_RESPUESTA' => $arrayInsert["solutionCase"],
                'CED_DIRECCIONADO_A' => $arrayInsert["dependencyToValue"],
                'CED_REGISTRADO_POR' => $arrayInsert["pegeId"],
                'CED_FECHA_CAMBIO' => $dateNow
            ]);

            $this->updateCaseStudentStatus($arrayInsert["ceId"],$arrayInsert['caseStatus']);
            return true;
        }
        return false;

    }

}
