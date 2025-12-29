<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['level_id', 'lang', 'title'];
}
