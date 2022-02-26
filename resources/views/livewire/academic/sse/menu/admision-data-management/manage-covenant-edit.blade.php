<div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Gestion Convenio Editar</b></h5>
    </div>

    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        Nombre: @error('nameToSave') <small
            style="color: red">{{ $message }}</small> @enderror
    </div>
    <div class="row col-lg-12 justify-content-center mt-0 text-center">
        <input type="text" wire:model="nameToSave" value="{{$nameToSave}}">
    </div>
    <div class="col-lg-12 mt-4 d-flex justify-content-center">

        <button class="btn btn-info mr-2" wire:click="editCoven">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-sd-card" viewBox="0 0 16 16">
                <path
                    d="M6.25 3.5a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2zm2 0a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2zm2 0a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2zm2 0a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2z"/>
                <path fill-rule="evenodd"
                      d="M5.914 0H12.5A1.5 1.5 0 0 1 14 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5V3.914c0-.398.158-.78.44-1.06L4.853.439A1.5 1.5 0 0 1 5.914 0zM13 1.5a.5.5 0 0 0-.5-.5H5.914a.5.5 0 0 0-.353.146L3.146 3.561A.5.5 0 0 0 3 3.914V14.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-13z"/>
            </svg>
            Guardar

        </button>

        <a class="btn btn-danger" href="{{route("administrarConvenios")}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
            </svg> Volver

        </a>

    </div>
    <div class="col-lg-12 d-flex justify-content-center ">
        @if (session()->has('covenSaved'))
            <div class="alert alert-success">
                {{ session('covenSaved') }}
            </div>
        @endif
        @if (session()->has('covenSavedFailed'))
            <div class="alert alert-danger">
                {{ session('covenSavedFailed') }}
            </div>
        @endif
    </div>

</div>
