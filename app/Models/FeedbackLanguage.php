<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'lang', 'description', 'feedback_id'];
}
