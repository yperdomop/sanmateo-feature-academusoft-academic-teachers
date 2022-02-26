<?php
//imports livewire components
//use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\RegisterAttentionUnity;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\Index;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\ViewStudent;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\CaseStudent;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\RegisterAttention;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\Schedule;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\History;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\Pensum;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\Documents;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\Files;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\PendingSubjects;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\Faults;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\ExtendedRegistry;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\MayoredPetitions;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\BussinessPractices;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\Disciplinary;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\Homologation;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\Liquidation;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\ActualScores;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\Graduate;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\Offer;
use \App\Http\Livewire\Academic\Sse\Index as IndexSSE;
use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManageCauses;
use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManageCausesEdit;
use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManageCausesCreate;

use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManageCovenant;
use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManageCovenantEdit;
use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManageCovenantCreate;

use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManagePayMethod;
use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManagePayMethodEdit;
use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManagePayMethodCreate;

use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManageFormType;
use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManageFormTypeCreate;
use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManageFormTypeEdit;

use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManageTypeDocs;
use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManageTypeDocsCreate;
use \App\Http\Livewire\Academic\Sse\Menu\AdmisionDataManagement\ManageTypeDocsEdit;

use \App\Http\Livewire\Academic\Sse\Menu\Admision\AdmissionData;
use \App\Http\Livewire\Academic\Sse\Menu\Admision\AdmissionDataDetail;
use \App\Http\Livewire\Academic\Sse\Menu\Admision\StudentForm;
use \App\Http\Livewire\Academic\Sse\Menu\Admision\ResponsibleStudent;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::group(['prefix' => '', 'middleware' => [ 'web','isUser', 'auth','role:121' ] ],function (){
    Route::get('/', [IndexSSE::class,'__invoke'])->name("indexMenu");
//    Route::get('/registrar-unidad-atencion', [Index::class,'__invoke'])->name("registrarUnidadAtencion");
    Route::group(['prefix' => 'registrar-unidad-atencion', 'middleware' => [ 'role:121,73658' ]],function (){
        Route::get('/', [Index::class,'__invoke'])->name("registrarUnidadAtencion");
        Route::get('/ver-estudiante/{estpId}', [ViewStudent::class,'__invoke'])->name("verEstudiante");
        Route::get('/ver-estudiante/{estpId}/registrar-atencion', [RegisterAttention::class,'__invoke'])->name("verRegistrarAtencion");
        Route::get('/ver-estudiante/{estpId}/registrar-atencion/caso/{ceId}', [CaseStudent::class,'__invoke'])->name("casoEstudiante");
        Route::get('/ver-estudiante/{estpId}/historial', [History::class,'__invoke'])->name("verHistorial");
        Route::get('/ver-estudiante/{estpId}/horario', [Schedule::class,'__invoke'])->name("verHorario");
        Route::get('/ver-estudiante/{estpId}/pensum', [Pensum::class,'__invoke'])->name("verPensum");
        Route::get('/ver-estudiante/{estpId}/documentos', [Documents::class,'__invoke'])->name("verDocumentos");
        Route::get('/ver-estudiante/{estpId}/archivos', [Files::class,'__invoke'])->name("verArchivos");
        Route::get('/ver-estudiante/{estpId}/materias-pendientes', [PendingSubjects::class,'__invoke'])->name("verMateriasPendientes");
        Route::get('/ver-estudiante/{estpId}/registro-extendido', [ExtendedRegistry::class,'__invoke'])->name("verRegistroExtendido");
        Route::get('/ver-estudiante/{estpId}/fallas', [Faults::class,'__invoke'])->name("verFallas");
        Route::get('/ver-estudiante/{estpId}/peticiones-grado', [MayoredPetitions::class,'__invoke'])->name("verPeticionesGrado");
        Route::get('/ver-estudiante/{estpId}/practicas-empresariales', [BussinessPractices::class,'__invoke'])->name("verPracticasEmpresariales");
        Route::get('/ver-estudiante/{estpId}/disciplinarios', [Disciplinary::class,'__invoke'])->name("verDisciplinarios");
        Route::get('/ver-estudiante/{estpId}/homologacion', [Homologation::class,'__invoke'])->name("verHomologacion");
        Route::get('/ver-estudiante/{estpId}/liquidacion', [Liquidation::class,'__invoke'])->name("verLiquidacion");
        Route::get('/ver-estudiante/{estpId}/notas-actuales', [ActualScores::class,'__invoke'])->name("verNotasActuales");
        Route::get('/ver-estudiante/{estpId}/egresado', [Graduate::class,'__invoke'])->name("verEgresado");
        Route::get('/ver-estudiante/{estpId}/oferta', [Offer::class,'__invoke'])->name("verOferta");
    });

    Route::group(['prefix' => 'administrar-datos-admision', 'middleware' => [ 'role:121' ]],function (){
        Route::get('/administrar-causas', [ManageCauses::class,'__invoke'])->name("administrarDatosAtencion")->middleware('role:121, 73659');
        Route::get('/administrar-causas/editar/{cauId}', [ManageCausesEdit::class,'__invoke'])->name("administrarDatosAtencionEditar")->middleware('role:121, 73659');
        Route::get('/administrar-causas/crear', [ManageCausesCreate::class,'__invoke'])->name("administrarDatosAtencionCreated")->middleware('role:121, 73659');

        Route::get('/administrar-convenios', [ManageCovenant::class,'__invoke'])->name("administrarConvenios")->middleware('role:121, 73660');
        Route::get('/administrar-convenios/editar/{conId}', [ManageCovenantEdit::class,'__invoke'])->name("administrarConveniosEditar")->middleware('role:121, 73660');
        Route::get('/administrar-convenios/crear', [ManageCovenantCreate::class,'__invoke'])->name("administrarConveniosCrear")->middleware('role:121, 73660');

        Route::get('/administrar-pagos', [ManagePayMethod::class,'__invoke'])->name("administrarPagos")->middleware('role:121, 73661');
        Route::get('/administrar-pagos/editar/{paId}', [ManagePayMethodEdit::class,'__invoke'])->name("administrarPagosEditar")->middleware('role:121, 73661');
        Route::get('/administrar-pagos/crear', [ManagePayMethodCreate::class,'__invoke'])->name("administrarPagosCrear")->middleware('role:121, 73661');

        Route::get('/administrar-tipo-formulario', [ManageFormType::class,'__invoke'])->name("administrarTipoFormulario")->middleware('role:121, 73662');
        Route::get('/administrar-tipo-formulario/editar/{tfId}', [ManageFormTypeEdit::class,'__invoke'])->name("administrarTipoFormularioEditar")->middleware('role:121, 73662');
        Route::get('/administrar-tipo-formulario/crear', [ManageFormTypeCreate::class,'__invoke'])->name("administrarTipoFormularioCrear")->middleware('role:121, 73662');

        Route::get('/administrar-tipo-doc', [ManageTypeDocs::class,'__invoke'])->name("administrarTipoDoc")->middleware('role:121, 73663');
        Route::get('/administrar-tipo-doc/editar/{tiId}', [ManageTypeDocsEdit::class,'__invoke'])->name("administrarTipoDocEditar")->middleware('role:121, 73663');
        Route::get('/administrar-tipo-doc/crear', [ManageTypeDocsCreate::class,'__invoke'])->name("administrarTipoDocCrear")->middleware('role:121, 73663');

    });

    Route::group(['prefix' => 'admision', 'middleware' => []],function (){
        Route::get('/datos-admision', [AdmissionData::class,'__invoke'])->name("datosAdmission");
        Route::get('/datos-admision/detalle/{foinId}', [AdmissionDataDetail::class,'__invoke'])->name("datosAdmissionDetalle");
        Route::get('/datos-admision/detalle/{foinId}/formulario-estudiante', [StudentForm::class,'__invoke'])->name("formularioEStudiante");
        Route::get('/datos-admision/detalle/{foinId}/responsable-estudiante', [ResponsibleStudent::class,'__invoke'])->name("responsableEStudiante");
    });


});
