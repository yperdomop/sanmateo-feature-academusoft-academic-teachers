<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'bussinessPractices','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Practicas Empresariales</b></h5>
    </div>
    @if($practice!=null && count($practice)>0)
        <div class=" col-lg-10 justify-content-center  mt-5 ">
            <div><b>N.: </b> {{$practice["estpr_id"]}}</div>
            <div><b>Periodo: </b> {{$practice["periodano"]}}</div>
            <div><b>Estado Practica: </b> {{$practice["estpr_estadopractica"]}}</div>
            <div><b>Modalidad: </b> {{$practice["mopr_nombre"]}}</div>
            <div><b>Fecha de Inicio: </b> {{$practice["estpr_fechainicio"]}}</div>
            <div><b>Fecha de Finalizacion: </b> {{$practice["estpr_fechafin"]}}</div>
            <div><b>Docente: </b> {{$practice["nombre"]}}</div>
            <div><b>Nota Final: </b> {{$practice["estpr_notadefinitiva"]}}</div>
            <div><b>Nota del Docente: </b> {{$practice["estpr_notadocente"]}}</div>
            <div><b>Nota de la Empresa: </b> {{$practice["estpr_notaentidad"]}}</div>
            <div><b>Nota de la Coordinacion: </b> {{$practice["estpr_notacoord"]}}</div>
            <div><b>Observacion de la coordinacion: </b> {{$practice["estpr_obscoord"]}}</div>
            <div><b>Fecha de la visita: </b> {{$practice["estpr_fechavisita"]}}</div>
            <div><b>Observacion de la visita: </b> {{$practice["estpr_obsvisita"]}}</div>
            <div><b>Fortalezas: </b> {{$practice["estpr_fortalezas"]}}</div>
            <div><b>Aspectos a Mejorar: </b> {{$practice["estpr_aspmejorar"]}}</div>
            <div><b>Aspectos a Mejorar del Programa : </b> {{$practice["estpr_aspectosmejorarprog"]}}</div>
            <div><b>Empresa: </b> {{$practice["ent_nombre"]}}</div>
            <div><b>Jefe Inmediato: </b> {{$practice["estpr_jefeinmediato"]}}</div>
            <div><b>Correo del Jefe Inmediato: </b> {{$practice["estpr_mailjefeinmediato"]}}</div>
            <div><b>Direccion: </b> {{$practice["estpr_direccion"]}}</div>
            <div><b>Telefono: </b> {{$practice["estpr_telefono"]}}</div>
            <div><b>Dependencia: </b> {{$practice["estpr_dependencia"]}}</div>
            <div><b>Zona: </b> {{$practice["estpr_zona"]}}</div>
        </div>

    @else
        <div class="row col-lg-12 justify-content-center mt-3 text-center">
            <h6>No hay registros de practicas</h6>
        </div>
    @endif


    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Labor Social</b></h5>
    </div>
    @if($socialLabor!=null && count($socialLabor)>0)
        <div class="row col-lg-12 mt-5">
            <div class="col-lg-1"><b>Periodo</b></div>
            <div class="col-lg-1"><b>Fecha de inicio</b></div>
            <div class="col-lg-1"><b>Fecha de Financiación</b></div>
            <div class="col-lg-1"><b>Radico Certificado</b></div>
            <div class="col-lg-1"><b>Certidicado Validado</b></div>
            <div class="col-lg-2"><b>Estado</b></div>
            <div class="col-lg-1"><b>Entidad</b></div>
            <div class="col-lg-1"><b>Cantidad Horas</b></div>
            <div class="col-lg-2"><b>Observaciones</b></div>
        </div>
        <div class="row col-lg-12  mt-0">
            <div class="col-lg-1">{{$socialLabor["periodo"]}}</div>
            <div class="col-lg-1">{{$socialLabor["labso_fechainicio"]}}</div>
            <div class="col-lg-1">{{$socialLabor["labso_fechafin"]}}</div>
            <div class="col-lg-1">{{($socialLabor["labso_radicocertificado"]==1)?'SI':'NO'}}</div>
            <div class="col-lg-1">{{($socialLabor["labso_certificadovalidado"]==1)?'SI':'NO'}}</div>
            <div class="col-lg-2">{{$socialLabor["labso_estado"]}}</div>
            <div class="col-lg-1">{{$socialLabor["ent_nombre"]}}</div>
            <div class="col-lg-1">{{$socialLabor["labso_canthoras"]}}</div>
            <div class="col-lg-2">{{$socialLabor["labso_observaciones"]}}</div>
        </div>

    @else
        <div class="row col-lg-12 justify-content-center mt-3 text-center">
            <h6>No hay registros de labor social</h6>
        </div>
    @endif

</div>
