<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'percentage', 'status'];

    public function expertiseLanguage(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ExpertiseLanguage::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
