<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository
{
    public function all($data = [])
    {
        return Notification::where('user_id', $data['user_id'])->paginate($data['paginate']);
    }

    public function update($request, $id)
    {
        return Notification::whereIn('id', $id)->update($request);
    }

    public function delete($id)
    {
        return Notification::whereIn('id', $id)->delete();
    }

    public function UserNotification($data = [])
    {
        return Notification::where('user_id', $data['user_id'])->latest()->get();
    }
}
