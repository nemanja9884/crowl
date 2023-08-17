<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AnswerDetail extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'language_id', 'sentence_id', 'answer_id', 'reason', 'sentence_bad_part', 'created_at', 'updated_at'];

    public function answer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Answer::class, 'answer_id', 'id');
    }

    public static function store($langId, $sentenceId, $answerId, $reason)
    {
        $answerDetail = AnswerDetail::where(['answer_id' => $answerId, 'sentence_id' => $sentenceId, 'language_id' => $langId, 'reason' => $reason])->first();
        if (!$answerDetail) {
            return AnswerDetail::create([
                'language_id' => $langId,
                'sentence_id' => $sentenceId,
                'answer_id' => $answerId,
                'reason' => $reason,
            ]);
        }
    }

    public static function answerReasonCheck($langId, $sentenceId, $reason)
    {
        return AnswerDetail::where(['sentence_id' => $sentenceId, 'language_id' => $langId, 'reason' => $reason])->first();
    }

    public static function answerProblematicCheck($langId, $sentenceId, $badPart): bool
    {
        $badWords = explode('|', $badPart);
        $answerDetails = AnswerDetail::where(['sentence_id' => $sentenceId, 'language_id' => $langId])->get();
        foreach ($answerDetails as $item) {
            if ($item->sentence_bad_part) {
                $badWordsDb = explode('|', $item->sentence_bad_part);
                $check = array_intersect($badWords, $badWordsDb);
                if (!empty($check)) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function checkIfIsAnswered($answerId)
    {
       return AnswerDetail::where('answer_id', $answerId)->first();
    }

    public static function checkIfIsAnsweredLvl3($answerId)
    {
        return AnswerDetail::whereNotNull('sentence_bad_part')->where('id', $answerId)->first();
    }

    public static function compareLvl2Statistic($langId, $data): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|null
    {
        $user = Auth::guard('web')->user();
        // Count number of different answers
        $baseQuery = AnswerDetail::select('answer_id')->whereHas('answer', function($query) use($user, $data) {
            return $query->where('user_id', '!=', $user->id);
        })->where('sentence_id', $data['sentenceId'])->groupBy('answer_id');
        $count = $baseQuery->get()->count();
        $allAnswers = $baseQuery->get()->toArray();
        $sameAnswers = 0;
        foreach ($allAnswers as $answer) {
            $detail = AnswerDetail::select('reason')->where('answer_id', $answer['answer_id'])->get()->pluck('reason')->toArray();
            $differenceArray = array_diff($detail, $data['reasons']);
            if(empty($differenceArray)) {
                // It's same, so user get points, count how many users got the same answer
                $sameAnswers++;
            }
        }

        if ($sameAnswers > 0 && $count > 0) {
            $points = $sameAnswers / $count * 100;
            Score::store($langId, $points);
            return view('web.additional-message', ['message' => "$points% of the players have answered the same as you. You’ve got $points extra points!"]);
        } else {
            return null;
        }
    }

    public static function compareLvl3Statistic($langId, $data): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|null
    {
        $user = Auth::guard('web')->user();
        // Count number of different answers
        $baseQuery = AnswerDetail::select('answer_id', 'sentence_bad_part')->whereNotNull('sentence_bad_part')->where('reason', $data['reason'])->whereHas('answer', function($query) use($user, $data) {
            return $query->where('user_id', '!=', $user->id);
        })->where('sentence_id', $data['sentenceId']);
        $count = $baseQuery->get()->count();
        $allAnswers = $baseQuery->get()->toArray();
        $sameAnswers = 0;
        foreach ($allAnswers as $answer) {
            if($data['problematicWords'] == $answer['sentence_bad_part']) {
                // It's same, so user get points, count how many users got the same answer
                $sameAnswers++;
            }
        }

        if ($sameAnswers > 0 && $count > 0) {
            $points = $sameAnswers / $count * 100;
            Score::store($langId, $points);
            return view('web.additional-message', ['message' => "$points% of the players have answered the same as you. You’ve got $points extra points!"]);
        } else {
            return null;
        }
    }
}
