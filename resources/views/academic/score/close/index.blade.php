@extends('layouts.mainLayout')

@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
                <li class="breadcrumb-item"><a href="{{ route('calificaciones.cierres') }}">Cierres</a></li>
            </ol>
        </nav>
        <div class="row d-grid">
            <a class="m-1 col btn btn-light border" href=""> Cerrar periodo </a>
            <a class="m-1 col btn btn-light border" href=""> Cerrar año de internado </a>
            <a class="m-1 col btn btn-light border" href=""> Cerrar periodo académico por grupo </a>
            <a class="m-1 col btn btn-light border" href=""> Cerrar periodo estudiante </a>
        </div>
    </div>
@endsection
