<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'documents','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Documentos Estudiante</b></h5>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Documento</b>
        </div>
        <div class="col-lg-6">
            <b>Entrego</b>
        </div>
    </div>
    @foreach($studentDocs as $doc)

    <div class="row col-lg-12 justify-content-center d-flex">
        <div class="col-lg-6">
            {{$doc["tdoc_descripcion"]}}
        </div>
        <div class="col-lg-6 text-center">
            @if($doc["exist_doc"] == "0")
                No
            @else
                Si
            @endif
        </div>
    </div>
    @endforeach

    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Documentos Formulario</b></h5>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Documento</b>
        </div>
        <div class="col-lg-6">
            <b>Url</b>
        </div>
    </div>
    @foreach($formDocs as $doc)

        <div class="row col-lg-12 justify-content-center d-flex">
            <div class="col-lg-6">
                {{$doc["asdo_nombre"]}}
            </div>
            <div class="col-lg-6 text-center">
               {{$doc["doas_url"]}}
            </div>
        </div>
    @endforeach

    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Documentos Homologación</b></h5>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Documento</b>
        </div>
    </div>
    @foreach($homoDocs as $doc)

        <div class="row col-lg-12 justify-content-center d-flex">
            <div class="col-lg-6">
                {{$doc["nombre_documento"]}}
            </div>
        </div>
    @endforeach

</div>
