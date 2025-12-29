<div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12">
    <div class="payment-box">
        <div class="payment-icon">
            <img src="{{ static_asset('images/payment-icon/google_pay.svg') }}" alt="Stripe">
            <span class="title">{{ __('google_pay') }}</span>
        </div>

        <div class="payment-settings">
            <div class="payment-settings-btn">
                <a href="#" class="btn btn-md sg-btn-outline-primary"  data-bs-toggle="modal" data-bs-target="#google_pay"><i class="las la-cog"></i> <span>{{ __('setting') }}</span></a>
            </div>

            <div class="setting-check">
                <input type="checkbox" id="is_google_pay_activated" value="setting-status-change/is_google_pay_activated" class="status-change" {{ setting('is_google_pay_activated') ? 'checked' : '' }}>
                <label for="is_google_pay_activated"></label>
            </div>
        </div>
    </div>
</div>
<!-- End Payment box -->
<div class="modal fade" id="google_pay" tabindex="-1" aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('google_pay') }} {{ __('configuration') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('payment.gateway') }}" method="post" class="form">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="is_modal" class="is_modal" value="0">
                    <input type="hidden" name="payment_method" value="google_pay">
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('merchant_id') }}</label>
                            <input type="text" class="form-control rounded-2" name="google_pay_merchant_id" placeholder="{{ __('enter_merchant_id') }}" value="{{ setting('google_pay_merchant_id') }}">
                            <div class="nk-block-des text-danger">
                                <p class="google_pay_merchant_id_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End MarChant ID -->

                    <div class="col-12">
                        <div class="mb-4">
                            <label for="google_pay_merchant_name" class="form-label">{{ __('merchant_name') }}</label>
                            <input type="text" class="form-control rounded-2" name="google_pay_merchant_name" id="google_pay_merchant_name" placeholder="{{ __('enter_merchant_name') }}" value="{{ setting('google_pay_merchant_name') }}">
                            <div class="nk-block-des text-danger">
                                <p class="google_pay_merchant_name_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="google_pay_gateway" class="form-label">{{ __('gateway') }}</label>
                            <input type="text" class="form-control rounded-2" name="google_pay_gateway" id="google_pay_gateway" placeholder="{{ __('enter_gateway') }}" value="{{ setting('google_pay_gateway') }}">
                            <div class="nk-block-des text-danger">
                                <p class="google_pay_gateway_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="google_pay_gateway_merchant_id" class="form-label">{{ __('gateway_merchant_id') }}</label>
                            <input type="text" class="form-control rounded-2" name="google_pay_gateway_merchant_id" id="google_pay_gateway_merchant_id" placeholder="{{ __('enter_gateway_merchant_id') }}" value="{{ setting('google_pay_gateway_merchant_id') }}">
                            <div class="nk-block-des text-danger">
                                <p class="google_pay_gateway_merchant_id_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End MarChant Key -->
                </div>
                <!-- END Permissions Tab====== -->
                <div class="d-flex justify-content-end align-items-center mt-30">
                    <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                </div>
            </form>
        </div>
    </div>
</div>
