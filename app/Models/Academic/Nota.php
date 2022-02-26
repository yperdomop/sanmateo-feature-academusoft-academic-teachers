<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    public $table = 'ACADEMICO.NOTA';
    protected $primaryKey = 'nota_id';
    public $timestamps = false;
    protected $fillable = [
        'NOTA_ID',
        'NOTA_DESCRIPCION',
        'NOTA_PESO',
        'NOTA_REGISTRADOPOR',
        'NOTA_FECHACAMBIO',
        'EVAC_ID',
        'GRUP_ID',
    ];
}
