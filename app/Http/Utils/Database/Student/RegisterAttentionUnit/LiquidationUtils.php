<?php

namespace App\Http\Utils\Database\Student\RegisterAttentionUnit;

use Illuminate\Support\Facades\DB;

trait LiquidationUtils
{
    //obtener saldo
    public function getBalance($estpId)
    {
        return DB::table("")->select(DB::raw("
              sacl_id,
                liqu_id,
                sacl_valor,
                sacl_valorpagado,
                sacl_ordinario,
                sacl_fecha,
                (sacl_valor - sacl_valorpagado) saldo
         "))
            ->fromRaw("
                 cartera.saldoceroliquidacion
            ")
            ->whereRaw("liqu_id in (select liqu_id from cartera.liquidacion where estp_id = ".$estpId.")")
            ->get()
            ->fromStdToArray();
    }

    public function getLiquidation($estpId)
    {
        $data = DB::table("")->select(DB::raw("
             distinct p.pege_documentoidentidad,
            li.LIQU_ID,
            pu.peun_ano || '-' || pu.peun_periodo                  Periodo,
            LIQU_REFERENCIA                                        Referencia,
            LIQU_TOTALLIQUIDADO,
            LIQU_TOTALDESCUENTO,
            LIQU_FECHAPAGO,
            nvl(LIQU_VALORPAGADO, 0) as LIQU_VALORPAGADO,
            pr.prog_nombre,
            (select (sum(nvl(cf2.CUFI_VALOR, '0')) + sum(nvl(cf2.CUFI_VALOREXTRA, '0'))) - sum(nvl(cf2.CUFI_ABONO, '0'))
             from cartera.financiacion f2,
                  cartera.LIQUIDACION l2,
                  cartera.CUOTAFINANCIACION cf2
             where f2.LIQU_ID = l2.LIQU_ID
               and f2.FINA_ID = cf2.FINA_ID
               and l2.LIQU_ID = li.LIQU_ID
               and cf2.CUFI_ESTADO not in ('PAGADO', 'Pagado')) as saldo,
               (select to_char(max(rc3.reca_fechacambio), 'DD-MM-YYYY HH:MI:SS AM')
                from cartera.recibocajaconcepto rcc3,
                     cartera.recibocaja rc3
                where rcc3.conc_id = 9
                  and rcc3.reca_id = rc3.reca_id
                  and rc3.estp_id = ep.estp_id)                       fechainscripcion,
                  LIQU_FECHAPAGO
         "))
            ->fromRaw("
                 general.v_persona p,
                academico.estudiantepensum ep,
                cartera.liquidacion li,
                academico.unidadprograma up,
                academico.programa pr,
                academico.situacionestudiante site,
                academico.categoria cate,
                academico.periodouniversidad pu,
                cartera.financiacion f,
                cartera.cuotafinanciacion cf
            ")
            ->whereRaw("
                ep.estp_id = li.estp_id
                and p.pege_id = ep.pege_id
                and li.peun_id = pu.peun_id
                and ep.unpr_id = up.unpr_id
                and up.prog_id = pr.prog_id
                and ep.site_id = site.site_id
                and ep.cate_id = cate.cate_id
                AND li.LIQU_ESTADO <> 'ANULADO'
                and f.liqu_id = li.liqu_id
                and cf.fina_id = f.fina_id
            ")
            ->where("ep.estp_id","=",$estpId)
            ->get()
            ->fromStdToArray();

        return ($data == null)?[]:$data;
    }


    public function getLiquidationDetail($estpId,$liquId)
    {
        $data = DB::table("")->select(DB::raw("
             li.LIQU_ID,
            cf.cufi_valor,
            cf.cufi_valorextra,
            cf.cufi_abono,
            cf.cufi_estado,
            cf.cufi_numerocuota,
            to_char(cf.cufi_fechalimite, 'DD-MM-YYYY HH:MI:SS AM') as cufi_fechalimite,
            (select to_char(max(rc3.reca_fechacambio), 'DD-MM-YYYY HH:MI:SS AM')
             from cartera.recibocajaconcepto rcc3,
                  cartera.recibocaja rc3
             where rcc3.conc_id = 9
               and rcc3.reca_id = rc3.reca_id
               and rc3.estp_id = ep.estp_id)                       fechainscripcion,
            (select to_char(max(rcc2.recc_fecha), 'DD-MM-YYYY HH:MI:SS AM')
             from cartera.recibocajaconcepto rcc2
             where rcc2.liqu_id = li.liqu_id
               and rcc2.cufi_id = cf.cufi_id)                      fechapago
         "))
            ->fromRaw("
                general.v_persona p,
                academico.estudiantepensum ep,
                cartera.liquidacion li,
                academico.unidadprograma up,
                academico.programa pr,
                academico.situacionestudiante site,
                academico.categoria cate,
                academico.periodouniversidad pu,
                cartera.financiacion f,
                cartera.cuotafinanciacion cf
            ")
            ->whereRaw("
                ep.estp_id = li.estp_id
                 and p.pege_id = ep.pege_id
                 and li.peun_id = pu.peun_id
                 and ep.unpr_id = up.unpr_id
                 and up.prog_id = pr.prog_id
                 and ep.site_id = site.site_id
                 and ep.cate_id = cate.cate_id
                 AND li.LIQU_ESTADO <> 'ANULADO'
                 and f.liqu_id = li.liqu_id
                 and cf.fina_id = f.fina_id
            ")
            ->where("ep.estp_id","=",$estpId)
            ->where("li.LIQU_ID","=",$liquId)
            ->get()
            ->fromStdToArray();

        return ($data == null)?[]:$data;
    }

}
