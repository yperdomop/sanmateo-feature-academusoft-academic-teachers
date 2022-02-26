<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NormaGeneral extends Model
{
    public $table = 'GENERAL.NORMAGENERAL';
    protected $primaryKey = 'NORG_ID';
    public $timestamps = false;
    protected $fillable = [
        'NORG_ID',
        'NORG_NUMERO',
        'NORG_DESCRIPCION',
        'NORG_FECHAEXPEDICION',
        'NORG_FECHAINICIOVIGENCIA',
        'NORG_FECHAFINVIGENCIA',
        'ENEG_ID',
        'NORG_ARCHIVO',
        'NORG_VIGENTE',
        'TING_ID',
        'NORG_REGISTRADORPOR',
        'NORG_FECHACAMBIO',
        'NORG_RESTRINGIDO',
        'NORG_RESPONSABLE',
    ];
}
