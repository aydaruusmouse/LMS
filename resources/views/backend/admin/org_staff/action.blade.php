<ul class="d-flex gap-30 justify-content-end align-items-center">

    @if (hasPermission('staff.edit'))
        <li>
            <a class="edit_modal"
                href="{{ route('organizations.staff.edit', ['org_id' => request()->route('org_id'), 'id' => $user->id]) }}"><i
                    class="las la-edit"></i></a>
        </li>
    @endif

    <div class="dropdown">

        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="las la-ellipsis-v"></i>
        </a>

        <ul class="dropdown-menu">
             @if (!empty($user->email_verified_at))
                <li><a class="dropdown-item"
                        href="{{ route('users.verified', $user->id) }}">{{ __('unverified_instructor') }}</a>
                </li>
            @else
                <li><a class="dropdown-item"
                        href="{{ route('users.verified', $user->id) }}">{{ __('verified_instructor') }}</a>
                </li>
            @endif
            @if ($user->is_user_banned == 0)
                <li><a class="dropdown-item"
                        href="{{ route('users.ban', $user->id) }}">{{ __('ban_this_instructor') }}</a>
                </li>
            @else
                <li><a class="dropdown-item"
                        href="{{ route('users.ban', $user->id) }}">{{ __('active_this_student') }}</a>
                </li>
            @endif
        </ul>
    </div>
</ul>
