@if(hasPermission('coupons.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change"
               {{ ($coupon->status == 1) ? 'checked' : '' }} data-id="{{ $coupon->id }}" value="coupon-status/{{$coupon->id}}"
               id="customSwitch2-{{$coupon->id}}">
        <label for="customSwitch2-{{ $coupon->id }}"></label>
    </div>
@endif
