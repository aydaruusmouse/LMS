<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleCourse extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'organization_id', 'instructor_id', 'course_ids', 'is_free', 'price', 'discount', 'discount_type', 'discount_period', 'status', 'image', 'bundle_media_id'];
}
