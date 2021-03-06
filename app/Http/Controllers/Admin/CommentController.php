<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CommentController extends Controller
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
            'column' => 'created_at',
            'direction' => 'desc'
        ];
        $data = Comment::orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'));

        return view('admin.comment.index', compact('data', 'order'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);

        return view('admin.comment.show', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if ($request->action == 'approve') {
            $comment->approved = 1;
        } else {
            session()->flash('message', ['type' => 'warning', 'message' => "Ação inesperada"]);
            return response()->json(['redirect' => route('admin.comment.index')]);
        }

        $comment->save();

        session()->flash('message', ['type' => 'success', 'message' => "Comentário alterado!"]);

        return response()->json(['redirect' => route('admin.comment.index')]);
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);

        return view('admin.comment.delete', compact('comment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        session()->flash('message', ['type' => 'success', 'message' => "Comentário deletado!"]);

        return response()->json(['redirect' => route('admin.comment.index')]);
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
            $data = Comment::where(function ($query) use ($params, $order) {
                foreach ($params as $param => $props) {

                    if (is_array($props)) {
                        switch ($props['operator']) {
                            case 'LIKE':
                                if (Str::contains($param, '__')) {
                                    $clause = explode('__', $param);
                                    $query->whereHas($clause[0], function ($query) use ($clause, $props) {
                                        $query->where($clause[1], 'LIKE', "%{$props['value']}%");
                                    });
                                } else {
                                    $query->where($param, 'LIKE', "%{$props['value']}%");
                                }
                                break;

                            case 'checked':
                                $props['value'] = isset($props['value']) && $props['value'] == 1 ? '1' : '0';

                                if (Str::contains($param, '__')) {
                                    $clause = explode('__', $param);
                                    $query->whereHas($clause[0], function ($query) use ($clause, $props) {
                                        $query->where($clause[1], $props['operator'] ?? '=', "%{$props['value']}%");
                                    });
                                } else {
                                    $query->where($param, '=', $props['value']);
                                }
                                break;

                            default:
                                if (Str::contains($param, '__')) {
                                    $clause = explode('__', $param);
                                    $query->whereHas($clause[0], function ($query) use ($clause, $props) {
                                        $query->where($clause[1], $props['operator'] ?? '=', "%{$props['value']}%");
                                    });
                                } else {
                                    $query->where($param, $props['operator'] ?? '=', $props['value']);
                                }
                        }
                    } else {
                        $query->where($param, $props);
                    }
                }
            })->orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'), ['*'], 'page', $page);
        } else {
            $data = Post::orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'));
        }

        return view('admin.comment.index_list', compact('data', 'order'));
    }
}
