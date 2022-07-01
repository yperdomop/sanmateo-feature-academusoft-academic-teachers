<div>
    <div class="row">

        <div class="p-1 mb-1 bg-light text-dark container-sm " style="width: 40% ; background-color: #219ef1">
            <h5>
                <center>PROGRAMAS ACADÉMICOS</center>
            </h5>
        </div>
        <div class="col" wire:ignore><br>
            <select wire:model="programa" class="select2">
                <option value="">Seleccione el programa</option>
                @foreach ($programs as $program)
                    <option value="{{ $program->prog_id }}">{{ $program->prog_nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br><br><br><br>
    <div class="row">
        <div class="p-1 mb-1 bg-light text-dark container-sm " style="width: 30%">
            <h5>
                <center>DATOS DE PENSUM</center>
            </h5>
        </div>
    </div>
    <div class="col">
        <div class="table-responsive mt-2">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr><br><br>
                        <th scope="col" class="col-5">Descripción</th>
                        <th scope="col" class="col-2">Fecha de inicio</th>
                        <th scope="col" class="col-2">Estado</th>
                        <th scope="col" class="col-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pensums as $pensum)
                        <tr>
                            <td>{{ $pensum->pens_descripcion }}</td>
                            <td>{{ $pensum->pens_anoinicio }}-{{ $pensum->pens_periodoinicio }}</td>
                            <td>{{ $pensum->estado->espe_descripcion }}</td>
                            <td class="text-center d-flex">
                                <a class="btn btn-primary"
                                    href="{{ route('administrador.programs.show', $program) }}">
                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Continuar</a>
                                &nbsp;
                                <form method="post" action="{{ route('administrador.programs.destroy', $program) }}"
                                    onSubmit="return confirm('Seguro desea eliminar?')">
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                            aria-hidden="true"> </i>
                                        Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col"><br>
        <a href="" class="btn btn-success pull-right"><i class="fa fa-check-circle-o"
                aria-hidden="true"></i>&nbsp;Agregar Pensum</a>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
            $('.select2').on('change', function() {
                @this.set('programa', this.value);
            })
        });
    </script>
@endpush
</div>
