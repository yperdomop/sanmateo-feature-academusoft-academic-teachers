<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'liquidation','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Saldos de Recuperacion de Cartera</b></h5>
    </div>

    <div class="row col-lg-12  mt-5 text-center">
        <div class="col-lg-1">
            <b>#</b>
        </div>
        <div class="col-lg-2">
            <b>Liquidación</b>
        </div>
        <div class="col-lg-2">
            <b>Valor</b>
        </div>
        <div class="col-lg-2">
            <b>Valor Pagado</b>
        </div>
        <div class="col-lg-1">
            <b>Ordinario</b>
        </div>
        <div class="col-lg-2">
            <b>Fecha</b>
        </div>
        <div class="col-lg-2">
            <b>Saldo</b>
        </div>
    </div>
    @if($balance != null && count($balance) > 0)
        @foreach($balance as $balanceData)
            <div class="row col-lg-12  mt-5 text-center">
                <div class="col-lg-1">
                    {{$balanceData["sacl_id"]}}
                </div>
                <div class="col-lg-2">
                    {{$balanceData["liqu_id"]}}
                </div>
                <div class="col-lg-2">
                    {{$balanceData["sacl_valor"]}}
                </div>
                <div class="col-lg-2">
                    {{$balanceData["sacl_valorpagado"]}}
                </div>
                <div class="col-lg-1">
                    {{($balanceData["sacl_ordinario"] == 1)?'SI':'NO'}}
                </div>
                <div class="col-lg-2">
                    {{$balanceData["sacl_fecha"]}}
                </div>
                <div class="col-lg-2">
                    {{$balanceData["saldo"]}}
                </div>
            </div>
        @endforeach
    @else
        <div class="row col-lg-12 justify-content-center mt-5 text-center">
            <h6>No hay datos</h6>
        </div>
    @endif


    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Liquidación Estudiante</b></h5>
    </div>
    @if($liquidation != null && count($liquidation) > 0)
        @foreach($liquidation as $liquidationData)
            <div class="row col-lg-12  mt-5 text-center bg-info">
                <div class="col-lg-1">
                    <b>Referencia</b>
                </div>
                <div class="col-lg-2">
                    <b>Periodo</b>
                </div>
                <div class="col-lg-2">
                    <b>Total Liquidado</b>
                </div>
                <div class="col-lg-2">
                    <b>Total Descuento</b>
                </div>
                <div class="col-lg-1">
                    <b>Fecha Inscripción</b>
                </div>
                <div class="col-lg-2">
                    <b>Valor Pagado</b>
                </div>
                <div class="col-lg-2">
                    <b>Saldo</b>
                </div>
            </div>

            <div class="row col-lg-12  mt-5 text-center">
                <div class="col-lg-1">
                    {{$liquidationData["referencia"]}}
                </div>
                <div class="col-lg-2">
                    {{$liquidationData["periodo"]}}
                </div>
                <div class="col-lg-2">
                    {{$liquidationData["liqu_totalliquidado"]}}
                </div>
                <div class="col-lg-2">
                    {{$liquidationData["liqu_totaldescuento"]}}
                </div>
                <div class="col-lg-1">
                    {{$liquidationData["fechainscripcion"]}}
                </div>
                <div class="col-lg-2">
                    {{$liquidationData["liqu_valorpagado"]}}
                </div>
                <div class="col-lg-2">
                    {{$liquidationData["saldo"]}}
                </div>
            </div>


            @php
               $dataDetail = $this->getDetailLiqu($liquidationData["liqu_id"]);
            @endphp

            <div class="row col-lg-12  mt-5 text-center">
                <div class="col-lg-1">
                    <b>Número</b>
                </div>
                <div class="col-lg-1">
                    <b>Valor Cuota</b>
                </div>
                <div class="col-lg-2">
                    <b>Valor Extra / Interes</b>
                </div>
                <div class="col-lg-2">
                    <b>Abono</b>
                </div>
                <div class="col-lg-2">
                    <b>Estado</b>
                </div>
                <div class="col-lg-2">
                    <b>Fecha Limite</b>
                </div>
                <div class="col-lg-2">
                    <b>Fecha Ultimo Pago</b>
                </div>
            </div>
            @foreach($dataDetail as $detail)
                <div class="row col-lg-12  mt-5 text-center">
                    <div class="col-lg-1">
                        {{$detail["cufi_numerocuota"]}}
                    </div>
                    <div class="col-lg-1">
                        {{$detail["cufi_valor"]}}
                    </div>
                    <div class="col-lg-2">
                        {{$detail["cufi_valorextra"]}}
                    </div>
                    <div class="col-lg-2">
                        {{$detail["cufi_abono"]}}
                    </div>
                    <div class="col-lg-2">
                        {{$detail["cufi_estado"]}}
                    </div>
                    <div class="col-lg-2">
                        {{$detail["cufi_fechalimite"]}}
                    </div>
                    <div class="col-lg-2">
                        {{$detail["fechapago"]}}
                    </div>
                </div>
            @endforeach



        @endforeach
    @else
        <div class="row col-lg-12 justify-content-center mt-5 text-center">
            <h6>No hay datos</h6>
        </div>
    @endif


</div>
