<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = [
            'column' => 'id',
            'direction' => 'asc'
        ];
        $data = User::where('active', 1)->orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'));

        return view('admin.user.index', compact('data', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = $request->active;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        session()->flash('message', ['type' => 'success', 'message' => "Usuário <strong>{$user->name}</strong> cadastrado!"]);

        return response()->json(['redirect' => route('admin.user.index')]);
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
    public function update(UserRequest $request, $id)
    {
        dd($request->all());
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
        }), ['_order', '_order_direction', '_page']);

        $order = [
            'column' => $request->get('_order') ?? 'id',
            'direction' => $request->get('_order_direction') ?? 'asc'
        ];

        $page = $request->get('_page') ?? 1;

        if ($params) {
            $data = User::where(function ($query) use ($params, $order) {
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
            $data = User::orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'));
        }

        return view('admin.user.index_list', compact('data', 'order'));
    }
}
