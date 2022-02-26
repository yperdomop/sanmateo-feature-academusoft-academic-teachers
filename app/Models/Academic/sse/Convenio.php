<?php

namespace App\Models\academic\sse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    protected $connection = 'oracle';
    protected $table = 'SSE.CONVENIO';
    public $timestamps = false;

    protected $primaryKey = 'CON_ID';

    protected $fillable = [
        'CON_ID',
        'CON_NOMBRE',
        'CON_ESTADO',
    ];
}
