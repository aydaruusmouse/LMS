<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'short_description', 'description', 'blog_id', 'lang', 'tags', 'meta_title', 'meta_keywords', 'meta_description'];
}
