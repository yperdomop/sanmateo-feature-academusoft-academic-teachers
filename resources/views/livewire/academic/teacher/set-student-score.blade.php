<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        {!! $menu !!}
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

    <div class="row mt-5">
        <div class="col">
            <small class="text"><strong>Materia</strong></small>
            <h6>{{$groupSubjectInfo[0]['subjectid'] ?? ''}} - {{$groupSubjectInfo[0]['subjectname'] ?? ''}}</h6>
        </div>
        <div class="col">
            <small class="text"><strong>Grupo</strong></small>
            <h6>{{$groupSubjectInfo[0]['groupid'] ?? ''}}</h6>
        </div>
        <div class="col">
            <small class="text"><strong>Nota a calificar</strong></small>
            @if (!empty($selectedScore))
                <h6>{{$selectedScore['evacdescription']}} <i class="fa fa-window-close-o icon--red" aria-hidden="true" wire:click="resetSelectedScore"></i></h6>
            @else
            <div class="form-group">
                <select name="subjectRate" id="subjectRate" class="form-control" wire:change="selectScoreToRate($event.target.value)">
                    <option value="">Selecciona una nota</option>
                    @if ($subjectRatingWithDates->isNotEmpty())
                        @foreach ($subjectRatingWithDates as $key => $subjectRatingDate)
                            <option value="{{$key}}">{{$subjectRatingDate['evacdescription']}}</option>
                        @endforeach
                    @else
                        <option value="">No hay notas por calificar habilitadas</option>
                    @endif
                </select>
            </div>
            @endif
        </div>
    </div>

    <hr>

    @if (!empty($selectedScore))
    <div class="table-responsive mt-5">
        <table class="table table-striped">
            <thead class="thead-dark table__header-text--normal">
                <tr>
                  <th style="width: 20%" scope="col">Identificación</th>
                  <th style="width: 50%" scope="col">Nombre</th>
                  <th style="width: 30%">{{$selectedScore['evacdescription']}}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($studentsWithRate as $estpId => $student)
                    <tr class="table__body-text--normal">
                        <td class="">{{$student['documenttype']}} {{$student['documentnumber']}}</td>
                        <td class="">{{$student['name']}}</td>
                        <td class="">
                            @if (empty($student['ratings']))
                                <!--Not exists note-->
                                <input type="number" wire:model="newNotes.{{$estpId}}"  min="0" max="5" step=".1"/>
                                <i class="fa fa-check-circle fa-2x icon--green cursor--pointer" aria-hidden="true"
                                wire:click="confirmNote({{$estpId}})"></i>
                            @elseif (in_array($estpId, $editingNotes))
                                <input type="number" name="" id=""
                                    wire:model="newNotes.{{$estpId}}" value="{{$student['ratings'][0]['ratingvalue']}}"
                                    min="0" max="5" step=".1"/>
                                <!--Save note-->
                                <i class="fa fa-check-circle fa-2x icon--green cursor--pointer" aria-hidden="true"
                                wire:click="confirmNote({{$estpId}})"></i>
                                <!--Cancel edit note-->
                                <i class="fa fa-window-close-o fa-2x icon--red cursor--pointer" aria-hidden="true"
                                wire:click="cancelEditNote({{$estpId}})"></i>
                            @else
                                <!--Existent note-->
                                {{$student['ratings'][0]['ratingvalue']}}
                                <i class="fa fa-pencil fa-2x icon--orange cursor--pointer"
                                aria-hidden="true"
                                wire:click="editNote({{$estpId}})"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
              </tbody>
        </table>
      </div>

      <div class="mt-4 d-flex justify-content-end">
        <input type="submit" class="btn btn-success" wire:click="saveAllNotes" value="Guardar/Editar Notas">
      </div>
    @endif


</div>
