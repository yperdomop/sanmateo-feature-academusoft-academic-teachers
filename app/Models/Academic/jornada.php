<?php

namespace App\Models\academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jornada extends Model
{
    public $table = 'academico.jornada';
        protected $primaryKey = 'jorn_id';
        public $timestamps = false;
        protected $fillable=[

            'jorn_descripcion',
            'jorn_registradopor',
            'jorn_fechacambio',
            'jorn_horainicio',
            'jorn_horafin',
            'jorn_jornadaesnies',
            'jorn_findesemana', 

        ];
        public function tipoJornada() {
            return $this->hasMany(Programa::class, 'jorn_id', 'jorn_id');
        }
}
