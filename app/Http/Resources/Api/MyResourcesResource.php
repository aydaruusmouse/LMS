<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class MyResourcesResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => (int) $this->id,
            'title'         => $this->title,
            'resource_type' => $this->resource_type,
            'source'        => get_media($this->source),
            'source_data'   => $this->source_data,
            'description'   => $this->description,
            'image'         => $this->image,
            'is_free'       => $this->is_free,
            'order_no'      => $this->order_no,
            'status'        => $this->status,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
