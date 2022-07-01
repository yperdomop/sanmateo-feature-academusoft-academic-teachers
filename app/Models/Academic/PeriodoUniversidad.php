<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodoUniversidad extends Model
{
    public $table = 'academico.periodouniversidad';
    protected $primaryKey = 'peun_id';
    public $timestamps = false;
    protected $dates = [
        'peun_fechainicio',
        'peun_fechafin',
        'peun_fechainicioclases',
        'peun_fechafinclases',
    ];
    protected $fillable = [
        'peun_fechainicio',
        'peun_fechafin',
        'peun_ano',
        'peun_periodo',
        'tppa_id',
        'peun_registradopor',
        'peun_fechacambio',
        'peun_fechainicioclases',
        'peun_fechafinclases',
        'peun_codigoperiodo'
    ];

     //uno a muchos inverso
     public function tipoPeriodoAcademico()
     {
         return $this->belongsTo(TipoPeriodoAcademico::class, 'tppa_id', 'tppa_id');
     }
}
