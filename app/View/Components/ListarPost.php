<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListarPost extends Component
{
    // registrar $posts
    public $posts; 
    /**
     * Create a new component instance.
     * Cuando se ejecuta x-listar-post se manda a llamar el constuctor.
     * Importante tiene que ser el mismo nombre de variable ($posts)
     */
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listar-post');
    }
}
