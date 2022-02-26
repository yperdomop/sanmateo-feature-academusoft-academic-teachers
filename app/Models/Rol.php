<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use DB;
class Rol extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'VORTAL.ROL';
    protected $primaryKey = 'rol_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ROL_ID',
        'ROL_NOMBRE',
        'ROL_DESCRIPCION',
        'ROL_TIPO',
        'ROL_ESTADO',
        'ROL_REGISTRADOPOR'
    ];

    public static function searchAplicationsRole($role_id) {
        $usuarios = DB::table('vortal.rolporletaplicacion rolet')
                    ->where('rolet.rol_id', '=', $role_id)
                    ->join('vortal.aplicacion apl', 'apl.apli_id', '=', 'rolet.apli_id')
                    ->select('rolet.apli_id', 'rolet.rpap_id', 'apl.apli_nombre')
                    ->get();
        return $usuarios;
    }
}
