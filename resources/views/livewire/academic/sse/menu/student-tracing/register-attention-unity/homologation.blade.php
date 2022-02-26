<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'homologation','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Homologación</b></h5>
    </div>
    @if($periods != null && count($periods))
        @foreach($periods as $period)
            <div class="row col-lg-12 justify-content-center  mt-5">
                <div>
                    <b>Periodo: </b>{{$period["periodo"]}}
                </div>
            </div>

            @php
                $detail =$this->getHomologationByPeunId($period["peun_id"]);
            @endphp
            <div class="row col-lg-12  mt-5 text-center">
                <div class="col-lg-4"><b>Codigo</b></div>
                <div class="col-lg-4"><b>Materia</b></div>
                <div class="col-lg-4"><b>Nota</b></div>
            </div>

            @foreach($detail as $homo)
                <div class="row col-lg-12  mt-1 text-center">
                    <div class="col-lg-4">{{$homo["mate_codigomateria"]}}</div>
                    <div class="col-lg-4">{{$homo["mate_nombre"]}}</div>
                    <div class="col-lg-4">{{($homo["ticl_descripcion"]==null)?'-':$homo["ticl_descripcion"]}}</div>
                </div>
            @endforeach

        @endforeach
    @else
        <div class="row col-lg-12 justify-content-center mt-5 text-center">
            <h6>No hay datos de homologación</h6>
        </div>
    @endif

</div>
