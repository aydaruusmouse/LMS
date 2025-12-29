@extends('backend.layouts.master')
@section('title', __('ai_writer_setting'))
@section('content')

<div class="row justify-content-md-center">
    <div class="col col-lg-8 col-md-9">
        <h3>{{__('ai_writer_setting') }}</h3>
        <div class="bg-white redious-border p-20 p-sm-30">
            <form action="{{ route('ai_writer.setting') }}" class="form-validate form" method="POST">
                @csrf
                <input type="hidden" class="is_modal" value="0"/>
                <div class="col-12">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label for="secret_key" class="form-label">{{__('secret_key') }} <span
                                    class="text-danger">*</span></label>
                            <a href="https://platform.openai.com/account/api-keys"
                               target="_blank">{{ __('click_here_to_get_the_key') }}</a>
                        </div>
                        <input type="text" class="form-control rounded-2" id="secret_key"
                               name="ai_secret_key" value="{{ stringMasking(setting('ai_secret_key'),'*') }}"
                               placeholder="{{ __('enter_secret_key') }}">
                        <div class="nk-block-des text-danger">
                            <p class="secret_key_error error">{{ $errors->first('secret_key') }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-30">
                        <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                    </div>
                </div>
                <!--                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="status" class="form-label">{{__('ai_course_review') }}</label>
                                        <select name="ai_course_review" class="without_search" id="ai_course_review">
                                            <option value="0" {{ setting('ai_course_review') == '0' ? 'selected' : '' }}>{{ __('disable') }}</option>
                                            <option value="1" {{ setting('ai_course_review') == '1' ? 'selected' : '' }}>{{ __('enable') }}</option>
                                            <option value="2" {{ setting('ai_course_review') == '2' ? 'selected' : '' }}>{{ __('depend_on_instructor') }}</option>
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="ai_course_review_error error"></p>
                                        </div>
                                    </div>
                                </div>-->
            </form>
        </div>
    </div>
</div>
@endsection
