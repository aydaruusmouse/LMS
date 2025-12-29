<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    use HasFactory;

    protected $fillable = ['checkout_id', 'price', 'quantity', 'coupon_discount', 'discount', 'tax', 'shipping_cost', 'sub_total', 'enrollable_id', 'complete_details', 'complete_count', 'enrollable_type'];

    public function enrollable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function checkout(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Checkout::class);
    }
}
