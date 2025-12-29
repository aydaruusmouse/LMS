<div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12">
    <div class="payment-box">
        <div class="payment-icon">
            <img src="{{ static_asset('images/payment-icon/paytm.svg') }}" alt="Stripe">
            <span class="title">{{ __('paytm') }}</span>
        </div>

        <div class="payment-settings">
            <div class="payment-settings-btn">
                <a href="#" class="btn btn-md sg-btn-outline-primary" data-bs-toggle="modal" data-bs-target="#paytm"><i
                        class="las la-cog"></i> <span>{{ __('setting') }}</span></a>
            </div>

            <div class="setting-check">
                <input type="checkbox" id="is_paytm_activated" value="setting-status-change/is_paytm_activated"
                       class="status-change" {{ setting('is_paytm_activated') ? 'checked' : '' }}>
                <label for="is_paytm_activated"></label>
            </div>
        </div>
    </div>
</div>
<!-- End Payment box -->
<div class="modal fade" id="paytm" tabindex="-1" aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('paytm') }} {{ __('configuration') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('payment.gateway') }}" method="post" class="form">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="is_modal" class="is_modal" value="0">
                    <input type="hidden" name="payment_method" value="paytm">
                    <div class="col-12">
                        <div class="d-flex gap-12 sandbox_mode_div mb-4">
                            <input type="hidden" name="is_paytm_sandbox_mode_activated" value="{{ setting('is_paytm_sandbox_mode_activated') == 1 ? 1 : 0 }}">
                            <label class="form-label" for="is_paytm_sandbox_mode_activated">{{ __('sandbox_mode') }}</label>
                            <div class="setting-check">
                                <input type="checkbox" value="1" id="is_paytm_sandbox_mode_activated" class="sandbox_mode" {{ setting('is_paytm_sandbox_mode_activated') == 1 ? 'checked' : '' }}>
                                <label for="is_paytm_sandbox_mode_activated"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('merchant_id') }}</label>
                            <input type="text" class="form-control rounded-2" name="merchant_id"
                                   placeholder="{{ __('enter_merchant_id') }}" value="{{ stringMasking(old('merchant_id',setting('merchant_id')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="merchant_id_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End MarChant ID -->

                    <div class="col-12">
                        <div class="mb-4">
                            <label for="merchant_key" class="form-label">{{ __('merchant_key') }}</label>
                            <input type="text" class="form-control rounded-2" name="merchant_key" id="merchant_key"
                                   placeholder="{{ __('enter_merchant_key') }}" value="{{ stringMasking(old('merchant_key',setting('merchant_key')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="merchant_key_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End MarChant Key -->
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="merchant_website" class="form-label">{{ __('merchant_website') }}</label>
                            <input type="text" class="form-control rounded-2" name="merchant_website"
                                   id="merchant_website" placeholder="{{ __('enter_merchant_website') }}"
                                   value="{{ stringMasking(old('merchant_website',setting('merchant_website')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="merchant_website_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="channel" class="form-label">{{ __('channel') }}</label>
                            <input type="text" class="form-control rounded-2" name="channel" id="channel"
                                   placeholder="{{ __('enter_channel') }}" value="{{ setting('channel') }}">
                            <div class="nk-block-des text-danger">
                                <p class="channel_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="channel" class="form-label">{{ __('industry_type') }}</label>
                            <input type="text" class="form-control rounded-2" name="industry_type" id="industry_type"
                                   placeholder="{{ __('enter_industry_type') }}" value="{{ setting('industry_type') }}">
                            <div class="nk-block-des text-danger">
                                <p class="industry_type_error error"></p>
                            </div>
                        </div>
                    </div>
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
