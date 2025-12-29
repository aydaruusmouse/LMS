<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class MyMeetingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'             => (int) $this->id,
            'title'          => $this->title,
            'class_date'     => $this->class_date,
            'meeting_method' => $this->meeting_method,
            'description'    => $this->description,
            'meeting_link'   => $this->meeting_link,
            'meeting_id'     => $this->meeting_id,
            'end_at'         => $this->end_at,
            'start_at'       => $this->start_at,
            'is_free'        => $this->is_free,

        ];
    }
}
