<?php

namespace App\Models\academic\sse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoFormulario extends Model
{
    protected $connection = 'oracle';
    protected $table = 'SSE.TIPO_FORMULARIO';
    public $timestamps = false;

    protected $primaryKey = 'TF_ID';

    protected $fillable = [
        'TF_ID',
        'TF_NOMBRE',
        'TF_ESTADO',
    ];
}
