<ul class="d-flex gap-30 justify-content-end">
    @if(hasPermission('expertise.edit'))
        <li>
            <a href="{{ route('organization.expertise.edit',$expertise->id) }}"><i
                    class="las la-edit"></i></a>
        </li>
    @endif
    @if(hasPermission('expertise.destroy'))
        <li>
            <a href="javascript:void(0)"
               onclick="delete_row('{{ route('organization.expertise.destroy', $expertise->id) }}')"
               data-toggle="tooltip"
               data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
        </li>
    @endif
</ul>
