<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        $created_at = Carbon::parse($this->created_at);

        return [
            'id'    => (int) $this->id,
            'title' => $this->title,
            'date'  => $created_at->isToday() ? $created_at->format('h:i A') : $created_at->format('d M, Y'),
        ];
    }
}
