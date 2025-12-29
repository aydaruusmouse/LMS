<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'lang', 'title', 'content', 'meta_title', 'meta_keywords', 'meta_description'];
}
