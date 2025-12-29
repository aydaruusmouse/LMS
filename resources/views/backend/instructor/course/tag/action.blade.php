<ul class="d-flex gap-30 justify-content-end">
    @if(hasPermission('tags.edit'))
        <li>
            <a href="{{ route('tag.edit',$tag->id) }}"><i
                    class="las la-edit"></i></a>
        </li>
    @endif
    @if(hasPermission('tags.destroy'))
        <li>
            <a href="javascript:void(0)"
               onclick="delete_row('{{ route('tag.destroy', $tag->id) }}')"
               data-toggle="tooltip"
               data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
        </li>
    @endif
</ul>
