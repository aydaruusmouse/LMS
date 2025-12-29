<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'lang',
        'title',
    ];
}
