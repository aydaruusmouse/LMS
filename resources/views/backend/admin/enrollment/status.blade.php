@if($checkout->status)
    <span class="text-success">{{ __('approved') }}</span>
@else
    <span class="text-warning">{{ __('pending') }}</span>
@endif
