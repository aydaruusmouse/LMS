<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'lang', 'category_id', 'meta_title', 'meta_keywords', 'meta_description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
