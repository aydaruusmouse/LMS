@extends('backend.layouts.master')
@section('title', __('otp_setting'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-top d-flex justify-content-between align-items-center">
                    <h3 class="section-title">{{__('otp_setting') }}</h3>
                    <div class="oftions-content-right mb-12">
                        <a href="#" class="d-flex align-items-center btn sg-btn-primary gap-2"
                           data-bs-toggle="modal" data-bs-target="#test_number">
                            <i class="las la-plus"></i>
                            <span>{{__('test_number') }}</span>
                        </a>
                    </div>
                </div>
                <div class="bg-white redious-border pt-30 p-20 p-sm-30">
                    <form action="{{ route('otp.setting') }}" method="post" class="form">@csrf
                        <div class="row gx-20">
                            <h6 class="mb-3">{{ __('sms_providers') }}</h6>
                            <div class="col-lg-12">
                                <div class="d-flex flex-wrap">
                                    <div class="custom-radio me-40 mb-20">
                                        <label>
                                            <input type="radio" value="twillio"
                                                   name="active_sms_provider" {{ setting('active_sms_provider') == 'twillio' || !setting('active_sms_provider') ? 'checked' : '' }}>
                                            <span class="ps-30">{{ __('twilio') }}</span>
                                        </label>
                                    </div>

                                    <div class="custom-radio me-40 mb-20">
                                        <label>
                                            <input type="radio" name="active_sms_provider"
                                                   value="fast2" {{ setting('active_sms_provider') == 'fast2' ? 'checked' : '' }}>
                                            <span class="ps-30">{{ __('fast_2SMS') }}</span>
                                        </label>
                                    </div>

                                    <div class="custom-radio me-40 mb-20">
                                        <label>
                                            <input type="radio" name="active_sms_provider"
                                                   value="spagreen" {{ setting('active_sms_provider') == 'spagreen' ? 'checked' : '' }}>
                                            <span class="ps-30">{{ __('reve_systems') }}</span>
                                        </label>
                                    </div>

                                    <div class="custom-radio me-40 mb-20">
                                        <label>
                                            <input type="radio" name="active_sms_provider"
                                                   value="mimo" {{ setting('active_sms_provider') == 'mimo' ? 'checked' : '' }}>
                                            <span class="ps-30">{{ __('mimo') }}</span>
                                        </label>
                                    </div>

                                    <div class="custom-radio me-40 mb-20">
                                        <label>
                                            <input type="radio" name="active_sms_provider"
                                                   value="nexmo" {{ setting('active_sms_provider') == 'nexmo' ? 'checked' : '' }}>
                                            <span class="ps-30">{{ __('nexmo') }}</span>
                                        </label>
                                    </div>

                                    <div class="custom-radio me-40 mb-20">
                                        <label>
                                            <input type="radio" name="active_sms_provider"
                                                   value="ssl_wireless" {{ setting('active_sms_provider') == 'ssl_wireless' ? 'checked' : '' }}>
                                            <span class="ps-30">{{ __('ssl_wireless') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- End SMS Providers -->

                            <div
                                class="col-lg-12 twillio_div {{ setting('active_sms_provider') == 'twillio' || !setting('active_sms_provider') ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="twilioSID" class="form-label">{{ __('twilio_sid') }}</label>
                                    <input type="text" class="form-control rounded-2" id="twilioSID" name="twilio_sms_sid" value="{{ stringMasking(setting('twilio_sms_sid'),'*',3,-3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="twilio_sms_sid_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Twilio SID -->

                            <div
                                class="col-lg-12 twillio_div {{ setting('active_sms_provider') == 'twillio' || !setting('active_sms_provider') ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="twilioAuthToken"
                                           class="form-label">{{ __('twilio_auth_token') }}</label>
                                    <input type="text" class="form-control rounded-2" name="twilio_sms_auth_token" id="twilioAuthToken" value="{{ stringMasking(setting('twilio_sms_auth_token'),'*',3,-3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="twilio_sms_auth_token_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Twilio Auth Token -->

                            <div
                                class="col-lg-12 twillio_div {{ setting('active_sms_provider') == 'twillio' || !setting('active_sms_provider') ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="validTwilioNumber"
                                           class="form-label">{{ __('valid_twilio_number') }}</label>
                                    <input type="text" class="form-control rounded-2" id="validTwilioNumber" name="valid_twilio_sms_number" value="{{ stringMasking(setting('valid_twilio_sms_number'),'*',3,-3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="valid_twilio_sms_number_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Valid Twilio Number -->
                            <!-- End Twilio Fields -->


                            <div
                                class="col-lg-12 fast2_div {{ setting('active_sms_provider') == 'fast2' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="authKey" class="form-label">{{ __('auth_key') }}</label>
                                    <input type="text" class="form-control rounded-2" id="authKey" name="fast_2_auth_key" value="{{ stringMasking(setting('fast_2_auth_key'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="fast_2_auth_key_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Auth Key -->

                            <div
                                class="col-lg-12 fast2_div {{ setting('active_sms_provider') == 'fast2' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="entityID" class="form-label">{{ __('entity_id') }}</label>
                                    <input type="text" class="form-control rounded-2" id="entityID" name="fast_2_entity_id" value="{{ stringMasking(setting('fast_2_entity_id'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="fast_2_entity_id_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Entity ID -->

                            <div
                                class="col-lg-6 fast2_div {{ setting('active_sms_provider') == 'fast2' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="route" class="form-label">{{ __('route') }}</label>
                                    <div class="select-type-v2">
                                        <select id="route" class="form-select form-select-lg mb-3 without_search"
                                                name="fast_2_route">
                                            <option value="dlt_manual">{{ __('dlt_manual') }}</option>
                                            <option value="promotional_use">{{ __('promotional_use') }}</option>
                                            <option value="transactional_use">{{ __('transactional_use') }}</option>
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="fast_2_route_error error"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Route -->

                            <div
                                class="col-lg-6 fast2_div {{ setting('active_sms_provider') == 'fast2' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="language" class="form-label">{{ __('language') }}</label>
                                    <div class="select-type-v2">
                                        <select id="language" class="form-select form-select-lg mb-3 without_search"
                                                name="fast_2_language">
                                            <option value="english">{{ __('english') }}</option>
                                            <option value="Unicode">{{ __('unicode') }}</option>
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="fast_2_language_error error"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Language -->

                            <div
                                class="col-lg-12 fast2_div {{ setting('active_sms_provider') == 'fast2' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="senderID" class="form-label">{{ __('sender_id') }}</label>
                                    <input type="text" class="form-control rounded-2" id="senderID" name="fast_2_sender_id" value="{{ stringMasking(setting('fast_2_sender_id'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="fast_2_sender_id_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Sender ID -->
                            <!-- End Fast 2SMS Fields -->


                            <div
                                class="col-lg-12 spagreen_div {{ setting('active_sms_provider') == 'spagreen' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="REVESystemsApi"
                                           class="form-label">{{ __('reve_systems_api_key') }}</label>
                                    <input type="text" class="form-control rounded-2" id="REVESystemsApi" name="spagreen_sms_api_key" value="{{ stringMasking(setting('spagreen_sms_api_key'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="spagreen_sms_api_key_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End REVE Systems Api Key -->

                            <div class="col-lg-12 spagreen_div  {{ setting('active_sms_provider') == 'spagreen' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="REVESystemsSecret"
                                           class="form-label">{{ __('reve_systems_secret') }}</label>
                                    <input type="text" class="form-control rounded-2" id="REVESystemsSecret" name="spagreen_secret_key" value="{{ stringMasking(setting('spagreen_secret_key'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="spagreen_secret_key_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 spagreen_div  {{ setting('active_sms_provider') == 'spagreen' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="REVESystemsSecret"
                                           class="form-label">{{ __('reve_systems_sender_id') }}</label>
                                    <input type="text" class="form-control rounded-2" id="reve_systems_sender_id" name="spagreen_sender_id" value="{{ stringMasking(setting('spagreen_sender_id'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="spagreen_sender_id_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 spagreen_div  {{ setting('active_sms_provider') == 'spagreen' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="REVESystemsSecret"
                                           class="form-label">{{ __('sms_url') }}</label>
                                    <input type="text" class="form-control rounded-2" id="reve_systems_base_url" name="spagreen_sms_url" value="{{ stringMasking(setting('spagreen_sms_url'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="spagreen_sms_url_error error"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 mimo_div  {{ setting('active_sms_provider') == 'mimo' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="MIMOUsername" class="form-label">{{ __('mimo_username') }}</label>
                                    <input type="text" class="form-control rounded-2" id="MIMOUsername" name="mimo_username" value="{{ stringMasking(setting('mimo_username'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="mimo_username_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End MIMO Username -->

                            <div
                                class="col-lg-12 mimo_div {{ setting('active_sms_provider') == 'mimo' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="MIMOPassword" class="form-label">{{ __('mimo_password') }}</label>
                                    <input type="text" class="form-control rounded-2" id="MIMOPassword" name="mimo_sms_password" value="{{ stringMasking(setting('mimo_sms_password'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="mimo_sms_password_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End MIMO Password -->

                            <div
                                class="col-lg-12 mimo_div {{ setting('active_sms_provider') == 'mimo' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="MIMOSenderID" class="form-label">{{ __('mimo_sender_id') }}</label>
                                    <input type="text" class="form-control rounded-2" id="MIMOSenderID" name="mimo_sms_sender_id" value="{{ stringMasking(setting('mimo_sms_sender_id'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="mimo_sms_sender_id_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End MIMO Sender ID -->
                            <!-- End MIMO Fields -->


                            <div
                                class="col-lg-12 nexmo_div {{ setting('active_sms_provider') == 'nexmo' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="NexmoKey" class="form-label">{{ __('nexmo_key') }}</label>
                                    <input type="text" class="form-control rounded-2" id="NexmoKey" name="nexmo_sms_key" value="{{ stringMasking(setting('nexmo_sms_key'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="nexmo_sms_key_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Nexmo Key -->

                            <div
                                class="col-lg-12 nexmo_div {{ setting('active_sms_provider') == 'nexmo' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="NexmoSecret" class="form-label">{{ __('nexmo_secret') }}</label>
                                    <input type="text" class="form-control rounded-2" id="NexmoSecret" name="nexmo_sms_secret_key" value="{{ stringMasking(setting('nexmo_sms_secret_key'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="nexmo_sms_secret_key_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Nexmo Secret -->
                            <!-- End Nexmo Fields -->


                            <div
                                class="col-lg-12 ssl_wireless_div {{ setting('active_sms_provider') == 'ssl_wireless' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="SSLWirelessKey" class="form-label">{{ __('ssl_sms_api_token') }}</label>
                                    <input type="text" class="form-control rounded-2" id="SSLWirelessKey" name="ssl_sms_api_token" value="{{ stringMasking(setting('ssl_sms_api_token'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="ssl_sms_api_token_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End SSL Wireless Key -->

                            <div class="col-lg-12 ssl_wireless_div {{ setting('active_sms_provider') == 'ssl_wireless' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="SSLWirelessSecret"
                                           class="form-label">{{ __('ssl_sms_sid') }}</label>
                                    <input type="text" class="form-control rounded-2" id="SSLWirelessSecret" name="ssl_sms_sid" value="{{ stringMasking(setting('ssl_sms_sid'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="ssl_sms_sid_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 ssl_wireless_div {{ setting('active_sms_provider') == 'ssl_wireless' ? '' : 'd-none' }}">
                                <div class="mb-4">
                                    <label for="SSLWirelessSecret"
                                           class="form-label">{{ __('ssl_sms_url') }}</label>
                                    <input type="text" class="form-control rounded-2" id="ssl_sms_url" name="ssl_sms_url" value="{{ stringMasking(setting('ssl_sms_url'),'*',3) }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="ssl_sms_url_error error"></p>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex justify-content-end align-items-center mt-30">
                                <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                                @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="test_number" tabindex="-1" aria-labelledby="addCurrencyLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <h6 class="sub-title">{{__('test_number') }} </h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <form action="{{ route('test.number.send') }}" method="post" class="form">@csrf
                    @csrf
                    <div class="col-12">
                        @include('backend.common.tel-input',[
                                            'name'              => 'test_number',
                                            'value'             => old('phone'),
                                            'label'             => __('phone_number'),
                                            'id'                => 'phoneNumber',
                                            'country_id_field'  => 'phone_country_id',
                                            'country_id'        => setting('default_country') ? : 19
                                            ])
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-30">
                        <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
  <script src="{{ static_asset('admin/js/countries.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('change', 'input[name = "active_sms_provider"]', function () {
                let provider = $(this).val();
                $('.twillio_div').addClass('d-none');
                $('.fast2_div').addClass('d-none');
                $('.spagreen_div').addClass('d-none');
                $('.mimo_div').addClass('d-none');
                $('.nexmo_div').addClass('d-none');
                $('.ssl_wireless_div').addClass('d-none');
                $('.' + provider + '_div').removeClass('d-none');
            });
        });
    </script>
@endpush
