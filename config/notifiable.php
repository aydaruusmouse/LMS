<?php

use App\Models\User;

return [
    'on_purchase'         => function () {
        return User::whereIn('role_id', [
            1, 2,
        ])->pluck('id')->toArray();
    },

    'on_student_register' => function () {
        return User::whereIn('role_id', [
            1, 3,
        ])->pluck('id')->toArray();
    },

    'on_publish_course'   => function () {
        return User::whereIn('role_id', [
            2,
        ])->pluck('id')->toArray();
    },

];
