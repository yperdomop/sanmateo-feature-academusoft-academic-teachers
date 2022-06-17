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

        <form action="{{ route('administrador.unitprograms.store', $programa) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <div class="form-group">
                        <label class="" for="description"><strong>Datos Programa</strong></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="" for="codigoprograma"><strong>Código</strong></label>
                    <h6>{{ $programa->prog_codigoprograma }}</h6>
                </div>
                <div class="col">
                    <label class="" for="nombreprograma"><strong>Nombre</strong></label>
                    <h6>{{ $programa->prog_nombre }}</h6>
                </div>
                <div class="col">
                    <label class="" for="codigoicfes"><strong>Código ICFES</strong></label>
                    <h6>{{ $programa->prog_codigoicfes }}</h6>
                </div>
                <div class="col">
                    <label class="" for="jornada"><strong>Jornada</strong></label>
                    <h6>{{ $programa->jornada->jorn_descripcion }}</h6>
                </div>
                <div class="col">
                    <label class="" for="estado"><strong>Estado</strong></label>
                    <h6>{{ $programa->prog_estado == 1 ? 'ACTIVO' : 'INACTIVO' }}</h6>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <div class="form-group">
                        <label class="" for="unit"><strong>Unidad</strong></label>
                        <select name="unit" id="unit" class="form-control">
                            <option value="">Selecciona una opción</option>
                            @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->unid_id }}">{{ $unidad->unid_nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <div class="form-group">
                        <label for="relationType">Tipo de Relación</label>
                        <select name="relationType" id="relationType" class="form-control">
                            <option value="">Selecciona una opción</option>
                            @foreach ($relationTypes as $key => $relation)
                                <option value="{{ $key }}">{{ $relation }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col text-center">
                    <div>
                        <label for="isFaculty">Es Facultad</label>
                    </div>
                    <input name="isFaculty" type="checkbox" id="isFaculty" value="1">
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <div class="form-group">
                        <label class="" for="coveringType">Tipo de cubrimiento</label>
                        <select name="coveringType" id="coveringType" class="form-control">
                            <option value="00">Selecciona una opción</option>
                            @foreach ($tipoCubrimientos as $tipoCubrimiento)
                                <option value="{{ $tipoCubrimiento->tcsn_id }}">
                                    {{ $tipoCubrimiento->tcsn_descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="form-group">
                        <label class="" for="methodology">Metodología</label>
                        <select name="methodology" id="methodology" class="form-control">
                            <option value="">Selecciona una opción</option>
                            @foreach ($metodologias as $metodologia)
                                <option value="{{ $metodologia->meto_id }}"
                                    @if ($metodologia->meto_id == $programa->meto_id) selected @endif>
                                    {{ $metodologia->meto_descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


            <div class="mt-4 d-flex justify-content-end">
                <input type="submit" class="btn btn-success" value="Guardar">
            </div>

        </form>
    </div>
@endsection
