<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'body', 'instructor_signature', 'instructor_signature_media_id', 'administrator_signature', 'administrator_signature_media_id', 'background_image', 'background_image_media_id'];

    protected $casts    = [
        'instructor_signature'    => 'array',
        'administrator_signature' => 'array',
        'background_image'        => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
