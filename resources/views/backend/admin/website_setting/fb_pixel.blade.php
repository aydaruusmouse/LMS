@extends('backend.layouts.master')
@section('title', __('fb_pixel'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('backend.admin.website_setting.sidebar_component')
            <div class="col-xxl-9 col-lg-8 col-md-8">
                <h3 class="section-title">{{ __('fb_pixel') }}</h3>
                <div class="bg-white redious-border pt-30 p-20 p-sm-30">
                    <form action="{{ route('fb.pixel') }}" method="post" class="form">@csrf
                        <div class="row gx-20">

                            <div class="col-12">
                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="is_facebook_pixel_activated" value="{{ setting('is_facebook_pixel_activated') == 1 ? 1 : 0 }}">
                                    <label class="form-label" for="is_facebook_pixel_activated">{{ __('status') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="is_facebook_pixel_activated" class="sandbox_mode" {{ setting('is_facebook_pixel_activated') == 1 ? 'checked' : '' }}>
                                        <label for="is_facebook_pixel_activated"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="facebook_pixel_id" class="form-label">{{ __('pixel_id') }}</label>
                                    <input type="hidden" name="facebook_pixel_id" class="cross_origin_input" value="{{ setting('facebook_pixel_id') }}">
                                    <textarea class="form-control cross-origin" id="facebook_pixel_id"
                                              placeholder="<script>
    ......
</script>">{{ base64_decode(setting('facebook_pixel_id')) }}</textarea>
                                    <div class="nk-block-des text-danger">
                                        <p class="facebook_pixel_id_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start align-items-center">
                                <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                                @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                            </div>
                        </div>
                    </form>
                    <!-- End Image Optimization -->
                </div>
            </div>
        </div>
    </div>
@endsection
