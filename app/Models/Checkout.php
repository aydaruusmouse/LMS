<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'trx_id', 'sub_total', 'tax', 'discount', 'coupon_discount', 'total_amount', 'payable_amount', 'invoice_no', 'offline_method_id',
        'invoice_date', 'payment_type', 'payment_details', 'status', 'billing_address', 'shipping_address', 'shipping_cost', 'system_commission', 'organization_commission',
    ];

    protected $casts    = [
        'billing_address'  => 'array',
        'shipping_address' => 'array',
        'payment_details'  => 'array',
    ];

    public function enrolls(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Enroll::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedPaymentTypeAttribute(): string
    {
        return str_replace('_', ' ', ucwords($this->payment_type));
    }
}
