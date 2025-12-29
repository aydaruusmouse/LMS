<tr>
    <td>{{ $wallets->firstItem() + $key }}</td>
    <td>{{ ucwords(str_replace('_',' ',$wallet->source)) }}</td>
    <td>{{ \Carbon\Carbon::parse($wallet->created_at)->format('d-m-Y h:i a') }}</td>
    <td>{{ $wallet->trx_id }}</td>
    <td>{{ ucwords(str_replace('_','',$wallet->payment_method)) }}</td>
    <td @class([
        'text-success'  => $wallet->type == 'income',
        'text-danger'   => $wallet->type == 'expense',
])>{{ get_price($wallet->amount, userCurrency()) }}</td>
    <td @class([
                                                    'text-success' => $wallet->status == 1,
                                                    'text-danger' => $wallet->status == 2,
                                                    'text-warning' => $wallet->status == 0,
                                                ])>{{ $wallet->status == 1 ? __('approved') :($wallet->status == 2 ? __('rejected') : __('pending')) }}</td>
</tr>
