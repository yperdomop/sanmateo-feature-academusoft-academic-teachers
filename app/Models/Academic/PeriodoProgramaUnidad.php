<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodoProgramaUnidad extends Model
{
    public $table = 'academico.periodoprogramaunidad';
    protected $primaryKey = 'pepu_id';
    public $timestamps = false;
    protected $dates = [
        'pepu_fechainicio',
        'pepu_fechafin',
        'pepu_fechainicioclases',
        'pepu_fechafinclases',
    ];
    protected $fillable = [
        'unpr_id',
        'pepu_fechainicio',
        'pepu_fechafin',
        'pepu_estado',
        'pepu_fechainicioclases',
        'pepu_fechafinclases',
        'pepu_registradopor',
        'pepu_fechacambio',
        'peun_id',
        'unid_id'
    ];

    public function unidadPrograma()
    {
        return $this->belongsTo(UnidadPrograma::class, 'unpr_id', 'unpr_id');
    }
}
