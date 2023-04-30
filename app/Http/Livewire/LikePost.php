<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // Importante $request no esta diponible en livewire
    public $post;
    public $isLiked;
    public $likes;

    // Saber cuando el usuario entra a la vista y detectar si le dio "me gusta"    
    // Ciclo de vida mount se ejeucuta automaticamente cuando sea instanciado
    public function mount($post)
    {
        $this->isLiked = $post->checkLike(auth()->user());
        // una ves instanciado leemos la cantidad de like que tiene y la asignamos a this->likes
        $this->likes = $post->likes->count();
    }

    public function like() 
    {
        // Revisa si el usuario actual ya dio "me gusta"
        if ( $this->post->checkLike(auth()->user())) {
            // Eliminar like
            $this->post->likes()->where('post_id', $this->post->id)->delete(); 
            // Re-render
            $this->isLiked = false;     
            $this->likes--;  
        }else {
            // Guardar like
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
