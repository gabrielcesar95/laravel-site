<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Traits\Authorizable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
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
        $roles = Role::where('visible', 1)->orderBy('name')->get();
        $permissions = $this->sortPermissions(Permission::all());

        return view('admin.user.create', compact('roles', 'permissions'));
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

        $roles = $request->roles ? array_merge($request->roles, ['admin']) : ['admin'];

        $user->save();
        $user->syncRoles($roles);
        $user->syncPermissions($request->permissions);

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
        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::where('visible', 1)->orderBy('name')->get();
        $permissions = $this->sortPermissions(Permission::all());
        $user = User::findOrFail($id);
        $user->directPermissions = $user->getDirectPermissions()->pluck('id')->toArray();

        return view('admin.user.edit', compact('user', 'roles', 'permissions'));
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

        $roles = $request->roles ? array_merge($request->roles, ['admin']) : ['admin'];

        $user->save();
        $user->syncRoles($roles);
        $user->syncPermissions($request->permissions);

        session()->flash('message', ['type' => 'success', 'message' => "Usuário <strong>{$user->name}</strong> alterado!"]);
        return response()->json(['redirect' => route('admin.user.index')]);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.delete', compact('user'));
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

        return view('admin.user.index_list', compact('data', 'order'));
    }

    /**
     * Organize permissions on a multidimensional array
     *
     * @param array $permissionList
     * @return array
     */
    public function sortPermissions(Collection $permissionList)
    {
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

        return $permissions;
    }
}
