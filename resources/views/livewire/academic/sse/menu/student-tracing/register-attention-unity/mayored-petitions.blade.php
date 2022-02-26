<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'mayoredPetitions','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Peticiones de Grado</b></h5>
    </div>
        <div class="row col-lg-12  mt-5 text-center " style="background-color: #a0d2f3">
            <div class="col-lg-1">
                <b>Radicado</b>
            </div>
            <div class="col-lg-1">
                <b>TD</b>
            </div>
            <div class="col-lg-1">
                <b>Documento</b>
            </div>
            <div class="col-lg-1">
                <b>Programa</b>
            </div>
            <div class="col-lg-2">
                <b>Nombre</b>
            </div>
            <div class="col-lg-2">
                <b>Correo</b>
            </div>
            <div class="col-lg-1">
                <b>Celular</b>
            </div>
            <div class="col-lg-1">
                <b>T. Petición</b>
            </div>
            <div class="col-lg-2">
                <b> Periodo Grado</b>
            </div>
        </div>

            <div class="row col-lg-12  mt-0 border">
                <div class="col-lg-1 ">
                    {{$requests["peti_id"]}}
                </div>
                <div class="col-lg-1">
                    {{$requests["tidg_abreviatura"]}}
                </div>
                <div class="col-lg-1">
                    {{$requests["pege_documentoidentidad"]}}
                </div>
                <div class="col-lg-1">
                    {{$requests["programa"]}}
                </div>
                <div class="col-lg-2">
                    {{$requests["nombres"]}}
                </div>
                <div class="col-lg-2">
                    {{$requests["pege_mail"]}}
                </div>
                <div class="col-lg-1">
                    {{$requests["pege_telefonocelular"]}}
                </div>
                <div class="col-lg-1">
                    {{$requests["peti_tipo"]}}
                </div>
                <div class="col-lg-2">
                    {{$requests["pegr_nombre"]}}
                </div>
            </div>

    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Estado de la petición</b></h5>
    </div>
    <div class="row col-lg-12 justify-content-center mt-3 text-center">
        <table class="table table-striped " >
            <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col">Practica</th>
                <th scope="col">L. social</th>
                <th scope="col">Banco Finalización</th>
                <th scope="col">ECAES</th>
                <th scope="col">Documentos</th>
                <th scope="col">Materias Pendientes</th>
                <th scope="col">Ultimo Periodo</th>
                <th scope="col">Nivel Idioma</th>
                <th scope="col">Estado Petición Academica</th>
                <th scope="col">Paz y salvo Sem.</th>
                <th scope="col">Paz y salvo Der. Grado</th>
                <th scope="col">Estado Petición Financiero</th>
            </tr>
            </thead>
            <tbody>
{{--            @foreach ($classes as $class)--}}
{{--                <tr>--}}
{{--                    <td>{{$class['groupcode']}}</td>--}}
{{--                    <td>{{$class['classcode']}}</td>--}}
{{--                    <td>{{$class['classname']}}</td>--}}
{{--                    <td>{{$class['classcode']}}</td>--}}
{{--                    <td>{{$class['classcode']}}</td>--}}
{{--                    <td>{{$class['groupname']}}</td>--}}
{{--                    <td>{{$class['unityname']}}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
            </tbody>
        </table>
    </div>
    </div>



</div>
