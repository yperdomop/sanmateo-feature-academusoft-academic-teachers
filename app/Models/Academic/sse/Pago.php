<?php

namespace App\Models\academic\sse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $connection = 'oracle';
    protected $table = 'SSE.PAGO';
    public $timestamps = false;

    protected $primaryKey = 'PA_ID';

    protected $fillable = [
        'PA_ID',
        'PA_NOMBRE',
    ];
}
