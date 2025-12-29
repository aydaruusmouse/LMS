@extends('backend.layouts.master')
@section('title', __('edit_page'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_page') }}</h3>
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
                            <form action="{{ route('pages.update',$page->id) }}" class="form-validate form" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $page->id }}">
                                <input type="hidden" value="{{ $lang }}" name="lang">
                                <input type="hidden" value="{{ $page_language->translation_null == 'not-found' ? '' : $page_language->id }}" name="translate_id">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{__('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="title" name="title"
                                               placeholder="{{ __('enter_title') }}" value="{{ $page_language->title }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error">{{ $errors->first('title') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="is_modal" value="0"/>
                                <input type="hidden" value="custom_page" name="type"/>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="link" class="form-label">{{__('link_or_slug') }}</label>
                                        <input type="text" class="form-control rounded-2" id="link" name="link"
                                               placeholder="{{ __('enter_link_or_slug') }}" value="{{ $page->link }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="link_error error">{{ $errors->first('link') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="editor-wrapper mb-4">
                                        <label for="content" class="form-label">{{__('content') }}</label>
                                        <textarea class="template-body" id="product-update-editor" name="content">{!! $page_language->content !!}</textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="content_error error">{{ $errors->first('content') }}</p>
                                        </div>
                                    </div>
                                </div>
                                @include('components.meta-fields',[
                                                    'meta_title' => $page_language->meta_title,
                                                    'meta_keywords' => $page_language->meta_keywords,
                                                    'meta_description' => $page_language->meta_description,
                                                    'meta_image' => $page->meta_image,
                                                    'edit' => $page,
])

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
