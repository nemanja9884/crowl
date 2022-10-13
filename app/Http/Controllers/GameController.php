<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Language;
use App\Models\Sentence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::guard('web')->user();

        switch ($level) {
            case '1':
            case '1+2':
            case '1+2+3':
                $firstSentence = $this->gameData($user, $language->id, $level, 'ASC', 'first');
                if ($firstSentence) {
                    $secondSentence = $this->gameData($user, $language->id, $level, 'DESC', $firstSentence->id, 'second');
                }

                if (!$firstSentence || !$secondSentence) {
                    return redirect()->route('noGames');
                }

                return view('web.game-level1', ['language' => Language::where('lang_code', $code)->first(), 'level' => $level, 'firstSentence' => $firstSentence ?? null, 'secondSentence' => $secondSentence]);
            case '2':
            case '2+3':
            case '3':
                $answers = $this->gameData($user, $language->id, $level);
                if(count($answers) < 1) {
                    return redirect()->route('noGames');
                }
                return $this->level($level == 3 ? 3 : 2, $language, $level, $answers[0]->sentence_id, $answers->pluck('id')->toArray(), $answers[0]->id);
        }
    }

    public function level($bladeNumber, $language, $level, $sentenceAnswer, $answersIds, $answerId)
    {
        $sentence = Sentence::find($sentenceAnswer);
        return view('web.game-level' . $bladeNumber, ['language' => $language, 'level' => $level, 'sentence' => $sentence, 'answersIds' => $answersIds, 'answerId' => $answerId]);
    }

    public function gameData($user, $langId, $level, $sort = 'ASC', $firstSentenceId = null, $sentenceNum = null)
    {
        switch ($level) {
            case '1':
            case '1+2':
            case '1+2+3':
                $sentenceDb = Sentence::where('language_id', $langId)->finished('0');

                if ($sentenceNum == 'second') {
                    $sentenceDb->where('id', '!=', $firstSentenceId);
                }

                if ($user) {
                    $sentenceDb->whereDoesntHave('answers', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    });
                } else {
                    $sentenceDb->whereDoesntHave('answers', function ($q) use ($user) {
                        $q->where('ip_address', request()->ip());
                    });
                }

                $sentenceDb = $sentenceDb->orderBy('word_reliability', $sort)->limit(100)->get();
                if (count($sentenceDb) > 0) {
                    return $sentenceDb->random();
                } else {
                    return false;
                }
            case '2':
            case '2+3':
                return Answer::where(function ($q) {
                    $q->where('positive_answer', 1);
                    $q->orWhere('negative_answer', 1);
                })
                    ->where('negative_reasons', null)
                    ->where('sentence_bad_part', null)
                    ->limit(2)->get();
            case '3';
                return Answer::where('negative_reasons', '!=', null)
                    ->where('sentence_bad_part', null)
                    ->limit(2)->get();
        }
    }

    public function answerLevel1(Request $request, $code, $level)
    {
        toastr()->info('Thank you for your answer!');
        $language = Language::where('lang_code', $code)->first();
        if (isset($request->noneOfThem)) {
            $request->noneOfThem = explode(',', $request->noneOfThem);
            foreach ($request->noneOfThem as $none) {
                Answer::store($language->id, $none, 0, 1);
            }
            return $this->game($code, $level);
        } elseif (isset($request->bothOfThem)) {
            $request->bothOfThem = explode(',', $request->bothOfThem);
            $answersIds = [];
            foreach ($request->bothOfThem as $both) {
                $answer = Answer::store($language->id, $both, 1, 0);
                $answersIds [] = $answer->id;
            }

            if ($level == '1') {
                return $this->game($code, $level);
            } else {
                return $this->level(2, $language, $level, $request->bothOfThem[0], $answersIds, $answersIds[0]);
            }
        } else {
            $answer = Answer::store($language->id, $request->input('answer'), 1, 0);

            if ($level == '1') {
                return $this->game($code, $level);
            } else {
                return $this->level(2, $language, $level, $request->input('answer'), $answer->id, $answer->id);
            }
        }
    }

    public function answerLevel2(Request $request, $code, $level)
    {
        toastr()->info('Thank you for your answer!');
        $language = Language::where('lang_code', $code)->first();
        $answersIds = $request->input('answersIds');
        $answer = Answer::find($request->input('answerId'));

        $reasons = $request->input('answer');
        $reasons = implode(',', $reasons);
        $answer->negative_reasons = $reasons;
        $answer->save();

        // Check if there is more than one question and check if this is first, if so, let him answer on second question
        if (is_array($answersIds) && $answersIds[0] == $request->input('answerId')) {
            $sentenceAnswer = Answer::find($answersIds[1]);
            return $this->level(2, $language, $level, $sentenceAnswer->sentence_id, $answersIds, $answersIds[1]);
        } else {
            if ($level == '2' || $level == '1+2') {
                return $this->game($code, $level);
            } elseif ($level == '2+3' || $level == '1+2+3') {
                if (is_array($answersIds)) {
                    $sentenceAnswer = Answer::find($answersIds[0]);
                    return $this->level(3, $language, $level, $sentenceAnswer->sentence_id, $answersIds, $answersIds[0]);
                } else {
                    $sentenceAnswer = Answer::find($answersIds);
                    return $this->level(3, $language, $level, $sentenceAnswer->sentence_id, $answersIds, $answersIds);
                }

            }
        }
    }

    public function answerLevel3(Request $request, $code, $level)
    {
        toastr()->info('Thank you for your answer!');
        $language = Language::where('lang_code', $code)->first();
        $answersIds = $request->input('answersIds');
        $answer = Answer::find($request->input('answerId'));
        $answer->sentence_bad_part = $request->input('problematicWords');
        $answer->save();

        // Check if there is more than one question and check if this is first, if so, let him answer on second question
        if (is_array($answersIds) && $answersIds[0] == $request->input('answerId')) {
            $sentenceAnswer = Answer::find($answersIds[1]);
            return $this->level(3, $language, $level, $sentenceAnswer->sentence_id, $answersIds, $answersIds[1]);
        } else {
            // If user answered on every question in level 3, let im play again level that he choose
            return $this->game($code, $level);
        }
    }
}

