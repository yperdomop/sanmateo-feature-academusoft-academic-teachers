<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'pendingSubjects','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Materias Pendientes</b></h5>
    </div>
    @if($pendingSub!=null && count($pendingSub) > 0)
        <div class="row col-lg-12 mt-5 ">
            <div class="col-lg-3 text-center">
                <strong>Programa</strong>
            </div>
            <div class="col-lg-2 text-center">
                <strong>Jornada</strong>
            </div>
            <div class="col-lg-1 text-center">
                <strong>Periodo</strong>
            </div>
            <div class="col-lg-1 text-center">
                <strong>Codigo</strong>
            </div>
            <div class="col-lg-3 text-center">
                <strong>Materia</strong>
            </div>
            <div class="col-lg-1 text-center">
                <strong>Creditos</strong>
            </div>
            <div class="col-lg-1 text-center">
                <strong>Obligatoria</strong>
            </div>
        </div>
        @foreach($pendingSub as $subjects)
            <div class="row col-lg-12 mt-5 ">
                <div class="col-lg-3 ">
                   {{$subjects["prog_nombre"]}}
                </div>
                <div class="col-lg-2 ">
                    {{$subjects["jorn_descripcion"]}}
                </div>
                <div class="col-lg-1 ">
                    {{$subjects["periodo"]}}
                </div>
                <div class="col-lg-1 ">
                    {{$subjects["codigo"]}}
                </div>
                <div class="col-lg-3 ">
                    {{$subjects["materia"]}}
                </div>
                <div class="col-lg-1 ">
                    {{$subjects["creditos"]}}
                </div>
                <div class="col-lg-1">
                    {{$subjects["pema_obligatoria"]}}
                </div>
            </div>
        @endforeach
    @else
        <div class="row col-lg-12 justify-content-center mt-5 text-center">
            <h6>No hay materias pendientes</h6>
        </div>
    @endif

</div>
