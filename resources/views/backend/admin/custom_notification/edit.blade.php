@extends('backend.layouts.master')
@section('title', __('edit_notification'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_coupon') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row">
                            <form action="{{ route('custom-notification.update',$notification->id) }}" class="form-validate form"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <input type="hidden" class="is_modal" value="0"/>
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="couponTitle" class="form-label">{{ __('title') }}</label>
                                            <input type="text" class="form-control rounded-2" id="couponTitle"
                                                   name="title"
                                                   placeholder="{{ __('enter_title') }}"
                                                   value="{{ $notification->title }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="title_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Coupon Title -->
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="popup_description" class="form-label">{{ __('description') }}</label>
                                            <textarea class="form-control" id="popup_description"
                                                      name="description" placeholder="{{ __('enter_description') }}">{{ $notification->description }}</textarea>
                                            <div class="nk-block-des text-danger">
                                                <p class="description_error error">{{ $errors->first('lang') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="multi-select-v2 mb-4">
                                            <label for="user_ids"
                                                   class="form-label">{{ __('select_user') }}</label>
                                            <select id="user_ids" name="user_ids[]" multiple
                                                    class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                    aria-label=".form-select-lg example">
                                                @foreach($users as $user)
                                                    <option
                                                        value="{{ $user->id }}" {{ $notification->user_ids && in_array($user->id,$notification->user_ids) ? 'selected' : '' }}>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="nk-block-des text-danger">
                                                <p class="instructor_ids_error error"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Select Instructor -->

                                    @include('backend.common.media-input',[
                                        'title' => __('banner'),
                                        'name'  => 'image_media_id',
                                        'col'   => 'col-12 mb-4',
                                        'size'  => '(828x490)',
                                        'label' => __('banner'),
                                        'image' => $notification->image,
                                        'edit'  => $notification,
                                        'image_object'  => $notification->image,
                                        'media_id'  => $notification->image_media_id,
                                    ])
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
    @include('backend.common.gallery-modal')
@endsection

@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
    <script>
        $(document).ready(function () {
            searchUser($('#user_ids'));
        });
    </script>
@endpush
