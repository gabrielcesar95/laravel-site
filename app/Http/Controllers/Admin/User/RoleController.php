<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Role;
use App\Traits\Authorizable;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
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
        if (auth()->user()->can('super')) {
            $data = Role::orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'));
        } else {
            $data = Role::where('visible', 1)->orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'));
        }

        return view('admin.role.index', compact('data', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->sortPermissions(Permission::all());

        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->name]);

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }

        session()->flash('message', ['type' => 'success', 'message' => "Grupo de Acesso <strong>{$role->name}</strong> cadastrado!"]);

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
        $role = Role::findOrFail($id);

        $permissions = $this->sortPermissions(Permission::all());

        return view('admin.role.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        $permissions = $this->sortPermissions(Permission::all());

        return view('admin.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }

        $role->save();

        session()->flash('message', ['type' => 'success', 'message' => "Grupo de Acesso <strong>{$role->name}</strong> alterado!"]);

        return response()->json(['redirect' => route('admin.role.index')]);
    }

    public function delete($id)
    {
        $user = Role::findOrFail($id);

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
        $role = Role::findOrFail($id);
        if (!$role->visible) {
            session()->flash('message', ['type' => 'error', 'message' => "Grupos de Acesso ocultos não podem ser excluídos"]);
        } else {
            $role->delete();

            session()->flash('message', ['type' => 'success', 'message' => "Grupo de Acesso <strong>{$role->name}</strong> deletado!"]);
        }

        return response()->json(['redirect' => route('admin.role.index')]);
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
                $data = Role::where(function ($query) use ($params, $order) {
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
                $data = Role::where('visible', 1)->where(function ($query) use ($params, $order) {
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
            $data = Role::orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'));
        }

        return view('admin.role.index_list', compact('data', 'order'));
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
