<ul class="d-flex gap-30 justify-content-end align-items-center">
    <li>
        <a href="{{ route('organization.students.edit', $user->id) }}"><i class="las la-edit"></i></a>
    </li>
  
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="las la-ellipsis-v"></i>
        </a>
        <ul class="dropdown-menu">
            @if(hasPermission('students.show'))
                <li><a class="dropdown-item" href="{{ route('organization.students.show', $user->id) }}">{{__('view_details')}}</a>
                </li>
            @endif
            @if(hasPermission('students.edit'))
                @if(!empty($user->email_verified_at))
                    <li><a class="dropdown-item"
                           href="{{ route('organization.users.verified', $user->id) }}">{{__('unverified_student')}}</a></li>
                @else
                    <li><a class="dropdown-item"
                           href="{{ route('organization.users.verified', $user->id) }}">{{__('verified_student')}}</a></li>
                @endif
                @if($user->is_user_banned == 0)
                    <li><a class="dropdown-item"
                           href="{{ route('organization.users.ban', $user->id) }}">{{__('ban_this_student')}}</a>
                    </li>
                @else
                    <li><a class="dropdown-item"
                           href="{{ route('organization.users.ban', $user->id) }}">{{__('active_this_student')}}</a></li>
                @endif
            @endif
        </ul>
    </div>
</ul>
