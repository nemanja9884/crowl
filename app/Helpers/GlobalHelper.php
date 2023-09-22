<?php


namespace App\Helpers;

use App\Models\Answer;
use App\Models\AnswerDetail;
use App\Models\Badge;
use App\Models\Score;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GlobalHelper
{
    public function getFivePointsMessage(): string
    {
        $texts = ['Good job!', 'Well done!', 'You are on a hot streak!'];
        return "<img src='" . asset("images/game/" . rand(1, 3) . ".gif") . "' style='width: 30px;'> &nbsp" . trans('home.' . Arr::random($texts, 1)[0]) . ' ' . trans('home.You got 5 extra points!');
    }

    public function gamesInRow($langId, $dataArray = [])
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
            }
            // Tracking for game statistic between 7 and 12 played games
            $playedGames = session()->get('playedGames');
            if (!$playedGames) {
                session()->put('playedGames', 2);
            } else {
                if ($playedGames >= 7 && $playedGames <= 12) {
                    $random = rand($playedGames, 12);
                    if ($random == $playedGames) {
                        $playedGames = 1;
                        $returnStatistic = true;
                    } else {
                        $playedGames = $playedGames + 1;
                    }
                } else {
                    $playedGames = $playedGames + 1;
                }
                session()->put('playedGames', $playedGames);
            }

            // Return message as last session put because of bug. Message must be the last created session.
            if ($data == 5) {
                session()->put('info', $this->getFivePointsMessage());
            }

            if (isset($returnStatistic) && $returnStatistic) {
                if (rand(1, 2) == 1) {
                    // This is case for % of same answers
                    $getStatistic = $this->getStatistic($langId, $dataArray);
                    // If there is no same answer like the users, then give mu message about next badge
                    if(!$getStatistic){
                        return ['view' => $this->userNextBadgeNeededPoints(Auth::guard('web')->user())];
                    } else {
                        return ['view' => $getStatistic];
                    }
                } else {
                    // This is case for how many points user needs to reach new badge
                    return ['view' => $this->userNextBadgeNeededPoints(Auth::guard('web')->user())];
                }
            } else {
                return ['view' => null];
            }
        }
    }

    public function getStatistic($langId, $data)
    {
        switch ($data['level']) {
            case 1:
                return Answer::compareLvl1Statistic($langId, $data);
            case 2:
                return AnswerDetail::compareLvl2Statistic($langId, $data);
            case 3:
                return AnswerDetail::compareLvl3Statistic($langId, $data);
        }
    }

    public function userNextBadgeNeededPoints($user): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|null
    {
        $pointCheck = DB::select(DB::raw("SELECT sum(points) as points from scores where user_id = $user->id"));
        $points = $pointCheck[0]->points;
        $badge = Badge::where('points', '>', $points)->orderBy('points', 'ASC')->first();
        if ($badge) {
            return view('web.additional-message', ['message' => trans("home.Keep it up! There’s") . " " . $badge->points - $points . " " . trans("home.points left to reach the") . " " . $badge->name . " " . trans("home.badge")]);
        } else {
            return null;
        }
    }
}
