<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerDetail extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'language_id', 'answer_id', 'reason', 'sentence_bad_part', 'created_at', 'updated_at'];

    public function answer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Answer::class, 'answer_id', 'id');
    }

    public static function store($langId, $answerId, $reason)
    {
        $answerDetail = AnswerDetail::where(['answer_id' => $answerId, 'language_id' => $langId, 'reason' => $reason])->first();
        if(!$answerDetail) {
            return AnswerDetail::create([
                'language_id' => $langId,
                'answer_id' => $answerId,
                'reason' => $reason,
            ]);
        }
    }
}
