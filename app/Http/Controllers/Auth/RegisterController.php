<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'username.unique' => 'That username is already taken. Please select another.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'working_on_university' => $data['working_on_university'],
            'age' => $data['age'],
            'dominant_language' => $data['dominant_language'],
            'language_teacher' => $data['language_teacher'],
            'language' => App::getLocale()
        ]);
    }

    protected function additionUserInfo(Request $request, $userId)
    {
        $user = User::findorfail($userId);
        $user->update([
            'working_on_university' => $request->working_on_university,
            'age' => $request->age,
            'dominant_language' => $request->dominant_language,
            'language_teacher' => $request->language_teacher,
            'language' => App::getLocale()
        ]);

        auth()->login($user, true);
        toastr()->info(trans('home.Thank you for your answer!'));
        return redirect()->route('index');
    }
}
