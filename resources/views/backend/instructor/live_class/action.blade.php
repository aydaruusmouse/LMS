<div class="dropdown">
    <a class="dropdown-toggle" href="#" role="button"
       data-bs-toggle="dropdown" aria-expanded="false">
        <i class="las la-ellipsis-v"></i>
    </a>
    <ul class="dropdown-menu">
        @if(hasPermission('live-classes.edit'))
            <li><a class="dropdown-item edit_modal" href="javascript:void(0)"
                   data-fetch_url="{{ route('instructor.live-classes.edit',$class->id) }}"
                   data-route="{{ route('instructor.live-classes.update',$class->id) }}" data-modal="form"
                >{{__('edit') }}</a>
            </li>
        @endif
        @if(hasPermission('live-classes.destroy'))
            <li>
                <a class="dropdown-item" href="javascript:void(0)"
                   onclick="delete_row('{{ route('instructor.live-classes.destroy', $class->id) }}')"
                   data-toggle="tooltip"
                   data-original-title="{{ __('delete') }}">{{__('delete') }}</a>
            </li>
        @endif
    </ul>
</div>
