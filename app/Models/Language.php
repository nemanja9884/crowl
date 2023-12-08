<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'intro', 'additional_info_content', 'lang_code', 'content', 'image', 'status', 'sort', 'created_at', 'updated_at'];
}
