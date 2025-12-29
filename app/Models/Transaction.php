<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'type', 'payment_method', 'come_from', 'description', 'file', 'amount', 'payment_details', 'trx_id', 'date', 'transactionable_id', 'transactionable_type', 'status'];
}
