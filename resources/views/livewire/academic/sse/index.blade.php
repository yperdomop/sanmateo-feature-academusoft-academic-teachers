<div class=" col-lg-12 row">
    <div class="col-lg-6">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <!-- <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="#" onclick="window.location='{{route("registrarUnidadAtencion")}}'">Registrar unidad de atención</a>
                            </li>
                        </ul>
                    </div>
                </div> -->
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($functions as $f)
                                <li class="list-group-item">
                                    <a href="#" onclick="window.location='sse{{ $f->func_urlrecurso }}'">{{ $f->func_nombre }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                            Administrar datos admisión
                        </button>
                    </h2>
                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="#" onclick="window.location='{{route("administrarDatosAtencion")}}'">Administrar causas</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" onclick="window.location='{{route("administrarConvenios")}}'">Administrar datos convenios</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" onclick="window.location='{{route("administrarPagos")}}'">Administrar pagos</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" onclick="window.location='{{route("administrarTipoFormulario")}}'">Administrar tipo formulario</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" onclick="window.location='{{route("administrarTipoDoc")}}'">Administrar tipo documento</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <div class="col-lg-6">
        
    </div>
</div>
