<?php

namespace App\Traits;

use App\Events\PusherNotification;
use App\Models\Notification;

trait SendNotification
{
    public function sendNotification($users = [], $message = null, $message_type = 'success', $url = null, $details = null): bool
    {
        foreach ($users as $user) {
            $notification              = new Notification();
            $notification->user_id     = $user;
            $notification->title       = $message;
            $notification->description = $details;
            $notification->url         = $url;
            $notification->created_by  = auth()->id();
            $notification->save();
        }

        try {
            if (setting('is_pusher_notification_active')) {
                foreach ($users as $user) {
                    event(new PusherNotification($user, $message, $message_type, $url, $details));
                }
            }
        } catch (\Exception $e) {
            dd($e);
        }

        return true;
    }
}
