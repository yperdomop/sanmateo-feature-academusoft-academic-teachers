<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadPrograma extends Model
{
    public $table = 'academico.unidadPrograma';
    protected $primaryKey = 'unpr_id';
    public $timestamps = false;
    protected $fillable = [
        'unid_id',
        'unpr_relacion',
        'unpr_fechacambio',
        'prog_id',
        'unpr_cupominimo',
        'unpr_cupomaximo',
        'unpr_numeroopcionados',
        'unpr_registradopor',
        'unpr_esfacultad',
    ];
}
