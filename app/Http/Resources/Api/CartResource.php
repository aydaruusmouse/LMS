<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request): array
    {
        $currency = $request->currency ?: null;
        $row      = [
            'id'               => (int) $this->id,
            'thumbnail'        => getFileLink('417x384', $this->cartable->image),
            'title'            => $this->cartable->title,
            'is_free'          => (bool) $this->is_free,
            'price'            => $this->is_free ? __('free') : get_price($this->price, $currency),
            'is_discounted'    => $this->cartable->is_discount,
            'discount_type'    => nullCheck($this->cartable->discount_type),
            'discounted_price' => get_price($this->cartable->discount_amount, $currency),
            'type'             => $this->cartable_type == 'App\Models\Course' ? 'course' : 'book',
            'coupon_applied'   => $this->coupon_discount > 0,
            'coupon_code'      => nullCheck(@$this->coupon->code),
        ];

        if ($this->cartable_type == 'App\Models\Course') {
            $row['total_lessons'] = $this->cartable->lessons()->count();
            $row['total_enrolls'] = $this->cartable->enrolls()->count();
            $row['course_id']     = $this->cartable->id;

        }

        return $row;
    }
}
