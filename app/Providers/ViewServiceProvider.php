<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Score;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
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
            }

            $settings = Setting::first();

            $view->with([
                'points' => $points ?? 0,
                'settings' => $settings
            ]);
        });
    }
}
