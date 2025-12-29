<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        $token    = substr($request->header('authorization'), 7);
        $trx_id   = $this->checkout->trx_id;
        $currency = $request->currency ?: null;

        return [
            'id'           => (int) $this->checkout_id,
            'payment_type' => (string) $this->checkout->payment_type,
            'title'        => $this->enrollable->title,
            'invoice_link' => url("api/user/invoice-download?trx_id=$trx_id&token=$token"),
            'amount'       => get_price($this->checkout->payable_amount, $currency),
            'created_at'   => Carbon::parse($this->checkout->created_at)->format('d M Y h:i A'),
        ];
    }
}
