<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Request $request, $slug)
    {
        //TODO: Incrementar contador de views a cada visita

        $post = Post::where('posted_at', '<', date('Y-m-d H:i'))->where('slug', $slug)->first();

        if(!$post){
            abort(404);
        }

        return view('web.post', compact('post'));
    }
}
