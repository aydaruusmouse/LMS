<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessStoryLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['success_story_id', 'title', 'lang', 'description'];
}
