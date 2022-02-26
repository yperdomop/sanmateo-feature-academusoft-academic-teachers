<?php

namespace App\Models\academic\sse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $connection = 'oracle';
    protected $table = 'SSE.FORMULARIO';
    public $timestamps = false;

    protected $primaryKey = 'FOIN_ID';

    protected $fillable = [
        "FOIN_ID",
        "TF_ID",
        "FOR_NUMERO",
        "FOR_REGISTRADOPOR",
        "FOR_FECHACAMBIO",
    ];
}
