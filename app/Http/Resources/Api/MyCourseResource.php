<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class MyCourseResource extends JsonResource
{
    public function toArray($request): array
    {

        return [
            'id'                   => (int) $this->id,
            'thumbnail'            => getFileLink('402x248', $this->image),
            'title'                => $this->title,
            'total_lessons'        => $this->lessons_count,
            'completed_lessons'    => 1,
            'completed_percentage' => $this->progress > 100 ? '100%' : $this->progress.'%',
        ];
    }
}
