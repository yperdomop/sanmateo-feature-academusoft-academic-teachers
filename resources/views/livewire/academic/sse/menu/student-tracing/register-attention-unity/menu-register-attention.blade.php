<div>
    <div class="col-lg-12">

        <div class="col-g-12 mt-5">
            <ul class="nav nav-tabs" >
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "registerAttention") active @endif"
                       href="{{route("verRegistrarAtencion",$estpId)}}">Registrar Atención</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "history") active @endif"
                       href="{{route("verHistorial",$estpId)}}">Historial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "schedule") active @endif"
                       href="{{route("verHorario",$estpId)}}">Horario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "actualScores") active @endif"
                       href="{{route("verNotasActuales",$estpId)}}">Notas Actuales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "extendedRegistry") active @endif"
                       href="{{route("verRegistroExtendido",$estpId)}}">Registro Extendido</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "pensum") active @endif"
                       href="{{route("verPensum",$estpId)}}">Pensum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "documents") active @endif"
                       href="{{route("verDocumentos",$estpId)}}">Documentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "liquidation") active @endif"
                       href="{{route("verLiquidacion",$estpId)}}">Liquidación</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "files") active @endif"
                       href="{{route("verArchivos",$estpId)}}">Archivos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "pendingSubjects") active @endif"
                       href="{{route("verMateriasPendientes",$estpId)}}">Materias Pendientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "faults") active @endif"
                       href="{{route("verFallas",$estpId)}}">Fallas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "mayoredPetitions") active @endif"
                       href="{{route("verPeticionesGrado",$estpId)}}">Peticiones de Grado</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "bussinessPractices") active @endif"
                       href="{{route("verPracticasEmpresariales",$estpId)}}">Practicas Empresariales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "disciplinary") active @endif"
                       href="{{route("verDisciplinarios",$estpId)}}">Disciplinarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "homologation") active @endif"
                       href="{{route("verHomologacion",$estpId)}}">Homologation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "graduate") active @endif"
                       href="{{route("verEgresado",$estpId)}}">Egresado</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(isset($activeMenu) && $activeMenu == "offer") active @endif"
                       href="{{route("verOferta",$estpId)}}">Oferta</a>
                </li>
            </ul>
        </div>
    </div>
</div>
