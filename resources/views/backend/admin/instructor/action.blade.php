@if(hasPermission('instructors.edit') || hasPermission('users.destroy') || hasPermission('instructors.show'))
    <ul class="d-flex gap-30 justify-content-end align-items-center">
        @if(hasPermission('instructors.edit'))
            <li>
                <a class="edit_modal" href="{{ route('instructors.edit', $user->id) }}"><i
                        class="las la-edit"></i></a>
            </li>
        @endif
        @if(hasPermission('users.destroy'))
            <li>
                @if($user->is_deleted == 0)
                    <a href="javascript:void(0)"
                       onclick="delete_row('{{ route('users.destroy', $user->id) }}')"
                       data-toggle="tooltip"
                       data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
                @else
                    <a href="javascript:void(0)" title="{{ __('restore') }}"
                       onclick="delete_row('{{ route('users.destroy', $user->id) }}')"
                       data-toggle="tooltip"
                       data-original-title="{{ __('restore') }}"><i class="las la-redo-alt"></i></a>
                @endif
            </li>
        @endif
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                <i class="las la-ellipsis-v"></i>
            </a>
            <ul class="dropdown-menu">
                @if(hasPermission('instructors.show'))
                    <li><a class="dropdown-item"
                           href="{{ route('instructors.show', ['instructor' => $user->id,'org_id' => getArrayValue('org_id',Route::current()->parameters)]) }}">{{__('view_details')}}</a>
                    </li>
                @endif
                @if(hasPermission('instructors.edit'))
                    @if(!empty($user->email_verified_at))
                        <li><a class="dropdown-item"
                               href="{{ route('users.verified', $user->id) }}">{{__('unverified_instructor')}}</a></li>
                    @else
                        <li><a class="dropdown-item"
                               href="{{ route('users.verified', $user->id) }}">{{__('verified_instructor')}}</a></li>
                    @endif
                    @if($user->is_user_banned == 0)
                        <li><a class="dropdown-item"
                               href="{{ route('users.ban', $user->id) }}">{{__('ban_this_instructor')}}</a>
                        </li>
                    @else
                        <li><a class="dropdown-item"
                               href="{{ route('users.ban', $user->id) }}">{{__('active_this_student')}}</a></li>
                    @endif
                @endif
            </ul>
        </div>
    </ul>
@endif
