<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        if(!$answerDetail) {
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
            if($item->sentence_bad_part) {
                $badWordsDb = explode('|', $item->sentence_bad_part);
                $check = array_intersect($badWords,$badWordsDb);
                if(!empty($check)) {
                    return true;
                }
            }
        }

        return false;
    }
}
