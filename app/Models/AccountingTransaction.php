<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'account_id',
        'bank_account_id',
        'type',
        'date',
        'payment_method',
        'amount',
        'description',
        'file',
        'reference',
        'transaction_id',
        'transactionable_id',
        'transactionable_type',
        'created_by',
        'updated_by',
    ];

    public function account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function bankAccount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BankAccount::class, 'bank_account_id');
    }
}
