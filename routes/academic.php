<?php

use App\Http\Livewire\Academic\Administrator\CreateScoreType;
use App\Http\Livewire\Academic\Administrator\EditScoreType;
use App\Http\Livewire\Academic\Administrator\EvaluationSystem\AsignGroupNote;
use App\Http\Livewire\Academic\Administrator\EvaluationSystem\CreateAcademicEvaluation;
use App\Http\Livewire\Academic\Administrator\EvaluationSystem\CreateEvaluationSystem;
use App\Http\Livewire\Academic\Administrator\EvaluationSystem\DetailEvaluationSystem;
use App\Http\Livewire\Academic\Administrator\EvaluationSystem\EditAcademicEvaluation;
use App\Http\Livewire\Academic\Administrator\EvaluationSystem\EditEvaluationSystem;
use App\Http\Livewire\Academic\Administrator\EvaluationSystem\EvaluationSystem;
use App\Http\Livewire\Academic\Administrator\EvaluationSystem\UpdateGroupAcademicSystem;
use App\Http\Livewire\Academic\Administrator\Notes\AssignGroupScore;
use App\Http\Livewire\Academic\Administrator\Notes\DetailGroups;
use App\Http\Livewire\Academic\Administrator\ScoreType;
use \App\Http\Livewire\Academic\Teacher\GetClasses;
use App\Http\Livewire\Academic\Teacher\GetSchedule;
use \App\Http\Livewire\Academic\Teacher\GetStudentScore;
use App\Http\Livewire\Academic\Teacher\SetStudentScore;
use Illuminate\Support\Facades\Route;
//Rutas controladores programas
use App\Http\Controllers\Academic\Administrator\ProgramsController;
use App\Http\Controllers\Academic\Administrator\UnitProgramsController;

Route::group(['prefix' => 'docente', 'middleware' => ['web']], function () {
    Route::get('mis-clases', [GetClasses::class, '__invoke'])->name('teacher.getClass');
    Route::get('ver-notas', [GetStudentScore::class, '__invoke'])->name('teacher.getStudentScore');
    Route::get('calificar', [SetStudentScore::class, '__invoke'])->name('teacher.setStudentScore');
    Route::get('mis-horarios', [GetSchedule::class, '__invoke'])->name('teacher.getSchedule');
});


Route::group(['prefix' => 'administrador', 'middleware' => ['web']], function () {
    Route::get('/', function () {
        dump('menu-here');
    })->name('administrator.index');
    Route::get('tipo-calificaciones', [ScoreType::class, '__invoke'])->name('administrator.scoreType');
    Route::get('tipo-calificaciones/crear', [CreateScoreType::class, '__invoke'])->name('administrator.createScoreType');
    Route::get('tipo-calificaciones/editar/{scoreTypeId}', [EditScoreType::class, '__invoke'])->name('administrator.editScoreType');


    Route::get('sistema-evaluacion', [EvaluationSystem::class, '__invoke'])->name('administrator.evaluationSystem');
    Route::get('sistema-evaluacion/crear', [CreateEvaluationSystem::class, '__invoke'])->name('administrator.createEvaluationSystem');
    Route::get('sistema-evaluacion/{evaluationSystemId}', [DetailEvaluationSystem::class, '__invoke'])->name('administrator.detailEvaluationSystem')->where('evaluationSystemId', '[0-9]+');
    Route::get('sistema-evaluacion/{evaluationSystemId}/editar', [EditEvaluationSystem::class, '__invoke'])->name('administrator.editEvaluationSystem');
    Route::get('sistema-evaluacion/{evaluationSystemId}/evaluacion-academico', [CreateAcademicEvaluation::class, '__invoke'])->name('administrator.createAcademicEvaluation');
    Route::get('sistema-evaluacion/{evaluationSystemId}/evaluacion-academico/{academicEvaluationId}', [EditAcademicEvaluation::class, '__invoke'])->name('administrator.editAcademicEvaluation');

    Route::get('sistema-evaluacion/asignar-grupo-nota', [AsignGroupNote::class, '__invoke'])->name('administrator.asignGroupNote');
    Route::get('sistema-evaluacion/actualizar-grupo', [UpdateGroupAcademicSystem::class, '__invoke'])->name('administrator.updateGroupAcademicSystem');

    Route::get('calificar', [DetailGroups::class, '__invoke'])->name('administrator.setGroupForScore');
    Route::get('calificar/calificar-grupo', [AssignGroupScore::class, '__invoke'])->name('administrator.assignScore');

    //Rutas programas
    Route::get('programas', [ProgramsController::class, 'index',])->name('administrador.programs.index');
    Route::get('programas/crear', [ProgramsController::class, 'create'])->name('administrador.programs.create');
    Route::post('programas/crear', [ProgramsController::class, 'store'])->name('administrador.programs.store');
    Route::get('programas/{programa}', [ProgramsController::class, 'show'])->name('administrador.programs.show');
    Route::get('programas/{programa}/editar', [ProgramsController::class, 'edit'])->name('administrador.programs.edit');
    Route::post('programas/{programa}/editar', [ProgramsController::class, 'update'])->name('administrador.programs.update');
    Route::post('programas/{programa}', [ProgramsController::class, 'destroy'])->name('administrador.programs.destroy');
    Route::get('programas/{programa}/unidad', [UnitProgramsController::class, 'create'])->name('administrador.unitprograms.create');
    Route::post('programas/{programa}/unidad', [UnitProgramsController::class, 'store'])->name('administrador.unitprograms.store');
    Route::get('programas/{programa}/unidad/{unidadPrograma}', [UnitProgramsController::class, 'edit'])->name('administrador.unitprograms.edit');
    Route::post('programas/{programa}/unidad/{unidadPrograma}', [UnitProgramsController::class, 'update'])->name('administrador.unitprograms.update');
    Route::post('programas/{programa}/unidad/{unidadPrograma}/eliminar', [UnitProgramsController::class, 'destroy'])->name('administrador.unitprograms.destroy');
});
