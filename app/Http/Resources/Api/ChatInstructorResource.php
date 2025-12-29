<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatInstructorResource extends JsonResource
{
    public function toArray($request)
    {
        $chat_room    = $this->chatRoom;
        $last_message = @$chat_room->lastMessage;

        return [
            'id'           => $this->id,
            'uname'        => $this->name,
            'chat_room_id' => $chat_room ? $chat_room->id : '',
            'image'        => $this->profile_pic,
            'has_message'  => (bool) $last_message,
            'message'      => $last_message ? [
                'message'    => $last_message->message,
                'file_type'  => $last_message->file_type,
                'is_file'    => (bool) $last_message->is_file,
                'is_seen'    => (bool) $last_message->is_seen,
                'file'       => $last_message->is_file ? static_asset($last_message->file) : '',
                'created_at' => $last_message->created_at->diffForHumans(),
            ] : '',
        ];
    }
}
