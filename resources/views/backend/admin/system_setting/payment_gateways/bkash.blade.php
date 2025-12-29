<div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12">
    <div class="payment-box">
        <div class="payment-icon">
            <img src="{{ static_asset('images/payment-icon/bKash.svg') }}" alt="Stripe">
            <span class="title">{{ __('bkash') }}</span>
        </div>

        <div class="payment-settings">
            <div class="payment-settings-btn">
                <a href="#" class="btn btn-md sg-btn-outline-primary"  data-bs-toggle="modal" data-bs-target="#bkash"><i class="las la-cog"></i> <span>{{ __('setting') }}</span></a>
            </div>

            <div class="setting-check">
                <input type="checkbox" id="is_bkash_activated" value="setting-status-change/is_bkash_activated" class="status-change" {{ setting('is_bkash_activated') ? 'checked' : '' }}>
                <label for="is_bkash_activated"></label>
            </div>
        </div>
    </div>
</div>
<!-- End Payment box -->
<div class="modal fade" id="bkash" tabindex="-1" aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('bkash') }} {{ __('configuration') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('payment.gateway') }}" method="post" class="form">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="is_modal" class="is_modal" value="0">
                    <input type="hidden" name="payment_method" value="bkash">
                    <div class="col-12">
                        <div class="d-flex gap-12 sandbox_mode_div mb-4">
                            <input type="hidden" name="is_bkash_sandbox_mode_activated" value="{{ setting('is_bkash_sandbox_mode_activated') == 1 ? 1 : 0 }}">
                            <label class="form-label" for="is_bkash_sandbox_mode_activated">{{ __('sandbox_mode') }}</label>
                            <div class="setting-check">
                                <input type="checkbox" value="1" id="is_bkash_sandbox_mode_activated" class="sandbox_mode" {{ setting('is_bkash_sandbox_mode_activated') == 1 ? 'checked' : '' }}>
                                <label for="is_bkash_sandbox_mode_activated"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('app_key') }}</label>
                            <input type="text" class="form-control rounded-2" name="app_key" placeholder="{{ __('enter_app_key') }}" value="{{ stringMasking(old('app_key',setting('app_key')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="app_key_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End MarChant ID -->

                    <div class="col-12">
                        <div class="mb-4">
                            <label for="bkash_app_secret" class="form-label">{{ __('app_secret') }}</label>
                            <input type="text" class="form-control rounded-2" name="bkash_app_secret" id="bkash_app_secret" placeholder="{{ __('enter_secret_key') }}" value="{{ stringMasking(old('bkash_app_secret',setting('bkash_app_secret')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="bkash_app_secret_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="bkash_username" class="form-label">{{ __('username') }}</label>
                            <input type="text" class="form-control rounded-2" name="bkash_username" id="bkash_username" placeholder="{{ __('enter_username') }}" value="{{ stringMasking(old('bkash_username',setting('bkash_username')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="bkash_username_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="bkash_password" class="form-label">{{ __('password') }}</label>
                            <input type="text" class="form-control rounded-2" name="bkash_password" id="bkash_password" placeholder="{{ __('enter_password') }}" value="{{ stringMasking(old('bkash_password',setting('bkash_password')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="bkash_password_error error"></p>
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
