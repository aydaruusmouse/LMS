@if(hasPermission('student-faqs.edit') || hasPermission('student-faqs.destroy'))
    <ul class="d-flex gap-30 justify-content-end">
        @if(hasPermission('student-faqs.edit'))
            <li>
                <a href="{{ route('student-faqs.edit',$faq->id) }}"><i
                        class="las la-edit"></i></a>
            </li>
        @endif
        @if(hasPermission('student-faqs.destroy'))
            <li>
                <a href="javascript:void(0)"
                   onclick="delete_row('{{ route('student-faqs.destroy', $faq->id) }}')"
                   data-toggle="tooltip"
                   data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
            </li>
        @endif
    </ul>
@endif
