<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
    <div class="payment-box payment-box-v2">
        <div class="payment-icon">
            <img src="{{ static_asset('images/payment-icon/payoneer.svg') }}" alt="payoneer">
            <span class="title">{{__('payoneer')}}</span>
        </div>
        <div class="payment-checker d-flex flex-column gap-20">
            @if(hasPermission('payouts.method-setting-update'))
                <div class="d-flex justify-content-between align-items-center gap-20 gap-md-40">
                    <label for="payoneer2">{{__('activation')}} :</label>
                    <div class="setting-check">
                        <input type="checkbox" id="payoneer2" value="setting-status-change/enable_payonner_payout"
                               class="status-change" {{ setting('enable_payonner_payout') ? 'checked' : '' }}>
                        <label for="payoneer2"></label>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


