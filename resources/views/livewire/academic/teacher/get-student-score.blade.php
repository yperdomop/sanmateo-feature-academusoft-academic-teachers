<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/docente">Docente</a></li>
        <li class="breadcrumb-item"><a href="/academico/docente/mis-clases">Mis clases</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ver notas</li>
        </ol>
    </nav>
    <div class="row mt-5">
        <div class="col">
            <small class="text"><strong>Materia</strong></small>
            <h6>{{$groupSubjectInfo[0]['subjectid'] ?? ''}} - {{$groupSubjectInfo[0]['subjectname'] ?? ''}}</h6>
        </div>
        <div class="col">
            <small class="text"><strong>Grupo</strong></small>
            <h6>{{$groupSubjectInfo[0]['groupid'] ?? ''}}</h6>
        </div>
    </div>


    <div class="table-responsive mt-5">
        <table class="table table-striped">
            <thead class="thead-dark table__header-text--normal">
                <tr>
                  <th style="width: 10%" scope="col">Identificación</th>
                  <th style="width: 30%" scope="col">Nombre</th>
                  @foreach ($ratings as $rating)
                    <th style="width: 7%" scope="col">{{$rating['evac_descripcion']}}</th>
                  @endforeach
                  <th style="width: 7%">NOTA FINAL</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($students as $student)
                    <tr class="table__body-text--normal">
                        <td class="">{{$student['documenttype']}} {{$student['documentnumber']}}</td>
                        <td class="">{{$student['name']}}</td>
                        @foreach ($student['ratings'] as $ratingStudent)
                            <td class="">{{$ratingStudent['ratingvalue']}}</td>
                        @endforeach
                        <td class="">{{$student['grmafinal']}}</td>
                    </tr>
                @endforeach
              </tbody>
        </table>
      </div>



</div>
