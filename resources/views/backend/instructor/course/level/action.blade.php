<ul class="d-flex gap-30 justify-content-end">
    @if(hasPermission('level.edit'))
        <li>
            <a href="{{ route('level.edit',$level->id) }}"><i
                    class="las la-edit"></i></a>
        </li>
    @endif
    @if(hasPermission('level.destroy'))
        <li>
            <a href="javascript:void(0)"
               onclick="delete_row('{{ route('level.destroy', $level->id) }}')"
               data-toggle="tooltip"
               data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
        </li>
    @endif
</ul>
