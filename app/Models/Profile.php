<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone_number',
        'url_instagram',
        'user_id',
        'url_avatar'
    ];
    //Indicar que le pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
