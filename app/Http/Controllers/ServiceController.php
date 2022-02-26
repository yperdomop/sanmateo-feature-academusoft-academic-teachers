<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Aplicacion;
use App\Models\Rol;
use App\Models\Funcionalidad;
use App\Models\Usuariorol;
use App\Models\Rolporletaplicacion;
use App\Models\Rolaplicacionfuncionalidad;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Log;
class ServiceController extends Controller
{
    public function getApplications(Request $request){
        if($request->ajax()){
            $applications = User::getApplicationUser($request->rol_id);
            return response()->json($applications);
        }
    }
    public function generateToken(Request $request){
        if($request->ajax()){
            $user = Auth::user();
            $accessToken = $user->createToken('authToken')->accessToken;
            $route = User::getRouteAplication($request->apli_id);
            $msg = [ 'accessToken'=> $accessToken,
                     'user_id' => $user["usua_id"],
                     'usua_nombre' => $user["usua_nombre"],
                     'usua_nick' => $user["usua_nick"],
                     'peye_id' => $user["usua_nick"],
                     'rol_id' => $request->rol_id,
                     'apli_id' => $request->apli_id,
                     'route' => $route
            ];
            $info = $request->ip().' '.$user["usua_nick"].' '.$route->apli_nombre;
            Log::channel('userLogs')->info($info);
            #En la base de datos
            return response()->json($msg);
        }
    }
    public function getApplicationId(Request $request){
        if($request->ajax()){
            $application = Admin::getApplicationId($request->selected_apli);
            return response()->json($application);
        }
    }
    public function getRoleId(Request $request){
        if($request->ajax()){
            $application = Admin::getRoleId($request->selected_role);
            return response()->json($application);
        }
    }
    public function getFuncId(Request $request){
        if($request->ajax()){
            $funcionalidad = Admin::getFuncId($request->selected_func);
            return response()->json($funcionalidad);
        }
    }
    public function getFuncAplication(Request $request){
        if($request->ajax()){
            $application = Admin::getFuncAplications($request->selected_aplication);
            return response()->json($application);
        }
    }
    public function deleteAplication(Request $request){
        if($request->ajax()){
            $aplc = Aplicacion::find($request->id);
            $aplc->delete();
            return response()->json();
        }
    }
    public function saveAplication(Request $request){
        if($request->ajax()){
            if($request->id == null){
                $aplc = Aplicacion::orderBy('APLI_ID', 'DESC')->first();
                Aplicacion::create([
                    'APLI_ID' => ($aplc->apli_id)+1,
                    'APLI_NOMBRE' => $request->name_aplication,
                    'APLI_NOMBRE' => $request->name_aplication,
                    'APLI_DESCRIPCION' => $request->desc_aplication,
                    'APLI_URL' => $request->url_aplication,
                    'PORL_ID' => 1,
                    'APLI_REGISTRADOPOR' => 'MAURICIO'
                ]);
            } else {
                $aplc = Aplicacion::find($request->id);
                $aplc->apli_nombre = $request->name_aplication;
                $aplc->apli_descripcion = $request->desc_aplication;
                $aplc->apli_url = $request->url_aplication;
                $aplc->save();
            }
            return response()->json();
        }
    }
    public function deleteRol(Request $request){
        if($request->ajax()){
            $rol = Rol::find($request->id);
            $rol->delete();
            return response()->json();
        }
    }
    public function saveRol(Request $request){
        if($request->ajax()){
            if($request->id == null){
                $rol = Rol::orderBy('ROL_ID', 'DESC')->first();
                $user = Auth::user();
                Rol::create([
                    'ROL_ID' => ($rol->rol_id)+1,
                    'ROL_NOMBRE' => $request->rol_nombre,
                    'ROL_DESCRIPCION' => $request->rol_descripcion,
                    'ROL_TIPO' => $request->rol_tipo,
                    'ROL_ESTADO' => 1,
                    'ROL_REGISTRADOPOR' => $user->usua_id
                ]);
            } else {
                $rol = Rol::find($request->id);
                $rol->rol_nombre = $request->rol_nombre;
                $rol->rol_descripcion = $request->rol_descripcion;
                $rol->rol_tipo = $request->rol_tipo;
                $rol->save();
            }
            return response()->json();
        }
    }
    public function deleteFunction(Request $request){
        if($request->ajax()){
            $func = Funcionalidad::find($request->id);
            $func->delete();
            return response()->json();
        }
    }
    public function saveFunction(Request $request){
        if($request->ajax()){
            if($request->id == null){
                $func = Funcionalidad::orderBy('FUNC_ID', 'DESC')->first();
                $user = Auth::user();
                $func = Funcionalidad::create([
                    'APLI_ID' => $request->apli_id,
                    'FUNC_ID' => ($func->func_id)+1,
                    'FUNC_NOMBRE' => $request->name_function,
                    'FUNC_DESCRIPCION' => $request->desc_funcion,
                    'FUNC_TIPO' => 3,
                    'FUNC_ESTADO' => 1,
                    'FUNC_URLRECURSO' => $request->url_func,
                    'FUNC_REGISTRADOPOR' => $user->usua_id,
                    'FUNC_ORDEN' => $request->order
                ]);
            } else {
                $func = Funcionalidad::find($request->id);
                $func->func_nombre = $request->name_function;
                $func->func_descripcion = $request->desc_funcion;
                $func->func_urlrecurso = $request->url_func;
                $func->func_orden = $request->order;
                $func->save();
            }
            return response()->json();
        }
    }
    public function searchuser(Request $request){
        if($request->ajax()){
            $usuarios = User::searchUser($request->txt_user);
            return response()->json($usuarios);
        }
    }
    public function getRolesUser(Request $request){
        if($request->ajax()){
            $roles = User::getRoleUserAdmin($request->usua_id);
            return response()->json($roles);
        }
    }
    public function deleteRoleUser(Request $request){
        if($request->ajax()){
            $func = Usuariorol::find($request->usua_rol_id);
            $func->delete();
            $roles = User::getRoleUserAdmin($request->usua_id);
            return response()->json($roles);
        }
    }
    public function addRoleUser(Request $request){
        if($request->ajax()){
            $usua_rol = Usuariorol::orderBy('USRO_ID', 'DESC')->first();
            $user = Auth::user();
            $currentTime = Carbon::now();
            $usua_rol = Usuariorol::create([
                'USRO_ID' => ($usua_rol->usro_id)+1,
                'USRO_REGISTRADOPOR' => $user->usua_id,
                'USUA_ID' => $request->usua_id,
                'ROL_ID' => $request->rol_id,
                'USRO_FECHACAMBIO' => $currentTime
            ]);
            $roles = User::getRoleUserAdmin($request->usua_id);
            return response()->json($roles);
        }
    }
    public function searchAplicationsRole(Request $request){
        if($request->ajax()){
            $aplicaciones = Rol::searchAplicationsRole($request->selected_role);
            return response()->json($aplicaciones);
        }
    }
    public function saveRoleAplication(Request $request){
        if($request->ajax()){
            $rol_apli = Rolporletaplicacion::orderBy('RPAP_ID', 'DESC')->first();
            $user = Auth::user();
            $currentTime = Carbon::now();
            $rol_apli = Rolporletaplicacion::create([
                'RPAP_ID' => ($rol_apli->rpap_id)+1,
                'RPAP_REGISTRADOPOR' => $user->usua_id,
                'APLI_ID' => $request->apli_id,
                'ROL_ID' => $request->rol_id,
                'PORL_ID' => 1,
                'RPAP_FECHACAMBIO' => $currentTime
            ]);
            $aplicaciones = Rol::searchAplicationsRole($request->rol_id);
            return response()->json($aplicaciones);
        }
    }
    public function deleteAppRole(Request $request){
        if($request->ajax()){
            $rolapl = Rolporletaplicacion::find($request->rpap_id);
            $rolapl->delete();
            $aplicaciones = Rol::searchAplicationsRole($request->rol_id);
            return response()->json($aplicaciones);
        }
    }
    
