<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadopensum extends Model
{
    public $table = 'academico.estadopensum';
    protected $primaryKey = 'espe_id';
    public $timestamps = false;

    protected $fillable = [
        'espe_id',
        'espe_descripcion',
        'espe_registradopor',
        'espe_fechacambio'
    ];

    public function pensums()
    {
        return $this->hasMany(Pensum::class, 'espe_id', 'espe_id');
    }
}
