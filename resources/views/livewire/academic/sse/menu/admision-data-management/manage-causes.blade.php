<div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Gestion Causas</b></h5>
    </div>

    @if(count($causes) > 0)
        <div class="row col-lg-12 mt-5 text-center">
            <div class="col-lg-4">
                <b>Código</b>
            </div>
            <div class="col-lg-4">
                <b>Causa</b>
            </div>
            <div class="col-lg-4">
                <b>Acción</b>
            </div>
        </div>
        @foreach($causes as $cause)
            <div class="row col-lg-12 mt-5 text-center">
                <div class="col-lg-4">
                    {{$cause["cau_id"]}}
                </div>
                <div class="col-lg-4">
                    {{$cause["cau_nombre"]}}
                </div>
                <div class="col-lg-4">
                    <a href="{{route("administrarDatosAtencionEditar",[$cause["cau_id"]])}}" class="btn btn-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-brush" viewBox="0 0 16 16">
                            <path d="M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.067 6.067 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.118 8.118 0 0 1-3.078.132 3.659 3.659 0 0 1-.562-.135 1.382 1.382 0 0 1-.466-.247.714.714 0 0 1-.204-.288.622.622 0 0 1 .004-.443c.095-.245.316-.38.461-.452.394-.197.625-.453.867-.826.095-.144.184-.297.287-.472l.117-.198c.151-.255.326-.54.546-.848.528-.739 1.201-.925 1.746-.896.126.007.243.025.348.048.062-.172.142-.38.238-.608.261-.619.658-1.419 1.187-2.069 2.176-2.67 6.18-6.206 9.117-8.104a.5.5 0 0 1 .596.04zM4.705 11.912a1.23 1.23 0 0 0-.419-.1c-.246-.013-.573.05-.879.479-.197.275-.355.532-.5.777l-.105.177c-.106.181-.213.362-.32.528a3.39 3.39 0 0 1-.76.861c.69.112 1.736.111 2.657-.12.559-.139.843-.569.993-1.06a3.122 3.122 0 0 0 .126-.75l-.793-.792zm1.44.026c.12-.04.277-.1.458-.183a5.068 5.068 0 0 0 1.535-1.1c1.9-1.996 4.412-5.57 6.052-8.631-2.59 1.927-5.566 4.66-7.302 6.792-.442.543-.795 1.243-1.042 1.826-.121.288-.214.54-.275.72v.001l.575.575zm-4.973 3.04.007-.005a.031.031 0 0 1-.007.004zm3.582-3.043.002.001h-.002z"/>
                        </svg> Editar
                    </a>
                </div>
            </div>
        @endforeach()

    @else
        <div class="row col-lg-12 justify-content-center mt-5 ">
            <h6><b>No hay datos</b></h6>
        </div>
    @endif
    <div class="row col-lg-12 text-center">
        <button class="btn btn-success mr-2" wire:click="redirectCreateCause" style="color: #1b1e21">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-sd-card" viewBox="0 0 16 16">
                <path
                    d="M6.25 3.5a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2zm2 0a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2zm2 0a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2zm2 0a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2z"/>
                <path fill-rule="evenodd"
                      d="M5.914 0H12.5A1.5 1.5 0 0 1 14 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5V3.914c0-.398.158-.78.44-1.06L4.853.439A1.5 1.5 0 0 1 5.914 0zM13 1.5a.5.5 0 0 0-.5-.5H5.914a.5.5 0 0 0-.353.146L3.146 3.561A.5.5 0 0 0 3 3.914V14.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-13z"/>
            </svg>
            Crear

        </button>
    </div>
</div>
