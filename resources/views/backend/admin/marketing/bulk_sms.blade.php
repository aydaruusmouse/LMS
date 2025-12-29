@extends('backend.layouts.master')
@section('title', __('bulk_sms'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12 col-lg-12 col-md-12">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">{{__('bulk_sms') }}</h3>
                    </div>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('bulk.sms') }}" method="POST" class="form">@csrf
                            <div class="row gx-20">
                                <input type="hidden" value="0" class="is_modal" name="is_modal">
                                <div class="col-lg-12">
                                    <div class="select-type-v2 mb-4 ">
                                        <label for="role_ids" class="form-label">{{ __('users') }}</label>
                                        <select class="with_search mb-3" placeholder="{{ __('select_user_type') }}"
                                                name="role_ids[]" multiple id="role_ids">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="role_ids_error error"></p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="message" class="form-label">{{ __('message') }}</label>
                                        <textarea class="form-control" id="popup_description"
                                                  name="message" placeholder="{{ __('enter_message_here') }}"></textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="message_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                @if(setting('active_sms_provider') == 'fast2')
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="popup_title" class="form-label">{{ __('fast2_template_id') }}</label>
                                            <input type="text" class="form-control rounded-2" id="popup_title"
                                                   placeholder="{{ __('enter_fast2_template_id') }}" name="fast2_template_id">
                                            <div class="nk-block-des text-danger">
                                                <p class="fast2_template_id_error error">{{ $errors->first('lang') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-start align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                </div>
                                @if(!setting('active_sms_provider'))
                                    <p class="text-warning mt-4">{{ __('no_sms_provider_found') }} <a class="text-warning" target="_blank"
                                                href="{{ route('otp.setting') }}">{{ __('click_here_to_configure') }}</a></p>

                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
