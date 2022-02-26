<?php

namespace App\Models\academic\sse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoEstudiante extends Model
{
    protected $connection = 'oracle';
    protected $table = 'SSE.PAGO_ESTUDIANTE';
    public $timestamps = false;

    protected $primaryKey = 'FOIN_ID';

    protected $fillable = [
        'FOIN_ID',
        'PA_ID',
        'CON_ID',
        'PE_VALOR',
        'PE_REGISTRADOPOR',
        'PE_FECHACAMBIO',
        'PA_DESCUENTO',
        'SI_ID',
        'PE_DESCUENTOPRIMERCUOTA',
    ];
}
