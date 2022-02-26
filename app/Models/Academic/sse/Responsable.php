<?php

namespace App\Models\academic\sse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $connection = 'oracle';
    protected $table = 'SSE.RESPONSABLE';
    public $timestamps = false;

    protected $primaryKey = 'FOIN_ID';

    protected $fillable = [
        "FOIN_ID",
        "PEGE_ID",
        "RE_REGISTRADOPOR",
        "RE_FECHACAMBIO",
    ];
}
