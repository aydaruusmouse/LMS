@if(hasPermission('custom-notification.destroy'))
    <ul class="d-flex gap-30 justify-content-end">
        <li>
            <a href="javascript:void(0)"
               onclick="delete_row('{{ route('custom-notification.destroy', $notification->id) }}')"
               data-toggle="tooltip"
               data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
        </li>
    </ul>
@endif
