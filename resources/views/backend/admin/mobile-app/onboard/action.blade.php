@if(hasPermission('onboards.edit') || hasPermission('onboards.destroy'))
    <ul class="d-flex gap-30 justify-content-end">
        @if(hasPermission('onboards.edit'))
            <li><a href="{{ route('onboards.edit', $onboard->id) }}"><i
                        class="las la-edit"></i></a></li>
        @endif
        @if(hasPermission('onboards.destroy'))
            <li>
                <a class="dropdown-item" href="javascript:void(0)"
                   onclick="delete_row('{{ route('onboards.destroy', $onboard->id) }}',null,true)"
                   data-toggle="tooltip"
                   data-original-title="{{ __('delete') }}"><i
                        class="las la-trash-alt"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
