<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // Importante $request no esta diponible en livewire
    public $post;

    public function like() 
    {
        // Revisa si el usuario actual ya dio "me gusta"
        if ( $this->post->checkLike(auth()->user())) {
            // Eliminar like
            $this->post->likes()->where('post_id', $this->post->id)->delete();           
        }else {
            // Guardar like
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
