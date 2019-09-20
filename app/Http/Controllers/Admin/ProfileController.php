<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile');
    }

    public function update(ProfileRequest $request)
    {
        $profile = User::findOrFail(auth()->user()->id);

        $profile->name = $request->name;
        $profile->email = $request->email;

        if ($request->password) {
            $profile->password = Hash::make($request->password);
        }
        $profile->save();

        session()->flash('message', ['type' => 'success', 'message' => "Perfil editado!"]);
        return response()->json(['refresh' => true]);
    }
}
