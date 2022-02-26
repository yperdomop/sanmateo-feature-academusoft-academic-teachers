<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema Académico - San Mateo') }}</title>

    <!-- Scripts -->
    <script
        src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sticky-headers.js') }}"></script>
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sanmateo.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{--  sweet alert  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>


    @livewireStyles
</head>
<body>
@livewire('components.general.header')

<div class="container p-3 border mt-3 mb-3" style="max-width: max-content">
    <div class="d-flex align-items-center p-3 my-3 rounded box-shadow">
        <img class="mr-3" src="{{ asset(isset($logoPath)?$logoPath:'images/sanmateo-logo.png') }}" alt="" width="48" height="48">
        <div class="">
            <h3 class="mb-0 lh-100">{{$title}}</h3>
            <small>{{$rol}}</small>
        </div>
    </div>
    <hr>

    <div class="col-lg-12">
        <div class="row col-lg-12 justify-content-center">
            <h2>Datos del estudiante</h2>
        </div>
        <div class="col-lg-12 d-flex mt-4 justify-content-center">
            <div class="col-lg-4">
                <div>
                    <strong>Nombres y apellidos:</strong> {{$dataStudent['nombre']}}
                </div>
                <div>
                    <strong>Programa:</strong> {{$dataStudent['prog_nombre']}}
                </div>
                <div>
                    <strong>Estado:</strong> {{$dataStudent['site_descripcion']}}
                </div>
                <div>
                    <strong> Dirección:</strong> {{$dataStudent['pege_direccion']}}
                </div>
                <div>
                    <strong>Sede:</strong> {{$dataStudent['unid_nombre']}}
                </div>
                <div>
                    <strong>Semestre:</strong> {{$dataStudent['sem']}}
                </div>
            </div>
            <div class="col-lg-4">
                <div>
                    <strong>Numero Documento:</strong> {{$dataStudent['pege_documentoidentidad']}}
                </div>
                <div>
                    <strong>Modalidad:</strong> {{$dataStudent['jorn_descripcion']}}
                </div>
                <div>
                    <strong>Telefonos:</strong> {{$dataStudent['pege_telefonocelular']}}
                    / {{$dataStudent['pege_telefono']}}
                </div>
                <div>
                    <strong>Fecha Nacimiento:</strong> {{$dataStudent['fecha_nacimiento']}}
                </div>

            </div>
            <div class="col-lg-4">
                <div>
                    <strong>Categoria:</strong> {{$dataStudent['cate_descripcion']}}
                </div>
                <div>
                    <strong>Jornada:</strong> {{$dataStudent['jorn_descripcion']}}
                </div>
                <div>
                    <strong>Correo:</strong> {{$dataStudent['pege_mail']}}
                </div>
                <div>
                    <strong>Sexo:</strong> {{$dataStudent['peng_sexo']}}
                </div>

            </div>
        </div>
        @yield("contentRegisterAttention")
    </div>

</div>
@include('sweetalert::alert')
@livewireScripts
<script>

    window.addEventListener('swal',function(e){
        Swal.fire(e.detail);
    });
</script>
</body>
</html>
<script>
    $('table').stickyTableHeaders();

    $('table').DataTable( {
        "paging":   true,
        "ordering": true,
        "info":     false
    } );

    window.addEventListener('contentChanged', event => {
        $('table').stickyTableHeaders();
        $('table').DataTable( {
            "paging":   true,
            "ordering": true,
            "info":     false
        } );
    });
    document.addEventListener("livewire:load", function (event) {
        window.livewire.hook('afterDomUpdate', () => {
            $('.js-select2').select2();
        });
    });

</script>
