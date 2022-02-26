<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Model;

class GrupoMatriculado extends Model
{
    public $table = 'ACADEMICO.GRUPOMATRICULADO';
    protected $primaryKey = 'grma_id';
    public $timestamps = false;
    protected $fillable = [
        'GRUP_ID',
        'GRMA_NUMEROFALLAS2',
        'GRMA_ESTADO',
        'GRMA_REGISTRADOPOR',
        'GRMA_FECHACAMBIO',
        'MAAC_ID',
        'GRMA_ID',
        'GRMA_APROBADO',
        'MATE_CODIGOMATERIAREAL',
        'PENS_IDEQUIVALENTE',
        'GRMA_BANCOMATERIA',
        'EQPM_ID',
        'GRMA_PERDIDAFALLAS',
        'GRMA_DEFINITIVA',
        'GRMA_HABILITACION',
        'GRMA_FINAL',
        'GRMA_HABILITACIONNCL_ID',
        'GRMA_FINALNCL_ID',
        'GRMA_DEFINITIVANCL_ID',
        'GRMA_FECHAREGISTRO',
        'GRMA_NUMEROFALLAS',
        'GRMA_DESEMPENO',
        'MAAC_ID_VIEJO',
    ];

}
