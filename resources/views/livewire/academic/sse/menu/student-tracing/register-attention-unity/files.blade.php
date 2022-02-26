<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'files','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Archivos</b></h5>
    </div>
    @foreach($typeCases as $typeCase)
        <div class="row col-lg-12 mt-5 ">
            <div class="col-lg-3">
                <strong>Caso:</strong> {{$typeCase['ce_id']}}
            </div>
            <div class="col-lg-3">
                <strong>Tipo Caso:</strong> {{$typeCase['caso_nombre']}}
            </div>
            <div class="col-lg-3">
                <strong>Fecha del Caso:</strong> {{$typeCase['ce_fecha_in']}}
            </div>
            <div class="col-lg-3">
                <strong>Tipo Requerimiento:</strong> {{$typeCase['ced_tipo_requerimiento']}}
            </div>
        </div>

        @php
            $detailFiles = $this->getFilesByCeId($typeCase['ce_id']);
        @endphp
        <div class="row col-lg-12 mt-3 " style="background-color: #a0d2f3">
            <div class="col-lg-6 text-center">
               <strong>Nombre Doc.</strong>
            </div>
            <div class="col-lg-6 text-center">
                <strong>Url</strong>
            </div>
        </div>
        @foreach($detailFiles as $files)
            <div class="row col-lg-12 mt-0">
                <div class="col-lg-6 ">
                    {{$files["cado_nombre"]}}
                </div>
                <div class="col-lg-6">
                    {{($files["url"]==null)?"No hay archivo":$files["url"]}}
                </div>
            </div>
        @endforeach

    @endforeach
</div>
