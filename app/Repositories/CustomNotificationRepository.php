<?php

namespace App\Repositories;

use App\Models\CustomNotification;
use App\Traits\ImageTrait;

class CustomNotificationRepository
{
    use ImageTrait;

    public function all()
    {
        return CustomNotification::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function store($request)
    {
        if (arrayCheck('image_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['image_media_id'], '402', '238', true);
        }

        $userRepository = new UserRepository();
        $users          = $userRepository->findUsers([
            'role_id'   => $request['role_ids'],
            'onesignal' => 1,
        ]);

        if (count($users) > 0) {
            $url        = 'https://onesignal.com/api/v1/notifications';
            $action_for = '';
            $action_to  = '';

            if (arrayCheck('action_for', $request)) {
                if ($request['action_for'] == 'instructor') {
                    $action_to  = $request['instructor_id'];
                    $action_for = 'instructor';
                } elseif ($request['action_for'] == 'category') {
                    $action_to  = $request['category_id'];
                    $action_for = 'category';
                } elseif ($request['action_for'] == 'course') {
                    $action_to  = $request['course_id'];
                    $action_for = 'course';
                } elseif ($request['action_for'] == 'organization') {
                    $action_to  = $request['organization_id'];
                    $action_for = 'organization';
                } elseif ($request['action_for'] == 'student') {
                    $action_to  = $request['student_id'];
                    $action_for = 'student';
                } elseif ($request['action_for'] == 'blog') {
                    $action_to  = $request['blog_id'];
                    $action_for = 'blog';
                } elseif ($request['action_for'] == 'subject') {
                    $action_to  = $request['subject_id'];
                    $action_for = 'subject';
                } elseif ($request['action_for'] == 'book') {
                    $action_to  = $request['book_id'];
                    $action_for = 'book';
                }
            }

            $body       = [
                'include_player_ids' => array_unique(array_filter($users->pluck('onesignal_player_id')->toArray())),
                'contents'           => [
                    'en' => $request['description'],
                ],
                'headings'           => [
                    'en' => $request['title'],
                ],

                'big_picture'        => arrayCheck('image', $request) ? getFileLink('190x230', $request['image']) : null,
                'chrome_web_image'   => arrayCheck('image', $request) ? getFileLink('190x230', $request['image']) : null,
                'chrome_big_picture' => arrayCheck('image', $request) ? getFileLink('190x230', $request['image']) : null,
                'ios_attachments'    => arrayCheck('image', $request) ? getFileLink('190x230', $request['image']) : null,
                'app_id'             => setting('onesignal_app_id'),
                'url'                => url('/'),
                'data'               => [
                    'action_type' => $action_for,
                    'action_to'   => $action_to,
                    'open_from'   => arrayCheck('open_from', $request) ? $request['open_from'] : '',
                ],
            ];
            $headers    = [
                'Authorization' => 'Basic '.setting('onesignal_rest_api_key'),
                'accept'        => 'application/json',
                'content-type'  => 'application/json',
            ];
            $request    = curlRequest($url, $body, 'POST', $headers);
        }

        return CustomNotification::create($request);
    }

    public function find($id)
    {
        return CustomNotification::find($id);
    }

    public function update($request, $id)
    {
        $coupon = CustomNotification::findOrfail($id);

        if (arrayCheck('image_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['image_media_id'], '402', '238', true);
        }

        return $coupon->update($request);
    }

    public function destroy($id)
    {
        return CustomNotification::destroy($id);
    }
}
