<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // La info que se llena en la base de datos
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user() 
    {
        // un posts pertenece a un usuario
        return $this->belongsTo(User::class)->select(['name', 'username']); // solo los campos que necesito traer
        
    }

    public function comentarios()
    {
        // un posts va a tener multiples comentarios
        return $this->hasMany(Comentario::class);
    }

}
