<?php

namespace App\Http\Utils\Database\Student\AdmissionData;

use App\Models\academic\sse\Formulario;
use App\Models\academic\sse\PagoEstudiante;
use Illuminate\Support\Facades\DB;

trait AdmissionDataUtil
{
    public function findAdmissionDataByDocument($documentNumber)
    {
        $data = DB::table("")->select(DB::raw("
               B.FOIN_ID,
                A.ASPI_NUMERODOCUMENTO,
                A.ASPI_PRIMERAPELLIDO || ' ' || A.ASPI_SEGUNDOAPELLIDO AS APELLIDOS,
                A.ASPI_PRIMERNOMBRE || ' ' || A.ASPI_SEGUNDONOMBRE     AS NOMBRES,
                F.PROG_NOMBRE,
                H.JORN_DESCRIPCION,
                B.FOIN_ESTADOADMISION,
                M.PEUN_ANO || '-' || M.PEUN_PERIODO                       PERIODO
         "))
            ->fromRaw("
                ACADEMICO.ASPIRANTE A,
                 ACADEMICO.FORMULARIOINSCRIPCION B,
                 ACADEMICO.PROGRAMAXFORMULARIO D,
                 ACADEMICO.UNIDADPROGRAMA E,
                 ACADEMICO.PROGRAMA F,
                 ACADEMICO.MODALIDAD G,
                 ACADEMICO.JORNADA H,
                 GENERAL.TIPODOCUMENTOGENERAL I,
                 ACADEMICO.CONVOCATORIAINSCRIPCION L,
                 ACADEMICO.PERIODOUNIVERSIDAD M
            ")
            ->whereRaw("B.FOIN_ESTADOADMISION <> 'ANULADO'
                AND A.ASPI_ID = B.ASPI_ID
                AND B.FOIN_ID = D.FOIN_ID
                AND D.UNPR_ID = E.UNPR_ID
                AND E.PROG_ID = F.PROG_ID
                AND F.MODA_ID = G.MODA_ID
                AND F.JORN_ID = H.JORN_ID
                AND L.COIN_ID = D.COIN_ID
                AND M.PEUN_ID = L.PEUN_ID
                AND A.ASPI_TIPODOCUMENTO = I.TIDG_ID
                AND A.ASPI_NUMERODOCUMENTO = '".$documentNumber."'")
            ->groupByRaw("B.FOIN_ID, A.ASPI_NUMERODOCUMENTO, A.ASPI_PRIMERAPELLIDO, A.ASPI_SEGUNDOAPELLIDO, A.ASPI_PRIMERNOMBRE,
         A.ASPI_SEGUNDONOMBRE, F.PROG_NOMBRE, H.JORN_DESCRIPCION, B.FOIN_ESTADOADMISION, M.PEUN_ANO, M.PEUN_PERIODO")->get()->fromStdToArray();
        return ($data == null)?[]:$data;
    }


    public function getGeneralDataByFoinId($foinId)
    {
        $data = DB::table("")->select(DB::raw("
               B.FOIN_ID,
                I.TIDG_ABREVIATURA,
                A.ASPI_NUMERODOCUMENTO,
                A.ASPI_PRIMERAPELLIDO || ' ' || A.ASPI_SEGUNDOAPELLIDO     AS APELLIDOS,
                A.ASPI_PRIMERNOMBRE || ' ' || A.ASPI_SEGUNDONOMBRE         AS NOMBRES,
                A.ASPI_TELEFONORESIDENCIA || '-' || A.ASPI_TELEFONOCELULAR AS TELEFONOS,
                F.PROG_NOMBRE,
                H.JORN_DESCRIPCION,
                B.FOIN_ESTADOADMISION,
                G.MODA_DESCRIPCION,
                M.PEUN_ANO || '-' || M.PEUN_PERIODO as PERIODO,
                B.FOIN_FECHAHORAVERIFICACION,
                A.ASPI_SEXO,
                NVL(A.ASPI_EMAIL, '--') as EMAIL,
                N.PA_ID,
                O.PA_NOMBRE,
                N.CON_ID,
                P.CON_NOMBRE,
                N.PE_VALOR,
                N.PA_DESCUENTO,
                Q.TF_ID,
                R.TF_NOMBRE,
                Q.FOR_NUMERO,
                S.PEGE_ID,
                NVL(T.PC_BOLETA, '0') as PC_BOLETA,
                NVL((SELECT PEGE_DOCUMENTOIDENTIDAD from GENERAL.V_PERSONA where PEGE_ID = T.PEGE_ID AND ROWNUM <= 1),'0') as REFERENTE,
                NVL(V.OMED_DESCRIPCION, 'NO REGISTRA') as OMED_DESCRIPCION,
                N.PE_DESCUENTOPRIMERCUOTA
         "))
            ->fromRaw("
               ACADEMICO.ASPIRANTE A,
                ACADEMICO.FORMULARIOINSCRIPCION B,
                ACADEMICO.PROGRAMAXFORMULARIO D,
                ACADEMICO.UNIDADPROGRAMA E,
                ACADEMICO.PROGRAMA F,
                ACADEMICO.MODALIDAD G,
                ACADEMICO.JORNADA H,
                GENERAL.TIPODOCUMENTOGENERAL I,
                ACADEMICO.CONVOCATORIAINSCRIPCION L,
                ACADEMICO.PERIODOUNIVERSIDAD M,
                SSE.PAGO_ESTUDIANTE N,
                SSE.PAGO O,
                SSE.CONVENIO P,
                SSE.FORMULARIO Q,
                SSE.TIPO_FORMULARIO R,
                SSE.RESPONSABLE S,
                SSE.PLAN_CONEXION T,
                ACADEMICO.MEDIODIVULGACION U,
                ACADEMICO.OTROMEDIODIVULGACION V
            ")
            ->where("B.FOIN_ID","=",$foinId)
            ->whereRaw("
            B.FOIN_ESTADOADMISION <> 'ANULADO'
              AND A.ASPI_ID = B.ASPI_ID
              AND B.FOIN_ID = D.FOIN_ID
              AND D.UNPR_ID = E.UNPR_ID
              AND E.PROG_ID = F.PROG_ID
              AND F.MODA_ID = G.MODA_ID
              AND F.JORN_ID = H.JORN_ID
              AND L.COIN_ID = D.COIN_ID
              AND M.PEUN_ID = L.PEUN_ID
              AND A.ASPI_TIPODOCUMENTO = I.TIDG_ID
              AND B.FOIN_ID = '39924'
              AND N.FOIN_ID = B.FOIN_ID
              AND O.PA_ID = N.PA_ID
              AND P.CON_ID = N.CON_ID
              AND Q.FOIN_ID = B.FOIN_ID
              AND Q.TF_ID = R.TF_ID
              AND S.FOIN_ID = B.FOIN_ID
              AND B.FOIN_ID = T.FOIN_ID(+)
              AND U.MEDI_ID = A.MEDI_IDCONOCEINSTITUCION
              AND V.OMED_ID = U.OMED_ID
                        ORDER BY B.FOIN_ID DESC, REFERENTE")
            ->get()
            ->fromStdToArray();
        return ($data == null)?[]:$data;
    }

    public function getPayment(){
        $data = DB::table("")->select(DB::raw("*"))
            ->fromRaw("SSE.PAGO")
            ->get()
            ->fromStdToArray();
        return ($data == null)?[]:$data;
    }

    public function getCovenants(){
        $data = DB::table("")->select(DB::raw("*"))
            ->fromRaw("SSE.CONVENIO")
            ->whereRaw("con_estado=1 order by CON_NOMBRE")
            ->get()
            ->fromStdToArray();
        return ($data == null)?[]:$data;
    }

    public function saveStudentPayment(array $data, $foinId){

        $entity = PagoEstudiante::where("foin_id","=",$foinId)->update($data);
        if($entity == 1){
            return true;
        }
        return false;
    }

    public function getTypeFormLIst(){
        $data = DB::table("")->select(DB::raw("*"))
            ->fromRaw("SSE.TIPO_FORMULARIO")
            ->whereRaw("tf_estado=1")
            ->get()
            ->fromStdToArray();
        return ($data == null)?[]:$data;
    }

    public function saveTypeFormSelected(array $data, $foinId){

        $entity = Formulario::where("foin_id","=",$foinId)->update($data);
        if($entity == 1){
            return true;
        }
        return false;
    }

    public function getAdviserList(){
        $data = DB::table("")->select(DB::raw("
        distinct F.PEGE_ID, G.PENG_PRIMERAPELLIDO AS APELLIDOS, G.PENG_PRIMERNOMBRE NOMBRES
        "))
            ->fromRaw("GENERAL.PERSONAGENERAL F,
                GENERAL.PERSONANATURALGENERAL G,
                academico.unidad un,
                talentov3.labor la,
                talentov3.trabajadorlabor tl,
                talentov3.trabajadorlaborunidad tlu,
                talentov3.tiponombramiento tn")
            ->whereRaw("
                F.PEGE_ID = G.PEGE_ID
                AND F.PEGE_ID = TL.PEGE_ID
                AND F.PEGE_ID = TLU.PEGE_ID
                AND TLU.UNID_ID = UN.UNID_ID
                AND TL.TNOM_ID = TN.TNOM_ID
                and tl.labo_id = tlu.labo_id
                and la.labo_id = tl.labo_id
                and la.labo_id = tlu.labo_id
                and tlu.TRLU_ESTADO = 'ACTIVO'

                AND (LABO_NOMBRE like '%MARKETING Y COMUNICACIÒNES%' or LABO_NOMBRE like '%PRACTICANTE%' or
                     LABO_NOMBRE like '%ASESOR COMERCIAL%')
                and F.PEGE_ID not in (000000, 8128791, 8180945, 8171225, 8135727, 8179706, 8180965)
                AND (tl.trla_fechafinal >= SYSDATE OR tl.trla_fechafinal IS NULL)
            ")
            ->where("un.UNID_ID","=",'2254') //TODO validar con la sesion la unidad a la que pertenece
            ->orderByRaw("NOMBRES, APELLIDOS")
            ->get()
            ->fromStdToArray();
        return ($data == null)?[]:$data;
    }
}
