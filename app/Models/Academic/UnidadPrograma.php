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

    //uno a muchos inverso
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'prog_id', 'prog_id');

    }
    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unid_id', 'unid_id');

    }

    //muchos a muchos
    public function cubrimientos()
    {
        return $this->belongsToMany(TipoCubrimientosNies::class, 'academico.cubrimientoprograma', 'unpr_id', 'tcsn_id')->withPivot('meto_id');
    }
}
