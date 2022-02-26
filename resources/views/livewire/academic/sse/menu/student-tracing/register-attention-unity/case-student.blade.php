<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=> 'registerAttention','estpId'=> $dataStudent["estp_id"]])
    </div>

    <div class="row col-lg-12 justify-content-center mt-5">
        <h2>Caso</h2>
    </div>
    <div class="col-g-12 mt-5 d-flex justify-content-center">
        <div class="col-lg-2">
            <div>
                <strong>Codigo:</strong>
            </div>
            <div>
                {{$dataCase['ce_id']}}
            </div>
        </div>
        <div class="col-lg-2">
            <div>
                <strong>Asunto:</strong>
            </div>
            <div>
                {{$dataCase['caso_nombre']}}
            </div>
        </div>
        <div class="col-lg-2">
            <div>
                <strong>Fecha Creación:</strong>
            </div>
            <div>
                {{$dataCase['ce_fecha_in']}}
            </div>
        </div>
        <div class="col-lg-2">
            <div>
                <strong>Origen:</strong>
            </div>
            <div>
                {{$dataCase['unid_nombre']}}
            </div>
        </div>
        <div class="col-lg-2">
            <div>
                <strong>Propietario:</strong>
            </div>
            <div>
                {{--                {{$dataCase['nombre']}}--}}
            </div>
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5">
        <h2>Historial</h2>
    </div>
    <div class="col-lg-12 mt-3 d-flex justify-content-center">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th class="th-sm">Dependencia</th>
                <th class="th-sm">Fecha</th>
                <th class="th-sm">Petición</th>
                <th class="th-sm">Direccionado a</th>
                <th class="th-sm">Forma de atención</th>
            </tr>
            </thead>
            @if($caseHistory!=null && count($caseHistory)>0)
                <tbody>
                @foreach($caseHistory as $history)
                    <tr>
                        <td>{{$history['unid_nombre']}}</td>
                        <td>{{$history['ced_fecha_cambio']}}</td>
                        <td>{{$history['ced_respuesta']}}</td>
                        <td>{{$history['direccionado']}}</td>
                        <td>{{$history['foat_nombre']}}</td>
                    </tr>
                @endforeach
                </tbody>
            @endif
        </table>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5">
        <h2>Registrar</h2>
    </div>
    <div class="col-lg-12 d-flex mt-5">
        <div class="col-lg-4">
            <div class="">
                Tipo: @error('selectedTypeAttention') <small style="color: red">{{ $message }}</small> @enderror
            </div>
            <div class="">
                <select class="form-control" id="typeAttention" wire:model="selectedTypeAttention"
                        wire:change="setTypeAttention">
                    <option value="">Seleccione</option>
                    @foreach($typeAttention as $type)
                        <option value="{{$type['caso_id']}}">{{$type['caso_nombre']}}</option>
                    @endforeach
                </select>

            </div>

            <div class="">
                Solución:  @error('solutionCase') <small style="color: red">{{ $message }}</small> @enderror
            </div>
            <div>
                <textarea class="form-control" id="solutionCase" wire:model="solutionCase" wire: placeholder="Escriba aquí."></textarea>

            </div>

        </div>
        <div class="col-lg-4">
            <div class="">
                Direccionado a: @error('dependencyToValue') <small style="color: red">{{ $message }}</small> @enderror
            </div>
            <div>
                <select class="form-control" wire:model="dependencyToValue" id="dependencyToValue">
                    <option value="" >Seleccione</option>
                    @foreach($dependecyTo as $to)
                        <option value="{{$to["unid_id"]}}">{{$to["unid_nombre"]}}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="">
                Forma de Atención: @error('attentionWaysValue') <small style="color: red">{{ $message }}</small> @enderror
            </div>
            <div>
                <select class="form-control" id="attentionWaysValue" wire:model="attentionWaysValue">
                    <option value="" >Seleccione</option>
                    @foreach($attentionWays as $way)
                        <option value="{{$way['foat_id']}}">{{$way['foat_nombre']}}</option>
                    @endforeach
                </select>

            </div>
            <div class="">
                Estado:  @error('caseStatus') <small style="color: red">{{ $message }}</small> @enderror
            </div>
            <div>
                <select id="ce_estado" class="form-control" wire:model="caseStatus">
                    <option value="" >Seleccione</option>
                    <option value="Cerrado">Pendiente</option>
                    <option value="Cerrado">Cerrado</option>
                    <option value="Cerrado Con Aprobacion">Cerrado Con Aprobacion</option>
                    <option value="Cerrado Sin Aprobacion">Cerrado Sin Aprobacion</option>
                </select>

            </div>
        </div>
    </div>
    <div class="col-lg-12 mt-4 d-flex justify-content-center">

        <button class="btn btn-info mr-2" wire:click="saveSolution">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sd-card" viewBox="0 0 16 16">
                <path d="M6.25 3.5a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2zm2 0a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2zm2 0a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2zm2 0a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2z"/>
                <path fill-rule="evenodd" d="M5.914 0H12.5A1.5 1.5 0 0 1 14 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5V3.914c0-.398.158-.78.44-1.06L4.853.439A1.5 1.5 0 0 1 5.914 0zM13 1.5a.5.5 0 0 0-.5-.5H5.914a.5.5 0 0 0-.353.146L3.146 3.561A.5.5 0 0 0 3 3.914V14.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-13z"/>
            </svg> Guardar

        </button>

        <a class="btn btn-danger" href="{{route("verRegistrarAtencion",$estpId)}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
            </svg> Volver
        </a>

    </div>
    <div class="col-lg-12 d-flex justify-content-center ">
        @if (session()->has('caseDependencyUpdated'))
            <div class="alert alert-success">
                {{ session('caseDependencyUpdated') }}
            </div>
        @endif
        @if (session()->has('caseDependencyUpdatedFailed'))
            <div class="alert alert-danger">
                {{ session('caseDependencyUpdatedFailed') }}
            </div>
        @endif
    </div>
</div>
