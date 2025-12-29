@extends('backend.layouts.master')
@section('title', __('slider'))
@section('content')
    <!-- Add Slider Section -->
    <section class="add-sider-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('add') }} {{__('new_slider') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('sliders.store') }}" method="post" enctype="multipart/form-data"
                              class="form">
                            @csrf
                            <input type="hidden" value="0" class="is_modal" name="is_modal">
                            <div class="row">
                                <div class="col-lg-12  custom-image">
                                    <div class="select-type-v2 mb-4">
                                        <label for="action_type" class="form-label">{{__('action_type') }}</label>
                                        <select id="action_type"
                                                class="form-select form-select-lg mb-3 search-action-to without_search"
                                                aria-label=".form-select-lg example" name="source">
                                            <option value="course">{{__('course') }}</option>
                                            <option value="url">{{__('url') }}</option>
                                            @if(addon_is_activated('book_store'))
                                                <option value="book">{{__('book') }}</option>
                                            @endif
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="source_error error">{{ $errors->first('source_type') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Action Type for select course -->
                                <div class="col-lg-12 course">
                                    <div class="mb-4">
                                        <div class="select-type-v2">
                                            <label for="select_course"
                                                   class="form-label">{{ __('select_course') }}</label>
                                            <select id="select_course" name="sliderable_id"
                                                    placeholder="{{ __('select_course') }}"
                                                    data-route="{{ route('ajax.courses') }}"
                                                    class="form-select-lg rounded-0 mb-3"
                                                    aria-label=".form-select-lg example">
                                            </select>
                                            <div class="nk-block-des text-danger">
                                                <p class="error sliderable_id_error">{{ $errors->first('sliderable_id') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Action To -->

                                @if(addon_is_activated('book_store'))
                                    <div class="col-lg-12 book d-none">
                                        <div class="select-type-v2 mb-4">
                                            <label for="book_id" class="form-label">{{__('select_book') }}</label>
                                            <div class="action-display">
                                                <select id="book_id" class="form-select select2 mb-3 with_search"
                                                        aria-label=".form-select-lg example" name="sliderable_id">
                                                    <option value="">{{__('select_book') }}</option>
                                                    @foreach($books as $book)
                                                        <option value="{{ $book->id }}">{{__($book->title) }} </option>
                                                    @endforeach
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="course_id_error error">{{ $errors->first('course_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <!-- End Action Type for book -->

                                <!-- End Action To -->

                                <div class="col-lg-12 url d-none">
                                    <div class="mb-4">
                                        <label for="url" class="form-label">{{ __('url') }}</label>
                                        <input type="text" class="form-control rounded-2" id="url"
                                               placeholder="{{ __('url') }}" name="url" value="{{ old('url') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="url_error error">{{ $errors->first('url') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="order_no" class="form-label">{{ __('order') }}</label>
                                        <input type="number" class="form-control rounded-2" id="order_no"
                                               placeholder="Order" name="order_no" value="{{ old('order_no') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="order_no_error error">{{ $errors->first('order_no') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Order -->

                                @include('backend.common.media-input',[
                                        'title' => 'Slider Image',
                                        'name'  => 'image',
                                        'col'   => 'col-12',
                                        'size'  => '(305x150)',
                                        'image' => old('image'),
                                        'label' => __('background_image'),
                                    ])
                                <!-- End Select Image -->


                                <div class="d-flex justify-content-between align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.gallery-modal')
@endsection
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            searchCourse($('#select_course'));
            $(document).on('change','#action_type',function (){
                let val = $(this).val();
                $('.course').addClass('d-none');
                $('.book').addClass('d-none');
                $('.url').addClass('d-none');
                $('.'+val).removeClass('d-none');
            });
        });
    </script>
@endpush
