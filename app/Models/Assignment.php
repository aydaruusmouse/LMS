<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'file', 'file_media_id', 'deadline', 'course_id', 'instructor_id', 'section_id', 'lesson_id', 'total_marks', 'pass_marks', 'is_free', 'status'];

    protected $casts    = [
        'file' => 'array',
    ];

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function media(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MediaLibrary::class, 'file_media_id');
    }

    public function instructor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function section(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function lesson(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeCourseAssignment($query)
    {
        return $query->whereHas('course', function ($query) {
            $query->whereHas('enrolls.checkout', function ($query) {
                $query->where('user_id', auth()->id());
            });
        });
    }
}
