@extends('layouts.mainLayout')

@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
                <li class="breadcrumb-item"><a href="/academico/administrador/programas">Programas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        @if (session('info'))
            <div class="alert alert-success" role="alert">
                {{ session('info') }}
            </div>
        @endif

        <form action="{{ route('administrador.programs.update', $programa) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="IcfesCode">Código ICFES</label>
                        <input name="IcfesCode" type="text" class="form-control"
                            value="{{ $programa->prog_codigoicfes }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="approvalDate">Fecha aprobación ICFES</label>
                        <input name="approvalDate" type="date" class="form-control"
                            value="{{ $programa->prog_fechaaprobacionicfes->format('Y-m-d') }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="programCode">Código Programa</label>
                        <input name="programCode" type="text" class="form-control"
                            value="{{ $programa->prog_codigoprograma }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <div class="form-check">
                        @if ($programa->prog_estado == 1)
                            <input type="checkbox" class="form-check-input" checked>
                        @else
                            <input type="checkbox" class="form-check-input">
                        @endif
                        <label for="status" class="form-check-label">Activo</label>
                    </div>
                    <div class="form-check">
                        @if ($programa->prog_tieneconvenio == 0)
                            <input type="checkbox" class="form-check-input" value="0" checked>
                        @else
                            <input type="checkbox" class="form-check-input" value="0">
                        @endif
                        <label for="agreement" class="form-check-label">Convenio</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="programName">Nombre de programa</label>
                        <input type="text" name="programName" class="form-control"
                            value="{{ $programa->prog_nombre }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="complexity">Complejidad</label>
                        <input type="text" name="complexity" class="form-control"
                            value="{{ $programa->prog_complejidad }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label for="period">Nro. periodos</label>
                        <input type="number" name="period" class="form-control" step="1"
                            value="{{ $programa->prog_numperiodos }}" required>
                        @error('period')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="abbreviation">Abreviatura</label>
                        <input type="text" name="abbreviation" class="form-control"
                            value="{{ $programa->prog_abreviatura }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="titleAwarded">Titulo otorgado</label>
                        <input type="text" name="titleAwarded" class="form-control"
                            value="{{ $programa->prog_titulootorga }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="programType">Tipo de Programa</label>
                    <select name="programType" id="programType" class="form-control">
                        @foreach ($programTypes as $key => $programType)
                            <option value="{{ $key }}" @if ($key == $programa->prog_tipoprograma) selected @endif>
                                {{ $programType }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="modality">Modalidad</label>
                    <select name="modality" id="modality" class="form-control">
                        <option value="null">Selecciona una opción</option>
                        @foreach ($modalities as $modality)
                            <option value="{{ $modality->moda_id }}" @if ($modality->moda_id == $programa->moda_id) selected @endif>
                                {{ $modality->moda_descripcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="methodology">Metodología</label>
                    <select name="methodology" id="methodology" class="form-control">
                        <option value="null">Selecciona una opción</option>
                        @foreach ($methodologies as $methodology)
                            <option value="{{ $methodology->meto_id }}"
                                @if ($methodology->meto_id == $programa->meto_id) selected @endif>{{ $methodology->meto_descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="workingDay">Jornada</label>
                    <select name="workingDay" id="workingDay" class="form-control">
                        <option value="null">Selecciona una opción</option>
                        @foreach ($workingDays as $workingDay)
                            <option value="{{ $workingDay->jorn_id }}"
                                @if ($workingDay->jorn_id == $programa->jorn_id) selected @endif>{{ $workingDay->jorn_descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="typeAcademicPeriod">Tipo de Periodo Académico</label>
                    <select name="typeAcademicPeriod" id="typeAcademicPeriod" class="form-control">
                        <option value="null">Selecciona una opción</option>
                        @foreach ($academicPeriodTypes as $typeAcademicPeriod)
                            <option value="{{ $typeAcademicPeriod->tppa_id }}"
                                @if ($typeAcademicPeriod->tppa_id == $programa->tppa_id) selected @endif>
                                {{ $typeAcademicPeriod->tppa_descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-2 d-flex justify-content-end">
                <input type="submit" class="btn btn-success" value="Guardar">
            </div>
        </form>
    </div>
@endsection
