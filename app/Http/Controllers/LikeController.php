<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // dd('Dando Like');
        // dd($post->id);
        // dd($request->user()->id);

        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();

    }
}
