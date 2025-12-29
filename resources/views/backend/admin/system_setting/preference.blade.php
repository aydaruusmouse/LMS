@extends('backend.layouts.master')
@section('title', __('general_setting'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-6 col-md-9">
                <h3 class="section-title">{{ __('system_settings') }}</h3>
                <div class="bg-white redious-border pt-30 p-20 p-sm-30">
                    <div class="section-top">
                        <h6>{{ __('preference') }}</h6>
                    </div>
                    <div class="row gx-20">
                        <div class="col-lg-6">
                            <h6 class="mb-3">{{ __('system') }}</h6>
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="HTTPSActivation">{{ __('https_activation') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change"
                                               id="HTTPSActivation"
                                               value="setting-status-change/https" {{ setting('https') == 1 ? 'checked' : ''}}>
                                        <label for="HTTPSActivation"></label>
                                    </div>

                                </div>

                            </div>
                            <!-- End HTTPS Activation -->

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="maintenanceModeActivation">
                                        {{ __('maintenance_mode_activation') }}
                                        @if(setting('maintenance_mode') == 1)
                                            <br>
                                            <small class="text-danger warning_text">{{ __('access_your_site') }}
                                                <strong>
                                                    <a class="text-danger" target="_blank"
                                                       href="{{ url(setting('maintenance_secret')) }}">{{ url(setting('maintenance_secret')) }}</a>
                                                </strong>
                                            </small>
                                        @endif
                                    </label>
                                    <div class="setting-check">
                                        <input data-field_for="maintenance_mode" type="checkbox" class="status-change"
                                               id="maintenanceModeActivation"
                                               value="setting-status-change/maintenance_mode" {{ setting('maintenance_mode') == 1 ? 'checked' : ''}}>
                                        <label for="maintenanceModeActivation"></label>
                                    </div>
                                </div>


                            </div>
                            <!-- End Maintenance Mode Activation -->

                            <h6 class="mb-3 mt-30">{{ __('business_related') }}</h6>

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="sellerProductApprove">{{ __('instructor_course_auto_approve')}}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="sellerProductApprove"
                                               value="setting-status-change/instructor_course_auto_approve" {{ setting('instructor_course_auto_approve') == 1 ? 'checked' : ''}}>
                                        <label for="sellerProductApprove"></label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Seller Product Auto Approve -->

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="walletSystemActivation">{{ __('wallet_system_activation') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="walletSystemActivation"
                                               value="setting-status-change/wallet_system" {{ setting('wallet_system') == 1 ? 'checked' : ''}}>
                                        <label for="walletSystemActivation"></label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Wallet System Activation -->

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="couponSystemActivation">{{ __('coupon_system_activation') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="couponSystemActivation"
                                               value="setting-status-change/coupon_system" {{ setting('coupon_system') == 1 ? 'checked' : ''}}>
                                        <label for="couponSystemActivation"></label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Coupon System Activation -->

<!--                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="liveAPICurrency">{{ __('live_api_exchange_rate') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="liveAPICurrency"
                                               value="setting-status-change/live_api_currency" {{ setting('live_api_currency') == 1 ? 'checked' : ''}}>
                                        <label for="liveAPICurrency"></label>
                                    </div>
                                </div>
                            </div>-->
                            <!-- End Use Live API for Currency Exchange Rate -->

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="enableEmailConfirmation">{{ __('disable_email_confirmation') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="enableEmailConfirmation"
                                               value="setting-status-change/disable_email_confirmation" {{ setting('disable_email_confirmation') == 1 ? 'checked' : ''}}>
                                        <label for="enableEmailConfirmation"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="enableOTPConfirmation">{{ __('disable_otp_verification') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="enableOTPConfirmation"
                                               value="setting-status-change/disable_otp_verification" {{ setting('disable_otp_verification') == 1 ? 'checked' : ''}}>
                                        <label for="enableOTPConfirmation"></label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Disable Email Confirmation -->

                            <h6 class="mb-3 mt-30">{{ __('course_preference') }}</h6>

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="hide_instructor">{{ __('hide_instructor_from_course_details') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="hide_instructor"
                                               value="setting-status-change/hide_instructor_from_course_details" {{ setting('hide_instructor_from_course_details') == 1 ? 'checked' : ''}}>
                                        <label for="hide_instructor"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="hide_curriculum">{{ __('hide_curriculum_from_course_details') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="hide_curriculum"
                                               value="setting-status-change/hide_curriculum_from_course_details" {{ setting('hide_curriculum_from_course_details') == 1 ? 'checked' : ''}}>
                                        <label for="hide_curriculum"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="hide_faq">{{ __('hide_faq_from_course_details') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="hide_faq"
                                               value="setting-status-change/hide_faq_from_course_details" {{ setting('hide_faq_from_course_details') == 1 ? 'checked' : ''}}>
                                        <label for="hide_faq"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="hide_review">{{ __('hide_review_from_course_details') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="hide_review"
                                               value="setting-status-change/hide_review_from_course_details" {{ setting('hide_review_from_course_details') == 1 ? 'checked' : ''}}>
                                        <label for="hide_review"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="disable_write_review">{{ __('disable_write_review') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="disable_write_review"
                                               value="setting-status-change/disable_write_review" {{ setting('disable_write_review') == 1 ? 'checked' : ''}}>
                                        <label for="disable_write_review"></label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="hide_organization">{{ __('hide_organization_from_course_details') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="hide_organization"
                                               value="setting-status-change/hide_organization_from_course_details" {{ setting('hide_organization_from_course_details') == 1 ? 'checked' : ''}}>
                                        <label for="hide_organization"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="disable_share_option">{{ __('disable_share_option_from_course_details') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="disable_share_option"
                                               value="setting-status-change/disable_share_option_from_course_details" {{ setting('disable_share_option_from_course_details') == 1 ? 'checked' : ''}}>
                                        <label for="disable_share_option"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="disable_related_course">{{ __('disable_related_course_from_course_details') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="disable_related_course"
                                               value="setting-status-change/disable_related_course_from_course_details" {{ setting('disable_related_course_from_course_details') == 1 ? 'checked' : ''}}>
                                        <label for="disable_related_course"></label>
                                    </div>
                                </div>
                            </div>

                            <h6 class="mb-3 mt-30">{{ __('instructor_preference') }}</h6>

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="hide_all_instructor_contact_information_from_everywhere">{{ __('hide_all_instructor_contact_information_from_everywhere') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="hide_all_instructor_contact_information_from_everywhere"
                                               value="setting-status-change/hide_all_instructor_contact_information_from_everywhere" {{ setting('hide_all_instructor_contact_information_from_everywhere') == 1 ? 'checked' : ''}}>
                                        <label for="hide_all_instructor_contact_information_from_everywhere"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="hide_instructor_contact_information">{{ __('hide_instructor_contact_information') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="hide_instructor_contact_information"
                                               value="setting-status-change/hide_instructor_contact_information" {{ setting('hide_instructor_contact_information') == 1 ? 'checked' : ''}}>
                                        <label for="hide_instructor_contact_information"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="hide_instructor_social_contact_information">{{ __('hide_instructor_social_contact_information') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="hide_instructor_social_contact_information"
                                               value="setting-status-change/hide_instructor_social_contact_information" {{ setting('hide_instructor_social_contact_information') == 1 ? 'checked' : ''}}>
                                        <label for="hide_instructor_social_contact_information"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="hide_contact_form">{{ __('hide_contact_form') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" class="status-change" id="hide_contact_form"
                                               value="setting-status-change/hide_contact_form" {{ setting('hide_contact_form') == 1 ? 'checked' : ''}}>
                                        <label for="hide_contact_form"></label>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="maintenance_mode" tabindex="-1" aria-labelledby="editCurrencyLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <h6 class="sub-title create_sub_title">{{__('maintenance_mode_setting') }}</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <form action="{{ route('setting.status.change') }}" method="POST">
                    @csrf
                    <input type="hidden" class="maintenance_mode" value="1" name="maintenance_mode">
                    <div class="row gx-20">
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="maintenance_secret" class="form-label">{{__('maintenance_mode') }}</label>
                                <input type="text" class="form-control rounded-2 maintenance_secret"
                                       id="maintenance_secret"
                                       placeholder="{{ __('e.g.') }}123" name="maintenance_secret" required>
                                <div class="nk-block-des text-danger">
                                    <p class="maintenance_secret_error error"></p>
                                </div>
                                <p class="text-danger">{!! __('maintenance_mode_text',['url' => url('/your_given_secret_code')]) !!}</p>
                                <p class="mt-2">{{ __('e.g.') }} : <a href="{{ url('/123') }}">{{ url('/123') }}</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-30">
                        <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
