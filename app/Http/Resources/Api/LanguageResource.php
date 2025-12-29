<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'             => (int) $this->id,
            'name'           => $this->name,
            'locale'         => $this->locale,
            'text_direction' => $this->text_direction,
        ];
    }
}
