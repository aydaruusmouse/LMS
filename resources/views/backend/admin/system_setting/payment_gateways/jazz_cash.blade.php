<div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12">
    <div class="payment-box">
        <div class="payment-icon">
            <img src="{{ static_asset('images/payment-icon/JazzCash.svg') }}" alt="Stripe">
            <span class="title">{{ __('jazz_cash') }}</span>
        </div>

        <div class="payment-settings">
            <div class="payment-settings-btn">
                <a href="#" class="btn btn-md sg-btn-outline-primary" data-bs-toggle="modal"
                   data-bs-target="#jazz_cash"><i class="las la-cog"></i> <span>{{ __('setting') }}</span></a>
            </div>

            <div class="setting-check">
                <input type="checkbox" id="is_jazz_cash_activated" value="setting-status-change/is_jazz_cash_activated"
                       class="status-change" {{ setting('is_jazz_cash_activated') ? 'checked' : '' }}>
                <label for="is_jazz_cash_activated"></label>
            </div>
        </div>
    </div>
</div>
<!-- End Payment box -->
<div class="modal fade" id="jazz_cash" tabindex="-1" aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('jazz_cash') }} {{ __('configuration') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('payment.gateway') }}" method="post" class="form">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="is_modal" class="is_modal" value="0">
                    <input type="hidden" name="payment_method" value="jazz_cash">
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('merchant_id') }}</label>
                            <input type="text" class="form-control rounded-2" name="jazz_cash_merchant_id"
                                   placeholder="{{ __('enter_merchant_id') }}"
                                   value="{{ stringMasking(old('jazz_cash_merchant_id',setting('jazz_cash_merchant_id')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="jazz_cash_merchant_id_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End MarChant ID -->

                    <div class="col-12">
                        <div class="mb-4">
                            <label for="jazz_cash_password" class="form-label">{{ __('password') }}</label>
                            <input type="text" class="form-control rounded-2" name="jazz_cash_password"
                                   id="jazz_cash_password" placeholder="{{ __('enter_password') }}"
                                   value="{{ stringMasking(old('jazz_cash_password',setting('jazz_cash_password')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="jazz_cash_password_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="jazz_cash_integrity_salt" class="form-label">{{ __('integrity_salt') }}</label>
                            <input type="text" class="form-control rounded-2" name="jazz_cash_integrity_salt"
                                   id="jazz_cash_password" placeholder="{{ __('enter_integrity_salt') }}"
                                   value="{{ setting('jazz_cash_integrity_salt') }}">
                            <div class="nk-block-des text-danger">
                                <p class="jazz_cash_integrity_salt_error error"></p>
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
