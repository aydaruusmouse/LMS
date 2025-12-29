<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['logo', 'brand_media_id', 'order_no', 'status'];

    protected $casts    = [
        'logo' => 'array',
    ];
}
