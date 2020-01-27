<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleCollectionResource;
use App\Http\Resources\RoleResource;
use App\Http\Requests\Api\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return RoleCollectionResource
     */
    public function index()
    {
        if (request()->user()->can('super')) {
            return new RoleCollectionResource(Role::paginate(env('APP_RESULTS_PER_PAGE')));
        }
        return new RoleCollectionResource(Role::where('visible', 1)->paginate(env('APP_RESULTS_PER_PAGE')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RoleResource
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->name]);

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }

        return new RoleResource($role);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return RoleResource
     */
    public function show($id)
    {
        if (request()->user()->hasRole('super')) {
            $role = Role::findOrFail($id);
        } else {
            $role = Role::whereId($id)->where('visible', 1)->firstOrFail();
        }
        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return RoleResource
     */
    public function update(RoleRequest $request, $id)
    {
        if (request()->user()->hasRole('super')) {
            $role = Role::findOrFail($id);
        } else {
            $role = Role::whereId($id)->where('visible', 1)->firstOrFail();
        }

        $role->name = $request->name ?? $role->name;

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }

        $role->save();

        return new RoleResource($role);
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
            return response(['message' => __("Hidden User groups cannot be deleted.")], 403);
        }

        $role->delete();
    }
}
