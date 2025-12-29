<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'user_id', 'instructor_id', 'organization_id', 'category_ids', 'available_format', 'price', 'publication', 'current_stock', 'description', 'organization_id', 'total_rating',
        'specification', 'thumbnail', 'discount_type', 'discount', 'discount_start_at', 'discount_end_at', 'deleted_at', 'is_free', 'subject_id', 'meta_title', 'meta_keywords', 'meta_description', 'meta_image', 'status',
    ];

    public function instructor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function organization(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function wishlists(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Wishlist::class, 'wishable');
    }

    public function reviews(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Rating::class, 'commentable');
    }

    public function carts(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Cart::class, 'cartable');
    }

    public function enrolls(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Enroll::class, 'enrollable');
    }

    public function getIsDiscountAttribute(): bool
    {
        return $this->is_free != 1 && $this->discount > 0 && $this->discount_start_at <= now() && $this->discount_end_at >= now();
    }

    public function getDiscountAmountAttribute()
    {
        $amount = 0;

        if ($this->is_discount) {
            $type = $this->discount_type;

            if ($type == 'flat') {
                $amount = $this->price - $this->discount;
            } else {
                $amount = $this->price - ($this->price * ($this->discount / 100));
            }
        }

        return $amount;
    }

    public function getDiscountCheckAttribute()
    {
        $amount = 0;

        if ($this->is_discount) {
            $type = $this->discount_type;

            if ($type == 'flat') {
                $amount = $this->discount;
            } else {
                $amount = $this->price * ($this->discount / 100);
            }
        }

        return $amount;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
