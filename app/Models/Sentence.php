<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'language_id', 'sentence', 'positive_answers', 'negative_answers', 'total_answers', 'word_reliability', 'external_id', 'created_at', 'updated_at'];

    public function answers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function scopeFinished($query, $value)
    {
        return $query->where('finished', $value);
    }
}
