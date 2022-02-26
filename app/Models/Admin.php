<?php

namespace App\Models;

use DB;
class Admin
{
    public static function getAplications() {
        $role = DB::table('vortal.aplicacion apl')
                    ->select('apl.apli_id', 'apl.apli_nombre', 'apl.apli_descripcion', 'apl.apli_url')
                    ->get();
        return $role;
    }
    public static function getRoles() {
        $role = DB::table('vortal.rol vrol')
                    ->select('vrol.rol_id', 'vrol.rol_nombre', 'vrol.rol_descripcion', 'vrol.rol_tipo')
                    ->get();
        return $role;
    }
    public static function getApplicationId($apli_id) {
        $role = DB::table('vortal.aplicacion apl')
                    ->select('apl.apli_id', 'apl.apli_nombre', 'apl.apli_descripcion', 'apl.apli_url')
                    ->where('apl.apli_id', '=', $apli_id)
                    ->get()->first();
        return $role;
    }
    public static function getRoleId($role_id) {
        $role = DB::table('vortal.rol vrol')
                    ->select('vrol.rol_id', 'vrol.rol_nombre', 'vrol.rol_descripcion', 'vrol.rol_tipo')
                    ->where('vrol.rol_id', '=', $role_id)
                    ->get()->first();
        return $role;
    }
    public static function getFuncId($func_id) {
        $role = DB::table('vortal.funcionalidad func')
                    ->select('func.func_id', 'func.func_nombre', 'func.func_descripcion', 'func.func_orden', 'func.func_urlrecurso')
                    ->where('func.func_id', '=', $func_id)
                    ->get()->first();
        return $role;
    }
    
    public static function getFuncAplications($apli_id) {
        $role = DB::table('vortal.funcionalidad func')
                    ->select('func.func_id', 'func.func_nombre', 'func.func_descripcion', 'func.func_orden', 'func.func_urlrecurso')
                    ->orderBy('func.func_orden', 'asc')
                    ->where('func.apli_id', '=', $apli_id)
                    ->get();
        return $role;
    }
}
