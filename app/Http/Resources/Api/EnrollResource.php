<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class EnrollResource extends JsonResource
{
    public function toArray($request): array
    {
        $currency = $request->currency ?: null;

        return [
            'id'        => (int) $this->id,
            'title'     => @$this->enrollable->title,
            'price'     => get_price($this->price, $currency),
            'quantity'  => (int) $this->quantity,
            'sub_total' => get_price($this->sub_total, $currency),
        ];
    }
}
