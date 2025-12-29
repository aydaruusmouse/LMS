@if(hasPermission('staffs.edit') || hasPermission('staffs.delete'))
    <ul class="d-flex gap-30 justify-content-end align-items-center">
        @if(hasPermission('staffs.edit'))
            <li><a href="{{ route('staffs.edit', $staff->id) }}"><i class="las la-edit"></i></a></li>
        @endif
        @if(hasPermission('staffs.delete'))
            @if($staff->is_deleted == 0)
                <li><a onclick="delete_row('{{ route('staffs.delete', $staff->id) }}')"
                       href="javascript:void(0)"><i class="las la-trash-alt"></i></a></li>
            @else
                <li><a onclick="delete_row('{{ route('staffs.delete', $staff->id) }}')"
                       href="javascript:void(0)"><i class="las la-redo-alt"></i></a></li>
            @endif
        @endif
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                <i class="las la-ellipsis-v"></i>
            </a>
            <ul class="dropdown-menu">
                @if(hasPermission('staffs.edit'))
                    @if(!empty($staff->email_verified_at))
                        <li><a class="dropdown-item"
                               href="{{ route('staffs.verified', $staff->id) }}">{{__('unverified_person')}}</a></li>
                    @else
                        <li><a class="dropdown-item"
                               href="{{ route('staffs.verified', $staff->id) }}">{{__('verified_person')}}</a></li>
                    @endif
                    @if($staff->is_user_banned == 0)
                        <li><a class="dropdown-item"
                               href="{{ route('staffs.bannUser', $staff->id) }}">{{__('ban_this_person')}}</a></li>
                    @else
                        <li><a class="dropdown-item"
                               href="{{ route('staffs.bannUser', $staff->id) }}">{{__('active_this_person')}}</a></li>
                    @endif
                @endif
            </ul>
        </div>
    </ul>
@endif

