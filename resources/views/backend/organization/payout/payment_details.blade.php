<div class="payment-details">
    <ul>
        <li>{{__('method')}} : {{$payout->payment_method}}</li>
        <li>{{__('email')}} : {{ $payout->user->email }}</li>
        <li>{{__('date')}} : {{ date('M d, Y - H:i a') }}</li>
    </ul>
</div>
