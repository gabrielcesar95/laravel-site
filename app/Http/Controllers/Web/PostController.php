<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CommentRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Request $request, $slug)
    {
        //TODO: Incrementar contador de views a cada visita

        $post = Post::where('posted_at', '<', date('Y-m-d H:i'))->where('slug', $slug)->first();

        if (!$post) {
            return redirect()->back();
        }

        return view('web.post', compact('post'));
    }

    public function comment(CommentRequest $request, $slug)
    {
        $post = Post::where('posted_at', '<', date('Y-m-d H:i'))->where('slug', $slug)->first();

        if(!$post){
            return redirect()->back();
        }



        dd($request->all());

    }
}
