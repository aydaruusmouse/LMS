<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_name', 'slug', 'email', 'phone_country_id', 'phone', 'country_id', 'address', 'logo', 'org_media_id', 'brand_color', 'tin', 'license', 'person_name', 'about',
        'tagline', 'person_designation', 'person_email', 'person_country_id', 'person_phone', 'payment_method', 'payment_details', 'status', 'person_image', 'person_media_id',
    ];

    protected $casts    = [
        'logo'         => 'array',
        'person_image' => 'array',
    ];

    public function courses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function instructors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Instructor::class);
    }

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
