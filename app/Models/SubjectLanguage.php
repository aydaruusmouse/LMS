<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'lang', 'subject_id', 'meta_title', 'meta_keywords', 'meta_description'];

    protected $casts    = [
        'meta_image' => 'array',
    ];
}
