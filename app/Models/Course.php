<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'short_description', 'user_id', 'organization_id', 'instructor_ids', 'category_id', 'course_type', 'language_id', 'description', 'is_private', 'video_source', 'video', 'image', 'image_media_id', 'duration',
        'is_downloadable', 'is_free', 'price', 'is_discountable', 'discount_type', 'discount', 'discount_start_at', 'discount_end_at', 'is_featured', 'deleted_at', 'tags', 'level_id', 'total_enrolled', 'subject_id',
        'is_renewable', 'renew_after', 'meta_title', 'meta_keywords', 'meta_description', 'meta_image', 'status', 'is_published', 'total_rating', 'total_lesson', 'capacity', 'class_ends_at',
    ];

    protected $casts    = [
        'instructor_ids' => 'array',
        'video'          => 'array',
        'image'          => 'array',
        'meta_image'     => 'array',
        'tags'           => 'array',
        'status'         => 'string',
    ];

    public function sections(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Section::class)->orderBy('order_no');
    }

    public function lessons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('order_no');
    }

    public function resources(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Resource::class)->orderBy('order_no');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function organization(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function level(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function subject(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function instructor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviews(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Rating::class, 'commentable')->where('status', 1);
    }

    public function carts(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Cart::class, 'cartable');
    }

    public function wishlists(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Wishlist::class, 'wishable');
    }

    public function enrolls(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Enroll::class, 'enrollable');
    }

    public function slider(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Slider::class, 'sliderable');
    }

    public function faqs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Faq::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'course_id');
    }

    public function certificate(): \Illuminate\Database\Eloquent\Relations\hasOne
    {
        return $this->hasOne(Certificate::class, 'course_id', 'id');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function progresses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseProgress::class);
    }

    public function getProgressAttribute()
    {
        $complete_percentage = 0;
        $total_lessons       = $this->lessons_count * 100;
        $progress            = $this->progresses_sum_progress;

        if ($total_lessons > 0) {
            $complete_percentage = round(($progress / $total_lessons) * 100, 2);
        }

        return min($complete_percentage, 100);
    }

    public function getCompletePercentageAttribute()
    {
        return $this->id * 20;
    }

    public function getIsDiscountAttribute(): bool
    {
        return $this->is_free != 1 && $this->is_discountable == 1 && $this->discount > 0 && $this->discount_start_at <= now() && $this->discount_end_at >= now();
    }

    public function getDiscountAmountAttribute()
    {
        $amount = $this->price;

        if ($this->is_discount) {
            $type = $this->discount_type;

            if ($type == 'amount') {
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

            if ($type == 'amount') {
                $amount = $this->discount;
            } else {
                $amount = $this->price * ($this->discount / 100);
            }
        }

        return $amount;
    }

    public function scopeActive($query)
    {
        return $query->where('is_published', 1)->where('status', 'approved');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }
}
