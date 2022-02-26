<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use DB;
class Funcionalidad extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'VORTAL.FUNCIONALIDAD';
    protected $primaryKey = 'func_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'FUNC_ID',
        'APLI_ID',
        'FUNC_NOMBRE',
        'FUNC_DESCRIPCION',
        'FUNC_URLRECURSO',
        'FUNC_ORDEN',
        'FUNC_FECHACAMBIO',
        'FUNC_REGISTRADOPOR',
        'FUNC_TIPO',
        'FUNC_ESTADO'
    ];
}
