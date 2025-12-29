@if(hasPermission('testimonials.edit') || hasPermission('testimonials.destroy'))
    <ul class="d-flex gap-30 justify-content-end">
        @if(hasPermission('testimonials.edit'))
            <li>
                <a href="{{ route('testimonials.edit',$testimonial->id) }}"><i
                        class="las la-edit"></i></a>
            </li>
        @endif
        @if(hasPermission('testimonials.destroy'))
            <li>
                <a href="javascript:void(0)"
                   onclick="delete_row('{{ route('testimonials.destroy', $testimonial->id) }}')"
                   data-toggle="tooltip"
                   data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
            </li>
        @endif
    </ul>
@endif
