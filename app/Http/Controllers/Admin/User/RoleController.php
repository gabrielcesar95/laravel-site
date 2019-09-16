<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
        $data = Role::orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'));

        return view('admin.role.index', compact('data', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissionList = Permission::all();

        if ($permissionList) {
            $permissions = [];
            foreach ($permissionList as $key => $permission) {
                $index = $permission->group;

                if (!isset($permissions[$index])) {
                    $permissions[$index] = [
                        $permission
                    ];
                } else {
                    $permissions[$index][] = $permission;
                }
            }
        }

        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->name]);

        session()->flash('message', ['type' => 'success', 'message' => "Grupo <strong>{$role->name}</strong> cadastrado!"]);

        return response()->json(['redirect' => route('admin.role.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.role.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.role.edit', compact('user'));
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
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = $request->active;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        session()->flash('message', ['type' => 'success', 'message' => "Usuário <strong>{$user->name}</strong> alterado!"]);

        return response()->json(['redirect' => route('admin.user.index')]);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        return view('admin.role.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == Auth::id()) {
            session()->flash('message', ['type' => 'error', 'message' => "Hey! Você não pode deletar a si mesmo 😉"]);
        } else {
            $user = User::findOrFail($id);
            $user->delete();

            session()->flash('message', ['type' => 'success', 'message' => "Usuário <strong>{$user->name}</strong> deletado!"]);
        }

        return response()->json(['redirect' => route('admin.user.index')]);
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

        return view('admin.role.index_list', compact('data', 'order'));
    }
}
