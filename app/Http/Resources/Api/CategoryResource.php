<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => (int) $this->id,
            'title'         => $this->category_title ?: $this->title,
            'icon'          => getFileLink('40x40', $this->image),
            'total_courses' => $this->active_courses_count,
        ];
    }
}
