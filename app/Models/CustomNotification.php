<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'image_media_id',
        'role_ids',
        'action_for',
        'instructor_id',
        'category_id',
        'course_id',
        'organization_id',
        'student_id',
        'blog_id',
        'subject_id',
        'book_id',
        'open_from',
        'status',
    ];

    protected $casts    = [
        'role_ids' => 'array',
        'image'    => 'array',
    ];
}
