@extends('backend.layouts.master')
@section('title', __('create_page'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('create_new_page') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row">
                            <form action="{{ route('pages.store') }}" class="form-validate form" method="POST">
                                @csrf
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{__('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="title" name="title"
                                               placeholder="{{ __('enter_title') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error">{{ $errors->first('title') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="is_modal" value="0"/>
                                <input type="hidden" value="custom_page" name="type"/>

                                <div class="col-12">
                                    <div class="editor-wrapper mb-4">
                                        <label for="content" class="form-label">{{__('content') }}</label>
                                        <textarea class="template-body" id="product-update-editor" name="content"></textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="content_error error">{{ $errors->first('content') }}</p>
                                        </div>
                                    </div>
                                </div>
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
@endsection
