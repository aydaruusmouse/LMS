@extends('backend.layouts.master')
@section('title', __('organization'))
@section('content')
    <!-- Organisation Details -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <h3 class="section-title">{{__('organisation_details') }}</h3>
          <div class="default-tab-list default-tab-list-v2  bg-white redious-border p-20 p-sm-30">
            @include('backend.admin.organization.topber')
            <!-- End Organisation Details Tab -->

            <form action="#">
                  <div class="row gx-20">
                    <div class="col-lg-7">
                      <div class="organisationPayment mb-4">
                        <label for="organisationPayment">{{__('payment_method')}}</label>
                        <div class="select-type-v2">
                          <select id="organisationPayment" class="form-select form-select-lg mb-3 without_search">
                            <option selected>{{__('paypal')}}</option>
                            <option value="1">{{__('bkash')}}</option>
                            <option value="2">{{__('google_pay')}}</option>
                            <option value="3">{{__('paytm')}}</option>
                            <option value="4">{{__('mercado')}}</option>
                            <option value="5">{{__('razorpay')}}</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- End Payment method Select -->

                    <div class="col-lg-6">
                      <label for="email" class="form-label">{{__('paypal_email')}}</label>
                      <input type="email" class="form-control rounded-2" id="email" placeholder="kenzi.lawson@example.com" >
                    </div>
                    <!-- End Email -->

                    <div class="d-flex justify-content-end align-items-center mt-30">
                      <button type="button" class="btn sg-btn-primary">{{__('save')}}</button>
                    </div>
                    <!-- End Submit BTN -->
                  </div>

                  <!-- Paymen method form for Bank Account====== -->
                  <div class="row gx-20">
                    <div class="col-lg-7">
                      <div class="organisationPayment mb-4">
                        <label for="organisationPayment">{{__('payment_method')}}</label>
                        <div class="select-type-v2">
                          <select id="organisationPayment" class="form-select form-select-lg mb-3 without_search">
                            <option selected>{{__('bank')}}</option>
                            <option value="1">{{__('bkash')}}</option>
                            <option value="2">{{__('google_pay')}}</option>
                            <option value="3">{{__('paytm')}}</option>
                            <option value="4">{{__('mercado')}}</option>
                            <option value="5">{{__('razorpay')}}</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- End Payment method Select -->

                    <div class="col-lg-6 col-md-6">
                      <div class="mb-4">
                        <label for="bankName" class="form-label">{{__('bank_name')}}</label>
                        <input type="text" class="form-control rounded-2" id="bankName">
                      </div>
                    </div>
                    <!-- End Bank Name -->

                    <div class="col-lg-6 col-md-6">
                      <div class="mb-4">
                        <label for="accountNumber" class="form-label">{{__('account_number')}}</label>
                        <input type="number" class="form-control rounded-2" id="accountNumber">
                      </div>
                    </div>
                    <!-- End Account Number -->

                    <div class="col-lg-6 col-md-6">
                      <div class="mb-4">
                        <label for="accountHolderName" class="form-label">{{__('account_holder_name')}}</label>
                        <input type="text" class="form-control rounded-2" id="accountHolderName">
                      </div>
                    </div>
                    <!-- End Account Holder Name -->

                    <div class="col-lg-6 col-md-6">
                      <div class="mb-4">
                        <label for="branch" class="form-label">{{__('branch')}}</label>
                        <input type="text" class="form-control rounded-2" id="branch">
                      </div>
                    </div>
                    <!-- End Branch -->

                    <div class="col-lg-6 col-md-6">
                      <label for="routingNumber" class="form-label">{{__('routing_number')}}</label>
                      <input type="email" class="form-control rounded-2" id="routingNumber">
                    </div>
                    <!-- End Routing Number -->

                    <div class="col-lg-6 col-md-6">
                      <label for="swiftCode" class="form-label">{{__('swift_code')}}</label>
                      <input type="text" class="form-control rounded-2" id="swiftCode">
                    </div>
                    <!-- End Swift Code -->

                    <div class="d-flex justify-content-end align-items-center mt-30">
                      <button type="button" class="btn sg-btn-primary">{{__('save')}}</button>
                    </div>
                    <!-- End Submit BTN -->
                  </div>

                  <!-- Paymen method form for Offline Payment====== -->
                  <div class="row gx-20">
                    <div class="col-lg-7">
                      <div class="organisationPayment mb-4">
                        <label for="organisationPayment" class="form-label">{{__('payment_method')}}</label>
                        <div class="select-type-v2">
                          <select id="organisationPayment" class="form-select form-select-lg mb-3 without_search">
                            <option selected>{{__('offline_payment')}}</option>
                            <option value="1">{{__('bkash')}}</option>
                            <option value="2">{{__('google_pay')}}</option>
                            <option value="3">{{__('paytm')}}</option>
                            <option value="4">{{__('mercado')}}</option>
                            <option value="5">{{__('razorpay')}}</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- End Payment method Select -->


                    <div class="col-lg-12">
                      <div class="">
                        <label for="describeDetails" class="form-label">{{__('describe_details')}}</label>
                        <textarea class="form-control" id="describeDetails"></textarea>
                      </div>
                    </div>
                    <!-- End Email -->
                    <div class="d-flex justify-content-end align-items-center mt-30">
                      <button type="button" class="btn sg-btn-primary">{{__('save')}}</button>
                    </div>
                    <!-- End Submit BTN -->
                  </div>
                <!-- END Payment Tab====== -->
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection
@include('backend.common.change-status-script')
