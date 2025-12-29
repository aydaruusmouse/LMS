@extends('backend.layouts.master')
@section('title', __('create_blog_category'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('create_new_category') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row">
                            <form action="{{ route('blog-categories.store') }}" class="form-validate form" method="POST">
                                @csrf
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{__('title') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control rounded-2" id="title" name="title"
                                               placeholder="{{ __('enter_title') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error">{{ $errors->first('title') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" class="is_modal" value="0"/>

                                @include('components.meta-fields')

                                <div class="d-flex justify-content-end align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.gallery-modal')
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush

