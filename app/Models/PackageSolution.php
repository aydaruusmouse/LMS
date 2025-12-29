<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageSolution extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'validity', 'upload_limit', 'add_limit', 'bundle', 'facilities', 'status'];
}
