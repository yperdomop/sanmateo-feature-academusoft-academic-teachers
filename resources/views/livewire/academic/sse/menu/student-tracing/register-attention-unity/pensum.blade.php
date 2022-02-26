<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'pensum','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Pensum</b></h5>
    </div>
    @foreach($periods as $period)
        <div class="row col-lg-12 mt-5">
            <div class="col-lg-6">
                <div>
                    <strong>Periodo:</strong> {{$period['pema_periodo']}}
                </div>
                <div>
                    <strong>Carrera:</strong> {{$period['prog_nombre']}}
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <strong>Jornada:</strong> {{$period['jorn_descripcion']}}
                </div>
                <div>
                    <strong>N. periodos:</strong> {{$period['pens_numperiodos']}}
                </div>
            </div>
        </div>
        @php
            $detail = $this->getPensumByEstpIdAndPeriod($period['pema_periodo']);
        @endphp
        <div class="row col-lg-12 mt-5 text-center">

            <div class="col-lg-1">
                <strong>Codigo</strong>
            </div>
            <div class="col-lg-2">
                <strong>Materia</strong>
            </div>
            <div class="col-lg-2">
                <strong>Condiciones por nivel</strong>
            </div>
            <div class="col-lg-1">
                <strong>Obligatoria</strong>
            </div>
            <div class="col-lg-2">
                <strong>Ponderación Acad.</strong>
            </div>
            <div class="col-lg-2">
                <strong>Creditos Requisitos</strong>
            </div>
            <div class="col-lg-2">
                <strong>Requisitos</strong>
            </div>
        </div>
        @foreach($detail as $pensum)

            <div class="row col-lg-12 mt-0">

                <div class="col-lg-1">
                    {{$pensum["mate_codigomateria"]}}
                </div>
                <div class="col-lg-2">
                    {{$pensum["mate_nombre"]}}
                </div>
                <div class="col-lg-2">
                    {{$pensum["nufo_descripcion"]}}
                </div>
                <div class="col-lg-1 text-center">
                    {{$pensum["pema_obligatoria"]}}
                </div>
                <div class="col-lg-2 text-center">
                    {{$pensum["mate_ponderacionacademica"]}}
                </div>
                <div class="col-lg-2 text-center">
                    {{$pensum["pema_creditorequisito"]}}
                </div>
                <div class="col-lg-2 text-center">
                    {{$pensum["requisito"]}}
                </div>
            </div>
        @endforeach

    @endforeach
    <div class="row col-lg-12 mt-5">
        <b>Periodo:</b>
    </div>

</div>
