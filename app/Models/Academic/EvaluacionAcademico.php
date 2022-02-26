<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionAcademico extends Model
{
    public $table = 'ACADEMICO.EVALUACIONACADEMICO';
    protected $primaryKey = 'evac_id';
    public $timestamps = false;
    protected $fillable = [
        'EVAC_ID',
        'EVAC_DESCRIPCION',
        'EVAC_PESO',
        'EVAC_OPCIONAL',
        'SIEV_ID',
        'EVAC_REGISTRADOPOR',
        'EVAC_FECHACAMBIO',
        'EVAC_NOTAMINIMAHABILITACION',
        'EVAC_ORDEN',
        'EVAC_ALCANCE',
        'EVAC_TIPO',
        'EVAC_ESFINAL',
    ];
}
