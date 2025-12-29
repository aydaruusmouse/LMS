<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'       => (int) $this->id,
            'question' => $this->faq_question ?: $this->question,
            'answer'   => $this->faq_answer ?: $this->answer,
        ];
    }
}
