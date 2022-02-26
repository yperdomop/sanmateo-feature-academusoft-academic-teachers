<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'history','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h4>Casos Abiertos</h4>
    </div>
    @if($openCases!=null && count($openCases) > 0)
        <div class="row col-lg-12  mt-3 ">
            <div class="col-lg-3 col-md-3 border  text-center ">
                <b>Codigo</b>
            </div>
            <div class="col-lg-3 col-md-3 border  text-center ">
                <b>Asunto</b>
            </div>
            <div class="col-lg-3 col-md-3 border  text-center ">
                <b>Fecha creación</b>
            </div>
            <div class="col-lg-3 col-md-3 border  text-center ">
                <b>Fecha respuesta oportuna</b>
            </div>
        </div>
        @foreach($openCases as $openCase)

            <div class="row col-lg-12  mt-0 ">
                <div class="col-lg-3 col-md-3 border">
                    {{$openCase['ce_id']}}
                </div>
                <div class="col-lg-3 col-md-3 border">
                    {{$openCase['caso_nombre']}}
                </div>
                <div class="col-lg-3 col-md-3 border">
                    {{$openCase['ce_fecha_in']}}
                </div>
                <div class="col-lg-3 col-md-3 border">
                    {{$openCase['ce_fecha_max']}}
                </div>
            </div>
        @endforeach
    @else
        <div class="row col-lg-12 justify-content-center mt-3 text-center alert alert-info">
            <h6>No se encuentran casos abiertos</h6>
        </div>
    @endif

{{--  casos cerrados  --}}
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h4>Casos Cerrados</h4>
    </div>
    @if($closedCases!=null && count($closedCases) > 0)
        <div class="row col-lg-12  mt-3 ">
            <div class="col-lg-1 col-md-3 border  text-center ">
                <b>Codigo</b>
            </div>
            <div class="col-lg-3 col-md-3 border  text-center ">
                <b>Asunto</b>
            </div>
            <div class="col-lg-2 col-md-3 border  text-center ">
                <b>Fecha creación</b>
            </div>
            <div class="col-lg-3 col-md-3 border  text-center ">
                <b>Fecha respuesta oportuna</b>
            </div>
            <div class="col-lg-3 col-md-3 border  text-center ">
                <b>Fecha cierre</b>
            </div>
        </div>
        @foreach($closedCases as $closedCase)

            <div class="row col-lg-12  mt-0 ">
                <div class="col-lg-1 col-md-3 border">
                    {{$closedCase['ce_id']}}
                </div>
                <div class="col-lg-3 col-md-3 border">
                    {{$closedCase['caso_nombre']}}
                </div>
                <div class="col-lg-2 col-md-3 border">
                    {{$closedCase['ce_fecha_in']}}
                </div>
                <div class="col-lg-3 col-md-3 border">
                    {{$closedCase['ce_fecha_max']}}
                </div>
                <div class="col-lg-3 col-md-3 border">
                    {{$closedCase['ce_fecha_fin']}}
                </div>
            </div>
        @endforeach
    @else
        <div class="row col-lg-12 justify-content-center mt-5 text-center alert alert-info">
            <h6>No se encuentran casos abiertos</h6>
        </div>
    @endif

</div>
