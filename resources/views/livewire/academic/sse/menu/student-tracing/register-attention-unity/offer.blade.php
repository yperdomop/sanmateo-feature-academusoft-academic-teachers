<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'offer','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Oferta</b></h5>
    </div>

    @if(count($offer) > 1)
        <div class="row col-lg-12  mt-5 ">
            <div class="col-lg-3">
                <b>Codigo</b>
            </div>
            <div class="col-lg-3">
                <b>Materia</b>
            </div>
            <div class="col-lg-3">
                <b>Unidad</b>
            </div>
            <div class="col-lg-3">
                <b>Numero veces</b>
            </div>
        </div>
        @foreach($offer as $dataOffer)
            <div class="row col-lg-12  mt-5 ">
                <div class="col-lg-3">
                   {{$dataOffer["mate_id"]}}
                </div>
                <div class="col-lg-3">
                    {{$dataOffer["mate_nombre"]}}
                </div>
                <div class="col-lg-3">
                    {{$dataOffer["unid_nombre"]}}
                </div>
                <div class="col-lg-3">
                    {{$dataOffer["dema_numeroveces"]}}
                </div>
            </div>
        @endforeach
    @else
        <div class="row col-lg-12 justify-content-center mt-5 text-center">
            <h6>No se encontraron datos</h6>
        </div>
    @endif



</div>
