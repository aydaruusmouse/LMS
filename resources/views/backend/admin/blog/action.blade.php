@if(hasPermission('blogs.edit') || hasPermission('blogs.destroy'))
    <ul class="d-flex gap-30 justify-content-end">
        @if(hasPermission('blogs.edit'))
            <li>
                <a href="{{ route('blogs.edit',$blog->id) }}"><i
                        class="las la-edit"></i></a>
            </li>
        @endif
        @if(hasPermission('blogs.destroy'))
            <li>
                <a href="javascript:void(0)"
                   onclick="delete_row('{{ route('blogs.destroy', $blog->id) }}')"
                   data-toggle="tooltip"
                   data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
            </li>
        @endif
    </ul>
@endif
