@if(hasPermission('roles.edit') || hasPermission('roles.destroy'))
    <ul class="d-flex gap-30 justify-content-center ">
        @if(hasPermission('roles.edit'))
            <li><a href="{{ route('roles.edit', $role->id) }}">{{__('edit') }}</a></li>
        @endif
        @if(hasPermission('roles.destroy'))
            <li><a onclick="delete_row('{{ route('roles.destroy', $role->id) }}')"
                   href="javascript:void(0)">{{__('delete')}}</a></li>
        @endif
    </ul>
@endif
