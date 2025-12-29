<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request): array
    {
        $row = [
            'id'               => (int) $this->id,
            'thumbnail'        => getFileLink('320x320', $this->thumbnail),
            'title'            => $this->title,
            'price'            => $this->is_free ? __('free') : number_format($this->price, 3, '.', ''),
            'is_free'          => (bool) $this->is_free,
            'total_rating'     => number_format($this->reviews_avg_rating, 2),
            'is_discounted'    => $this->is_discount,
            'discount_type'    => nullCheck($this->discount_type),
            'discounted_price' => number_format($this->discount_amount, 3, '.', ''),
        ];
        if ($this->relationLoaded('instructor')) {
            $row['published_by'] = $this->instructor->name;
        }

        return $row;
    }
}
