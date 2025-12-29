<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class FollowResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => (int) $this->follower_id,
            'name'        => $this->follower->name,
            'image'       => $this->follower->profile_pic,
            'designation' => nullCheck($this->follower->instructor->designation),
        ];
    }
}
