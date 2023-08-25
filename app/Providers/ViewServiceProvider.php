<?php

namespace App\Providers;

use App\Models\Badge;
use App\Models\Category;
use App\Models\Language;
use App\Models\Score;
use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::guard('web')->user();
            if ($user) {
                $pointCheck = DB::select(DB::raw("SELECT sum(points) as points from scores where user_id = $user->id"));
                $points = $pointCheck[0]->points;
                $userBadge = Badge::where('points', '<', $points)->first();
            }

            $gameStatistic = Cache::remember('gameStatistic', 60, function () {
                $locale = App::getLocale();
                $language = Language::where('lang_code', $locale)->first();
                if($language) {
                    $pointsCountry = DB::select(DB::raw("SELECT users.username as username, user_id, sum(points) as points from scores LEFT JOIN `users`
            ON `scores`.`user_id` = `users`.`id` where language_id = $language->id GROUP BY user_id ORDER BY points DESC LIMIT 0, 100"));
                    $sumCountriesPoints = DB::select(DB::raw("SELECT languages.name as language_name, language_id, sum(points) as points from scores LEFT JOIN `languages`
            ON `scores`.`language_id` = `languages`.`id` GROUP BY language_id ORDER BY points DESC LIMIT 0, 100"));
                }
                return ['pointsCountry' => $pointsCountry ?? [], 'sumCountriesPoints' => $sumCountriesPoints ?? []];
            });

            $settings = Setting::first();

            $view->with([
                'points' => $points ?? 0,
                'settings' => $settings,
                'pointsCountry' => $gameStatistic['pointsCountry'],
                'sumCountriesPoints' => $gameStatistic['sumCountriesPoints'],
                'medals' => ['Golden Medal', 'Silver medal', 'Bronze Medal'],
                'userBadge' => $userBadge ?? null
            ]);
        });
    }
}
