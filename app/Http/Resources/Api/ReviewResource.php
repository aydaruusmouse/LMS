<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'      => (int) $this->id,
            'rating'  => number_format($this->rating, 2),
            'date'    => Carbon::parse($this->created_at)->format('d M Y'),
            'comment' => $this->comment,
            'status'  => (bool) $this->status,
            'user'    => [
                'id'    => (int) $this->user_id,
                'name'  => $this->user->name,
                'image' => $this->user->profile_pic,
            ],
        ];
    }
}
