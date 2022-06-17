@extends('layouts.mainLayout')

@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
                <li class="breadcrumb-item"><a href="/academico/administrador/programas">Programas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalle</li>
            </ol>
        </nav>

        @if (session('info'))
            <div class="alert alert-success" role="alert">
                {{ session('info') }}
            </div>
        @endif

        {{-- ver detalle del programa --}}
        <hr>
        <div class="row mb-3">
            <div class="col">
                <a href="{{ route('administrador.programs.edit', $programa) }}" type="button"
                    class="btn btn-success pull-right">
                    <i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp;Editar</a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="IcfesCode">Código ICFES</label>
                    <input type="text" class="form-control" value="{{ $programa->prog_codigoicfes }}" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="approvalDate">Fecha aprobación ICFES</label>
                    <input type="date" class="form-control"
                        value="{{ $programa->prog_fechaaprobacionicfes->format('Y-m-d') }}" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="programCode">Código Programa</label>
                    <input type="text" class="form-control" value="{{ $programa->prog_codigoprograma }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                <div class="form-check">
                    @if ($programa->prog_estado == 1)
                        <input type="checkbox" class="form-check-input" checked disabled>
                    @else
                        <input type="checkbox" class="form-check-input" disabled>
                    @endif
                    <label for="status" class="form-check-label">Activo</label>
                </div>
                <div class="form-check">
                    @if ($programa->prog_tieneconvenio == 1)
                        <input type="checkbox" class="form-check-input" checked disabled>
                    @else
                        <input type="checkbox" class="form-check-input" disabled>
                    @endif
                    <label for="agreement" class="form-check-label">Convenio</label>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="programName">Nombre de programa</label>
                    <input type="text" class="form-control" value="{{ $programa->prog_nombre }}" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="complexity">Complejidad</label>
                    <input class="form-control" value="{{ $programa->prog_complejidad }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label for="period">Nro. periodos</label>
                    <input type="text" class="form-control" value="{{ $programa->prog_numperiodos }}" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="abbreviation">Abreviatura</label>
                    <input class="form-control" value="{{ $programa->prog_abreviatura }}" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="titleAwarded">Titulo otorgado</label>
                    <input class="form-control" value="{{ $programa->prog_titulootorga }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="programType">Tipo de Programa</label>
                <input class="form-control" value="{{ $programa->prog_tipoprograma }}" disabled>
            </div>
            <div class="col">
                <label for="modality">Modalidad</label>
                <input class="form-control" value="{{ $programa->modalidad->moda_descripcion }}" disabled>
            </div>
            <div class="col">
                <label for="methodology">Metodología</label>
                <input class="form-control" value="{{ $programa->metodologia->meto_descripcion }}" disabled>
            </div>
            <div class="col">
                <label for="workingDay">Jornada</label>
                <input class="form-control" value="{{ $programa->jornada->jorn_descripcion }}" disabled>
            </div>
            <div class="col">
                <label for="typeAcademicPeriod">Tipo de Periodo Académico</label>
                <input class="form-control" value="{{ $programa->tipoPeriodoAcademico->tppa_descripcion }}" disabled>
            </div>
        </div>

        {{-- listar relacion programa unidad --}}
        <hr>
        <div class="row">
            <div class="col text-center mb-2">
                <h4>Lista de unidades</h4>
            </div>
        </div>

        {{-- tabla de lista de unidades --}}
        <div class="row">
            <div class="col">
                <div class="table-responsive mt-2">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nombre de unidad</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Tipo de Relación</th>
                                <th scope="col">Es Facultad</th>
                                <th scope="col">Cubrimiento</th>
                                <th scope="col text-center">Acciones</th>
                            </tr>
                        </thead>
                        {{-- Listar relacion con unidad --}}

                        @foreach ($programa->unidadPrograma1 as $unidadPrograma)
                            <tr>
                                <td>{{ $unidadPrograma->unidad->unid_nombre }}</td>
                                <td>{{ $unidadPrograma->unidad->ciudad ? $unidadPrograma->unidad->ciudad->cige_nombre : '' }}
                                </td>
                                <td>
                                    {{-- Si es L debe colocar LOCALIDAD si es A debe colocar ACADEMICO --}}
                                    @if ($unidadPrograma->unpr_relacion == 'A')
                                        ACADEMICO
                                    @elseif ($unidadPrograma->unpr_relacion == 'L')
                                        LOCALIDAD
                                    @endif
                                </td>
                                <td>{{ $unidadPrograma->unpr_esfacultad ? 'SI' : 'NO' }}</td>
                                <td>{{ $unidadPrograma->cubrimiento->first() ? $unidadPrograma->cubrimiento->first()->tcsn_descripcion : '' }}
                                </td>
                                <td class="text-center d-flex">
                                    <a href="{{ route('administrador.unitprograms.edit', [$programa, $unidadPrograma]) }}"
                                        class="btn btn-primary">
                                        <i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp; Editar</a>
                                    &nbsp;
                                    <form method="post"
                                        action="{{ route('administrador.unitprograms.destroy', [$programa, $unidadPrograma]) }}"
                                        onSubmit="return confirm('Seguro desea eliminar?')">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                                aria-hidden="true"> </i>
                                            Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <a href="{{ route('administrador.unitprograms.create', $programa) }}"
                    class="btn btn-success pull-right"><i class="fa fa-check-circle-o"
                        aria-hidden="true"></i>&nbsp;Asociar Unidad</a>
            </div>
        </div>
    </div>
@endsection
