<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategoryLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'lang', 'blog_category_id', 'meta_title', 'meta_keywords', 'meta_description', 'meta_image'];
}
