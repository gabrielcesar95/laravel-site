<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\Admin\PostRequest;
use Illuminate\Support\Arr;

class PostController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = [
            'column' => 'name',
            'direction' => 'asc'
        ];
        $data = Post::orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'));

        return view('admin.post.index', compact('data', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->name = $request->name;
        $post->subtitle = $request->subtitle;
        $post->content = $request->get('content');
        $post->user_id = auth()->user()->id;
        if ($request->posted) {
            $post->posted_at = date('d/m/Y H:i');
        }
        $post->save();

        if ($request->categories) {
            $post->categories()->sync($request->categories);
        }

        if ($request->hasFile('cover')) {
            $post->cover = $request->cover->storeAs('posts', $post->slug . ".{$request->cover->getClientOriginalExtension()}");
            $post->save();
        }

        session()->flash('message', ['type' => 'success', 'message' => "Postagem <strong>{$post->name}</strong> cadastrada!"]);
        return response()->json(['redirect' => route('admin.post.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.post.show', compact('post'));
    }

    public function comments()
    {
        return view('admin.post.comments');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->name = $request->name;
        $post->subtitle = $request->subtitle;
        $post->content = $request->get('content');
        $post->user_id = auth()->user()->id;

        if ($request->posted) {
            if (!$post->posted_at) {
                $post->posted_at = date('d/m/Y H:i');
            }
        } else {
            $post->posted_at = null;
        }
        $post->save();

        $post->categories()->sync($request->categories);

        if ($request->hasFile('cover')) {
            if ($post->cover && Storage::exists($post->cover)) {
                Storage::delete($post->cover);
            }
            $post->cover = $request->cover->storeAs('posts', $post->slug . ".{$request->cover->getClientOriginalExtension()}");
            $post->save();
        }

        session()->flash('message', ['type' => 'success', 'message' => "Postagem <strong>{$post->name}</strong> alterada!"]);

        return response()->json(['redirect' => route('admin.post.index')]);
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.post.delete', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        session()->flash('message', ['type' => 'success', 'message' => "Postagem <strong>{$post->name}</strong> deletada!"]);

        return response()->json(['redirect' => route('admin.post.index')]);
    }

    public function filter(Request $request)
    {
        $params = Arr::except(array_filter($request->all(), function ($p) {
            return $p !== null;
        }), ['_order', '_order_direction', '_page']);

        $order = [
            'column' => $request->get('_order') ?? 'id',
            'direction' => $request->get('_order_direction') ?? 'asc'
        ];

        $page = $request->get('_page') ?? 1;

        if ($params) {
            $data = Post::where(function ($query) use ($params, $order) {
                foreach ($params as $param => $props) {
                    if (is_array($props)) {
                        switch ($props['operator']) {
                            case 'LIKE':
                                $query->where($param, 'LIKE', "%{$props['value']}%");
                                break;

                            default:
                                $query->where($param, $props['operator'] ?? '=', $props['value']);
                        }
                    } else {
                        $query->where($param, $props);
                    }
                }
            })->orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'), ['*'], 'page', $page);
        } else {
            $data = Post::orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'));
        }

        return view('admin.post.index_list', compact('data', 'order'));
    }
}
