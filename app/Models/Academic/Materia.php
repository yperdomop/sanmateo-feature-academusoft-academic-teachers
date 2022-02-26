<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    public $table = 'ACADEMICO.MATERIA';
    protected $primaryKey = 'mate_codigomateria';
    public $timestamps = false;
    protected $fillable = [
        'MATE_CODIGOMATERIA',
        'MATE_NOMBRE',
        'MATE_CAPACIDAD',
        'MATE_REGISTRADOPOR',
        'MATE_FECHACAMBIO',
        'UNID_ID',
        'MATE_PONDERACIONACADEMICA',
        'MATE_HABILITABLE',
        'TICA_ID',
        'NATU_ID',
        'MATE_ESOPCIONAL',
        'MATE_HOMOLOGABLE',
        'MATE_VALIDABLE',
        'TIPA_ID',
        'MATE_BLOQUEHORASTEORICAS',
        'MATE_BLOQUEHORASPRACTICAS',
        'MATE_CODIGOORIGINAL',
        'MATE_CUENTAPROMEDIO',
        'MATE_HORASINDEPENDIENTES',
        'MATE_HORASASESORIA',
        'ARMA_ID',
        'MATE_TIPO',
        'MATE_PROYECTODEGRADO',
        'MATE_DURACION',
        'MATE_ESEXTENSION',
        'MATE_ESEXTRACREDITO',
        'MATE_HORASTEORICAS',
        'MATE_HORASTEORICOPRACTICAS',
        'MATE_HORASPRACTICAS',
    ];

    public function grupos() {
        return $this->hasMany(Grupo::class, 'mate_codigomateria', 'mate_codigomateria');
    }
}
