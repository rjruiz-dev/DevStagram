<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() 
    {
        // es la relacion one to many
        // un usuario puede tener multiples posts
        return $this->hasMany(Post::class); 
    }

    public function likes() 
    {
        // un usuario puede tener multiples likes.
        // le puede dar like a todas las publicaciones que desea.
        return $this->hasMany(Like::class); 
    }

    // Almacena los seguidores de un usuario
    public function followers() // las personas que me siguen
    {
        // multiples seguidores 
        // user_id: usuario que estamos visitando
        // follower_id: es la persona que le esta dando "seguir" a esa persona
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id'); // followers: la tabla 
    }

    // Almacenar los que seguimos


}
