<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    public $table = 'ACADEMICO.GRUPO';
    protected $primaryKey = 'grup_id';
    public $timestamps = false;
    protected $fillable = [
        "GRUP_NOMBRE",
        "GRUP_CAPACIDAD",
        "mate_codigomateria",
        "TIGR_ID",
        "GRUP_REGISTRADOPOR",
        "GRUP_FECHACAMBIO",
        "UNID_IDREGIONAL",
        "GRUP_FECHAINICIAL",
        "GRUP_FECHAFINAL",
        "siev_id",
        "GRUP_ACTIVO",
        "GRUP_HORARIOXDIA",
        "GRUP_CUPOS",
        "SUBM_ID",
        "GRUP_HISTORICO",
        "GRUP_CUPOMINIMO",
        "PEUN_ID",
        "GRUP_IDPADRE",
    ];
}
