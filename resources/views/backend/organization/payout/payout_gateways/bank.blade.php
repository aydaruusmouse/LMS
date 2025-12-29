@php
    $data = organizationPayoutMethod(authOrganizationId(), 'bank');
@endphp


<div class="col-xxl-6 col-md-12">
    <div class="payment-box payment-box-v2">
        <div class="payment-icon">
            <img src="{{ static_asset('images/payment-icon/payoneer.svg') }}" alt="bank">
            <span class="title">{{__('bank')}}</span>
        </div>

        <div class="payment-settings ms-sm-auto">
            <div class="payment-settings-btn">
                <a href="#" class="btn btn-md sg-btn-outline-primary" data-bs-toggle="modal" data-bs-target="#paytmConfiguration"><i class="las la-cog"></i> <span>Setting</span></a>
            </div>
        </div>

        <div class="payment-checker">
            <div div class="d-flex justify-content-between gap-40">
                <label for="checkbox2">{{__('default_method')}} :</label>
                <div class="setting-check">
                    @if(!blank($data))
                        <input type="checkbox" class="instructor-status-change"
                               {{ ($data->is_default == 1) ? 'checked' : '' }} data-id="{{ $data->id }}" value="payout-default-change/{{$data->id}}"
                               id="customSwitch1-{{$data->id}}">
                        <label for="customSwitch1-{{ $data->id }}"></label>
                    @else
                        <input type="checkbox" class="instructor-status-change"
                               data-id="" value="payout-default-change/"
                               id="paytm1">
                        <label for="paytm1"></label>
                    @endif
                </div>
            </div>

            <div div class="d-flex justify-content-between gap-40 mt-20">
                <label for="checkbox2">{{__('activation')}} :</label>
                <div class="setting-check">
                    @if(!blank($data))
                        <input type="checkbox" class="instructor-status-change"
                               {{ ($data->status == 1) ? 'checked' : '' }} data-id="{{ $data->id }}" value="payout-status-change/{{$data->id}}"
                               id="customSwitch2-{{$data->id}}">
                        <label for="customSwitch2-{{ $data->id }}"></label>
                    @else
                        <input type="checkbox" class="instructor-status-change"
                               data-id="" value="payout-status-change/"
                               id="paytm2">
                        <label for="paytm2"></label>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Payment box -->
<div class="modal fade" id="paytmConfiguration" tabindex="-1" aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <h6 class="sub-title">{{__('Paytm Configuration') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('organization.payouts.method-setting-update') }}" method="post" class="form">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="is_modal" class="is_modal" value="0">
                    <input type="hidden" name="payout_method" value="bank">
                    <input type="hidden" name="organization_id" value="{{ authOrganizationId() }}">
                    <div class="col-sm-6">
                        <div class="mb-4">
                            <label for="bankName" class="form-label">{{__('bank_name')}}</label>
                            <input type="text" class="form-control rounded-2" id="bankName" placeholder="{{__('bank_name')}}"  name="value[bank_name]" value="{{ $data ?  $data->value['bank_name']: ''  }}">
                        </div>
                    </div>
                    <!-- End Bank Name -->

                    <div class="col-sm-6">
                        <div class="mb-4">
                            <label for="accountNumber" class="form-label">{{__('account_number')}}</label>
                            <input type="text" class="form-control rounded-2" id="accountNumber" placeholder="{{__('account_number')}}" name="value[account_number]" value="{{ $data ?  $data->value['account_number']: ''  }}">
                        </div>
                    </div>
                    <!-- End Account Number -->

                    <div class="col-sm-6">
                        <div class="mb-4">
                            <label for="accountHolderName" class="form-label">{{__('account_holder_name')}}</label>
                            <input type="text" class="form-control rounded-2" id="accountHolderName" placeholder="{{__('account_holder_name')}}" name="value[account_holder]" value="{{ $data ?  $data->value['account_holder']: ''  }}">
                        </div>
                    </div>
                    <!-- End Account Holder Name -->

                    <div class="col-sm-6">
                        <div class="mb-4">
                            <label for="branchName" class="form-label">{{__('branch_name')}}</label>
                            <input type="text" class="form-control rounded-2" id="branchName" placeholder="{{__('branch_name')}}" name="value[branch_name]" value="{{ $data ?  $data->value['branch_name']: ''  }}">
                        </div>
                    </div>
                    <!-- End Branch Name -->

                    <div class="col-sm-6">
                        <div class="">
                            <label for="routingNumber" class="form-label">{{__('routing_number')}}</label>
                            <input type="number" class="form-control rounded-2" id="routingNumber" placeholder="{{__('routing_number')}}" name="value[routing_number]" value="{{ $data ?  $data->value['routing_number']: ''  }}">
                        </div>
                    </div>
                    <!-- End Routing Number -->

                    <div class="col-sm-6">
                        <div class="">
                            <label for="swiftCode" class="form-label">{{__('swift_code')}}</label>
                            <input type="text" class="form-control rounded-2" id="swiftCode" placeholder="{{__('swift_code')}}" name="value[swift_code]" value="{{ $data ?  $data->value['swift_code']: ''  }}">
                        </div>
                    </div>
                    <!-- End Swift Code -->
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
