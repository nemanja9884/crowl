<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'points'];

    public static function scoring($level, $langId, $sentenceId, $positiveAnswer = null, $negativeAnswer = null, $reason = null, $problematicWords = null)
    {
        if(!Auth::guard('web')->user()) {
            return false;
        }

        switch ($level) {
            case '1':
                $checkAnswer = Answer::answerCheck($langId, $sentenceId, $positiveAnswer, $negativeAnswer);
                if ($checkAnswer) {
                    self::store();
                }
                break;
            case '2':
                $checkAnswer = AnswerDetail::answerReasonCheck($langId, $sentenceId, $reason);
                if ($checkAnswer) {
                    self::store();
                }
                break;
            case '3':
                $checkAnswer = AnswerDetail::answerProblematicCheck($langId, $sentenceId, $problematicWords);
                if ($checkAnswer) {
                    self::store();
                }
                break;
        }

    }

    public static function store()
    {
        $userId = Auth::guard('web')->user()->id;
        $check = Score::where('user_id', $userId)->first();
        if($check) {
            Score::where('user_id', $userId)
                ->update([
                    'points'=> DB::raw('points+1'),
                ]);
        } else {
            Score::create(['user_id' => $userId, 'points' => 1]);
        }
    }
}
