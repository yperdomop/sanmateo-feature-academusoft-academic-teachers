@extends('layouts.mainSelect')

@section('content')
<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
            <li class="breadcrumb-item"><a href="{{ route('calificaciones.cierres') }}">Cierres</a></li>
            <li class="breadcrumb-item">Cerrar periodo</li>
        </ol>
    </nav>
    @livewire('academic.administrator.score.close.period-filter')

</div>
@endsection
