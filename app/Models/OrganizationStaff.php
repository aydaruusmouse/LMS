<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationStaff extends Model
{
    use HasFactory;

    protected $table    = 'organization_staff';

    protected $casts    = [
        'social_links' => 'array',
        'expertises'   => 'array',
    ];

    protected $fillable = ['user_id', 'organization_id', 'designation', 'expertises', 'social_links', 'slug', 'website'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
