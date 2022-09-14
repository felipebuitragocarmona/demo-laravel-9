<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    /*
    Ingresar el nombre de cada uno
    de los atributos que componen
    el modelo
    */
    protected $fillable = [
        'url',
        'method'
    ];
    //Relación n a n
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
