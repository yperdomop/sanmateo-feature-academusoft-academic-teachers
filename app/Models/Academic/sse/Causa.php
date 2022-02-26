<?php

namespace App\Models\academic\sse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Causa extends Model
{
    protected $connection = 'oracle';
    protected $table = 'SSE.CAUSA';
    public $timestamps = false;

    protected $primaryKey = 'CAU_ID';

    protected $fillable = [
        'CAU_ID',
        'CAU_NOMBRE'
    ];
}
