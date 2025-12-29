<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'image_media_id',
        'banner',
        'banner_media_id',
        'is_featured',
        'published_date',
        'is_newspaper',
        'status',
        'user_id',
        'blog_category_id',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'meta_image',
    ];

    protected $casts    = [
        'image'      => 'array',
        'banner'     => 'array',
        'meta_image' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function languages(): HasMany
    {
        return $this->hasMany(BlogLanguage::class);
    }

    public function language(): HasOne
    {
        return $this->hasOne(BlogLanguage::class)->where('lang', app()->getLocale());
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class);
    }

    public function getLangTitleAttribute()
    {
        return $this->language ? $this->language->title : $this->title;
    }

    public function getLangShortDescriptionAttribute()
    {
        return $this->language ? $this->language->short_description : $this->short_description;
    }

    public function getLangDescriptionAttribute()
    {
        return $this->language ? $this->language->description : $this->description;
    }
}
