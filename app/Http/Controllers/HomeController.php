<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Language;
use App\Models\Setting;
use App\Models\User;
use App\Traits\CacheSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use CacheSystem;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        App::setLocale('pt-BR');
        session()->put('locale', 'pt-BR');
        return view('web.index', ['languagesFirstRow' => Language::where('status', '1')->orderBy('sort', 'ASC')->limit(3)->get(), 'languagesSecondRow' => Language::where('status', '1')->orderBy('sort', 'ASC')->skip(3)->limit(10)->get(), 'settings' => $this->getSettings()]);
    }

    public function home(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('home');
    }

    public function languageIndex($id, $code): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $language = Language::find($id);
        App::setLocale($language->lang_code);
        session()->put('locale', $language->lang_code);
        return view('web.index_language', ['language' => $language]);
    }

    public function additionalInfoData($field, $value)
    {
        $usersCount = User::count();
        $dataCount = User::where($field, $value)->count();

        return number_format((float)($dataCount / $usersCount) * 100, 1, '.', '');
    }

    public function userProfile()
    {
        $this->middleware('auth');
        $user = Auth::guard('web')->user();
        $userDb = User::findorfail($user->id);

        return view('web.user-profile', ['user' => $userDb]);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'password' => 'max:255',
        ]);

        if ($validator->fails()) {
            toastr()->error(trans('home.Something went wrong! Check your information again'));
            return redirect()->back();
        }

        $this->middleware('auth');
        $user = Auth::guard('web')->user();
        $userDb = User::findorfail($user->id);
        $userDb->update($request->all('username', $request->filled('password') ? 'password' : '', 'working_on_university', 'age', 'dominant_language', 'language_teacher'));

        toastr()->info(trans('home.Successfully saved user profile'));
        return redirect()->back();
    }

    public function badges(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('web.badges', ['badges' => Badge::orderBy('points', 'ASC')->get()]);
    }

    public function additionalInfo($code): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $settings = Setting::first();
        return view('web.additional-info', ['settings' => $settings]);
    }
}
