@extends('backend.layouts.master')
@section('title', __('email_setting'))
@section('content')
    <div class="main-content-wrapper">
        <!-- Main content wrapper=== -->
        <!-- Product Details -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('email_settings') }}</h3>
                    <div class="bg-white redious-border pt-30 p-40">
                        <div class="section-top">
                            <h6>{{__('server_configuration') }}</h6>
                            <div class=" d-flex gap-20">
                                {{-- <button type="submit" class="btn sg-btn-primary" name="test_mail" value="test-mail">Test Mail</button> --}}
                                <button type="button" class="btn sg-btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#testMail">{{__('test_mail') }}</button>
                            </div>
                        </div>

                        <form action="{{ route('email.server-configuration.update') }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row gx-20">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="emailServer"
                                               class="form-label">{{__('email_server_provider') }}</label>
                                        <div class="select-type-v2">
                                            <select id="emailServer"
                                                    class="form-select form-select-lg rounded-0 mb-3 with_search"
                                                    aria-label=".form-select-lg example" name="mail_server">
                                                <option
                                                    {{ old('mail_driver') =='smtp' ? 'selected' : (((old('mail_driver') =='' && $mail_driver =='smtp')  || $mail_driver == '') ? 'selected' : '' ) }} value="smtp">
                                                    SMTP ({{ __('recommended') }})
                                                </option>
                                                <option
                                                    {{ old('mail_driver') =='sendgrid' ? 'selected' : ((old('mail_driver') =='' && $mail_driver =='sendgrid') ? 'selected' : '' ) }} value="sendgrid">
                                                    {{__('sendGrid')}}
                                                </option>
                                                <option
                                                    {{ old('mail_driver') =='mailgun' ? 'selected' : ((old('mail_driver') =='' && $mail_driver =='mailgun') ? 'selected' : '' ) }} value="mailgun">
                                                    {{__('mailGun')}}
                                                </option>
                                                <option
                                                    {{ old('mail_driver') =='sendmail' ? 'selected' : ((old('mail_driver') =='' && $mail_driver =='sendmail') ? 'selected' : '' ) }} value="sendmail">
                                                    {{__('sendmail')}}
                                                </option>
                                                <option
                                                    {{ old('mail_driver') =='sendinBlue' ? 'selected' : ((old('mail_driver') =='' && $mail_driver =='sendinBlue') ? 'selected' : '' ) }} value="sendinBlue">
                                                    {{__('sendinBlue')}}
                                                </option>
                                                <option
                                                    {{ old('mail_driver') =='zohoSMTP' ? 'selected' : ((old('mail_driver') =='' && $mail_driver =='zohoSMTP') ? 'selected' : '' ) }} value="zohoSMTP">
                                                    {{__('zohoSMTP')}}
                                                </option>
                                                <option
                                                    {{ old('mail_driver') =='mailjet' ? 'selected' : ((old('mail_driver') =='' && $mail_driver =='mailjet') ? 'selected' : '' ) }} value="mailjet">
                                                    {{__('mailjet')}}
                                                </option>
                                            </select>
                                            @if($errors->has('mail_server'))
                                                <div class="nk-block-des text-danger">
                                                    <p>{{ $errors->first('mail_server') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- End Email Server Provider -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="SMTPServer"
                                               class="form-label">{{__('smtp_server_address') }}</label>
                                        <input type="text" class="form-control rounded-2" id="SMTPServer"
                                               name="smtp_server_address"
                                               value="{{ old('smtp_server_address',env('MAIL_HOST')) }}">
                                        @if($errors->has('smtp_server_address'))
                                            <div class="nk-block-des text-danger">
                                                <p>{{ $errors->first('smtp_server_address') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- End SMTP Server Address -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="SMTPUser" class="form-label">{{__('smtp_username') }}</label>
                                        <input type="text" class="form-control rounded-2" id="SMTPUser"
                                               placeholder="{{__('smtp_username')}}" name="smtp_user_name"
                                               value="{{ stringMasking(old('smtp_user_name',env('MAIL_USERNAME')),'*',3,-3) }}">
                                        @if($errors->has('smtp_user_name'))
                                            <div class="nk-block-des text-danger">
                                                <p>{{ $errors->first('smtp_user_name') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- End SMTP Username -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="SMTPPassword" class="form-label">{{__('smtp_password') }}</label>
                                        <input type="password" class="form-control rounded-2" id="SMTPPassword"
                                               placeholder="********" name="smtp_password"
                                               value="{{ stringMasking(old('smtp_password',env('MAIL_PASSWORD')),'*',0) }}">
                                        @if($errors->has('smtp_password'))
                                            <div class="nk-block-des text-danger">
                                                <p>{{ $errors->first('smtp_password') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- End SMTP Password -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="SMTPPort" class="form-label">{{__('smtp_port') }}</label>
                                        <input type="number" class="form-control rounded-2" id="SMTPPort"
                                               placeholder="7684" name="smtp_mail_port"
                                               value="{{ old('smtp_mail_port',env('MAIL_PORT')) }}">
                                        @if($errors->has('smtp_mail_port'))
                                            <div class="nk-block-des text-danger">
                                                <p>{{ $errors->first('smtp_mail_port') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- End SMTP Port -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="encryption" class="form-label">{{__('encryption_type') }}</label>
                                        <div class="select-type-v2">
                                            <select id="encryption"
                                                    class="form-select form-select-lg mb-3 without_search"
                                                    aria-label=".form-select-lg example" name="smtp_encryption_type">
                                                <option value="">{{ __('select_encryption_type') }}</option>
                                                <option
                                                    {{ env('MAIL_ENCRYPTION') == 'ssl' ? "selected" : "" }} value="ssl">{{__('SSL')}}</option>
                                                <option
                                                    {{ env('MAIL_ENCRYPTION') == 'tls' ? "selected" : "" }} value="tls">{{__('TLS')}}</option>
                                            </select>
                                            @if($errors->has('smtp_encryption_type'))
                                                <div class="nk-block-des text-danger">
                                                    <p>{{ $errors->first('smtp_encryption_type') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- End Encryption Type -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="MailFName" class="form-label">{{__('mail_from_name') }}</label>
                                        <input type="text" class="form-control rounded-2" id="MailFName"
                                               placeholder="{{__('mail_from_name') }}"
                                               name="smtp_mail_from_name"
                                               value="{{ old('smtp_mail_from_name',env('MAIL_FROM_NAME')) }}">
                                        @if($errors->has('smtp_mail_from_name'))
                                            <div class="nk-block-des text-danger">
                                                <p>{{ $errors->first('smtp_mail_from_name') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- End Mail From Name -->

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="emailAddress"
                                               class="form-label">{{__('mail_from_address')  }}</label>
                                        {{-- <input type="password" class="form-control rounded-2" id="SMTPPassword" placeholder="********"  name="smtp_password" value="@if(config('app.demo_mode'))@else {{ old('smtp_password') ? old('smtp_password') : env('MAIL_PASSWORD') }} @endif"> --}}

                                        <input type="email" class="form-control rounded-2" id="emailAddress"
                                               name="mail_from_address"
                                               value="{{ stringMasking(old('mail_from_address',env('MAIL_FROM_ADDRESS')),'*',3,-3) }}">
                                        @if($errors->has('replay_to'))
                                            <div class="nk-block-des text-danger">
                                                <p>{{ $errors->first('replay_to') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- End Replay To -->

                                <div class="col-lg-12">
                                    <div class="editor-wrapper">
                                        <label class="form-label mb-1">{{__('email_signature') }}</label>
                                        <textarea id="product-update-editor" name="mail_signature">
                            {{ old('mail_signature') ? old('mail_signature') : setting('mail_signature') }}
                          </textarea>
                                    </div>
                                    @if($errors->has('mail_signature'))
                                        <div class="nk-block-des text-danger">
                                            <p>{{ $errors->first('mail_signature') }}</p>
                                        </div>
                                    @endif
                                </div>
                                <!-- End Email Signature -->

                            </div>
                            <!-- END Permissions Tab====== -->
                            @if(hasPermission('email.server-configuration.edit'))
                                <div class="d-flex justify-content-between align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{__('update') }}</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END Main Content Wrapper -->
    <!-- Modal For Test Mail======================== -->
    <div class="modal fade" id="testMail" tabindex="-1" aria-labelledby="testMailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <h6 class="fs-4">{{__('Send Test Mail') }}</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <form action="{{ route('email.test') }}" method="post">
                    @csrf
                    <div class="row gx-20">
                        <div class="col-12">
                            <div class="mt-5">
                                <label for="testMail" class="form-label bold">{{__('send_to') }}</label>
                                <input type="email" class="form-control rounded-2" id="testMail"
                                       placeholder="example@email.com" name="send_to">
                                @if($errors->has('send_to'))
                                    <div class="nk-block-des text-danger">
                                        <p>{{ $errors->first('send_to') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- End Send To -->

                    </div>
                    <!-- END Permissions Tab====== -->
                    <div class="d-flex justify-content-end align-items-center mt-30">
                        <button type="submit" class="btn sg-btn-primary">{{__('send') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Modal For Test Mail======================== -->

@endsection
