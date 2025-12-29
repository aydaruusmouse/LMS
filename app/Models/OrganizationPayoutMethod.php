<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationPayoutMethod extends Model
{
    use HasFactory;

    protected $fillable = ['organization_id', 'payout_method', 'value', 'is_default', 'user_id',  'status'];

    protected $casts    = [
        'value' => 'array',
    ];
}
