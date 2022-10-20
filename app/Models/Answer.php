<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'language_id', 'sentence_id', 'user_id', 'ip_address', 'positive_answer', 'negative_answer', 'created_at', 'updated_at'];

    public function answersDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AnswerDetail::class);
    }

    public static function store($langId, $sentenceId, $positiveAnswer, $negativeAnswer)
    {
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

            self::checkSentenceDiff($sentenceId);

            return $answer;
        } else {
            return $answer;
        }
    }

    public static function checkSentenceDiff($sentenceId)
    {
        $positiveAnswers = DB::select(DB::raw("SELECT sum(positive_answer) as positive_answer from answers where sentence_id = $sentenceId"));
        $negativeAnswers = DB::select(DB::raw("SELECT sum(negative_answer) as negative_answer from answers where sentence_id = $sentenceId"));
        $answersDiff = abs($positiveAnswers[0]->positive_answer - $negativeAnswers[0]->negative_answer);
        if($answersDiff >= 3) {
            Sentence::where('id', $sentenceId)->update(['finished' => 1]);
        }
    }
}
