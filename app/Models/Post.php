<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpParser\Node\Expr\FuncCall;

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

    public function likes() 
    {
        // un posts va a tener muchos likes
        return $this->hasMany(Like::class);
    }    

    // Revisa si un usuario ya le dio me gusta, para evitar duplicados
    public function checkLike(User $user)
    {
        // likes = no como funcion, sino como la relacion sin ()
        // con likes se posiciona en la tabla de likes
        // contains si contiene en la columna de user_id, contiene el usuario del post?
        return $this->likes->contains('user_id', $user->id);
    }
}
