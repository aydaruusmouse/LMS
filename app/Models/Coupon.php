<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'type', 'code', 'image', 'coupon_media_id', 'discount_type', 'discount', 'start_date', 'end_date', 'course_ids', 'category_ids',
        'instructor_ids', 'user_id', 'status',
    ];

    protected $casts    = [
        'course_ids'     => 'array',
        'instructor_ids' => 'array',
        'category_ids'   => 'array',
        'image'          => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function appliedCoupons(): HasMany
    {
        return $this->hasMany(AppliedCoupon::class);
    }

    public function languages(): HasMany
    {
        return $this->hasMany(CouponLanguage::class);
    }

    public function language(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CouponLanguage::class)->where('lang', app()->getLocale());
    }

    public function getLangTitleAttribute()
    {
        return $this->language ? $this->language->title : $this->title;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
