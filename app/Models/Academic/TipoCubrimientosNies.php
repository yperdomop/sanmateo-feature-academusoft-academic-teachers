<?php

namespace App\Models\academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCubrimientosNies extends Model
{
    
        public $table = 'academico.tipocubrimientosnies';
        public $primaryKey = 'tcsn_id';
        public $timestamps = false;
        protected $fillable = [
    
            'tcsn_id',
            'tcsn_descripcion',
    
        ];
}
