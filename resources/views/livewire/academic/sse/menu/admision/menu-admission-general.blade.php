<div>
    <div class="col-lg-12">
        <div class="col-g-12 mt-5">
            <ul class="nav nav-tabs" >
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "studentPayment") active @endif"
                       href="{{route("datosAdmissionDetalle",$foinId)}}">Pago Estudiante</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "studentForm") active @endif"
                       href="{{route("formularioEStudiante",$foinId)}}">Formulario Estudiante</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "studentResponsible") active @endif"
                       href="{{route("responsableEStudiante",$foinId)}}">Responsable Estudiante</a>
                </li>
            </ul>
        </div>
    </div>
</div>
