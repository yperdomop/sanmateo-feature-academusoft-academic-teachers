<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use DB;
class Rolaplicacionfuncionalidad extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'VORTAL.ROLAPLICACIONFUNCIONALIDAD';
    protected $primaryKey = 'rpaf_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RPAF_ID',
        'RPAP_ID',
        'FUNC_ID',
        'RPAF_FECHACAMBIO',
        'RPAF_REGISTRADOPOR'
    ];
    public static function getFuntionRol($func_id) {
        $usuarios = DB::table('vortal.rolaplicacionfuncionalidad ralp')
                    ->where('ralp.func_id', '=', $func_id)
                    ->join('vortal.rolporletaplicacion rot', 'rot.rpap_id', '=', 'ralp.rpap_id')
                    ->join('vortal.rol rolc', 'rolc.rol_id', '=', 'rot.rol_id')
                    ->select('ralp.rpaf_id', 'rot.rpap_id', 'rolc.rol_nombre')
                    ->get();
        return $usuarios;
    }
}
