<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.admision.menu-admission-general",['tab'=>
        'studentPayment','foinId'=> $generalData["foin_id"]])
    </div>

    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Pago</b></h5>
    </div>

    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="row col-lg-12">
            <div class="col-lg-6"><b>Formulario de pago:</b>  @error('selectedPaId') <small
                    style="color: red">{{ $message }}</small> @enderror</div>
            <div class="col-lg-6">
                <select class="form-control" style="width: 50%" name="formPay" id="formPay" wire:model="selectedPaId">
                    <option value="">Seleccione.</option>
                    @foreach($listPayments as $listP)
                        <option value="{{$listP["pa_id"]}}">{{$listP["pa_nombre"]}}</option>
                    @endforeach

                </select>
            </div>
       </div>
        <div class="row col-lg-12 mt-2">
            <div class="col-lg-6"><b>Convenio o acuerdo:</b> @error('selectedCoId') <small
                    style="color: red">{{ $message }}</small> @enderror</div>
            <div class="col-lg-6">
                <select class="form-control" name="formPay" id="formPay" wire:model="selectedCoId" style="width: 50%">
                    <option value="">Seleccione.</option>
                    @foreach($covenantList as $listC)
                        <option value="{{$listC["con_id"]}}">{{$listC["con_nombre"]}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="row col-lg-12 mt-2">
            <div class="col-lg-6"><b>Valor full del semestre:</b> @error('fullSemesterAmount') <small
                    style="color: red">{{ $message }}</small> @enderror</div>
            <div class="col-lg-6">
                <input type="number" style="width: 50%" class="form-control" wire:model="fullSemesterAmount" placeholder="digite">
            </div>
        </div>
        <div class="row col-lg-12 mt-2">
            <div class="col-lg-6"><b>Porcentaje Beca:</b> @error('grantPercentaje') <small
                    style="color: red">{{ $message }}</small> @enderror</div>
            <div class="col-lg-6">
                <input type="number" style="width: 50%" class="form-control" wire:model="grantPercentaje" placeholder="digite">
            </div>
        </div>
        <div class="row col-lg-12 mt-2">
            <div class="col-lg-6"><b>Porcentaje Descuento 1er semestre:</b> @error('discountPercentaje') <small
                    style="color: red">{{ $message }}</small> @enderror</div>
            <div class="col-lg-6">
                <input type="number" style="width: 50%" class="form-control" wire:model="discountPercentaje" placeholder="digite">
            </div>
        </div>

    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <button class="btn btn-info mr-2" wire:click="savePayment">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2-fill" viewBox="0 0 16 16">
                <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v6h-2a.5.5 0 0 0-.354.854l2.5 2.5a.5.5 0 0 0 .708 0l2.5-2.5A.5.5 0 0 0 10.5 7.5h-2v-6z"/>
            </svg>
            Guardar
        </button>
    </div>
    <div class="col-lg-12 d-flex justify-content-center ">
        @if (session()->has('payStudentSaved'))
            <div class="alert alert-success">
                {{ session('payStudentSaved') }}
            </div>
        @endif
        @if (session()->has('payStudentSavedFail'))
            <div class="alert alert-danger">
                {{ session('payStudentSavedFail') }}
            </div>
        @endif
    </div>
</div>
