<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador/programas">Programas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalle</li>
        </ol>
    </nav>

    @error('successMessage')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror

    @error('errorMessage')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror

        {{--  ver detalle del programa  --}}
    <hr>
    <div class="row mb-3">
        <div class="col">
            <div wire:click="editProgram" class="btn btn-success pull-right"><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp;Editar</div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="IcfesCode">Código ICFES</label>
                <h6 class="form-control">{{"$programSystem->prog_codigoicfes"}}</h6>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="approvalDate">Fecha aprobación ICFES</label>
                <h6 class="form-control">{{"$date"}}</h6>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="programCode">Código Programa</label>
                <h6 class="form-control">{{"$programSystem->prog_codigoprograma"}}</h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            <div class="form-check">
                @if ($programSystem->prog_estado == 1)
                    <input type="checkbox" class="form-check-input" checked disabled >
                @else
                <input type="checkbox" class="form-check-input" disabled>
                @endif
                <label for="status" class="form-check-label">Activo</label>
            </div>
            <div class="form-check">
                @if ($programSystem->prog_tieneconvenio == 1)
                    <input type="checkbox" class="form-check-input" checked disabled >
                @else
                <input type="checkbox" class="form-check-input" disabled>
                @endif
                <label for="agreement" class="form-check-label">Convenio</label>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="programName">Nombre de programa</label>
                <h6 class="form-control">{{"$programSystem->prog_nombre"}}</h6>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="complexity">Complejidad</label>
                <h6 class="form-control">{{"$programSystem->prog_complejidad"}}</h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <label for="period">Nro. periodos</label>
                <h6 class="form-control">{{"$programSystem->prog_numperiodos"}}</h6>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="abbreviation">Abreviatura</label>
                <h6 class="form-control">{{"$programSystem->prog_abreviatura"}}</h6>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="titleAwarded">Titulo otorgado</label>
                <h6 class="form-control">{{"$programSystem->prog_titulootorga"}}</h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="programType">Tipo de Programa</label>
            <h6 class="form-control">{{"$programSystem->prog_tipoprograma"}}</h6>
        </div>
        <div class="col">
            <label for="modality">Modalidad</label>
            <h6 class="form-control">{{"$modalityDescription"}}</h6>
        </div>
        <div class="col">
            <label for="methodology">Metodología</label>
            <h6 class="form-control">{{"$methodDescription"}}</h6>
        </div>
        <div class="col">
            <label for="workingDay">Jornada</label>
            <h6 class="form-control">{{"$workDayDescription"}}</h6>
        </div>
        <div class="col">
            <label for="typeAcademicPeriod">Tipo de Periodo Académico</label>
            <h6 class="form-control">{{"$typeAcademicPeriod"}}</h6>
        </div>
    </div>

    {{--  listar relacion programa unidad  --}}
    <hr>
    <div class="row">
        <div class="col text-center mb-2">
            <h4>Lista de unidades</h4>
        </div>
    </div>

    {{--tabla de lista de unidades--}}
    <div class="row">
        <div class="col">
            <div class="table-responsive mt-2">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                          <th scope="col" class = "col-sm-4">Nombre de unidad</th>
                          <th scope="col">Ciudad</th>
                          <th scope="col">Tipo de Relación</th>
                          <th scope="col">Es Facultad</th>
                          <th scope="col">Cubrimiento</th>
                          <th scope="col text-center">Acciones</th>
                        </tr>
                    </thead>
                    {{--Listar relacion con unidad--}}
                    
                    @foreach ( $unitPrograms as $unitProgram )
                        
                        <tr>
                            <th>{{$unitProgram["unid_nombre"]}}</th>
                            <th>{{$unitProgram["cige_nombre"]}}</th>
                            <th>
                                {{--  Si es L debe colocar LOCALIDAD si es A debe colocar ACADEMICO  --}}
                                @if ($unitProgram["unpr_relacion"] == 'A')
                                    ACADEMICO
                                @elseif ($unitProgram["unpr_relacion"] == 'L')
                                    LOCALIDAD
                                @endif
                            </th>
                            <th>{{($unitProgram["unpr_esfacultad"])  ? 'SI' : 'NO'}}</th>
                            <th>{{$unitProgram["tcsn_descripcion"]}}</th>
                            <th><a class="btn btn-primary" wire:click="editUnitProgram({{$unitProgram["unpr_id"]}})"><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp; Editar</a>
                                @if ($deletingId == $unitProgram["unpr_id"])
                                    <a class="btn btn-danger" wire:click="deleteUnitProgram({{$unitProgram["unpr_id"]}})">Confirma eliminar ?</a>
                                @else
                                    <a class="btn btn-danger" wire:click="confirmingDelete({{$unitProgram["unpr_id"]}})"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Eliminar</a>
                                @endif</th>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <div wire:click="associateUnit" class="btn btn-success pull-right"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;Asociar Unidad</div>
        </div>
    </div>

</div>
