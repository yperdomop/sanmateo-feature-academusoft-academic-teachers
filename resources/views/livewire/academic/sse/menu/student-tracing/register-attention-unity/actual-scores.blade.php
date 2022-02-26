<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'actualScores','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Notas Actuales</b></h5>
    </div>

    <div class="row col-lg-12  mt-5 text-center">
        <div class="col-lg-1">
            <b>Codigo</b>
        </div>
        <div class="col-lg-2">
            <b>Materia</b>
        </div>
        <div class="col-lg-2">
            <b>Grupo</b>
        </div>
        <div class="col-lg-1">
            <b>Ponderación</b>
        </div>
        <div class="col-lg-2">
            <b>Acumulado</b>
        </div>
        <div class="col-lg-2">
            <b>Peso</b>
        </div>
        <div class="col-lg-2">
            <b>Definitiva</b>
        </div>
    </div>

    @if($scores != null && count($scores)>0)
        @foreach($scores as $score)
            <div class="row col-lg-12  mt-5 text-center">
                <div class="col-lg-1">
                    {{(isset($score["mate_codigomateria"])?$score["mate_codigomateria"]:'-')}}
                </div>
                <div class="col-lg-2">
                    {{(isset($score["mate_nombre"])?$score["mate_nombre"]:'-')}}
                </div>
                <div class="col-lg-2">
                    {{(isset($score["grup_nombre"])?$score["grup_nombre"]:'-')}}
                </div>
                <div class="col-lg-1">
                    {{(isset($score["mate_ponderacionacademica"])?$score["mate_ponderacionacademica"]:'-')}}
                </div>
                <div class="col-lg-2">
                    {{(isset($score["acumulado"])?$score["acumulado"]:'-')}}
                </div>
                <div class="col-lg-2">
                    {{(isset($score["peso"])?$score["peso"]:'-')}}
                </div>
                <div class="col-lg-2">
                    {{(isset($score["definitiva"])?$score["definitiva"]:'-')}}
                </div>
            </div>
        @endforeach

    @else
        <div class="row col-lg-12 justify-content-center mt-5 text-center">
            <h6><b>No hay datos</b></h6>
        </div>
    @endif

</div>
