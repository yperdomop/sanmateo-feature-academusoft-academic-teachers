<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador/tipo-calificaciones">Tipo de calificaciones</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$actionType}}</li>
        </ol>
    </nav>

    @error('successSaved')
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @enderror
    <form wire:submit.prevent="saveScoreType">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input wire:model.defer="description" type="text" class="form-control">
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col">
                <label for="type">Tipo</label>
                <select wire:model="type" id="type" class="form-control">
                    <option>Selecciona una opción</option>
                    @foreach ($scoreTypes as $scoreType)
                        <option value="{{$scoreType}}">{{$scoreType}}</option>
                    @endforeach
                </select>
                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="passingScore">Nota aprobatoria</label>
                    <input wire:model.defer="passingScore" type="number" class="form-control" step=".01">
                    @error('passingScore') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="minPassingScore">Nota mínima habilitadora</label>
                    <input wire:model.defer="minPassingScore" type="number" class="form-control" step=".01">
                    @error('minPassingScore') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="passingScoreEnabling">Nota aprobatoria habilitación</label>
                    <input wire:model.defer="passingScoreEnabling" type="number" class="form-control" step=".01">
                    @error('passingScoreEnabling') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        @if($type === 'CUANTITATIVA')
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="cuantitativeMinNote">Nota mínima</label>
                        <input wire:model.defer="cuantitativeMinNote" type="number" class="form-control" step=".01">
                        @error('cuantitativeMinNote') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="cuantitativeMaxNote">Nota máxima</label>
                        <input wire:model.defer="cuantitativeMaxNote" type="number" class="form-control" step=".01">
                        @error('cuantitativeMaxNote') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        @elseif ($type === 'CUALITATIVA')
        <hr>
        <div class="mt-5 d-flex justify-content-center">
            <h3>Valores Cualitativos</h3>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="form-group">
                    <label for="cual_description">Descripción</label>
                    <input wire:model.defer="cualitativeValues.cual_description" type="text" class="form-control">
                    @error('cual_description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="cual_nomenclature">Nomenclatura</label>
                    <input wire:model.defer="cualitativeValues.cual_nomenclature" type="text" class="form-control">
                    @error('cual_nomenclature') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="cual_numericvalue">Vr. numérico</label>
                    <input wire:model.defer="cualitativeValues.cual_numericvalue" type="number" class="form-control">
                    @error('cual_numericvalue') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="cual_minvalue">Vr. mínimo</label>
                    <input wire:model.defer="cualitativeValues.cual_minvalue" type="number" class="form-control">
                    @error('cual_minvalue') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="cual_maxvalue">Vr. máximo</label>
                    <input wire:model.defer="cualitativeValues.cual_maxvalue" type="number" class="form-control">
                    @error('cual_maxvalue') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <div wire:click="setCualitativeValue" class="form-control btn btn-success"><i class="fa fa-plus-square" aria-hidden="true"></i></div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col">
                @error('allCualitativeValues') <span class="text-danger">Si el tipo es cualitativo, debe agregar uno o más valores cualitativos</span> @enderror
            </div>
        </div>


        <table class="table table-striped mt-4">
            <thead class="thead-dark">
                <tr>
                  <th scope="col">Descripción</th>
                  <th scope="col">Nomenclatura</th>
                  <th scope="col text-center">Valor numérico</th>
                  <th scope="col text-center">Valor mínimo</th>
                  <th scope="col text-center">Valor máximo</th>
                  <th scope="col text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($allCualitativeValues as $key => $cualitativeValue)
                <tr>
                        <td>
                            {{$cualitativeValue['cual_description']}}
                        </td>
                        <td>{{$cualitativeValue['cual_nomenclature']}}</td>
                        <td>{{$cualitativeValue['cual_numericvalue']}}</td>
                        <td>{{$cualitativeValue['cual_minvalue']}}</td>
                        <td>{{$cualitativeValue['cual_maxvalue']}}</td>
                        <td>
                        <a class="btn btn-danger" wire:click="deleteCualitativeValue({{$key}})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
        </table>
        @endif

        <div class="mt-2 d-flex justify-content-end">
            <input type="submit" class="btn btn-success" value="Guardar">
        </div>

    </form>
</div>
