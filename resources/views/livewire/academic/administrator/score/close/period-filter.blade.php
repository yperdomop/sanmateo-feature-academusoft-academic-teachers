<div>
    <div>
        <div class="row">
            <div class="col text-center mb-2">
                <h4>Unidad regional</h4>
            </div>
        </div>
        <div class="row">
            <div class="col" wire:ignore>
                <select wire:model="ur" class="select2 form-control">
                    <option></option>
                    @foreach ($unidadesRegionales as $unidad)
                        <option value="{{ $unidad->unid_id }}">{{ strtoupper($unidad->unid_nombre) }} /
                            {{ $unidad->ciudad->cige_nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col text-center mb-2">
                <h4>Periodos académicos</h4>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="col-1"></th>
                                <th scope="col" class="col-2">Año</th>
                                <th scope="col" class="col-2">Periodo</th>
                                <th scope="col" class="col-2">Fecha Inicio</th>
                                <th scope="col" class="col-2">Fecha Fin</th>
                                <th scope="col" class="col-3">Tipo Periodo Academico</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="table-responsive" style="height:180px">
                    <table class="table table-striped">
                        <tbody>
                            @foreach ($periodos as $periodo)
                                <tr>
                                    <td class="col-1"><input type="radio" class="form-check-input" wire:model="per"
                                            id="per{{ $periodo->peun_id }}" value="{{ $periodo->peun_id }}"></td>
                                    <td class="col-2"><label class="form-check-label w-100"
                                            for="per{{ $periodo->peun_id }}">{{ $periodo->peun_ano }}</label></td>
                                    <td class="col-2"><label class="form-check-label w-100"
                                            for="per{{ $periodo->peun_id }}">{{ $periodo->peun_periodo }}</label></td>
                                    <td class="col-2"><label class="form-check-label w-100"
                                            for="per{{ $periodo->peun_id }}">{{ $periodo->peun_fechainicio->format('d-m-Y') }}</label>
                                    </td>
                                    <td class="col-2"><label class="form-check-label w-100"
                                            for="per{{ $periodo->peun_id }}">{{ $periodo->peun_fechafin->format('d-m-Y') }}</label>
                                    </td>
                                    <td class="col-3"><label class="form-check-label w-100"
                                            for="per{{ $periodo->peun_id }}">{{ $periodo->tipoPeriodoAcademico->tppa_descripcion }}</label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col text-center mb-2">
                <h4>Programas en el periodo</h4>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <select class="sel2 form-control">
                    <option></option>
                    @foreach ($programas as $programa)
                        <option value="">{{ $programa->unidadPrograma->programa->prog_nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.select2.defaults.set('language', 'es');
                $('.select2').select2({
                    placeholder: "Seleccione una unidad",
                });
                $('.select2').on('change', function() {
                    @this.set('ur', this.value);
                });

                window.initSel2 = () => {
                    $('.sel2').select2();
                }
                initSel2();
                window.livewire.on('sel2', () => {
                    initSel2();
                })
            });
        </script>
    @endpush
</div>
