<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class BoardResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => (int) $this->id,
            'title'       => $this->board_title ?: $this->title,
            'description' => $this->board_description ?: $this->description,
            'image'       => getFileLink('305x150', $this->image),
        ];
    }
}
