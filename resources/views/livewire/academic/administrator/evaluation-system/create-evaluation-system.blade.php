<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador/sistema-evaluacion">Sistema de evaluación</a></li>
        <li class="breadcrumb-item active" aria-current="page">Crear</li>
        </ol>
    </nav>

    @error('successSaved')
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @enderror
    <form wire:submit.prevent="saveEvaluationSystem">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input wire:model.defer="description" type="text" class="form-control">
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col">
                <label for="rule">Norma</label>
                <h5>ACTA FUS - PROCESOS ACADEMICOS</h5>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <h4>Relación entre nota final o práctica y habilitación</h4>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="passingQualification">Habilitación Aprobatoria</label>
                <select wire:model.defer="passingQualification" id="passingQualification" class="form-control" wire:click="canShowWeights">
                    <option>Selecciona una opción</option>
                    @foreach ($passingQualifications as $key => $passingQualification)
                        <option value="{{$key}}">{{$passingQualification}}</option>
                    @endforeach
                </select>
                @error('passingQualification') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col">
                <label for="nonPassingQualification">Habilitación no Aprobatoria</label>
                <select wire:model.defer="nonPassingQualification" id="nonPassingQualification" class="form-control" wire:click="canShowWeights">
                    <option>Selecciona una opción</option>
                    @foreach ($nonPassingQualifications as $key => $nonPassingQualification)
                        <option value="{{$key}}">{{$nonPassingQualification}}</option>
                    @endforeach
                </select>
                @error('nonPassingQualification') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        @if ($showWeights)
            <div class="row mt-2">
                <div class="col">
                    <div class="form-group">
                        <label for="weightFinalScore">Peso nota Final o Práctica</label>
                        <input wire:model.defer="weightFinalScore" type="number" class="form-control" step=".01">
                        @error('weightFinalScore') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="weightEnabling">Peso Habilitación</label>
                        <input wire:model.defer="weightEnabling" type="number" class="form-control" step=".01">
                        @error('weightEnabling') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-2 d-flex justify-content-end">
            <input type="submit" class="btn btn-success" value="Guardar">
        </div>

    </form>
</div>
