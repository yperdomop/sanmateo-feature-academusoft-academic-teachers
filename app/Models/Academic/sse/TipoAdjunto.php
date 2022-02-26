<?php

namespace App\Models\academic\sse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAdjunto extends Model
{
    protected $connection = 'oracle';
    protected $table = 'SSE.TIPO_ADJUNTO';
    public $timestamps = false;

    protected $primaryKey = 'TI_ID';

    protected $fillable = [
        'TI_ID',
        'TI_NOMBRE'
    ];
}
