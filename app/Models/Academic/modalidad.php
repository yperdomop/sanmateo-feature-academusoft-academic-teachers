<?php

namespace App\Models\academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modalidad extends Model
{
    public $table = 'academico.modalidad';
    protected $primaryKey = 'moda_id';
    public $timestamps = false;
    protected $fillable=[
        'moda_descripcion',
        'nied_id',
        'moda_fechacambio',
        'moda_puntos',
        'moda_registradopor',
        'moda_codigo',
    ];

    public function tipoModalidad() {
        return $this->hasMany(Programa::class, 'moda_id', 'moda_id');
    }

}
