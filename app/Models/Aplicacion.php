<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use DB;
class Aplicacion extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'VORTAL.APLICACION';
    protected $primaryKey = 'apli_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'PORL_ID',
        'APLI_ID',
        'APLI_NOMBRE',
        'APLI_DESCRIPCION',
        'APLI_URL',
        'APLI_REGISTRADOPOR'
    ];
}
