<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'lesson_type', 'course_id', 'section_id', 'source', 'source_data', 'order_no', 'duration', 'description', 'image', 'image_media_id', 'is_free', 'status'];

    protected $casts    = [
        'image'       => 'array',
        'source_data' => 'array',
    ];

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function section(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function progress(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CourseProgress::class)->where('user_id', authUser() ? authUser()->id : 0);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
