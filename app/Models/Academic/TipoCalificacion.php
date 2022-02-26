<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Model;

class TipoCalificacion extends Model
{

    public $table = 'ACADEMICO.TIPOCALIFICACION';
    protected $primaryKey = 'tica_id';
    public $timestamps = false;

    protected $fillable = [
        'TICA_ID',
        'TICA_DESCRIPCION',
        'TICA_REGISTRADOPOR',
        'TICA_FECHACAMBIO',
        'TICA_TIPO',
        'TICA_NOTAMINIMA',
        'TICA_NOTAMINHABILITACION',
        'TICA_NOTAAPRUEBAHABILITACION',
        'TICA_NOTAAPROBATORIA',
        'TICA_NOTAMAXIMA'
    ];

    public function TipoCalificacionCualitativa() {
        return $this->hasMany(TipoCalificacionCualitativa::class, 'tica_id', 'tica_id');
    }
}
