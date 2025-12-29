<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeScreen extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'section',  'contents', 'media_id_1', 'image_1', 'media_id_2', 'image_2', 'position'];

    protected $casts    = [
        'contents' => 'array',
        'image_1'  => 'array',
        'image_2'  => 'array',
    ];
}
