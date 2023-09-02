<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Fragment extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $translatable = ['text'];

    protected $fillable = ['text'];

    public static function getGroup(string $group, string $locale): array
    {
        return static::query()->where('key', 'LIKE', "{$group}.%")->get()
            ->map(function (Fragment $fragment) use ($locale, $group) {

                $key = preg_replace("/{$group}\\./", '', $fragment->key, 1);
                $text = $fragment->translate('text', $locale);

                return compact('key', 'text');

            })
            ->pluck('text', 'key')
            ->toArray();
    }
}
