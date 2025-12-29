@extends('backend.layouts.master')
@section('title', __('edit_coupon'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_coupon') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row">
                            <form>
                                <div class="col-lg-12">
                                    <input type="hidden" name="r" value="{{ url()->current() }}" class="r">
                                    <div class="mb-4">
                                        <label for="lang" class="form-label">{{__('language') }}</label>
                                        <select id="lang"
                                                class="form-select form-select-lg mb-3 with_search" name="lang">
                                            <option value="">{{__('select_language') }}</option>
                                            @foreach($languages as $language)
                                                <option
                                                    value="{{ $language->locale }}" {{ $lang == $language->locale ? 'selected' : '' }}>{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="lang_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('student-faqs.update',$faq->id) }}" class="form-validate form"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $faq->id }}">
                                    <input type="hidden" value="{{ $lang }}" name="lang">
                                    <input type="hidden"
                                           value="{{ $faq_language->translation_null == 'not-found' ? '' : $faq_language->id }}"
                                           name="translate_id">
                                    <input type="hidden" class="is_modal" value="0"/>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="question" class="form-label">{{ __('question') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control rounded-2" id="question" name="question"
                                                   placeholder="{{ __('enter_question') }}" value="{{ $faq_language->question }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="question_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="order" class="form-label">{{ __('order') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control rounded-2" id="order" name="ordering"
                                                   placeholder="{{ __('e.g.5') }}" value="{{ $faq->ordering }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="ordering_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="editor-wrapper">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label mb-1">{{ __('description') }}</label>
                                            </div>
                                            <textarea id="product-update-editor" class="description"
                                                      name="answer">{!! $faq_language->answer !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center mt-30">
                                        <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
