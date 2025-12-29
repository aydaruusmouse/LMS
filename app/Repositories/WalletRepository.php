<?php

namespace App\Repositories;

use App\Models\Wallet;
use App\Traits\ImageTrait;
use App\Traits\PaymentTrait;
use App\Traits\SendNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Support\Facades\DB;

class WalletRepository
{
    use ImageTrait,PaymentTrait,SendNotification;

    public function all($data = [], $with = [])
    {
        if (! arrayCheck('paginate', $data)) {
            $data['paginate'] = setting('paginate');
        }

        return Wallet::with($with)->when(arrayCheck('user_id', $data), function ($query) {
            $query->where('user_id', auth()->id());
        })->latest()->paginate($data['paginate']);
    }

    public function store($data, $amount, $source, $payment_details)
    {
        return Wallet::create([
            'user_id'           => auth()->id(),
            'walletable_id'     => null,
            'walletable_type'   => null,
            'amount'            => $amount,
            'source'            => $source,
            'type'              => $data['type'],
            'payment_method'    => $data['payment_type'],
            'payment_details'   => $payment_details,
            'trx_id'            => getArrayValue('trx_id', $data),
            'offline_method_id' => getArrayValue('offline_method_id', $data),
            'status'            => $data['status'],
        ]);
    }

    public function updateWallet($user, $amount, $type)
    {
        if ($type == 1) {
            $user->balance += $amount;
        } else {
            $user->balance -= $amount;
        }

        $user->save();

        return $user;
    }

    public function walletRecharge($data): array|string|Translator|Application|null
    {
        $source          = 'wallet_recharge';
        $amount          = arrayCheck('total', $data) ? $data['total'] : $data['amount'];
        $payment_details = [];

        if (arrayCheck('offline_method_id', $data)) {
            $source = 'offline_recharge';
            if (arrayCheck('offline_method_file', $data)) {
                $storage         = setting('default_storage') == 'aws_s3' ? 'aws_s3' : 'local';
                $fileName        = time().'.'.$data['offline_method_file']->extension();
                $data['offline_method_file']->move(public_path('images/wallets/'), $fileName);

                $payment_details = [
                    'storage' => $storage,
                    'image'   => 'images/wallets/'.$fileName,
                ];
            }
        } else {
            $payment_details = $this->methodCheck($data);
            if (! $this->successStatusCheck($data, $payment_details)) {
                return __('transaction_cant_be_completed');
            }
        }
        $data['type']    = 'income';
        $data['status']  = 0;
        $this->store($data, $this->amountCalculator($amount, $payment_details, $data), $source, $payment_details);

        $repo            = new UserRepository();

        $this->sendNotification($repo->find(1), 'New Wallet Request Is Created.', 'success', url('wallet/recharge-requests'), '');

        return $payment_details;
    }

    protected function amountCalculator($amount, $payment_details, $data)
    {
        $currency        = new CurrencyRepository();
        $active_currency = $currency->currencyByCode(userCurrency());
        $amount          = $amount / $active_currency->exchange_rate;

        if (array_key_exists('payment_type', $payment_details) && $payment_details['payment_type'] == 'aamarpay') {
            $token                = DB::table('payment_methods')->where('trx_id', $data['opt_b'])->first();
            $data['payment_type'] = 'aamarpay';
            $amount               = $token->amount;
        }

        return $amount;
    }

    public function changeStatus($data)
    {
        $wallet         = Wallet::find($data['id']);
        $wallet->status = $data['status'];
        $wallet->save();

        $this->updateWallet($wallet->user, $wallet->amount, $data['status']);

        return $wallet;
    }
}
