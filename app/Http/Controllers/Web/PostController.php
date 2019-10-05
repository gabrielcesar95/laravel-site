<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Cassandra\Date;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Request $request, $slug)
    {
        //TODO: Incrementar contador de views a cada visita

        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            session()->flash('message', ['type' => 'warning', 'message' => "Postagem não encontrada!"]);
            return redirect()->route('web.home');
        }

        if (!$post->posted_at || new \DateTime($post->getOriginal('posted_at')) > now()) {
            session()->flash('message', ['type' => 'warning', 'message' => "Postagem não encontrada!"]);
            return redirect()->route('web.home');
        }

        return view('web.post', compact('post'));
    }

    public function comment(CommentRequest $request, $slug)
    {
        $post = Post::where('posted_at', '<', date('Y-m-d H:i'))->where('slug', $slug)->first();

        if (!$post) {
            return response()->json(['errors' => ['post' => 'Postagem não encontrada']], 422);
        }

        $comment = new Comment();
        $comment->content = $request->get('content');
        $comment->user_id = auth()->user()->id;
        $comment->commentable()->associate($post);

        $comment->save();

        session()->flash('message', ['type' => 'success', 'message' => "Comentário enviado!<br>Aguardando aprovação..."]);

        return response()->json(['refresh' => true]);

    }
}
