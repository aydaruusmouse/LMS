<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'sub_title', 'source', 'btn_text', 'media_id', 'image', 'sliderable_type', 'sliderable_id', 'order_no', 'status', 'url'];

    protected $casts    = [
        'image' => 'array',
    ];

    public function sliderable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function language(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SliderLanguage::class)->where('lang', app()->getLocale());
    }

    public function getLangTitleAttribute()
    {
        return $this->language ? $this->language->title : $this->title;
    }

    public function getLangSubTitleAttribute()
    {
        return $this->language ? $this->language->sub_title : $this->sub_title;
    }

    public function getLangBtnTextAttribute()
    {
        return $this->language ? $this->language->btn_text : $this->btn_text;
    }
}
