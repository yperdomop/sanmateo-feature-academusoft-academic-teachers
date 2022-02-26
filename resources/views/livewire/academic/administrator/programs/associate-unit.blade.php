<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador/programas">Programas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalle</li>
        </ol>
    </nav>

    @error('successSaved')
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @enderror

    <form wire:submit.prevent="saveUnitProgram">
        <div class="row">
            <div class="col text-center">
                <div class="form-group">
                    <label class="" for="description"><strong>Datos Programa</strong></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label class="" for="codigoprograma"><strong>Código</strong></label>
                <h6>{{$programSystem->prog_codigoprograma}}</h6>
            </div>
            <div class="col">
                <label class="" for="nombreprograma"><strong>Nombre</strong></label>
                <h6>{{$programSystem->prog_nombre}}</h6>
            </div>
            <div class="col">
                <label class="" for="codigoicfes"><strong>Código ICFES</strong></label>
                <h6>{{$programSystem->prog_codigoicfes}}</h6>
            </div>
            <div class="col">
                <label class="" for="jornada"><strong>Jornada</strong></label>
                <h6>{{$workDayDescription}}</h6>
            </div>
            <div class="col">
                <label class="" for="estado"><strong>Estado</strong></label>
                <h6>{{($programSystem->prog_estado) ? 'ACTIVO' : 'INACTIVO'}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <div class="form-group">
                    <label class="" for="unit"><strong>Unidad</strong></label>
                    <select wire:model.defer="unit" id="unit" class="form-control">
                        <option value="">Selecciona una opción</option>
                        @foreach ($units as $item)
                            <option value="{{$item->unid_id}}">{{$item->unid_nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <div class="form-group">
                    <label for="relationType">Tipo de Relación</label>
                    <select wire:model.defer="relationType" id="relationType" class="form-control">
                        <option value="">Selecciona una opción</option>
                        @foreach ($relationTypes as $key => $relation)
                            <option value="{{$key}}">{{$relation}}</option>
                        @endforeach
                    </select>
                    </div>
            </div>
            <div class="col text-center">
                <div>
                    <label for="isFaculty">Es Facultad</label>
                </div>
                <input wire:model.defer="isFaculty" type="checkbox" id="isFaculty">
            </div>  
        </div>
        <div class="row">
            <div class="col text-center">
                <div class="form-group">
                    <label class="" for="coveringType">Tipo de cubrimiento</label>
                    <select wire:model.defer="coveringType" id="coveringType" class="form-control">
                        <option value="">Selecciona una opción</option>
                        @foreach ($coveringTypes as $coveringType) 
                            <option value="{{$coveringType->tcsn_id}}">{{$coveringType->tcsn_descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col text-center">
                <div class="form-group">
                    <label class="" for="methodology">Metodología</label>
                    <select wire:model.defer="methodology" id="methodology" class="form-control">
                        <option value="">Selecciona una opción</option>
                        @foreach ($methodologies as $methodology) --}}
                            <option value="{{$methodology->meto_id}}">{{$methodology->meto_descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


        <div class="mt-4 d-flex justify-content-end">
            <input type="submit" class="btn btn-success" value="Guardar">
        </div>

    </form>
</div>