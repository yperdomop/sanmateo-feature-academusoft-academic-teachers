<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\General\CiudadGeneral;

class Unidad extends Model
{
    public $table = 'academico.unidad';
    protected $primaryKey = 'unid_id';
    public $timestamps = false;
    protected $fillable = [
        'unid_id',
        'unid_nombre',
        'unid_registradopor',
        'unid_fechacambio',
        'tiun_id',
        'unid_codigo',
        'unid_telefono',
        'unid_email',
        'unid_exttelefono',
        'unid_ubicacion',
        'unid_nivel',
        'cige_id',
        'unid_asociaprogramadirecta',
        'unid_asociamateriadirecta',
        'unid_regional',
    ];

    //uno a muchos
    public function unidadPrograma()
    {
        return $this->hasMany(UnidadPrograma::class, 'unid_id', 'unid_id');
    }
    //uno a muchos inverso
    public function ciudad()
    {
        return $this->belongsTo(CiudadGeneral::class, 'cige_id', 'cige_id');
    }
}
