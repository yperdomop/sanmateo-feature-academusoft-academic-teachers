<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PasswordResets extends Model
{

    public $table = 'GENERAL.PASSWORD_RESETS';
    protected $fillable = ['email'];
    protected $attributes = [
        'EMAIL',
        'TOKEN',
        'CREATED_AT'
    ];
}