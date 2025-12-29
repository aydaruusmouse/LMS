<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'media_id',
        'image',
        'status',
    ];

    protected $casts    = [
        'image' => 'array',
    ];

    public function languages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TestimonialLanguage::class);
    }

    public function language(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TestimonialLanguage::class)->where('lang', app()->getLocale());
    }

    public function getLangNameAttribute()
    {
        return $this->language ? $this->language->name : $this->name;
    }

    public function getLangDescriptionAttribute()
    {
        return $this->language ? $this->language->description : $this->description;
    }
}
