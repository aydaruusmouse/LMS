<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
    <div class="payment-box payment-box-v2">
        <div class="payment-icon">
            <img src="{{ static_asset('images/payment-icon/paytm.svg') }}" alt="paytm">
            <span class="title">{{__('paytm')}}</span>
        </div>

        <div class="payment-checker d-flex flex-column gap-20">
            <div div class="d-flex justify-content-between align-items-center gap-20 gap-md-40">
                <label for="paytm2">{{__('activation')}} :</label>
                <div class="setting-check">
                    <input type="checkbox" id="paytm" value="setting-status-change/enable_paytm_payout" class="status-change" {{ setting('enable_paypal_payout') ? 'checked' : '' }}>
                    <label for="paytm"></label>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Payment box -->
