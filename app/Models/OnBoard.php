<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnBoard extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'onboard_media_id',  'is_skipable', 'status'];

    protected $casts    = [
        'image' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
