<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'schedule','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h2>Horario</h2>
    </div>
    @if($schedule!=null && count($schedule)>0)
        <div class="row col-lg-12  mt-5  justify-content-center">
            <div class="col-lg-3 col-md-3 border border-info text-center ">
                <b>Materia</b>
            </div>
            <div class="col-lg-1 col-md-3 border border-info text-center ">
                <b>Lunes</b>
            </div>
            <div class="col-lg-1 col-md-3 border border-info text-center ">
                <b>Martes</b>
            </div>
            <div class="col-lg-1 col-md-3 border border-info text-center ">
                <b>Miercoles</b>
            </div>
            <div class="col-lg-1 col-md-3 border border-info text-center ">
                <b>Jueves</b>
            </div>
            <div class="col-lg-1 col-md-3 border border-info text-center ">
                <b>Viernes</b>
            </div>
            <div class="col-lg-1 col-md-3 border border-info text-center ">
                <b>Sabado</b>
            </div>
        </div>
        @foreach($schedule as $sheduleSubject)
            <div class="row col-lg-12  mt-0  justify-content-center">
                <div class="col-lg-3 col-md-3 border border-info text-center ">
                    <small>{{$sheduleSubject['mate_codigomateria']}}</small><br>
                    <small>{{$sheduleSubject['mate_nombre']}}</small><br>
                    <small>{!! $sheduleSubject['grup_nombre'] !!}</small>
                </div>
                <div class="col-lg-1 col-md-3 border border-info text-center ">
                    @if($sheduleSubject['dia'] == 'LUNES')
                        <b><small>{{$sheduleSubject['inicio']}} - {{$sheduleSubject['final']}}</small></b><br>
                        <small>{{$sheduleSubject['tirf_descripcion']}}</small><br>
                        <small>{{$sheduleSubject['refi_nomenclatura']}}</small>
                    @endif
                </div>
                <div class="col-lg-1 col-md-3 border border-info text-center ">
                    @if($sheduleSubject['dia'] == 'MARTES')
                        <small>{{$sheduleSubject['inicio']}}-{{$sheduleSubject['final']}}</small><br>
                        <small>{{$sheduleSubject['tirf_descripcion']}}</small><br>
                        <small>{{$sheduleSubject['refi_nomenclatura']}}</small>
                    @endif
                </div>
                <div class="col-lg-1 col-md-3 justify-content-center border border-info text-center ">
                    @if($sheduleSubject['dia'] == 'MIERCOLES')
                        <small>{{$sheduleSubject['inicio']}}-{{$sheduleSubject['final']}}</small><br>
                        <small>{{$sheduleSubject['tirf_descripcion']}}</small><br>
                        <small>{{$sheduleSubject['refi_nomenclatura']}}</small>
                    @endif
                </div>
                <div class="col-lg-1 col-md-3 border border-info text-center ">
                    @if($sheduleSubject['dia'] == 'JUEVES')
                        <small>{{$sheduleSubject['inicio']}}-{{$sheduleSubject['final']}}</small><br>
                        <small>{{$sheduleSubject['tirf_descripcion']}}</small><br>
                        <small>{{$sheduleSubject['refi_nomenclatura']}}</small>
                    @endif
                </div>
                <div class="col-lg-1 col-md-3 border border-info text-center ">
                    @if($sheduleSubject['dia'] == 'VIERNES')
                        <small>{{$sheduleSubject['inicio']}}-{{$sheduleSubject['final']}}</small><br>
                        <small>{{$sheduleSubject['tirf_descripcion']}}</small><br>
                        <small>{{$sheduleSubject['refi_nomenclatura']}}</small>
                    @endif
                </div>
                <div class="col-lg-1 col-md-3 border border-info text-center ">
                    @if($sheduleSubject['dia'] == 'SABADO')
                        <small>{{$sheduleSubject['inicio']}}-{{$sheduleSubject['final']}}</small><br>
                        <small>{{$sheduleSubject['tirf_descripcion']}}</small><br>
                        <small>{{$sheduleSubject['refi_nomenclatura']}}</small>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="row col-lg-12 justify-content-center mt-5">
            <h6>No hay horarios disponibles</h6>
        </div>
    @endif

</div>
