<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=> 'registerAttention','estpId'=> $dataStudent["estp_id"]])
    </div>

    <div class="col-lg-12">
        Registrar Atención
        <div class="tab-pane fade show active" id="registrarAtencion" role="tabpanel"
             aria-labelledby="registrarAtencion-tab">
            <div class="col-lg-12 d-flex justify-content-center mt-5">
                <h3>Registrar.</h3>
            </div>
            <div class="col-lg-12 alert alert-danger">
                Recuerde actualizar los datos del estudiante antes de registrar el caso.
            </div>
            <div class="col-lg-12 d-flex">
                <div class="col-lg-4">
                    <div class="">
                        Tipo: @error('selectedTypeAttention') <small
                            style="color: red">{{ $message }}</small> @enderror
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
                        Observación: @error('observationCase') <small
                            style="color: red">{{ $message }}</small> @enderror
                    </div>
                    <div>
                                <textarea class="form-control" id="observationCase" wire:model="observationCase" wire:
                                          placeholder="Escriba aquí."></textarea>

                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="">
                        Tipo Requerimiento: @error('requirementType') <small
                            style="color: red">{{ $message }}</small> @enderror
                    </div>
                    <div>
                        <select id="tipo_requerimiento" wire:model="requirementType" class="form-control">
                            <option value="">Seleccione.</option>
                            <option value="Consulta">Consulta</option>
                        </select>

                    </div>
                    <div class="">
                        Direccionado a: @error('dependencyToValue') <small
                            style="color: red">{{ $message }}</small> @enderror
                    </div>
                    <div>
                        <select class="form-control" wire:model="dependencyToValue" id="dependencyToValue">
                            <option value="">Seleccione</option>
                            @foreach($dependecyTo as $to)
                                <option value="{{$to["unid_id"]}}">{{$to["unid_nombre"]}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="">
                        Forma de Atención: @error('attentionWaysValue') <small
                            style="color: red">{{ $message }}</small> @enderror
                    </div>
                    <div>
                        <select class="form-control" id="attentionWaysValue" wire:model="attentionWaysValue">
                            <option value="">Seleccione</option>
                            @foreach($attentionWays as $way)
                                <option value="{{$way['foat_id']}}">{{$way['foat_nombre']}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="">
                        Estado: @error('caseStatus') <small style="color: red">{{ $message }}</small> @enderror
                    </div>
                    <div>
                        <select id="ce_estado" class="form-control" wire:model="caseStatus">
                            <option value="">Seleccione</option>
                            <option value="Pendiente">Pendiente</option>
{{--                            <option value="Cerrado">Cerrado</option>--}}
{{--                            <option value="Cerrado Con Aprobacion">Cerrado Con Aprobacion</option>--}}
{{--                            <option value="Cerrado Sin Aprobacion">Cerrado Sin Aprobacion</option>--}}
                        </select>

                    </div>
                </div>
            </div>
            <div class="col-lg-12 d-flex justify-content-center ">
                @if (session()->has('messageSaved'))
                    <div class="alert alert-success">
                        {{ session('messageSaved') }}
                    </div>
                @endif
            </div>
            <div class="col-lg-12 mt-4 d-flex justify-content-center">

                <button class="btn btn-info mr-2" wire:click="saveCase">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-sd-card" viewBox="0 0 16 16">
                        <path
                            d="M6.25 3.5a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2zm2 0a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2zm2 0a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2zm2 0a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2z"/>
                        <path fill-rule="evenodd"
                              d="M5.914 0H12.5A1.5 1.5 0 0 1 14 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5V3.914c0-.398.158-.78.44-1.06L4.853.439A1.5 1.5 0 0 1 5.914 0zM13 1.5a.5.5 0 0 0-.5-.5H5.914a.5.5 0 0 0-.353.146L3.146 3.561A.5.5 0 0 0 3 3.914V14.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-13z"/>
                    </svg>
                    Guardar

                </button>

                <a class="btn btn-danger" href="{{route("registrarUnidadAtencion")}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                        <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                        <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
                    </svg> Volver

                </a>

            </div>

            <div class="col-lg-12 d-flex justify-content-center mt-5">
                <h3>Casos Abiertos.</h3>
            </div>
            <div class="col-lg-12 mt-3">

                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th class="th-sm">Codigo</th>
                        <th class="th-sm">Caso</th>
                        <th class="th-sm">Fecha inicio</th>
                        <th class="th-sm">Fecha fin Atención</th>
                        <th class="th-sm">Acción</th>
                    </tr>
                    </thead>
                    @if($attentionsByEstpId!=null && count($attentionsByEstpId)>0)
                        <tbody>
                        @foreach($attentionsByEstpId as $attention)
                            <tr>
                                <td>{{$attention["ce_id"]}}</td>
                                <td>{{$attention["caso_nombre"]}}</td>
                                <td>{{$attention["ce_fecha_in"]}}</td>
                                <td>{{$attention["ce_fecha_max"]}}</td>
                                <td><a class="btn btn-primary"
                                       href="{{route("casoEstudiante",[$dataStudent["estp_id"],$attention["ce_id"]])}}"
                                       role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    @endif
                </table>

            </div>
    </div>
</div>
