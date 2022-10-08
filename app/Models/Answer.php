<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'language_id', 'sentence_id', 'user_id', 'ip_address', 'positive_answer', 'negative_answer', 'negative_reasons', 'sentence_bad_part', 'created_at', 'updated_at'];

    public static function store($langId, $sentenceId, $positiveAnswer, $negativeAnswer)
    {
        $user = Auth::guard('web')->user();
        return Answer::create([
            'language_id' => $langId,
            'sentence_id' => $sentenceId,
            'user_id' => $user?->id,
            'ip_address' => Request()->ip(),
            'positive_answer' => $positiveAnswer,
            'negative_answer' => $negativeAnswer,
        ]);
    }
}
