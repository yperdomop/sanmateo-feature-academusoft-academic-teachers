<div>
    {{--    <div class="row col-lg-12 d-flex justify-content-center">--}}
    {{--        <img src="{{asset("components/academic/sse/sae.png")}}" alt="">--}}
    {{--    </div>--}}
    {{--    <br/>--}}
    {{--    <br/>--}}

    {{--    <div class=" col-lg-12 row">--}}
    {{--        --}}{{--<div class="col-lg-2">--}}
    {{--            @livewire("academic.sse.elements.left-menu")--}}
    {{--        </div>--}}
    {{--        @livewire("academic.sse.menu.student-tracing.register-attention-unity.search-students")--}}
    {{--    </div>--}}

    <div class="col-lg-12">
        <div class="row col-lg-12 justify-content-center">
            <h3>Buscar Estudiante</h3>
        </div>
        <div class="col-lg-11 d-flex justify-content-center">
            <div class="col-lg-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Documento</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" placeholder="escriba aquí"
                           aria-describedby="inputGroup-sizing-default" wire:model="document">
                </div>

            </div>
            <div class="col-lg-5">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Apellidos / nombre</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" placeholder="escriba aquí"
                           aria-describedby="inputGroup-sizing-default" wire:model="name">
                </div>

            </div>
            <div class="col-lg-2 text-center">
                <button type="button" class="btn btn-info" wire:click='getListStudents'>Buscar</button>
            </div>
        </div>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th class="th-sm">Documento</th>
                <th class="th-sm">Nombre(s) y Apellido(s)</th>
                <th class="th-sm">Programa</th>
                <th class="th-sm">Jornada</th>
                <th class="th-sm">Estado</th>
                <th class="th-sm">Acción</th>
            </tr>
            </thead>
            @if(isset($students))
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{$student["documento"]}}</td>
                        <td>{{$student["nombre"]}}</td>
                        <td>{{$student["programa"]}}</td>
                        <td>{{$student["jornada"]}}</td>
                        <td>{{$student["site_descripcion"]}}</td>
                        <td><a class="btn btn-primary" href="{{route("verRegistrarAtencion",$student["estp_id"])}}" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg></a> </td>
                    </tr>
                @endforeach
                </tbody>
            @endif
        </table>
    </div>
</div>
