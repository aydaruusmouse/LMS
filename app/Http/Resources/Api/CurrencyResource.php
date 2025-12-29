<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => (int) $this->id,
            'name'          => $this->name,
            'symbol'        => $this->symbol,
            'code'          => $this->code,
            'exchange_rate' => number_format($this->exchange_rate, 3, '.', ''),
        ];
    }
}
