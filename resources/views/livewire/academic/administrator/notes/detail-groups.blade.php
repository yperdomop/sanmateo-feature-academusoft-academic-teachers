<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
        <li class="breadcrumb-item active" aria-current="page">Calificar</li>
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
    <div class="row">
        <div class="col">
            <label for="selectedSubject">Materia</label>
            <select wire:model.defer="selectedSubject" id="subject" class="form-control" wire:change="showGroups($event.target.value)">
                <option>Selecciona una opción</option>
                @foreach ($activeSubjects as $activeSubject)
                    <option value="{{$activeSubject['mate_codigomateria']}}">{{$activeSubject['mate_nombre']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mt-5 d-flex justify-content-center">
        <h3>Listado de grupos</h3>
    </div>

    <div class="table-responsive mt-2">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nombre de la materia</th>
                    <th scope="col">Grupo</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Docente</th>
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
                        <td>{{$class['teachername']}}</td>
                        <td>
                            <div class="list-group" >
                                <a class="list-group-item" wire:click="setGroupScore({{$class['groupcode']}})"><i class="fa fa-check-square-o icon--orange" aria-hidden="true"></i>&nbsp; Calificar</a>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
        </table>
        </div>


    <div class="mt-2 d-flex justify-content-end">
        <input type="submit" class="btn btn-success" value="Guardar">
    </div>
</div>
