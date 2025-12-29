@extends('backend.layouts.master')
@section('title', __('ai_writer'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{ __('generate_ai_content') }}</h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="bg-white redious-border p-20 p-sm-30">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="#" class="form-validate" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-4">
                                                        <label for="use_case" class="form-label">{{__('use_case') }}
                                                            <span
                                                                class="text-danger">*</span></label>
                                                        <select name="use_case" class="with_search" id="use_case">
                                                            @foreach($use_cases as $key=> $use_case)
                                                                <option value="{{ $key }}">{{ $use_case }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="nk-block-des text-danger">
                                                            <p class="use_case_error error">{{ $errors->first('use_case') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-4">
                                                        <label for="primary_keyword"
                                                               class="form-label">{{__('primary_keyword') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control rounded-2"
                                                               id="primary_keyword"
                                                               name="primary_keyword"
                                                               placeholder="{{ __('enter_primary_keyword') }}">
                                                        <div class="nk-block-des text-danger">
                                                            <p class="secret_key_error error">{{ $errors->first('secret_key') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-4">
                                                        <label for="use_case" class="form-label">{{__('variants') }}
                                                            <span
                                                                class="text-danger">*</span></label>
                                                        <select name="variants" class="without_search" id="variants">
                                                            <option value="1">1 {{ __('variants') }}</option>
                                                            <option value="2">2 {{ __('variants') }}</option>
                                                            <option value="3">3 {{ __('variants') }}</option>
                                                        </select>
                                                        <div class="nk-block-des text-danger">
                                                            <p class="variants_error error">{{ $errors->first('variants') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end align-items-center mt-30">
                                                    <button type="submit" data-url="{{ route('ai.content') }}" class="btn sg-btn-primary generate_content_for_me">{{__('generate_content') }}</button>
                                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary generator_loading_btn'])
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="bg-white redious-border p-20 p-sm-30">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="editor-wrapper mb-4">
                                            <label for="description" class="form-label">{{__('generated_content') }}</label>
                                            <textarea class="template-body ai_description" name="decription"></textarea>
                                            <div class="nk-block-des text-danger">
                                                <p class="description_error error">{{ $errors->first('content') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="{{ static_asset('admin/js/ai_writer.js') }}"></script>
    <script>
        $('.ai_description').summernote({
            height: 210
        });
    </script>
@endpush
