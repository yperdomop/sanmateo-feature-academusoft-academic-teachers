<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use DB; 

class PersonaGeneral extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'GENERAL.PERSONAGENERAL';
    protected $primaryKey = 'pege_id';
    public $timestamps = false;
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'PEGE_ID',
        'PEGE_MAIL',
    ];

    public static function getPegeEmail($email) {
        $pege = DB::table('general.personageneral usu')
                    ->where('usu.pege_mail', '=', $email)
                    ->select('usu.pege_id', 'usu.pege_mail')
                    ->get()->first();
        return $pege;
    }
}
