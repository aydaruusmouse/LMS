@extends('backend.layouts.master')
@section('title', __('api_setting'))
@section('content')
    <!-- Oftions Section -->
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('api_setting') }}</h3>
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
                                                <option value="{{ $language->locale }}" {{ $lang == $language->locale ? 'selected' : '' }}>{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="lang_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('apikeys.update', $apikey->id)}}" class="form-validate form"
                                    method="POST">
                                @csrf
                                @method('put')

                                <input type="hidden" name="id" value="{{ $apikey->id }}">
                                <input type="hidden" value="{{ $lang }}" name="lang">
                                <input type="hidden" value="{{ $api_key_language->translation_null == 'not-found' ? '' : $api_key_language->id }}" name="translate_id">
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{__('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="title" name="title"
                                                value="{{ $api_key_language->api_title ? : $api_key_language->title }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="title_error error">{{ $errors->first('title') }}</p>
                                            </div>
                                    </div>
                                </div>
                                <!-- End Title -->

                                <div class="col-lg-12">
                                    <label for="inputGroup" class="form-label">{{__('api_key') }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="inputGroup" name="key"
                                                placeholder="{{ __('add_api_key') }}" value="{{ $apikey->key }}">
                                        <span class="input-group-text get_code" data-length="16"><i class="las la-redo-alt"></i></span>
                                    </div>
                                    <div class="nk-block-des text-danger">
                                        <p class="key_error error">{{ $errors->first('key') }}</p>
                                    </div>
                                </div>
                                <!-- End Add API Key -->
                                <div class="d-flex justify-content-end align-items-center mt-30">
                                    @if(hasPermission('apikeys.edit'))
                                        <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                    @endif
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Oftions Section -->
@endsection
