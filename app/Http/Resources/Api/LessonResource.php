<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    public function toArray($request): array
    {
        $source   = $link = '';

        if ($this->lesson_type == 'video') {
            $source = $this->source;
            $link   = $this->source == 'upload' ? get_media(getArrayValue('image', $this->source_data), getArrayValue('storage', $this->source_data)) : (string) $this->link;
        } elseif ($this->lesson_type == 'audio') {
            $source = $this->source;
            $link   = $this->source == 'upload' ? get_media(getArrayValue('image', $this->source_data), getArrayValue('storage', $this->source_data)) : (string) $this->link;
        } elseif ($this->lesson_type == 'doc') {
            $source = $this->source;
            $link   = $this->source == 'upload' ? (string) get_media(getArrayValue('image', $this->source_data), getArrayValue('storage', $this->source_data)) : (string) $this->link;
        }

        $progress = $this->progress;

        return [
            'id'           => (int) $this->id,
            'title'        => $this->title,
            'description'  => nullCheck($this->description),
            'type'         => $this->lesson_type,
            'duration'     => $this->duration,
            'is_free'      => (bool) $this->is_free,
            'thumbnail'    => getFileLink('320x320', $this->is_free),
            'source'       => $source,
            'link'         => nullCheck($link),
            'is_complete ' => $progress && $progress->progress >= 100,
            'progress'     => [
                'watch_percentage' => $progress ? round($progress->progress, 2) : 0,
                'total_spent_time' => $progress ? round($progress->total_spent_time, 2) : 0,
                'total_duration'   => $progress ? round($progress->total_duration, 2) : 0,
            ],
        ];
    }
}
