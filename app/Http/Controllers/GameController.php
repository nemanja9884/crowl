<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Language;
use App\Models\Sentence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class GameController extends Controller
{
    public function gameIntro($code): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $language = Language::where('lang_code', $code)->first();
        return view('web.gameIntro', ['language' => $language]);
    }

    public function startGame(Request $request, $code)
    {
        return $this->game($code, $request->input('level'));
    }

    public function game($code, $level)
    {
        $language = Language::where('lang_code', $code)->first();

        switch ($level) {
            case '1':
            case '1+2':
            case '1+2+3':
                $user = Auth::guard('web')->user();

                $sent = Sentence::find(5);
//                dd($sent->answers);

                $firstSentence = Sentence::where('language_id', $language->id);
                if ($user) {
                    $firstSentence->whereDoesntHave('answers', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    });
                } else {
                    $firstSentence->whereDoesntHave('answers', function ($q) use ($user) {
                        $q->where('ip_address', request()->ip());
                    });
                }

                $firstSentence = $firstSentence->orderBy('word_reliability', 'ASC')->limit(100)->get()->random();
                if ($firstSentence) {
                    $secondSentence = Sentence::where('language_id', $language->id)->where('id', '!=', $firstSentence->id);
                    if ($user) {
                        $secondSentence->whereDoesntHave('answers', function ($q) use ($user) {
                            $q->where('user_id', $user->id);
                        });
                    } else {
                        $secondSentence->whereDoesntHave('answers', function ($q) use ($user) {
                            $q->where('ip_address', request()->ip());
                        });
                    }
                    $secondSentence = $secondSentence->orderBy('word_reliability', 'DESC')->limit(100)->get()->random();
                }

                return view('web.game-level1', ['language' => Language::where('lang_code', $code)->first(), 'level' => $level, 'firstSentence' => $firstSentence ?? null, 'secondSentence' => $secondSentence ?? null]);
            case '2':
            case '2+3':

                break;
            case '3':

                break;
        }
    }

    public function answerLevel1(Request $request, $code, $level): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|null
    {
        $language = Language::where('lang_code', $code)->first();
        if (isset($request->noneOfThem)) {
            foreach ($request->noneOfThem as $none) {
                Answer::store($language->id, $none, 0, 1);
            }
            return $this->level1($code, $level);
        } elseif (isset($request->bothOfThem)) {
            $answersIds = [];
            foreach ($request->bothOfThem as $both) {
                $answer = Answer::store($language->id, $both, 1, 0);
                $answersIds [] = $answer->id;
            }

            if ($level == 1) {
                return $this->level1($code, $level);
            } else {
                return $this->level2($language, $level, $request->bothOfThem[0], $answersIds);
            }
        } else {
            Answer::store($language->id, $request->input('answer'), 1, 0);

            if ($level == 1) {
                return $this->level1($code, $level);
            } else {
                return $this->level2($language, $level, $request->input('answer'));
            }
        }
    }

    public function level1($code, $level): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|null
    {
        return $this->game($code, $level);
    }

    public function level2($language, $level, $answer, $answersIds = null): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $sentence = Sentence::find($answer);
        return view('web.game-level2', ['language' => $language, 'level' => $level, 'sentence' => $sentence, 'answersIds' => $answersIds]);
    }
}

