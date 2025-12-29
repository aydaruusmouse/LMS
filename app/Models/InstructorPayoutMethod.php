<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorPayoutMethod extends Model
{
    use HasFactory;

    protected $fillable = ['instructor_id', 'payout_method', 'value', 'status', 'is_default'];

    protected $casts    = [
        'value' => 'array',
    ];
}
