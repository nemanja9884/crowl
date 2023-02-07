<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'language_id', 'points'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public static function scoring($level, $langId, $sentenceId, $positiveAnswer = null, $negativeAnswer = null, $reason = null, $problematicWords = null)
    {
        if(!Auth::guard('web')->user()) {
            return false;
        }

        switch ($level) {
            case '1':
                $checkAnswer = Answer::answerCheck($langId, $sentenceId, $positiveAnswer, $negativeAnswer);
                if ($checkAnswer) {
                    self::store($langId);
                }
                break;
            case '2':
                $checkAnswer = AnswerDetail::answerReasonCheck($langId, $sentenceId, $reason);
                if ($checkAnswer) {
                    self::store($langId);
                }
                break;
            case '3':
                $checkAnswer = AnswerDetail::answerProblematicCheck($langId, $sentenceId, $problematicWords);
                if ($checkAnswer) {
                    self::store($langId);
                }
                break;
        }

    }

    public static function store($langId, $points = 1)
    {
        $userId = Auth::guard('web')->user()->id;
        Score::create(['user_id' => $userId, 'language_id' => $langId, 'points' => $points]);
    }
}
