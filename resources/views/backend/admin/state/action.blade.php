<ul class="d-flex gap-30 justify-content-end align-items-center">
    @if(hasPermission('states.edit'))
        <li>
            <a class="edit_modal" href="javascript:void(0)"
               data-fetch_url="{{ route('states.edit',$state->id) }}"
               data-route="{{ route('states.update',$state->id) }}" data-modal="state"><i
                    class="las la-edit"></i></a>
        </li>
    @endif
    @if(hasPermission('states.destroy'))
        <li>
            <a href="javascript:void(0)"
               onclick="delete_row('{{ route('states.destroy', $state->id) }}')"
               data-toggle="tooltip"
               data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
        </li>
    @endif
</ul>
