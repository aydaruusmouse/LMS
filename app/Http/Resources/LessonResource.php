<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    public function toArray($request): array
    {
        if ($this->lesson_type == 'video') {
            $source = $this->source;
            $link   = $this->source == 'upload' ? (string) get_media($this->link) : (string) $this->link;
        } elseif ($this->lesson_type == 'audio') {
            $source = $this->source;
            $link   = $this->source == 'upload' ? (string) get_media($this->link) : (string) $this->link;
        } elseif ($this->lesson_type == 'doc') {
            $source = $this->source;
            $link   = $this->source == 'upload' ? (string) get_media($this->link) : (string) $this->link;
        }

        return [
            'id'          => (int) $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'type'        => $this->lesson_type,
            'duration'    => $this->duration,
            'is_free'     => (bool) $this->is_free,
            'thumbnail'   => getFileLink('320x320', $this->is_free),
            'source'      => $source,
            'link'        => $link,
        ];
    }
}
