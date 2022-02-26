<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/docente">Docente</a></li>
        <li class="breadcrumb-item active" aria-current="page">Mis Clases</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
          <input type="text" wire:model.defer="codeFilter" class="form-control" placeholder="Código" aria-label="Código">
        </div>
        <div class="col">
          <input  type="text" wire:model.defer="classNameFilter" class="form-control" placeholder="Nombre" aria-label="Nombre">
        </div>

        <div class="col">
            <input  type="text" wire:model.defer="groupFilter" class="form-control" placeholder="Grupo" aria-label="Grupo">
        </div>
        <div class="col-auto">
            <input type="button" class="btn btn-primary" value="Buscar" wire:click="search">
        </div>
      </div>



    <div class="mt-5 d-flex justify-content-center">
        <h3>Listado de materias</h3>
    </div>

    <div class="table-responsive mt-2">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                  <th scope="col">Código</th>
                  <th scope="col">Nombre de la materia</th>
                  <th scope="col">Grupo</th>
                  <th scope="col">Unidad</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <td>{{$class['groupcode']}}</td>
                        <td>{{$class['classname']}}</td>
                        <td>{{$class['groupname']}}</td>
                        <td>{{$class['unityname']}}</td>
                        <td>
                            <div class="list-group" >
                                <a class="list-group-item" wire:click="getGroupScore({{$class['groupcode']}})"><i class="fa fa-book fa-fw icon--orange" aria-hidden="true"></i>&nbsp; Ver notas</a>
                                <a class="list-group-item" wire:click="setGroupScore({{$class['groupcode']}})"><i class="fa fa-check-square-o icon--orange" aria-hidden="true"></i>&nbsp; Calificar</a>
                              </div>
                        </td>

                    </tr>
                @endforeach
              </tbody>
        </table>
      </div>
</div>
