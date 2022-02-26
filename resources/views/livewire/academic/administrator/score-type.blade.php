<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/administrador">Administrador</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tipo de calificaciones</li>
        </ol>
    </nav>

    <div class="row mb-3">
        <div class="col">
            <div wire:click="createScoreType" class="btn btn-success pull-right"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;Crear</div>
        </div>
    </div>

    @error('successDelete')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    @enderror

    @error('dependencyError')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror

    <div class="row">
        <div class="col">
            <div class="table-responsive mt-2">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                          <th scope="col">Descripción</th>
                          <th scope="col">Tipo</th>
                          <th scope="col text-center">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($scoreTypes as $scoreType)
                            <tr>
                                <td>{{$scoreType->tica_descripcion}}</td>
                                <td>{{$scoreType->tica_tipo}}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary" wire:click="editScoreType({{$scoreType->tica_id}})"><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp; Editar</a>
                                    @if ($deletingId == $scoreType->tica_id)
                                        <a class="btn btn-danger" wire:click="deleteScoreType">Confirma eliminar ?</a>
                                    @else
                                        <a class="btn btn-danger" wire:click="confirmingDelete({{$scoreType->tica_id}})"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Eliminar</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                </table>
        </div>
    </div>
</div>
