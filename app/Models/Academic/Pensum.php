<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pensum extends Model
{
    public $table = 'academico.pensum';
    protected $primaryKey = 'pens_id';
    public $timestamps = false;

    protected $fillable = [
        'pens_registradopor',
        'pens_fechacambio',
        'pens_descripcion',
        'tipa_id',
        'pens_anoinicio',
        'pens_periodoinicio',
        'prog_id',
        'espe_id',
        'norg_id',
        'pens_totalcreditos',
        'tppa_id',
        'pens_numperiodos',
        'pens_redondeopromedio3',
        'pens_tipopromedio',
        'pens_redondeodefinitiva3',
        'pens_redondeopromedio',
        'pens_redondeodefinitiva',
        'pens_ponminmatnor',
        'pens_ponminmatele',
        'pens_fecharecibeestudiantes'
    ];

    //uno a muchos inverso
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'prog_id', 'prog_id');
    }
    public function estado()
    {
        return $this->belongsTo(Estadopensum::class, 'espe_id', 'espe_id');
    }
}
