<?php

namespace App\Traits;

use App\Models\Account;
use App\Models\AccountingTransaction;
use App\Models\BankAccount;
use Carbon\Carbon;

trait AccountingTrait
{
    use RandomStringTrait;

    protected function balanceCalculator($data, $type)
    {
        if (arrayCheck('account_id', $data) || arrayCheck('bank_account_id', $data)) {
            if (arrayCheck('account_id', $data)) {
                $account = Account::find($data['account_id']);
            } else {
                $account = BankAccount::find($data['bank_account_id']);
            }
        } else {
            $account = Account::where('default_for', $type)->first();

            if (! $account) {
                $account = Account::where('type', $type)->first();
            }
        }

        //        $account->balance += $data['amount'];
        //        $account->save();

        return $account;
    }

    protected function income($data)
    {
        $account                = $this->balanceCalculator($data, 'income');
        if ($data['account_type'] == 'cash') {
            $data['account_id'] = $account->id;
        } else {
            $data['bank_account_id'] = $account->id;
        }
        $data['type']           = 'income';
        $data['date']           = arrayCheck('date', $data) ? Carbon::parse($data['date'])->format('Y-m-d H:i:s') : date('Y-m-d H:i:s');
        $data['payment_method'] = 'Cash';
        $data['created_by']     = auth()->id();
        $data['updated_by']     = auth()->id();
        $data['transaction_id'] = '#'.$this->generate_random_string(10);

        return AccountingTransaction::create($data);
    }

    protected function expense($data)
    {
        $account                = $this->balanceCalculator($data, 'expense');
        if ($data['account_type'] == 'cash') {
            $data['account_id'] = $account->id;
        } else {
            $data['bank_account_id'] = $account->id;
        }
        $data['type']           = 'expense';
        $data['date']           = arrayCheck('date', $data) ? Carbon::parse($data['date'])->format('Y-m-d H:i:s') : date('Y-m-d H:i:s');
        $data['payment_method'] = 'Cash';
        $data['created_by']     = auth()->id();
        $data['updated_by']     = auth()->id();
        $data['account_id']     = $account->id;
        $data['transaction_id'] = $this->generate_random_string(10);

        return AccountingTransaction::create($data);
    }
}
