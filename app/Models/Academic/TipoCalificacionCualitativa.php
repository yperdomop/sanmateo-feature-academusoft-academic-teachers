<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Model;

class TipoCalificacionCualitativa extends Model
{
    const CREATED_AT = 'TICL_FECHACAMBIO';
    const UPDATED_AT = 'TICL_FECHACAMBIO';

    public $table = 'ACADEMICO.TIPOCALIFICACIONCUALITATIVA';
    protected $primaryKey = 'ticl_id';
    protected $attributes = [
        'TICL_ID',
        'TICL_DESCRIPCION',
        'TICL_REGISTRADOPOR',
        'TICL_FECHACAMBIO',
        'TICL_NOMENCLATURA',
        'TICA_ID',
        'TICL_VALORNUMERICO',
        'TICL_VALORMINIMO',
        'TICL_VALORMAXIMO'
    ];
}
