<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema Académico - San Mateo') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('js/sticky-headers.js') }}"></script>
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sanmateo.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    @livewireStyles
</head>

<body>
    @livewire('components.general.header')

    <div wire:loading class="sticky-top">
        <div class="d-flex justify-content-end">
            <div class="spinner-border text-danger" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>


    <div class="container p-3 border mt-5">
        <div class="no-print d-flex align-items-center p-3 my-3 rounded box-shadow">
            <img class="mr-3" src="{{ asset('images/sanmateo-logo.png') }}" alt="" width="48"
                height="48">
            <div class="">
                <h3 class="mb-0 lh-100">{{ $title }}</h3>
                <small>{{ $rol }}</small>
            </div>
        </div>
        <hr>
        @yield('content')
    </div>
    <div class="container mb-5 p-1 border">
        <div class="d-flex justify-content-around my-3 ml-3 mr-3 rounded box-shadow">
            <div class="btn btn-success" onclick="javascript:history.back()">
                Volver
            </div>

            <div class="btn btn-primary" onclick="javascript:window.print()">
                Imprimir
            </div>
        </div>
    </div>

    @livewireScripts

</body>

</html>
<script>
    $('table').stickyTableHeaders();
    $('#select2').select2();
</script>
@stack('scripts')
