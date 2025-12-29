<ul class="d-flex gap-30 justify-content-end align-items-center">

        @if(($user->id == auth()->user()->id))
            @if(hasPermission('instructors.self-edit'))
            <li>
                <a class="edit_modal" href="{{ route('organization.instructors.edit', $user->id) }}"><i
                        class="las la-edit"></i></a>
            </li>
            @endif
            @else
            @if(hasPermission('instructors.edit'))
            <li>
                <a class="edit_modal" href="{{ route('organization.instructors.edit', $user->id) }}"><i
                        class="las la-edit"></i></a>
            </li>
            @endif
       @endif
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <i class="las la-ellipsis-v"></i>
        </a>
        <ul class="dropdown-menu">

                <li><a class="dropdown-item"
                       href="{{ route('organization.instructors.show', ['instructor' => $user->id,'org_id' => getArrayValue('org_id',Route::current()->parameters)]) }}">{{__('view_details')}}</a>
                </li>

            @if(hasPermission('instructors.edit'))
                @if(!empty($user->email_verified_at))
                    <li><a class="dropdown-item"
                           href="{{ route('organization.users.verified', $user->id) }}">{{__('unverified_instructor')}}</a></li>
                @else
                    <li><a class="dropdown-item"
                           href="{{ route('organization.users.verified', $user->id) }}">{{__('verified_instructor')}}</a></li>
                @endif
                @if($user->is_user_banned == 0)
                    <li><a class="dropdown-item"
                           href="{{ route('organization.users.ban', $user->id) }}">{{__('ban_this_instructor')}}</a>
                    </li>
                @else
                    <li><a class="dropdown-item"
                           href="{{ route('organization.users.ban', $user->id) }}">{{__('active_this_instructor')}}</a></li>
                @endif
            @endif
        </ul>
    </div>
</ul>
