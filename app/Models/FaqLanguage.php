<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['faq_id', 'lang', 'question', 'answer'];
}
