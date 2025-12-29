<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'type', 'link', 'email', 'phone', 'meta_title', 'meta_keywords', 'meta_description', 'meta_image_id', 'meta_image', 'status'];

    protected $casts    = [
        'meta_image' => 'array',
    ];

    public function language(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PageLanguage::class)->where('lang', app()->getLocale());
    }

    public function getLangTitleAttribute()
    {
        return $this->language ? $this->language->title : $this->title;
    }

    public function getLangContentAttribute()
    {
        return $this->language ? $this->language->content : $this->content;
    }
}
