@if(hasPermission('success-stories.edit') || hasPermission('success-stories.destroy'))
    <ul class="d-flex gap-30 justify-content-end">
        @if(hasPermission('success-stories.edit'))
            <li>
                <a href="{{ route('success-stories.edit',$success_story->id) }}"><i
                        class="las la-edit"></i></a>
            </li>
        @endif
        @if(hasPermission('success-stories.destroy'))
            <li>
                <a href="javascript:void(0)"
                   onclick="delete_row('{{ route('success-stories.destroy', $success_story->id) }}')"
                   data-toggle="tooltip"
                   data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
            </li>
        @endif
    </ul>
@endif
