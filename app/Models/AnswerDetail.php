<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerDetail extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'language_id', 'answer_id', 'reason', 'sentence_bad_part', 'created_at', 'updated_at'];

    public static function store($langId, $answerId, $reason)
    {
//        $user = Auth::guard('web')->user();
//        $answer = Answer::where(['sentence_id' => $sentenceId, 'language_id' => $langId]);
//        if ($user) {
//            $answer->where('user_id', $user->id);
//        } else {
//            $answer->where('ip_address', Request()->ip());
//        }
//
//        $answer = $answer->first();
        return AnswerDetail::create([
            'language_id' => $langId,
            'answer_id' => $answerId,
            'reason' => $reason,
        ]);
    }
}
