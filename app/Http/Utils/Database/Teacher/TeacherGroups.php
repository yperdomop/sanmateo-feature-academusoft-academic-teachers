<?php

namespace App\Http\Utils\Database\Teacher;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait TeacherGroups
{
    public function getTeacherActiveGroups(int $teacherCode = null): Collection
    {
        //ToDo: cambiar periodo activo
        return DB::table("")->select(DB::raw("distinct
        GR.mate_codigomateria AS classCode, MAT.mate_nombre as className, GR.grup_id as groupCode, GR.SIEV_ID as sievCode,
        NVL(SUBSTR(GR.GRUP_NOMBRE, 0, INSTR(GR.GRUP_NOMBRE, '<')-1), GR.GRUP_NOMBRE) AS groupName, UN.unid_nombre as unityName"))
            ->fromRaw("general.v_persona PD,
            general.PERSONANATURALGENERAL PN,
            academico.docentegrupo DG,
            academico.docenteunidad DU,
            academico.grupo GR,
            academico.materia MAT, academico.USER_HERMESOFT UH,
            academico.unidad UN")
            ->whereRaw("DU.pege_id=PD.pege_id(+)
            and PD.pege_id=PN.pege_id(+)
            and DG.doun_id=DU.doun_id(+)
            and GR.grup_id=DG.grup_id(+)
            and PD.pege_id=UH.PEGE_ID(+)
            and GR.mate_codigomateria=MAT.mate_codigomateria
            and GR.UNID_IDREGIONAL=UN.unid_id")
            ->where("GR.peun_id", "=",1027)
            ->where("GR.grup_activo",1)
            ->when($teacherCode, function ($query, $teacherCode) {
                return $query->where('PN.pege_id', $teacherCode);
            })->get()->fromStdToArray();
    }

    public function getSubjectActiveGroups(int $subjectId, int $period): Collection
    {
        //ToDo: cambiar periodo activo
        return DB::table("")->select(DB::raw("distinct
        GR.mate_codigomateria AS classCode, MAT.mate_nombre as className, GR.grup_id as groupCode, GR.SIEV_ID as sievCode,
        NVL(SUBSTR(GR.GRUP_NOMBRE, 0, INSTR(GR.GRUP_NOMBRE, '<')-1), GR.GRUP_NOMBRE) AS groupName, UN.unid_nombre as unityName, PD.nombre as teacherName"))
            ->fromRaw("general.v_persona PD,
            general.PERSONANATURALGENERAL PN,
            academico.docentegrupo DG,
            academico.docenteunidad DU,
            academico.grupo GR,
            academico.materia MAT, academico.USER_HERMESOFT UH,
            academico.unidad UN")
            ->whereRaw("DU.pege_id=PD.pege_id(+)
            and PD.pege_id=PN.pege_id(+)
            and DG.doun_id=DU.doun_id(+)
            and GR.grup_id=DG.grup_id(+)
            and PD.pege_id=UH.PEGE_ID(+)
            and GR.mate_codigomateria=MAT.mate_codigomateria
            and GR.UNID_IDREGIONAL=UN.unid_id")
            ->where("GR.peun_id", "=", $period)
            ->where("MAT.mate_codigomateria", $subjectId)
            ->where("GR.grup_activo",1)
            ->get()->fromStdToArray();
    }
}
