<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador/sistema-evaluacion">Sistema de evaluación</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cargar Sistema Evaluación Grupo</li>
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
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror


    <form wire:submit.prevent="uploadFile">
        <div class="row">
            <div class="col">
                <label for="file">Adjunta el archivo base</label>
                <input type="file" wire:model="file">
            </div>
            <div class="col">
                <button class="btn btn-success" type="submit">Subir archivo</button>
            </div>
        </div>

    </form>
</div>
