<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador/sistema-evaluacion">Sistema de evaluación</a></li>
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

    <div class="row mb-3">
        <div class="col">
            <div wire:click="editEvaluationSystem" class="btn btn-success pull-right"><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp;Editar</div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="description">Descripción</label>
                <h6 class="form-control">{{$evaluationSystem->siev_descripcion}} </h6>
            </div>
        </div>
        <div class="col">
            <label for="rule">Norma</label>
            <h6 class="form-control-static">{{$ruleName}}</h6>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col text-center mb-2">
            <h4>Relación entre nota final o práctica y habilitación</h4>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for="passingQualification">Habilitación Aprobatoria</label>
            <h6 class="form-control">{{$evaluationSystem->siev_parhabapr}}</h6>
        </div>
        <div class="col">
            <label for="nonPassingQualification">Habilitación no Aprobatoria</label>
            <h6 class="form-control">{{$evaluationSystem->siev_parhabnapr}}</h6>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="weightFinalScore">Peso nota Final o Práctica</label>
                <h6 class="form-control">{{is_null($evaluationSystem->siev_pesodefinitiva) ? 'NO TIENE': $evaluationSystem->siev_pesodefinitiva}}</h6>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="weightEnabling">Peso Habilitación</label>
                <h6 class="form-control">{{is_null($evaluationSystem->siev_pesohabilitacion) ? 'NO TIENE': $evaluationSystem->siev_pesohabilitacion}}</h6>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col text-center mb-2">
            <h4>Evaluaciones</h4>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <div wire:click="addEvaluation" class="btn btn-success pull-right"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;Agregar Evaluación</div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive mt-2">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                          <th scope="col">Descripción</th>
                          <th scope="col">Peso</th>
                          <th scope="col">Tipo de Evaluación</th>
                          <th scope="col">Es Opcional</th>
                          <th scope="col">Es Final</th>
                          <th scope="col text-center">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($academicEvaluations as $academicEvaluation)
                            <tr>
                                <td>{{$academicEvaluation->evac_descripcion}}</td>
                                <td>{{$academicEvaluation->evac_peso}}</td>
                                <td>{{$academicEvaluation->evac_tipo}}</td>
                                <td>{{($academicEvaluation->evac_opcional) ? 'SI' : 'NO'}}</td>
                                <td>{{($academicEvaluation->evac_esfinal) ? 'SI' : 'NO'}}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary" wire:click="editEvaluation({{$academicEvaluation->evac_id}})"><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp; Editar</a>
                                    @if ($deletingId == $academicEvaluation->evac_id)
                                        <a class="btn btn-danger" wire:click="deleteAcademicEvaluation">Confirma eliminar ?</a>
                                    @else
                                        <a class="btn btn-danger" wire:click="confirmingDelete({{$academicEvaluation->evac_id}})"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Eliminar</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                </table>
        </div>
    </div>

    <div class="row">

    </div>
</div>
