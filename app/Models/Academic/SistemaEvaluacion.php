<?php

namespace App\Models\Academic;

use App\Models\General\NormaGeneral;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SistemaEvaluacion extends Model
{
    public $table = 'ACADEMICO.SISTEMAEVALUACION';
    protected $primaryKey = 'siev_id';
    public $timestamps = false;
    protected $fillable = [
        'SIEV_ID',
        'SIEV_DESCRIPCION',
        'SIEV_REGISTRADOPOR',
        'SIEV_FECHACAMBIO',
        'NORG_ID',
        'SIEV_PESODEFINITIVA',
        'SIEV_PESOHABILITACION',
        'SIEV_PARHABAPR',
        'SIEV_PARHABNAPR'
    ];

    public function evaluacionAcademico() {
        return $this->hasMany(EvaluacionAcademico::class, 'siev_id', 'siev_id');
    }

    public function normaGeneral() {
        return $this->hasOne(NormaGeneral::class, 'norg_id', 'norg_id');
    }
}
