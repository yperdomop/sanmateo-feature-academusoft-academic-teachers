<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use DB;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'GENERAL.USUARIO';
    protected $primaryKey = 'usua_id';
    public $timestamps = false;
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'USUA_ID',
        'PASSWORD',
        'USUA_FECHACAMBIO',
        'USUA_REGISTRADOPOR',
        'PEGE_ID',
        'USUA_DOCUMENTO',
        'usua_nombre',
        'USUA_USUARIO',
        'USUA_CONTRASENA',
        'USUA_TIPO',
        'USUA_PREGUNTASECRETA',
        'USUA_RESPUESTAPREGUNTA',
        'USUA_ESTADO',
        'USUA_IDVORTAL',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'PASSWORD',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function getRoleUser() {
        $role = DB::table('general.usuario usu')
                    ->join('vortal.usuariorol uro', 'uro.usua_id', '=', 'usu.usua_id')
                    ->join('vortal.rol rol', 'rol.rol_id', '=', 'uro.rol_id')
                    ->where('usu.usua_id', '=', Auth::user()->usua_id)
                    ->select('uro.rol_id', 'uro.usua_id', 'rol.rol_nombre')
                    ->get();
        return $role;
    }
    public static function getRoleUserAdmin($user_id) {
        $role = DB::table('general.usuario usu')
                    ->join('vortal.usuariorol uro', 'uro.usua_id', '=', 'usu.usua_id')
                    ->join('vortal.rol rol', 'rol.rol_id', '=', 'uro.rol_id')
                    ->where('usu.usua_id', '=', $user_id)
                    ->select('uro.rol_id', 'uro.usua_id', 'rol.rol_nombre', 'uro.usro_id')
                    ->get();
        return $role;
    }
    public static function getApplicationUser($rol_id) {
        $applic = DB::table('vortal.aplicacion apl')
                    ->join('vortal.rolporletaplicacion rol_apli', 'rol_apli.apli_id', '=', 'apl.apli_id')
                    ->where('rol_apli.rol_id', '=', $rol_id)
                    ->select('apl.apli_nombre', 'apl.apli_id')
                    ->get();
        return $applic;
    }
    public static function getApplicationUserId($usua_id, $apli_id) {
        $applic = DB::table('vortal.aplicacion apl')
                    ->join('vortal.rolporletaplicacion rol_apli', 'rol_apli.apli_id', '=', 'apl.apli_id')
                    ->join('vortal.usuariorol usu_rol', 'usu_rol.rol_id', '=', 'rol_apli.rol_id')
                    ->where('usu_rol.usua_id', '=', $usua_id)
                    ->where('apl.apli_id', '=', $apli_id)
                    ->select('apl.apli_id', 'apl.apli_nombre', 'apl.apli_url')
                    ->groupBy('apl.apli_id', 'apl.apli_nombre', 'apl.apli_url')
                    ->get();
        return $applic;
    }
    public static function getFunctionsUserId($usua_id, $func_id) {
        $applic = DB::table('vortal.funcionalidad func')
                    ->join('vortal.rolaplicacionfuncionalidad raf', 'raf.func_id', '=', 'func.func_id')
                    ->join('vortal.rolporletaplicacion rpa', 'rpa.rpap_id', '=', 'raf.rpap_id')
                    ->join('vortal.usuariorol usu_rol', 'usu_rol.rol_id', '=', 'rpa.rol_id')
                    ->where('usu_rol.usua_id', '=', $usua_id)
                    ->where('func.func_id', '=', $func_id)
                    ->where('FUNC_NOMBRE', '!=', '0')
                    ->select('func.func_id', 'func.func_nombre', 'func.func_urlrecurso')
                    ->groupBy('func.func_id', 'func.func_nombre', 'func.func_urlrecurso')
                    ->orderBy('func.func_id', 'asc')
                    ->get();
        return $applic;
    }
    public static function getFunctionsUserApliId($usua_id, $apli_id) {
        $applic = DB::table('vortal.funcionalidad func')
                    ->join('vortal.rolaplicacionfuncionalidad raf', 'raf.func_id', '=', 'func.func_id')
                    ->join('vortal.rolporletaplicacion rpa', 'rpa.rpap_id', '=', 'raf.rpap_id')
                    ->join('vortal.usuariorol usu_rol', 'usu_rol.rol_id', '=', 'rpa.rol_id')
                    ->where('usu_rol.usua_id', '=', $usua_id)
                    ->where('rpa.apli_id', '=', $apli_id)
                    ->where('FUNC_NOMBRE', '!=', '0')
                    ->select('func.func_id', 'func.func_nombre', 'func.func_urlrecurso')
                    ->groupBy('func.func_id', 'func.func_nombre', 'func.func_urlrecurso')
                    ->orderBy('func.func_id', 'asc')
                    ->get();
        return $applic;
    }
    public static function getRouteAplication($apli_id) {
        $applic = DB::table('vortal.aplicacion apl')
                    ->where('apl.apli_id', '=', $apli_id)
                    ->select('apl.apli_id', 'apl.apli_url', 'apl.apli_nombre')
                    ->get()->first();
        return $applic;
    }
    public static function searchUser($txt_user) {
        $usuarios = DB::table('general.usuario usu')
                    ->where('usu.usua_nombre', 'like', "%{$txt_user}%")
                    ->orWhere('usu.usua_usuario', 'like', "%{$txt_user}%")
                    ->orWhere('usu.usua_documento', 'like', "%{$txt_user}%")
                    ->select('usu.usua_nombre', 'usu.usua_documento', 'usu.usua_id', 'usu.usua_usuario')
                    ->limit(3)
                    ->get();
        return $usuarios;
    }
    public static function getRoleUserID($usro_id) {
        $role = DB::table('general.usuario usu')
                    ->join('vortal.usuariorol uro', 'uro.usua_id', '=', 'usu.usua_id')
                    ->join('vortal.rol rol', 'rol.rol_id', '=', 'uro.rol_id')
                    ->where('uro.usro_id', '=', $usro_id)
                    ->select('uro.rol_id', 'uro.usua_id', 'rol.rol_nombre', 'uro.usro_id')
                    ->get()->first();
        return $role;
    }
}
