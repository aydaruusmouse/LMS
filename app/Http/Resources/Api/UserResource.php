<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        $row = [
            'id'    => (int) $this->id,
            'name'  => $this->name,
            'image' => $this->profile_pic,
        ];
        if ($this->instructor) {
            $row['instructor'] = nullCheck($this->instructor->organization->org_name);
            $row['about']      = nullCheck($this->about);
        }

        return $row;
    }
}
