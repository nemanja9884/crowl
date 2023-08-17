<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use App\Traits\CacheSystem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Answer extends Model
{
    use HasFactory, CacheSystem;

    protected $fillable = ['id', 'language_id', 'sentence_id', 'user_id', 'ip_address', 'positive_answer', 'negative_answer', 'created_at', 'updated_at'];

    public function answersDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AnswerDetail::class);
    }

    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function sentence(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sentence::class, 'sentence_id', 'id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function store($langId, $sentenceId, $positiveAnswer, $negativeAnswer)
    {
        // For case if user just refresh page, we do not want to get 2 same answers from him
        $user = Auth::guard('web')->user();
        $answer = Answer::where(['sentence_id' => $sentenceId, 'language_id' => $langId]);
        if ($user) {
            $answer->where('user_id', $user->id);
        } else {
            $answer->where('ip_address', Request()->ip());
        }

        $answer = $answer->first();
        if (!$answer) {
            $answer = Answer::create([
                'language_id' => $langId,
                'sentence_id' => $sentenceId,
                'user_id' => $user?->id,
                'ip_address' => Request()->ip(),
                'positive_answer' => $positiveAnswer,
                'negative_answer' => $negativeAnswer,
            ]);

            (new Answer)->checkSentenceDiff($sentenceId);

            return $answer;
        } else {
            return $answer;
        }
    }

    public function checkSentenceDiff($sentenceId)
    {
        $settings = $this->getSettings();
        $positiveAnswers = DB::select(DB::raw("SELECT sum(positive_answer) as positive_answer from answers where sentence_id = $sentenceId and user_id is not null"));
        $negativeAnswers = DB::select(DB::raw("SELECT sum(negative_answer) as negative_answer from answers where sentence_id = $sentenceId and user_id is not null"));
        $answersDiff = abs($positiveAnswers[0]->positive_answer - $negativeAnswers[0]->negative_answer);
        if ($answersDiff >= $settings->finished_ration ?? 3) {
            Sentence::where('id', $sentenceId)->update(['finished' => 1, 'returned' => 0]);
        }
    }

    public static function answerCheck($langId, $sentenceId, $positiveAnswer, $negativeAnswer)
    {
        return Answer::where(['language_id' => $langId, 'sentence_id' => $sentenceId, 'positive_answer' => $positiveAnswer, 'negative_answer' => $negativeAnswer])->first();
    }

    public static function checkIfIsAnswered($sentenceId)
    {
        $user = Auth::guard('web')->user();
        $answer = Answer::where(['sentence_id' => $sentenceId]);
        if ($user) {
            $answer->where('user_id', $user->id);
        } else {
            $answer->where('ip_address', Request()->ip());
        }

        return $answer->first();
    }

    public static function compareLvl1Statistic($langId, $data): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|null
    {
        $user = Auth::guard('web')->user();
        $allAnswers = Answer::where('user_id', '!=', $user->id)->where('negative_answer', 1)->where('sentence_id', $data['sentenceId'])->count();
        $sameAsUserAnswers = Answer::where('user_id', '!=', $user->id)->where('positive_answer', $data['positiveAnswer'])->where('negative_answer', $data['negativeAnswer'])->where('sentence_id', $data['sentenceId'])->count();

        if ($allAnswers > 0 && $sameAsUserAnswers > 0) {
            $points = $sameAsUserAnswers / $allAnswers * 100;
            Score::store($langId, $points);
            return view('web.additional-message', ['message' => "$points% of the players have answered the same as you. You’ve got $points extra points!"]);
        } else {
            return null;
        }
    }
}
