<?php

namespace App\Models\academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metodologia extends Model
{

        public $table = 'academico.metodologia';
        protected $primaryKey = 'meto_id';
        public $timestamps = false;
        protected $fillable=[

            'meto_descripcion',
            'meto_fechacambio',
            'meto_registradopor',
            'meto_activo',

        ];
        //uno a muchos
        public function programa() {
            return $this->hasMany(Programa::class, 'meto_id', 'meto_id');
        }
}
