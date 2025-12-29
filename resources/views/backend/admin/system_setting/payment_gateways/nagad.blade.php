<div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12">
    <div class="payment-box">
        <div class="payment-icon">
            <img src="{{ static_asset('images/payment-icon/nagad.svg') }}" alt="Stripe">
            <span class="title">{{ __('nagad') }}</span>
        </div>

        <div class="payment-settings">
            <div class="payment-settings-btn">
                <a href="#" class="btn btn-md sg-btn-outline-primary"  data-bs-toggle="modal" data-bs-target="#nagad"><i class="las la-cog"></i> <span>{{ __('setting') }}</span></a>
            </div>

            <div class="setting-check">
                <input type="checkbox" id="is_nagad_activated" value="setting-status-change/is_nagad_activated" class="status-change" {{ setting('is_nagad_activated') ? 'checked' : '' }}>
                <label for="is_nagad_activated"></label>
            </div>
        </div>
    </div>
</div>
<!-- End Payment box -->
<div class="modal fade" id="nagad" tabindex="-1" aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('nagad') }} {{ __('configuration') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('payment.gateway') }}" method="post" class="form">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="is_modal" class="is_modal" value="0">
                    <input type="hidden" name="payment_method" value="nagad">
                    <div class="col-12">
                        <div class="d-flex gap-12 sandbox_mode_div mb-4">
                            <input type="hidden" name="is_nagad_sandbox_mode_activated" value="{{ setting('is_nagad_sandbox_mode_activated') == 1 ? 1 : 0 }}">
                            <label class="form-label" for="is_nagad_sandbox_mode_activated">{{ __('sandbox_mode') }}</label>
                            <div class="setting-check">
                                <input type="checkbox" value="1" id="is_nagad_sandbox_mode_activated" class="sandbox_mode" {{ setting('is_nagad_sandbox_mode_activated') == 1 ? 'checked' : '' }}>
                                <label for="is_nagad_sandbox_mode_activated"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('nagad_mode') }}</label>
                            <input type="text" class="form-control rounded-2" name="nagad_mode" placeholder="{{ __('enter_nagad_mode') }}" value="{{ setting('nagad_mode') }}">
                            <div class="nk-block-des text-danger">
                                <p class="nagad_mode_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End MarChant ID -->

                    <div class="col-12">
                        <div class="mb-4">
                            <label for="nagad_merchant_id" class="form-label">{{ __('merchant_id') }}</label>
                            <input type="text" class="form-control rounded-2" name="nagad_merchant_id" id="nagad_merchant_id" placeholder="{{ __('enter_merchant_id') }}" value="{{ stringMasking(old('nagad_merchant_id',setting('nagad_merchant_id')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="nagad_merchant_id_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="nagad_merchant_no" class="form-label">{{ __('merchant_no') }}</label>
                            <input type="text" class="form-control rounded-2" name="nagad_merchant_no" id="nagad_merchant_no" placeholder="{{ __('enter_merchant_no') }}" value="{{ stringMasking(old('nagad_merchant_no',setting('nagad_merchant_no')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="nagad_merchant_no_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="kkiapay_secret" class="form-label">{{ __('pubic_key') }}</label>
                            <input type="text" class="form-control rounded-2" name="nagad_public_key" id="nagad_public_key" placeholder="{{ __('enter_pubic_key') }}" value="{{ stringMasking(old('nagad_public_key',setting('nagad_public_key')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="nagad_public_key_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="nagad_private_key" class="form-label">{{ __('private_key') }}</label>
                            <input type="text" class="form-control rounded-2" name="nagad_private_key" id="nagad_private_key" placeholder="{{ __('enter_private_key') }}" value="{{ stringMasking(old('nagad_private_key',setting('nagad_private_key')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="nagad_private_key_error error"></p>
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
