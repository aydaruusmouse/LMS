<div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12">
    <div class="payment-box">
        <div class="payment-icon">
            <img src="{{ static_asset('images/payment-icon/midtrans.svg') }}" alt="Stripe">
            <span class="title">{{ __('midtrans') }}</span>
        </div>

        <div class="payment-settings">
            <div class="payment-settings-btn">
                <a href="#" class="btn btn-md sg-btn-outline-primary" data-bs-toggle="modal" data-bs-target="#midtrans"><i
                        class="las la-cog"></i> <span>{{ __('setting') }}</span></a>
            </div>

            <div class="setting-check">
                <input type="checkbox" id="is_mid_trans_activated" value="setting-status-change/is_mid_trans_activated"
                       class="status-change" {{ setting('is_mid_trans_activated') ? 'checked' : '' }}>
                <label for="is_mid_trans_activated"></label>
            </div>
        </div>
    </div>
</div>
<!-- End Payment box -->
<div class="modal fade" id="midtrans" tabindex="-1" aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('midtrans') }} {{ __('configuration') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('payment.gateway') }}" method="post" class="form">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="is_modal" class="is_modal" value="0">
                    <input type="hidden" name="payment_method" value="midtrans">
                    <div class="col-12">
                        <div class="d-flex gap-12 sandbox_mode_div mb-4">
                            <input type="hidden" name="is_midtrans_sandbox_enabled"
                                   value="{{ setting('is_midtrans_sandbox_enabled') == 1 ? 1 : 0 }}">
                            <label class="form-label" for="is_midtrans_sandbox_enabled">{{ __('sandbox_mode') }}</label>
                            <div class="setting-check">
                                <input type="checkbox" value="1" id="is_midtrans_sandbox_enabled"
                                       class="sandbox_mode" {{ setting('is_midtrans_sandbox_enabled') == 1 ? 'checked' : '' }}>
                                <label for="is_midtrans_sandbox_enabled"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('client_id') }}</label>
                            <input type="text" class="form-control rounded-2" name="mid_trans_client_id"
                                   placeholder="{{ __('enter_client_id') }}"
                                   value="{{ stringMasking(old('mid_trans_client_id',setting('mid_trans_client_id')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="mid_trans_client_id_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End MarChant ID -->

                    <div class="col-12">
                        <div class="mb-4">
                            <label for="mid_trans_server_key" class="form-label">{{ __('server_key') }}</label>
                            <input type="text" class="form-control rounded-2" name="mid_trans_server_key"
                                   id="mid_trans_server_key" placeholder="{{ __('enter_server_key') }}"
                                   value="{{ stringMasking(old('mid_trans_server_key',setting('mid_trans_server_key')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="mid_trans_server_key_error error"></p>
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
