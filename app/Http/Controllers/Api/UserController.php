<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserCollectionResource;
use App\Http\Resources\UserResource as UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return UserCollectionResource
     */
    public function index()
    {
        return new UserCollectionResource(User::withTrashed()->paginate());
    }

    /**
     * Display the logged in user.
     *
     * @param User $user
     * @return UserResource
     */
    public function me(Request $request)
    {
        $user = User::findOrFail($request->user()->id);

        return new UserResource($user);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param UserRequest $request
     * @return UserResource
     */
    public function store(UserRequest $request): ?UserResource
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar;
        $user->active = $request->active;
        $user->password = bcrypt($request->password);

        if ($request->hasFile('avatar')) {
            $user->avatar = url("storage/" . $request->avatar->store('users'));
        }

        $roles = $request->roles ? array_merge($request->roles, ['user']) : ['user'];

        if ($user->save()) {
            $user->syncRoles($roles);
            $user->syncPermissions($request->permissions);;

            return (new UserResource($user));
        }

        return null;
    }

    /**
     * Display the specified user.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    /**
     * Update the specified user in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UserRequest $request, User $user, $id): ?UserResource
    {
        $user = User::findOrFail($id);

        $user->name = $request->name ?? $user->name;
        if ($request->email && $request->email != $user->email) {
            $user->email_verified_at = null;
            $user->email = $request->email;
        }
        $user->active = $request->active ?? $user->active;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $roles = $request->roles ? array_merge($request->roles, ['user']) : ['user'];

        if ($user->hasRole('super') && $super = Role::where('name', 'super')->first()) {
            $roles[] = $super->id;
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
            $user->avatar = "storage/" . $request->avatar->store('users');
        }

        if ($user->save()) {
            $user->syncRoles($roles);
            $user->syncPermissions($request->permissions);

            return (new UserResource($user));
        }

        return null;
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        if ($id == request()->user()->id) {
            return response([
                'message' => __('You can’t delete yourself.')
            ], 403);
        }
        $user = User::findOrFail($id);
        if ($user->delete()) {
            return response([
                'message' => __('User successfully deleted.')
            ]);
        }
        return null;
    }
}
