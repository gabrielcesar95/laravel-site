<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ProfileRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        if (auth()->guest()) {
            return redirect(route('web.home'));
        }
        return view('web.profile');
    }

    public function update(ProfileRequest $request)
    {
        $profile = User::findOrFail(auth()->user()->id);

        if ($profile->email != $request->email) {
            $profile->email_verified_at = null;
            $verify = true;
        }

        $profile->name = $request->name;
        $profile->email = $request->email;

        if ($request->password) {
            $profile->password = Hash::make($request->password);
        }

        $profile->save();

        if (isset($verify) && $verify) {
            $profile->sendEmailVerificationNotification();
        }

        session()->flash('message', ['type' => 'success', 'message' => "Perfil editado!"]);
        return redirect()->route('web.profile.show');
    }
}
