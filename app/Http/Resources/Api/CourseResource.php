<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request): array
    {
        $currency_code = $request->currency ?: null;

        return [
            'id'               => (int) $this->id,
            'thumbnail'        => getFileLink('402x248', $this->image),
            'title'            => $this->title,
            'total_lessons'    => $this->lessons_count,
            'total_enrolls'    => $this->enrolls_count,
            'is_free'          => (bool) $this->is_free,
            'total_rating'     => number_format($this->reviews_avg_rating, 2),
            'price'            => $this->is_free ? __('free') : get_price($this->price, $currency_code),
            'is_discounted'    => $this->is_discount,
            'discount_type'    => nullCheck($this->discount_type),
            'discounted_price' => get_price($this->discount_amount, $currency_code),
            'status'           => $this->is_published == 1 ? __('active') : __('inactive'),
        ];
    }
}
