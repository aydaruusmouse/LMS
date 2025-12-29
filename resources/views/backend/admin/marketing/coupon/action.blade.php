@if(hasPermission('coupons.edit') || hasPermission('coupons.destroy'))
    <ul class="d-flex gap-30 justify-content-end">
        @if(hasPermission('coupons.edit'))
            <li>
                <a href="{{ route('coupons.edit',$coupon->id) }}"><i
                        class="las la-edit"></i></a>
            </li>
        @endif
        @if(hasPermission('coupons.destroy'))
            <li>
                <a href="javascript:void(0)"
                   onclick="delete_row('{{ route('coupons.destroy', $coupon->id) }}')"
                   data-toggle="tooltip"
                   data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
            </li>
        @endif
    </ul>
@endif
