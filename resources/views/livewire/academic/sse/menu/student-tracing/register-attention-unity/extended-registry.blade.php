<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'extendedRegistry','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Registro Extendido</b></h5>
    </div>

    @if($periods!=null && count($periods) > 0)

        @foreach($periods as $period)
            <div class="row col-lg-12 mt-5 ">
                <div class="col-lg-4 text-center">
                    <div><b>Pensum:</b> {{$period["pens_descripcion"]}}</div>
                    <div><b>Periodo:</b> {{$period["periodo"]}}</div>
                </div>
                <div class="col-lg-4 text-center">
                    <div><b>Promedio Periodo:</b> {{($period["properiodo"]==null)?0:$period["properiodo"]}}</div>
                    <div><b>Promedio Acumulado:</b> {{($period["proacumulado"]==null)?0:$period["proacumulado"]}}</div>
                </div>
                <div class="col-lg-4 text-center">
                    <div><b>Ubicación Semestral:</b> {{$period["estp_periodoacademico"]}}</div>
                </div>
            </div>
            @php
                $detail = $this->getDetailRegistry($period["peun_id"]);
            @endphp

            <div class="row col-lg-12 mt-5  " style="background-color: #a0d2f3">
                <div class="col-lg-1 text-center">
                   <b>Codigo</b>
                </div>
                <div class="col-lg-2 text-center">
                    <b>Materia</b>
                </div>
                <div class="col-lg-2 text-center">
                    <b>Ponderación</b>
                </div>
                <div class="col-lg-2 text-center">
                    <b>Grupo</b>
                </div>
                <div class="col-lg-1 text-center">
                    <b>Final</b>
                </div>
                <div class="col-lg-2 text-center">
                    <b>Habilitación</b>
                </div>
                <div class="col-lg-2 text-center">
                    <b>Definitiva</b>
                </div>

            </div>
            @foreach($detail as $detailPeriod)
            <div class="row col-lg-12 mt-5 ">
                <div class="col-lg-1 text-center">
                   {{$detailPeriod["mate_codigomateria"]}}
                </div>
                <div class="col-lg-2 text-center">
                    {{$detailPeriod["mate_nombre"]}}
                </div>
                <div class="col-lg-2 text-center">
                    {{$detailPeriod["reac_ponderacionacademica"]}}
                </div>
                <div class="col-lg-2 text-center">
                    {{$detailPeriod["grupo"]}}
                </div>
                <div class="col-lg-1 text-center">
                    @if(isset($detailPeriod["ticl_descripcion"])&&$detailPeriod["ticl_descripcion"]!=null)
                        {{$detailPeriod["ticl_descripcion"]}}
                    @else
                        {{$detailPeriod["reac_notafinal"]}}
                    @endif
                </div>
                <div class="col-lg-2 text-center">
                    {{$detailPeriod["reac_habilitacion"]}}
                </div>
                <div class="col-lg-2 text-center">
                    @if(isset($detailPeriod["ticl_descripcion"])&&$detailPeriod["ticl_descripcion"]!=null)
                        {{$detailPeriod["ticl_descripcion"]}}
                    @elseif($detailPeriod["reac_notaanteshab"] != null)
                        {{$detailPeriod["reac_notaanteshab"]}}
                    @else
                        {{$detailPeriod["reac_notafinal"]}}
                    @endif
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
