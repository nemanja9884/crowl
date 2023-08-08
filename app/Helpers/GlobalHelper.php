<?php


namespace App\Helpers;

use App\Models\Score;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class GlobalHelper
{
    public function getFivePointsMessage(): string
    {
        $texts = ['Good!', 'Well done!', 'You are on a hot streak!'];
        return "<img src='" . asset("images/game/" . rand(1, 3) . ".gif") . "' style='width: 30px;'> &nbsp" . trans('home.' . Arr::random($texts, 1)[0]) . ' ' . trans('home.You got 5 extra points!');
    }

    public function gamesInRow($langId): void
    {
        if (Auth::guard('web')->user()) {
            $data = session()->get('playerData');
            if (!$data) {
                session()->put('playerData', 2);
            } else {
                if ($data == 5) {
                    Score::store($langId, 5);
                    $data = 1;
                } else {
                    $data = $data + 1;
                }
                session()->put('playerData', $data);
                if($data == 5) {
                    session()->put('info', $this->getFivePointsMessage());
                }
            }
        }
    }
}
