<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use DB;
class Rolporletaplicacion extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'VORTAL.ROLPORLETAPLICACION';
    protected $primaryKey = 'rpap_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RPAP_ID',
        'ROL_ID',
        'PORL_ID',
        'APLI_ID',
        'RPAP_FECHACAMBIO',
        'RPAP_REGISTRADOPOR'
    ];

    public static function getFunAplicationRole($rol_id, $apli_id) {
        $role = DB::table('vortal.rolporletaplicacion rpla')
                    ->select('rpla.rpap_id')
                    ->where('rpla.apli_id', '=', $apli_id)
                    ->where('rpla.rol_id', '=', $rol_id)
                    ->get()->first();
        return $role;
    }
    
}
