@php
    if(Auth::check()):
        $data = payoutMethod(auth()->user()->id, 'paypal');
    else:
        $data = [];
    endif;
@endphp
<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
    <div class="payment-box payment-box-v2">
        <div class="payment-icon">
            <img src="{{ static_asset('images/payment-icon/paypal.svg') }}" alt="paypal">
            <span class="title">Paypal</span>
        </div>

        <div class="payment-settings ms-auto">
            <div class="payment-settings-btn">
                <a href="#" class="btn btn-md sg-btn-outline-primary" data-bs-toggle="modal" data-bs-target="#paypalConfiguration"><i class="las la-cog"></i> <span>Setting</span></a>
            </div>
        </div>

        <div class="payment-checker">
            <div div class="d-flex justify-content-between gap-40">
                <label for="checkbox2">{{__('default_method')}} :</label>
                <div class="setting-check">
                    @if(!blank($data))
                        <input type="checkbox" class="status-change"
                               {{ ($data->is_default == 1) ? 'checked' : '' }} data-id="{{ $data->id }}" value="payout-default-change/{{$data->id}}"
                               id="customSwitch1-{{$data->id}}">
                        <label for="customSwitch1-{{ $data->id }}"></label>
                    @else
                        <input type="checkbox" class="status-change"
                               data-id="" value="payout-default-change/"
                               id="paypal1">
                        <label for="paypal1"></label>
                    @endif
                </div>
            </div>

            <div div class="d-flex justify-content-between gap-40 mt-20">
                <label for="checkbox2">{{__('activation')}} :</label>
                <div class="setting-check">
                    @if(!blank($data))
                    <input type="checkbox" class="status-change"
                           {{ ($data->status == 1) ? 'checked' : '' }} data-id="{{ $data->id }}" value="payout-status-change/{{$data->id}}"
                           id="customSwitch2-{{$data->id}}">
                    <label for="customSwitch2-{{ $data->id }}"></label>
                     @else
                    <input type="checkbox" class="status-change"
                            data-id="" value="payout-status-change/"
                           id="paypal2">
                    <label for="paypal2"></label>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Payment box -->
<div class="modal fade" id="paypalConfiguration" tabindex="-1" aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <h6 class="sub-title">{{__('paypal_account_setting')}}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('payouts.method-setting-update') }}" method="post" class="form">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="is_modal" class="is_modal" value="0">
                    <input type="hidden" name="payout_method" value="paypal">
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('Paypal Email') }}</label>
                            <input type="text" class="form-control rounded-2" name="value[email]" placeholder="{{ __('kenzi.lawson@example.com') }}" value="{{ $data ?  $data->value['email']: ''  }}">
                            <div class="nk-block-des text-danger">
                                <p class="email_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End MarChant ID -->
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
