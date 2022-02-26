<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador/sistema-evaluacion">Sistema de evaluación</a></li>
        <li class="breadcrumb-item active" aria-current="page">Asignar Grupo</li>
        </ol>
    </nav>


    @error('successSaved')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror

    @error('errorSaved')
        <div class="alert alert-error alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror
    <form wire:submit.prevent="asignGroupNote">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Este proceso puede tomar varios minutos, no cierre la ventana por favor.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="row">
            <div class="col">
                <label for="selectedEvaluationSystem">Sistema de evaluación</label>
                <select wire:change="selectEvaluationSystem" wire:model="selectedEvaluationSystem" id="selectedEvaluationSystem" class="form-control">
                    <option value="">Selecciona una opción</option>
                    @foreach ($evaluationSystems as $key => $evaluationSystem)
                        <option value="{{$key}}">{{$evaluationSystem}}</option>
                    @endforeach
                </select>
                @error('selectedEvaluationSystem') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                @if (sizeof($groupsWithSubjects) > 0)
                    <div class="table-responsive mt-2">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                <th style="width: 10%" scope="col"></th>
                                <th scope="col">Materias y grupos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupsWithSubjects as $key => $groupsWithSubject)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <input
                                            type="checkbox"
                                            value="{{ $groupsWithSubject['groupid'] }}"
                                            wire:model.defer="selectedGroups.{{$groupsWithSubject['groupid']}}"
                                            checked=checked>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <p class="text-center "><strong>Información del grupo</strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="groupName{{$key}}"><strong>Nombre</strong></label>
                                                    <p id="groupName{{$key}}">{{$groupsWithSubject['groupname']}}</p>
                                                </div>
                                                <div class="col">
                                                    <label for="groupDates{{$key}}"><strong>Fechas inicio y fin</strong></label>
                                                    <p id="groupDates{{$key}}">{{explode(' ',$groupsWithSubject['groupstartdate'])[0]}} - {{explode(' ',$groupsWithSubject['groupenddate'])[0]}}</p>
                                                </div>
                                                <div class="col">
                                                    <label for="groupUnity{{$key}}"><strong>Unidad</strong></label>
                                                    <p id="groupUnity{{$key}}">{{$groupsWithSubject['subjectunity']}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <p class="text-center "><strong>Información de la materia</strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="subjectCode{{$key}}"><strong>Código</strong></label>
                                                    <p id="subjectCode{{$key}}">{{$groupsWithSubject['subjectcode']}}</p>
                                                </div>
                                                <div class="col">
                                                    <label for="subjectName{{$key}}"><strong>Código</strong></label>
                                                    <p id="subjectName{{$key}}">{{$groupsWithSubject['subjectname']}}</p>
                                                </div>
                                                <div class="col">
                                                    <label for="subjectType{{$key}}"><strong>Naturaleza</strong></label>
                                                    <p id="subjectType{{$key}}">{{$groupsWithSubject['subjecttype']}}</p>
                                                </div>
                                                <div class="col">
                                                    <label for="subjectOptional{{$key}}"><strong>Opcional</strong></label>
                                                    <p id="subjectOptional{{$key}}">{{$groupsWithSubject['subjectoptional'] == 0 ? 'NO' : 'SI'}}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-2 d-flex justify-content-end">
                        <input type="submit" class="btn btn-success" value="Asignar">
                    </div>

                @else
                    @if ($selectedEvaluationSystem != '')
                        <div class="alert alert-success" role="alert">
                            Este sistema de evaluación no tiene grupos pendientes por relacionar con notas
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            Seleccione un sistema de evaluación para asociar notas
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </form>
</div>
