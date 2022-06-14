<?php

namespace App\Models\academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CubrimientoPrograma extends Pivot
{
    public $table = 'academico.cubrimientoprograma';
    public $timestamps = false;
    protected $fillable = [

    'unpr_id',
    'tcsn_id',
    'meto_id',

    ];
}
