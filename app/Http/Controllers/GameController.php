<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\AnswerDetail;
use App\Models\Language;
use App\Models\Score;
use App\Models\Sentence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

    public function noGames($code)
    {
        $language = Language::where('lang_code', $code)->first();
        return view('web.no-games', ['language' => $language]);
    }

    public function game($code, $level)
    {
        $language = Language::where('lang_code', $code)->first();
        $user = Auth::guard('web')->user();

        $this->gamesInRow($language->id);

        switch ($level) {
            case '1':
            case '1+2':
            case '1+2+3':
                $firstSentence = $this->gameData($user, $language->id, $level, 'ASC', 'first');
                if ($firstSentence) {
                    $secondSentence = $this->gameData($user, $language->id, $level, 'DESC', $firstSentence->id, 'second');
                }

                if (!$firstSentence || !$secondSentence) {
                    return redirect()->route('noGames', $code);
                }

                return view('web.game-level1', ['language' => Language::where('lang_code', $code)->first(), 'level' => $level, 'firstSentence' => $firstSentence, 'secondSentence' => $secondSentence]);
            case '2':
            case '2+3':
                $answers = $this->gameData($user, $language->id, $level);
                if (count($answers) < 1) {
                    return redirect()->route('noGames', $code);
                }
                return $this->level($level == 3 ? 3 : 2, $language, $level, $answers[0]->sentence_id, $answers->pluck('id')->toArray(), $answers[0]->id);
            case '3':
                $answers = $this->gameData($user, $language->id, $level);
                if (count($answers) < 1) {
                    return redirect()->route('noGames', $code);
                } elseif (count($answers) == 1) {
                    $answers = $answers[0];
                    $sentenceAnswer = Answer::find($answers);
                } else {
                    $sentenceAnswer = Answer::find($answers[0]);
                }

                return $this->level($level == 3 ? 3 : 2, $language, $level, $sentenceAnswer->sentence_id, $answers, is_array($answers) ? $answers[0] : $answers);
        }
    }

    public function level($bladeNumber, $language, $level, $sentenceAnswer, $answersIds, $answerId, $reasonArrayKey = null)
    {
        $sentence = Sentence::find($sentenceAnswer);
        $data = ['language' => $language, 'level' => $level, 'sentence' => $sentence, 'answersIds' => $answersIds, 'answerId' => $answerId];
        if ($bladeNumber == 3) {
            $reasons = AnswerDetail::where('answer_id', $answerId)->where('reason', '!=', 'lack of context and/or incomprehensible')->whereNull('sentence_bad_part')->pluck('id')->toArray();
            $data['reasons'] = $reasons;
            if ($reasonArrayKey) {
                $data['reasonId'] = $reasonArrayKey;
            } else {
                $data['reasonId'] = $reasons[0];
            }
            $data['answerDetail'] = AnswerDetail::find($data['reasonId']);
        }

        return view('web.game-level' . $bladeNumber, $data);
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

                $sentenceDb = $this->gdexFn($sentenceDb);
                if (count($sentenceDb) > 0) {
                    return $sentenceDb->random();
                } else {
                    return false;
                }
            case '2':
            case '2+3':
                return Answer::where('language_id', $langId)->where(function ($q) {
                    $q->where('negative_answer', 1);
                })->whereDoesntHave('answersDetails')->limit(1)->get();
            case '3';
                return Answer::where('language_id', $langId)->whereHas('answersDetails', function ($q) use ($user) {
                    $q->whereNull('sentence_bad_part');
                })->limit(2)->pluck('id')->toArray();
        }
    }

    public function gdexFn($sentenceDb)
    {
        $random = rand(1, 2);
        if ($random == 1) {
            $sort = 'ASC';
        } else {
            $sort = 'DESC';
        }

        return $sentenceDb->orderBy('word_reliability', $sort)->limit(100)->get();
    }

    public function answerLevel1(Request $request, $code, $level)
    {
        toastr()->info('Thank you for your answer!');
        $language = Language::where('lang_code', $code)->first();
        if (isset($request->bothOfThem)) {
            $request->bothOfThem = explode(',', $request->bothOfThem);
            foreach ($request->bothOfThem as $both) {
                Score::scoring(1, $language->id, $both, 1, 0);
                Answer::store($language->id, $both, 1, 0);
            }
            return $this->game($code, $level);
        } elseif (isset($request->noneOfThem)) {
            $request->noneOfThem = explode(',', $request->noneOfThem);
            $answersIds = [];
            foreach ($request->noneOfThem as $none) {
                Score::scoring(1, $language->id, $none, 0, 1);
                $answer = Answer::store($language->id, $none, 0, 1);
                $answersIds [] = $answer->id;
            }

            if ($level == '1') {
                return $this->game($code, $level);
            } else {
                return $this->level(2, $language, $level, $request->noneOfThem[0], $answersIds, $answersIds[0]);
            }
        } else {
            Score::scoring(1, $language->id, $request->input('answer'), 0, 1);

            $answer = Answer::store($language->id, $request->input('answer'), 0, 1);
            if ($request->input('firstSentenceId') == $request->input('answer')) {
                $positiveAnswer = $request->input('secondSentenceId');
            } else {
                $positiveAnswer = $request->input('firstSentenceId');
            }
            Answer::store($language->id, $positiveAnswer, 1, 0);

            if ($level == '1') {
                return $this->game($code, $level);
            } else {
                return $this->level(2, $language, $level, $request->input('answer'), $answer->id, $answer->id);
            }
        }
    }

    /**
     * @throws ValidationException
     */
    public function answerLevel2(Request $request, $code, $level)
    {
        if (!$request->input('answer')) {
            return redirect()->route('index');
        }

        toastr()->info('Thank you for your answer!');
        $language = Language::where('lang_code', $code)->first();
        $answersIds = $request->input('answersIds');
        $answer = Answer::find($request->input('answerId'));
        $reasons = $request->input('answer');

        if (in_array('fine', $reasons)) {
            $answer->positive_answer = 1;
            $answer->negative_answer = 0;
            $answer->save();
        } else {
            foreach ($reasons as $reason) {
                AnswerDetail::store($language->id, $request->input('sentenceId'), $answer->id, $reason);
                Score::scoring(2, $language->id, $answer->id, null, null, $reason);
            }
        }

        // Check if there is more than one question and check if this is first, if so, let him answer on second question
        if (count($request->input('answer')) == 1 && $request->input('answer')[0] == 'lack of context and/or incomprehensible' && is_array($answersIds) && count($answersIds) > 1 && $answersIds[1] == $request->input('answerId')) {
            return $this->game($code, $level);
        } elseif (count($request->input('answer')) == 1 && $request->input('answer')[0] == 'lack of context and/or incomprehensible' && is_array($answersIds) && count($answersIds) > 1 && $answersIds[0] == $request->input('answerId')) {
            $sentenceAnswer = Answer::find($answersIds[1]);
            return $this->level(2, $language, $level, $sentenceAnswer->sentence_id, $answersIds, $answersIds[1]);
        } elseif (is_array($answersIds) && count($answersIds) > 1 && $level == '1+2+3') {
            $sentenceAnswer = Answer::find($request->input('answerId'));
            return $this->level(3, $language, $level, $sentenceAnswer->sentence_id, $answersIds, $request->input('answerId'));
        } elseif (is_array($answersIds) && count($answersIds) > 1 && $answersIds[0] == $request->input('answerId')) {
            $sentenceAnswer = Answer::find($answersIds[1]);
            return $this->level(2, $language, $level, $sentenceAnswer->sentence_id, $answersIds, $answersIds[1]);
        } else {
            if ($level == '2' || $level == '1+2' || ($level == '1+2+3' && $request->input('answer')[0] == 'lack of context and/or incomprehensible')) {
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


//        // Check if there is more than one question and check if this is first, if so, let him answer on second question
//        if (is_array($answersIds) && count($answersIds) > 1 && $answersIds[0] == $request->input('answerId')) {
//            $sentenceAnswer = Answer::find($answersIds[1]);
//            return $this->level(2, $language, $level, $sentenceAnswer->sentence_id, $answersIds, $answersIds[1]);
//        } else {
//            if ($level == '2' || $level == '1+2') {
//                return $this->game($code, $level);
//            } elseif ($level == '2+3' || $level == '1+2+3') {
//                if (is_array($answersIds)) {
//                    $sentenceAnswer = Answer::find($answersIds[0]);
//                    return $this->level(3, $language, $level, $sentenceAnswer->sentence_id, $answersIds, $answersIds[0]);
//                } else {
//                    $sentenceAnswer = Answer::find($answersIds);
//                    return $this->level(3, $language, $level, $sentenceAnswer->sentence_id, $answersIds, $answersIds);
//                }
//
//            }
//        }
    }

    public function answerLevel3(Request $request, $code, $level)
    {
        toastr()->info('Thank you for your answer!');
        $language = Language::where('lang_code', $code)->first();
        $answersIds = $request->input('answersIds');
        $answerId = $request->input('answerId');
        if ($request->input('fine')) {
            $answer = Answer::find($answerId);
            $answer->positive_answer = 1;
            $answer->negative_answer = 0;
            $answer->save();
        } else {
            Score::scoring(3, $language->id, $request->input('sentenceId'), null, null, null, $request->input('problematicWords'));
            $answerDetail = AnswerDetail::find($request->input('reasonId'));
            $answerDetail->sentence_bad_part = $request->input('problematicWords');
            $answerDetail->save();
        }

        $reasons = $request->input('reasons');
        $lastElement = end($reasons);
        // Check if there is more than one question and check if this is first, if so, let him answer on second question
        return $this->level3Reasons($reasons, $lastElement, $language, $level, $answersIds, $request, $code);
    }

    public function level3Reasons($reasons, $lastElement, $language, $level, $answersIds, $request, $code)
    {
        foreach ($reasons as $key => $value) {
            if ($value == $lastElement) {
                if (is_array($answersIds)) {
                    $lastElement = end($answersIds);
                    if ($lastElement == $request->input('answerId')) {
                        return $this->game($code, $level);
                    }
                } elseif (!is_array($answersIds)) {
                    return $this->game($code, $level);
                }

                $sentenceAnswer = Answer::find(is_array($answersIds) ? $answersIds[1] : $answersIds);
                return $this->level(2, $language, $level, $sentenceAnswer->sentence_id, $answersIds, is_array($answersIds) ? $answersIds[1] : $answersIds);
            } elseif ($value == $request->input('reasonId')) {
                $sentenceAnswer = Answer::find($request->input('answerId'));
                return $this->level(3, $language, $level, $sentenceAnswer->sentence_id, $answersIds, $request->input('answerId'), $reasons[$key + 1]);
            }
        }

        return null;
    }

    public function gamesInRow($langId)
    {
        if (Auth::guard('web')->user()) {
            $data = session()->get('playerData');
            if ($data === false) {
                session()->put('playerData', 0);
            } else {
                if ($data == 5) {
                    Score::store($langId, 5);
                    toastr()->info('You got 5 extra points!');
                    $data = 0;
                } else {
                    $data = $data + 1;
                }
                session()->put('playerData', $data);
            }
        }
    }
}

