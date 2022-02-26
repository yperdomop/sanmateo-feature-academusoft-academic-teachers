<?php

namespace App\Models\academic\sse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasoEstudianteDependencia extends Model
{
    protected $connection = 'oracle';
    protected $table = 'SSE.CASO_ESTUDIANTE_DEPENDENCIA';
    public $timestamps = false;

    protected $primaryKey = 'CED_ID';

    protected $fillable = [
        'CED_ID',
        'CE_ID',
        'CED_FECHA',
        'UNID_ID',
        'PEGE_ID',
        'CED_NO_ATENDIDO',
        'FOAT_ID',
        'CED_RESPUESTA',
        'CED_DIRECCIONADO_A',
        'CED_REGISTRADO_POR',
        'CED_FECHA_CAMBIO'
    ];
}
