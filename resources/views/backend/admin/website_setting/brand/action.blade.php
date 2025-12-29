@if(hasPermission('brands.edit') || hasPermission('brands.destroy'))
    <ul class="d-flex gap-30 justify-content-end">
        @if(hasPermission('brands.edit'))
            <li>
                <a href="{{ route('brands.edit',$brand->id) }}"><i
                        class="las la-edit"></i></a>
            </li>
        @endif
        @if(hasPermission('brands.destroy'))
            <li>
                <a href="javascript:void(0)"
                   onclick="delete_row('{{ route('brands.destroy', $brand->id) }}')"
                   data-toggle="tooltip"
                   data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
            </li>
        @endif
    </ul>
@endif

