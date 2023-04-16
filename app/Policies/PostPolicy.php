<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{    
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        // es el usuario actual el mismo que creo el post que se esta tratando de eliminar?
        return $user->id === $post->user_id;
    }
}