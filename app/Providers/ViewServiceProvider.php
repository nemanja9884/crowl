<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;
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
            if($user) {
                $pointCheck = Score::where('user_id', $user->id)->first();
                if($pointCheck) {
                    $points = $pointCheck->points;
                }
            }

            $view->with([
               'points' => $points ?? 0
            ]);
        });
    }
}
