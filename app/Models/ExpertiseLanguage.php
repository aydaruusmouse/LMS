<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertiseLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['expertise_id', 'lang', 'title'];
}
