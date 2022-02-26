<div>
    <div class="table-responsive mt-2">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                  <th scope="col">Día</th>
                  <th scope="col">Código materia</th>
                  <th scope="col">Nombre de la materia</th>
                  <th scope="col">Grupo</th>
                  <th scope="col">Ubicación</th>
                  <th scope="col">Hora de inicio</th>
                  <th scope="col">Hora fin</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($teacherSchedule as $day => $classes)
                    <tr>
                        <td class="text-center align-middle" rowspan="{{sizeof($classes)}}">{{$day}}</td>
                        <td>{{$classes[0]['subjectid']}}</td>
                        <td>{{$classes[0]['subjectname']}}</td>
                        <td>{{$classes[0]['groupname']}}</td>
                        <td>{{$classes[0]['locationdescription']}} - {{$classes[0]['locationclassroom']}}</td>
                        <td>{{\Carbon\Carbon::createFromFormat('Hi', $classes[0]['classinit'])->format('h:i A');}}</td>
                        <td>{{\Carbon\Carbon::createFromFormat('Hi', $classes[0]['classfinish'])->format('h:i A');}}</td>
                    </tr>
                    @foreach (array_slice($classes->toArray(), 1) as $class)
                        <tr>
                            <td>{{$class['subjectid']}}</td>
                            <td>{{$class['subjectname']}}</td>
                            <td>{{$class['groupname']}}</td>
                            <td>{{$class['locationdescription']}} - {{$class['locationclassroom']}}</td>
                            <td>{{\Carbon\Carbon::createFromFormat('Hi', $class['classinit'])->format('h:i A');}}</td>
                            <td>{{\Carbon\Carbon::createFromFormat('Hi', $class['classfinish'])->format('h:i A');}}</td>
                        </tr>
                    @endforeach
                @endforeach
              </tbody>
        </table>
</div>
