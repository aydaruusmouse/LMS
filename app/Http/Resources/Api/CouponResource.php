<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'image'         => getFileLink('72x72', $this->image),
            'title'         => $this->coupon_title ?: $this->title,
            'code'          => $this->code,
            'discount'      => $this->discount,
            'discount_type' => $this->discount_type,
            'end_date'      => Carbon::parse($this->end_date)->format('d M Y'),
        ];
    }
}
