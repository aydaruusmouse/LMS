<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedCoupon extends Model
{
    use HasFactory;

    protected $fillable = ['instructor_id', 'user_id', 'trx_id', 'coupon_id', 'couponable_id', 'couponable_type', 'coupon_discount', 'status'];

    public function coupon(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }
}
