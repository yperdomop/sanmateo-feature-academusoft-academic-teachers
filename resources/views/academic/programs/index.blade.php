@extends('layouts.mainLayout')

@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="/administrador">Administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Programas</li>
            </ol>
        </nav>

        <div class="row mb-3">
            <div class="col">
                <a class="btn btn-success pull-right" href="{{route('administador.programs.create')}}"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;Crear</a>
            </div>
        </div>

        @error('successMessage')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        @enderror

        @error('errorMessage')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @enderror

        <div class="row">
            <div class="col">
                <div class="table-responsive mt-2">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="col-9">Nombre del programa</th>
                                <th scope="col text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($programs as $program)
                                <tr>

                                    <td>{{ $program->prog_nombre }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Continuar</a>
                                        <a class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
