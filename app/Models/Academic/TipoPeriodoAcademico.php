<?php

namespace App\Models\academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPeriodoAcademico extends Model
{
    public $table = 'academico.tipoPeriodoAcademico';
    protected $primaryKey = 'TPPA_ID';
    public $timestamps = false;
    protected $fillable =
    [

        'tppa_descripcion',
        'tppa_registradopor',
        'tppa_fechacambio',
        'tppa_duracionsemanas',

    ];
    public function Programa()
    {
        return $this->hasMany(Programa::class, 'tppa_id', 'tppa_id');
    }
}
