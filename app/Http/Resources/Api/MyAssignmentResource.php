<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class MyAssignmentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => (int) $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'deadline'    => $this->deadline,
            'total_marks' => $this->total_marks,
            'pass_marks'  => $this->total_marks,
            'created_at'  => $this->created_at,
        ];
    }
}
