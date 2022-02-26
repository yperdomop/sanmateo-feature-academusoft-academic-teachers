<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.admision.menu-admission-general",['tab'=>
        'studentForm','foinId'=> $generalData["foin_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Formulario Estudiante</b></h5>
    </div>

    <div class="row col-lg-12 justify-content-center mt-5 text-center">
            <select class="form-control" style="width: 50%" name="formPay" id="selectedTypeForm" wire:model="selectedTypeForm">
                <option value="">Seleccione.</option>
                @foreach($typeFormList as $list)
                    <option value="{{$list["tf_id"]}}">{{$list["tf_nombre"]}}</option>
                @endforeach
            </select>
        <div>

            @error('selectedTypeForm') <small
                style="color: red">{{ $message }}</small> @enderror
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <button class="btn btn-info mr-2" wire:click="saveTypeForm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2-fill" viewBox="0 0 16 16">
                <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v6h-2a.5.5 0 0 0-.354.854l2.5 2.5a.5.5 0 0 0 .708 0l2.5-2.5A.5.5 0 0 0 10.5 7.5h-2v-6z"/>
            </svg>
            Guardar
        </button>
    </div>
    <div class="col-lg-12 d-flex justify-content-center ">
        @if (session()->has('typeFormFoinSaved'))
            <div class="alert alert-success">
                {{ session('typeFormFoinSaved') }}
            </div>
        @endif
        @if (session()->has('typeFormFoinFail'))
            <div class="alert alert-danger">
                {{ session('typeFormFoinFail') }}
            </div>
        @endif
    </div>
</div>
