<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use DB;

class Usuariorol extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'VORTAL.USUARIOROL';
    protected $primaryKey = 'usro_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'USRO_ID',
        'ROL_ID',
        'USUA_ID',
        'USRO_FECHACAMBIO',
        'USRO_REGISTRADOPOR'
    ];
}
