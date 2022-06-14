<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CiudadGeneral extends Model
{
    public $table = 'general.ciudadgeneral';
    protected $primaryKey = 'cige_id';
    public $timestamps = false;
    protected $fillable = [
        'dege_id',
        'cige_nombre',
        'cige_registradopor',
        'cige_fechacambio'
    ];
}
