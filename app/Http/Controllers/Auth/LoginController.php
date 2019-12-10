<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        Session::put('preUrl', URL::previous());
    }

    public function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => [new GoogleReCaptchaV3ValidationRule('login')]
        ]);
    }

    public function redirectTo()
    {
        return Session::get('preUrl') ? Session::get('preUrl') : $this->redirectTo;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($driver, $scopes = [])
    {
        return Socialite::driver($driver)->scopes($scopes)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($driver)
    {
        try {
            $oAuthUser = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        $user = User::where('email', $oAuthUser->getEmail())->orWhereHas('providers', function ($q) use ($driver, $oAuthUser) {
            $q->where('provider_name', $driver);
            $q->where('provider_id', $oAuthUser->getId());
        })->first();

        if ($user) {
            auth()->login($user, true);

            $this->createProvider($driver, $oAuthUser, $user);
        } else {

            if (!$user->getEmail()) {
                Session::put([
                    'provider' => [
                        'provider_name' => $driver,
                        'provider_id' => $oAuthUser->getId(),
                        'token' => $oAuthUser->token ?? null,
                        'refresh_token' => $oAuthUser->refresh_token ?? null,
                    ]
                ]);

                return redirect()->route('register')->withInput(['name' => $oAuthUser->getName(), 'avatar' => $oAuthUser->getAvatar()]);
            }

            $user = new User;
            $user->name = $oAuthUser->getName();
            $user->email = $oAuthUser->getEmail();
            $user->email_verified_at = now();
            $user->avatar = $oAuthUser->getAvatar();
            $user->save();

            $user->assignRole('user');

            $this->createProvider($driver, $oAuthUser, $user);

            auth()->login($user, true);
        }

        return redirect($this->redirectTo());
    }

    private function createProvider($driver, $oAuthUser, $user)
    {
        UserProvider::where('user_id', $user->id)->where('provider_name', $driver)->delete();

        $provider = new UserProvider;
        $provider->user_id = $user->id;
        $provider->provider_name = $driver;
        $provider->provider_id = $oAuthUser->getId();
        $provider->token = $oAuthUser->token ?? null;
        $provider->refresh_token = $oAuthUser->refresh_token ?? null;
        $provider->save();
    }
}
