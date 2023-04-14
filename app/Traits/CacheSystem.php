<?php

namespace App\Traits;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

trait CacheSystem
{
    public function getSettings()
    {
        return Cache::remember('getSettings', 86400, function () {
            return Setting::first();
        });
    }
}
