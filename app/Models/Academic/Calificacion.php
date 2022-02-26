<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    public $table = 'ACADEMICO.CALIFICACION';
    protected $primaryKey = 'calf_id';
    public $timestamps = false;
    protected $fillable = [
        'CALF_ID',
        'CALF_ESTADO',
        'CALF_FECHAFUERA',
        'NOTA_ID',
        'GRMA_ID',
        'TICL_ID',
        'NORG_ID',
        'CALF_REGISTRADOPOR',
        'CALF_FECHACAMBIO',
        'CALF_JUSTIFICACION',
        'CALF_SUPLETORIO',
        'CALF_VALOR',
        'CALF_IDVIEJO',
    ];
}
