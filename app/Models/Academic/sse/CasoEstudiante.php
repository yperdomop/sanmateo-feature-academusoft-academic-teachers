<?php

namespace App\Models\academic\sse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasoEstudiante extends Model
{
    protected $connection = 'oracle';
    protected $table = 'SSE.CASO_ESTUDIANTE';
    public $timestamps = false;

    protected $primaryKey = 'CE_ID';

    protected $fillable = [
        'CE_ID',
        'CASO_ID',
        'ESTP_ID',
        'CE_ESTADO',
        'CE_FECHA_IN',
        'CE_FECHA_FIN',
        'CE_FECHA_CAMBIO',
        'CE_REGISTRADO_POR',
        'CE_FECHA_MAX',
        'CED_TIPO_REQUERIMIENTO',
    ];
}
