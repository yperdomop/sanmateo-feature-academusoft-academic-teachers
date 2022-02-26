<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador/sistema-evaluacion">Sistema de evaluación</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador/sistema-evaluacion/ver/{{$evaluationSystemId}}">Detalle</a></li>
        <li class="breadcrumb-item active" aria-current="page">Crear evaluación académica</li>
        </ol>
    </nav>

    @error('successSaved')
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @enderror
    <form wire:submit.prevent="saveAcademicEvaluation">
        <div class="row">
            <div class="col text-center">
                <div class="form-group">
                    <label class="" for="description"><strong>Sistema de evaluación</strong></label>
                    <h6>{{$evaluationSystem->siev_descripcion}}</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input wire:model.defer="description" type="text" class="form-control">
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col">
                <label for="weight">Peso</label>
                <input wire:model.defer="weight" type="number" class="form-control">
                @error('weigth') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col">
                <label for="type">Tipo Evaluación</label>
                <select wire:model.defer="type" id="type" class="form-control">
                    <option value="">Selecciona una opción</option>
                    @foreach ($academicEvaluationTypes as $key => $evaluationType)
                        <option value="{{$evaluationType}}">{{$evaluationType}}</option>
                    @endforeach
                </select>
                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col text-center">
                <div>
                    <label for="isOptional">Es Opcional</label>
                </div>
                <input wire:model.defer="isOptional" type="checkbox" id="isOptional">
                @error('isOptional') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col text-center">
                <div>
                    <label for="isFinal">Es Final</label>
                </div>
                <input wire:model.defer="isFinal" type="checkbox" id="isFinal">
                @error('isFinal') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="order">Orden</label>
                <select wire:model.defer="order" id="order" class="form-control">
                    <option value="">Selecciona una opción</option>
                    @foreach ($orders as $key => $order)
                        <option value="{{$order}}">{{$order}}</option>
                    @endforeach
                </select>
                @error('order') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col">
                <label for="target">Alcance</label>
                <select wire:model.defer="target" id="target" class="form-control">
                    <option value="">Selecciona una opción</option>
                    @foreach ($academicEvaluationTargets as $key => $target)
                        <option value="{{$target}}">{{$target}}</option>
                    @endforeach
                </select>
                @error('target') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>


        <div class="mt-4 d-flex justify-content-end">
            <input type="submit" class="btn btn-success" value="Guardar">
        </div>

    </form>
</div>
