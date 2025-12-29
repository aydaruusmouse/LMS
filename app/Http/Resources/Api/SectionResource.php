<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'      => (int) $this->id,
            'title'   => $this->title,
            'lessons' => LessonResource::collection($this->lessons),
            'quizzes' => $this->quizzes,
        ];
    }
}
