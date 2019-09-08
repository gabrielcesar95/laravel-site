<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::paginate(env('APP_RESULTS_PER_PAGE'));

        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filter(Request $request)
    {
        $params = Arr::except(array_filter($request->all(), function ($p) {
            return $p !== null;
        }), '_order');
        $order = $request->all()['_order'] ?? '';

        if ($params) {
            $data = User::where(function ($query) use ($params) {
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
            })->paginate(env('APP_RESULTS_PER_PAGE'));
        } else {
            $data = User::paginate(env('APP_RESULTS_PER_PAGE'));
        }

        return view('admin.user.index_list', compact('data'));
    }
}