    public static function getFuncAplicationRol(Request $request) {
        if($request->ajax()){
            $rol_funcion = Rolaplicacionfuncionalidad::getFuntionRol($request->func_id);
            return response()->json($rol_funcion);
        }
    }
    public function addRoleFunction(Request $request){
        if($request->ajax()){
            
            $user = Auth::user();
            $currentTime = Carbon::now();

            $rol_apl = Rolporletaplicacion::getFunAplicationRole($request->rol_id, $request->apli_id);
            if (empty($rol_apl)){
                $rol_aplID = Rolporletaplicacion::orderBy('RPAP_ID', 'DESC')->first();
                $rol_apl = Rolporletaplicacion::create([
                    'RPAP_ID' => ($rol_aplID->rpap_id)+1,
                    'ROL_ID' => $request->rol_id,
                    'PORL_ID' => 1,
                    'APLI_ID' => $request->apli_id,
                    'RPAP_REGISTRADOPOR' => $user->usua_id,
                    'RPAP_FECHACAMBIO' => $currentTime
                ]);
                $rpap_id = $rol_apl->rpap_id;
            }else{
                $rpap_id = $rol_apl->rpap_id;
            }
            $rol_funcID = Rolaplicacionfuncionalidad::orderBy('RPAF_ID', 'DESC')->first();
            Rolaplicacionfuncionalidad::create([
                'RPAF_ID' => ($rol_funcID->rpaf_id)+1,
                'RPAP_ID' => $rpap_id,
                'FUNC_ID' => $request->func_id,
                'RPAF_REGISTRADOPOR' => $user->usua_id,
                'RPAF_FECHACAMBIO' => $currentTime
            ]);
            $rol_funcion = Rolaplicacionfuncionalidad::getFuntionRol($request->func_id);
            return response()->json($rol_funcion);
        }
    }
    public function deleteRoleFunc(Request $request){
        if($request->ajax()){
            $rolapl = Rolaplicacionfuncionalidad::find($request->rpaf_id);
            $rolapl->delete();
            $rolfunc = Rolporletaplicacion::find($request->rpap_id);
            $rolfunc->delete();

            $rol_funcion = Rolaplicacionfuncionalidad::getFuntionRol($request->func_id);

            return response()->json($rol_funcion);
        }
    }
    
}
