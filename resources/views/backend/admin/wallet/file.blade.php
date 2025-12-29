@if($wallet->payment_method == 'offline_method' && file_exists(public_path(getArrayValue('image',$wallet->payment_details))))
    <a href="{{ static_asset(getArrayValue('image',$wallet->payment_details)) }}" target="_blank">
        <img src="{{ static_asset(getArrayValue('image',$wallet->payment_details)) }}" alt="" width="100">
    </a>
@else
    {{ __('not_available') }}
@endif
