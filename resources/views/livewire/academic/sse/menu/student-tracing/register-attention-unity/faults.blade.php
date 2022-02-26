<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'faults','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Fallas Registradas</b></h5>
    </div>
    @if(count($faults) > 0)
        <div class="row col-lg-12 mt-5 text-center">
            <div class="col-lg-4">
                <b>Materia</b>
            </div>
            <div class="col-lg-4">
                <b>Grupo</b>
            </div>
            <div class="col-lg-4">
                <b>Fecha Falla</b>
            </div>
        </div>
        @foreach($faults as $f)
            <div class="row col-lg-12 mt-5 text-center">
                <div class="col-lg-4">
                    {{$f["mate_nombre"]}}
                </div>
                <div class="col-lg-4">
                    {!! $f["grup_nombre"] !!}
                </div>
                <div class="col-lg-4">
                    {!! $f["csfe_fecha"] !!}
                </div>
            </div>
        @endforeach
    @else
        <div class="row col-lg-12 justify-content-center mt-5 text-center">
            <h6><b>No se encontraron registros</b></h6>
        </div>
    @endif

    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Fallas Eliminadas por Excusas</b></h5>
    </div>
    @if(count($faultsDeleted) > 0)
        <div class="row col-lg-12 mt-5 text-center">
            <div class="col-lg-4">
                <b>Materia</b>
            </div>
            <div class="col-lg-4">
                <b>Grupo</b>
            </div>
            <div class="col-lg-4">
                <b>Fecha Falla</b>
            </div>
        </div>
        @foreach($faultsDeleted as $fd)
            <div class="row col-lg-12 mt-5 text-center">
                <div class="col-lg-4">
                    {{$fd["mate_nombre"]}}
                </div>
                <div class="col-lg-4">
                    {!! $fd["grup_nombre"] !!}
                </div>
                <div class="col-lg-4">
                    {!! $fd["csfe_fecha"] !!}
                </div>
            </div>
        @endforeach
    @else
        <div class="row col-lg-12 justify-content-center mt-5 text-center">
            <h6><b>No se encontraron registros</b></h6>
        </div>
    @endif
</div>
