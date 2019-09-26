<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Traits\Authorizable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
        $data = Category::orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'));

        return view('admin.category.index', compact('data', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        if ($request->hasFile('cover')) {
            $category->cover = $request->cover->storeAs('categories', $category->slug . ".{$request->cover->getClientOriginalExtension()}");
            $category->save();
        }

        session()->flash('message', ['type' => 'success', 'message' => "Categoria <strong>{$category->name}</strong> cadastrada!"]);
        return response()->json(['redirect' => route('admin.category.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.show', compact('category', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;

        if ($request->permissions) {
            $category->syncPermissions($request->permissions);
        }

        $category->save();

        session()->flash('message', ['type' => 'success', 'message' => "Categoria <strong>{$category->name}</strong> alterada!"]);

        return response()->json(['redirect' => route('admin.category.index')]);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.delete', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        session()->flash('message', ['type' => 'success', 'message' => "Categoria <strong>{$category->name}</strong> deletada!"]);

        return response()->json(['redirect' => route('admin.category.index')]);
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
            if (auth()->user()->can('super')) {
                $data = Category::where(function ($query) use ($params, $order) {
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
                $data = Category::where('visible', 1)->where(function ($query) use ($params, $order) {
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
            }
        } else {
            $data = Category::orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'));
        }

        return view('admin.category.index_list', compact('data', 'order'));
    }
}
