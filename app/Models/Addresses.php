<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'address', 'address_ids', 'country', 'state', 'city', 'latitude', 'longitude', 'postal_code', 'default_shipping', 'default_billing', 'user_id'];
}
