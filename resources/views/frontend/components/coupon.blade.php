<div class="valid-coupon-status m-b-10 delete-item">
    <div class="coupon-code">
        <h6>{{ $applied_coupon->coupon->code }}</h6>
        <p>{{__('coupon_applied')}}</p>
    </div>
    <div class="delete-btn">
        <a href="{{ route('delete.applied.coupon',$applied_coupon->id) }}" onclick="return confirm('{{ __('are_you_sure') }}')">
            <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 3.40039H11.8" stroke="#D16D86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M10.6031 3.4V11.8C10.6031 12.1183 10.4767 12.4235 10.2517 12.6485C10.0266 12.8736 9.72138 13 9.40312 13H3.40312C3.08487 13 2.77964 12.8736 2.5546 12.6485C2.32955 12.4235 2.20313 12.1183 2.20312 11.8V3.4M4.00312 3.4V2.2C4.00312 1.88174 4.12955 1.57652 4.3546 1.35147C4.57964 1.12643 4.88487 1 5.20312 1H7.60312C7.92138 1 8.22661 1.12643 8.45165 1.35147C8.6767 1.57652 8.80312 1.88174 8.80312 2.2V3.4" stroke="#D16D86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M5.20312 6.40039V10.0004" stroke="#D16D86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M7.60156 6.40039V10.0004" stroke="#D16D86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </a>
    </div>
</div>
