<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sentence extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'language_id', 'sentence', 'positive_answers', 'negative_answers', 'total_answers', 'word_reliability', 'source_toknum', 'source_id', 'external_id', 'finished', 'returned', 'created_at', 'updated_at'];

    public function answers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function scopeFinished($query, $value)
    {
        return $query->where('finished', $value);
    }
}
