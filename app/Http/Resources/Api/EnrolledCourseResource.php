<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrolledCourseResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'             => (int) $this->enrollable_id,
            'thumbnail'      => getFileLink('402x248', $this->enrollable->image),
            'title'          => $this->enrollable->title,
            'purchased_date' => Carbon::parse($this->created_at)->format('d M Y'),
        ];
    }
}
