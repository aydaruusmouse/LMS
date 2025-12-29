<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKeyLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['api_key_id', 'title', 'lang'];
}
