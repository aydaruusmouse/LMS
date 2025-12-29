@if(hasPermission('offline-methods.edit') || hasPermission('offline-methods.destroy'))
    <ul class="d-flex gap-30 justify-content-end align-items-center">
        @if(hasPermission('offline-methods.edit'))
            <li>
                <a href="{{ route('offline-methods.edit',$offline_method->id) }}"><i
                        class="las la-edit"></i></a>
            </li>
        @endif
        @if(hasPermission('offline-methods.destroy'))
            <li>
                <a href="javascript:void(0)"
                   onclick="delete_row('{{ route('offline-methods.destroy', $offline_method->id) }}')"
                   data-toggle="tooltip"
                   data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
            </li>
        @endif
    </ul>
@endif
