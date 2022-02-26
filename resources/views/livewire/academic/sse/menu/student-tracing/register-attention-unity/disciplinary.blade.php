<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'disciplinary','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Disciplinarios</b></h5>
    </div>
    @if($disciplinary!=null && (count($disciplinary)>0))
        <div class="row col-lg-12  mt-5 text-center">
            <div class="col-lg-1">
                <b>Fecha</b>
            </div>
            <div class="col-lg-1">
                <b>Estado</b>
            </div>
            <div class="col-lg-1">
                <b>N. Periodo</b>
            </div>
            <div class="col-lg-3">
                <b>Tipo sanción</b>
            </div>
            <div class="col-lg-1">
                <b>Implica Expulsión</b>
            </div>
            <div class="col-lg-4">
                <b>Descripción</b>
            </div>
        </div>

        @foreach($disciplinary as $dis)
            @php
                $date = date_create($dis["sanc_fecha"]);
            @endphp
            <div class="row col-lg-12  mt-0 ">
                <div class="col-lg-1">
                    {{date_format($date,'Y-m-d')}}
                </div>
                <div class="col-lg-1">
                    {{$dis["sanc_estado"]}}
                </div>
                <div class="col-lg-1">
                    {{$dis["sanc_numeroperiodos"]}}
                </div>
                <div class="col-lg-3">
                    {{$dis["tips_descripcion"]}}
                </div>
                <div class="col-lg-1">
                    {{($dis["tips_implicaexpulsion"]==0)?'No':'Si'}}
                </div>
                <div class="col-lg-4">
                    {{$dis["fare_descripcion"]}}
                </div>
            </div>
        @endforeach
    @else
        <div class="row col-lg-12 justify-content-center mt-5 text-center">
            <h6>No hay disciplinarios</h6>
        </div>
    @endif
</div>
