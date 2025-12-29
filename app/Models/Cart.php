<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['instructor_id', 'user_id', 'quantity', 'price', 'discount', 'trx_id', 'coupon_id', 'coupon_discount', 'tax', 'sub_total', 'total_amount', 'cartable_id', 'cartable_type', 'is_buy_now'];

    public function cartable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function coupon(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    protected $casts    = [
        'instructor_id' => 'array',
    ];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class, 'trx_id', 'trx_id');
    }
}
