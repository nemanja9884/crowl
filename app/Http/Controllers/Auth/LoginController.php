<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        return view('auth.login');
    }

    public function redirectToProvider($driver): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
            return redirect($this->redirectPath());
        } else {
            $newUser = new User;
            $newUser->provider_name = $driver;
            $newUser->provider_id = $user->getId();
            $newUser->username = User::generateUniqueUsername();
            $newUser->email = $user->getEmail();
            // we set email_verified_at because the user's email is already veridied by social login portal
            $newUser->email_verified_at = now();
            // you can also get avatar, so create avatar column in database it you want to save profile image
            // $newUser->avatar            = $user->getAvatar();
            $newUser->save();

//            auth()->login($newUser, true);

            return view('auth.additional-info', ['user' => $newUser]);
        }
    }
}
