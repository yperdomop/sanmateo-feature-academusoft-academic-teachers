<div>
    <div class="col-lg-12">
        @livewire("academic.sse.menu.student-tracing.register-attention-unity.menu-register-attention",['tab'=>
        'graduate','estpId'=> $dataStudent["estp_id"]])
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <h5><b>Egresado</b></h5>
    </div>

    @if(($dataGraduate != null) && count($dataGraduate) > 0)
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Indique en que área le interesaría obtener capacitación:</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["arie_id"]}} - {{$dataGraduate["arie_otro"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Indique el horario que le gustaría se implementará para continuar capacitandose:</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_horario"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Indique si pertenece a algún grupo, asociación, agremiación de tipo:</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_grupo"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Actualmente se encuentra Laborando en:</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_labora"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>La empresa donde trabaja lo vinculo después de la práctica empresarial </b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_vinculo"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Su Ingreso Mensual Actual es de:</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_ingresomensual"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Qué tan relacionado esta su trabajo con su profesión</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_relacionprofesion"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Actividad de la empresa</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_actividadempresa"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Dirección</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_direccionempresa"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Teléfonos</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_telefonoempresa"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Antigüedad de la empresa:</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_antiguedadempresa"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>No. De Empleados:</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_empleadosempresa"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Indique el Tipo de empresa:</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_tipoempresa"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Está intersado/a en recibir información de ofertas Laborales</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_interesoferlaboral"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Cree que el programa académico cumplio con sus expectativas?</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_expectativaprog"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>En que aspectos considera que es necesario mejorar y/o profundizar y porque?</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_mejoraprograma"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>¿Por qué?</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_mejoraprogamaporque"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Cómo se sostuvo económicamente durante sus estudios ?</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_sotenimientoestudios"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Indique cual es el cargo que usted más ha desempeñado, hasta el momento</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_cargo"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Si usted ha sido creador de empresa, cuál es la naturaleza de las misma?</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_naturaleza"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Nombre de la Empresa:</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_empresapropia"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Tipo de Empresa:</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_tipoempresapropia"]}}
        </div>
    </div>

    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Si se encuentra desempleado actualmente indique a qué atribuye esta situación</b>
        </div>
        <div class="col-lg-6">
            @php
                $unemployed = explode(",",$dataGraduate["eneg_desempleo"]);
            @endphp

            <div class="row col-lg-6 justify-content-center mt-1 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    La carrera es poco conocida
                </div>
                <div class="col-lg-2 ">
                    {{(isset($unemployed[0]) && $unemployed[0]!="")?$unemployed[0]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Deficiencia en la formación en pregrado
                </div>
                <div class="col-lg-2 ">
                    {{(isset($unemployed[1]) && $unemployed[1] != "")?$unemployed[1]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Escasa experiencia laboral
                </div>
                <div class="col-lg-2 ">
                    {{(isset($unemployed[2]) && $unemployed[2] != "")?$unemployed[2]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Situaciones Personales
                </div>
                <div class="col-lg-2 ">
                    {{(isset($unemployed[3]) && $unemployed[3] != "")?$unemployed[3]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Inexistencia de buenas relaciones familiares o sociales
                </div>
                <div class="col-lg-2 ">
                    {{(isset($unemployed[4]) && $unemployed[4] != "")?$unemployed[4]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Ofertas poco atractivas
                </div>
                <div class="col-lg-2 ">
                    {{(isset($unemployed[5]) && $unemployed[5] != "")?$unemployed[5]:'-'}}
                </div>
            </div>


        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Como considera la calidad de los docentes?</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_calidaddocentes"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Qué sugerencias tendría para el mejoramiento institucional y del programa del cual es egresado?</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_sugerencias"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Estaría dispuesto a convocar a sus compañeros de promoción y amigos egresados con el fin de trabajar por el desarrollo de la institución, el programa y la conformación de una organización de egresados?</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_convocaegresados"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Tiempo Disponible</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_disponibilidad"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Indique jornada:</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_jornada"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>¿Le gustaría seguir en contacto con la FUS, en Su calidad de egresado?</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_jornada"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>en orden de prioridad qué servicios le agradaría que le siguiera suministrando la Institución:</b>
        </div>
        @php
            $prority = explode(",",$dataGraduate["eneg_serviciosfus"]);
        @endphp
        <div class="col-lg-6 justify-content-center">
            <div class="row col-lg-6 justify-content-center mt-1 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Proyectos de investigación
                </div>
                <div class="col-lg-2 ">
                    {{(isset($prority[0]))?$prority[0]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Bienestar Universitario
                </div>
                <div class="col-lg-2 ">
                    {{(isset($prority[1]))?$prority[1]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Publicaciones Periódico
                </div>
                <div class="col-lg-2 ">
                    {{(isset($prority[2]))?$prority[2]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Información ocupacional y laboral
                </div>
                <div class="col-lg-2 ">
                    {{(isset($prority[3]))?$prority[3]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Programación artística y cultural
                </div>
                <div class="col-lg-2 ">
                    {{(isset($prority[4]))?$prority[4]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Simposios, seminarios y conferencias
                </div>
                <div class="col-lg-2 ">
                    {{(isset($prority[5]))?$prority[5]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Convocatorias concursos
                </div>
                <div class="col-lg-2 ">
                    {{(isset($prority[6]))?$prority[6]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Espacio radial en la Emisora
                </div>
                <div class="col-lg-2 ">
                    {{(isset($prority[7]))?$prority[7]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Plegables informativos mensuales
                </div>
                <div class="col-lg-2 ">
                    {{(isset($prority[8]))?$prority[8]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Pagina Web
                </div>
                <div class="col-lg-2 ">
                    {{(isset($prority[9]))?$prority[9]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Revistas Institucionales
                </div>
                <div class="col-lg-2 ">
                    {{(isset($prority[10]))?$prority[10]:'-'}}
                </div>
            </div>
            <div class="row col-lg-6 justify-content-center mt-1">
                <div class="col-lg-4 ">
                    Diplomados y cursos libres y de actualización
                </div>
                <div class="col-lg-2 ">
                    {{(isset($prority[11]))?$prority[11]:'-'}}
                </div>
            </div>

        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>De que forma considera que el programa que curso favoreció el desarrollo de su proyecto de vida?</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_proyectovida"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Ha sido nominado o ha recibido reconocimientos en alguna de estas áreas?  </b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_reconocimiento"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Cuál de los siguientes servicios que ofrece la institución a los egresados conoce?</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_serviciosconoce"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Cómo considera los servicios prestados por la institución</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_calificaservicios"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Su vinculación laboral fue a traves de? </b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_vinculacion"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Que tipos de logros ha obtenido con su presencia o participación en su trabajo, en su comunidad, en su familia, en grupos, en asociaciones?   </b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_logros"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Ayudenos a contactar e integrar a este proceso a los demás egresados de la FUS, conocidos por usted.</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["eneg_referencias"]}}
        </div>
    </div>
    <div class="row col-lg-12 justify-content-center mt-5 text-center">
        <div class="col-lg-6">
            <b>Opcion de Grado</b>
        </div>
        <div class="col-lg-6">
            {{$dataGraduate["peti_tipo"]}}
        </div>
    </div>
    @else
        <div class="row col-lg-12 justify-content-center mt-5 text-center">
            <h6>No se encontraron datos</h6>
        </div>
    @endif
</div>
