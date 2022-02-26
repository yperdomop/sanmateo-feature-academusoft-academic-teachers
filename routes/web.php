<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Academic\Teacher\GetClasses;
use App\Http\Controllers\Academic\Teacher\SetStudentScore;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Auth;
//imports livewire components
use \App\Http\Controllers\Academic\Sse\SseControler;
use \App\Http\Livewire\Academic\Sse\Menu\StudentTracing\RegisterAttentionUnity\RegisterAttentionUnity;
use \App\Http\Livewire\Academic\Sse\Index;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'user', 'middleware' => ['isUser', 'auth']], function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('admin', [UserController::class, 'admin'])->name('user.admin');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('settings', [UserController::class, 'settings'])->name('user.settings');
    Route::post('/getApplications', [ServiceController::class, 'getApplications']);
    Route::post('/generateToken', [ServiceController::class, 'generateToken']); 
    Route::post('/getApplicationId', [ServiceController::class, 'getApplicationId']); 
    Route::post('/getRoleId', [ServiceController::class, 'getRoleId']); 
    Route::post('/getFuncId', [ServiceController::class, 'getFuncId']); 
    Route::post('/getFuncAplication', [ServiceController::class, 'getFuncAplication']); 
    Route::post('/deleteAplication', [ServiceController::class, 'deleteAplication']); 
    Route::post('/saveAplication', [ServiceController::class, 'saveAplication']); 
    Route::post('/deleteRol', [ServiceController::class, 'deleteRol']); 
    Route::post('/saveRol', [ServiceController::class, 'saveRol']); 
    Route::post('/deleteFunction', [ServiceController::class, 'deleteFunction']); 
    Route::post('/saveFunction', [ServiceController::class, 'saveFunction']); 
    
});
Route::group(['prefix'=>'admin', 'middleware'=>['isUser', 'auth']], function(){
    Route::get('user_rol', [AdminController::class, 'user_rol'])->name('admin.user_rol');
    Route::get('rol_aplicacion', [AdminController::class, 'rol_aplicacion'])->name('admin.rol_aplicacion');
    Route::get('apli_func_rol', [AdminController::class, 'apli_func_rol'])->name('admin.apli_func_rol');
    Route::post('/searchuser', [ServiceController::class, 'searchuser']);
    Route::post('/getRolesUser', [ServiceController::class, 'getRolesUser']);
    Route::post('/deleteRoleUser', [ServiceController::class, 'deleteRoleUser']);
    Route::post('/addRoleUser', [ServiceController::class, 'addRoleUser']);
    Route::post('/searchAplicationsRole', [ServiceController::class, 'searchAplicationsRole']);
    Route::post('/saveRoleAplication', [ServiceController::class, 'saveRoleAplication']);
    Route::post('/deleteAppRole', [ServiceController::class, 'deleteAppRole']);
    Route::post('/getFuncAplication', [ServiceController::class, 'getFuncAplication']); 
    Route::post('/getFuncAplicationRol', [ServiceController::class, 'getFuncAplicationRol']);
    Route::post('/addRoleFunction', [ServiceController::class, 'addRoleFunction']);
    Route::post('/deleteRoleFunc', [ServiceController::class, 'deleteRoleFunc']);
});

Route::post('/user/getApplications', [ServiceController::class, 'getApplications']);

Route::get('applications/grados', function () {
    return Redirect::to('http://localhost/applications/grados/public_html');
});

Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');




