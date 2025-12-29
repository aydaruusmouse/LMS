@extends('backend.layouts.master')
@section('title', __('edit_expertise'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_expertise') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
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
                        <form action="{{ route('organization.expertise.update',$expertise->id) }}" class="form-validate form"
                              method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $expertise->id }}">
                            <input type="hidden" value="{{ $lang }}" name="lang">
                            <input type="hidden"
                                   value="{{ $expertise_language->translation_null == 'not-found' ? '' : $expertise_language->id }}"
                                   name="translate_id">
                            <div class="row gx-20 add-coupon">
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="title" name="title"
                                               placeholder="{{ __('enter_title') }}"
                                               value="{{ $expertise_language->title }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-12 sandbox_mode_div">
                                    <input type="hidden" name="status" value="{{ $expertise->status }}">
                                    <label class="form-label"
                                           for="status">{{ __('status') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="status"
                                               class="sandbox_mode" {{ $expertise->status == 1 ? 'checked' : '' }}>
                                        <label for="status"></label>
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
    </section>
@endsection
