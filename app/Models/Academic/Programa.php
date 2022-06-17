<?php

namespace App\Models\Academic;

use App\Models\academic\TipoCubrimientosNies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Programa extends Model
{
    public $table = 'academico.programa';
    protected $primaryKey = 'prog_id';
    public $timestamps = false;
    protected $dates = [
        'prog_fechaaprobacionicfes'
    ];
    protected $fillable = [
        'prog_codigoicfes',
        'prog_numperiodos',
        'prog_registradopor',
        'prog_fechacambio',
        'moda_id',
        'meto_id',
        'prog_complejidad',
        'prog_titulootorga',
        'prog_tieneconvenio',
        'jorn_id',
        'tppa_id',
        'prog_fechaaprobacionicfes',
        'prog_estado',
        'prog_codigoprograma',
        'prog_nombre',
        'prom_id',
        'prog_tipoprograma',
        'prog_abreviatura',
    ];

    //funcion join
    public function unidadPrograma($prog_id)
    {
        return $this->select('academico.unidadprograma.unpr_id', 'unid_nombre', 'unpr_esfacultad', 'unpr_relacion', 'cige_nombre', 'tcsn_descripcion')
            ->join('academico.unidadprograma', 'academico.programa.prog_id', '=', 'academico.unidadprograma.prog_id')
            ->leftjoin('academico.cubrimientoprograma', 'academico.unidadprograma.unpr_id', '=', 'academico.cubrimientoprograma.unpr_id')
            ->leftjoin('academico.tipocubrimientosnies', 'academico.tipocubrimientosnies.tcsn_id', '=', 'academico.cubrimientoprograma.tcsn_id')
            ->join('academico.unidad', 'academico.unidadprograma.unid_id', '=', 'academico.unidad.unid_id')
            ->join('general.ciudadgeneral', 'academico.unidad.cige_id', '=', 'general.ciudadgeneral.cige_id')
            ->where('academico.programa.prog_id', '=', $prog_id)->get()->toArray();
    }

    //uno a muchos
    public function unidadPrograma1()
    {
        return $this->hasMany(UnidadPrograma::class, 'prog_id', 'prog_id');
    }

    //uno a muchos inverso
    public function metodologia()
    {
        return $this->belongsTo(Metodologia::class, 'meto_id', 'meto_id');
    }
    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class, 'moda_id', 'moda_id');
    }
    public function jornada()
    {
        return $this->belongsTo(Jornada::class, 'jorn_id', 'jorn_id');
    }
    public function tipoPeriodoAcademico()
    {
        return $this->belongsTo(TipoPeriodoAcademico::class, 'tppa_id', 'tppa_id');
    }
}
