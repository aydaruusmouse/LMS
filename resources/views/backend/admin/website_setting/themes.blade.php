@extends('backend.layouts.master')
@section('title', __('website_themes'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('themes') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('website.themes') }}" method="post">@csrf
                            <div class="row gx-20">
                                <div class="pageTitle">
                                    <h6 class="sub-title">{{ __('choose_theme') }}</h6>
                                </div>

                                <div class="col-xxl-4 col-xl-6 col-lg-12 col-sm-12">
                                    <div class="custom-radio">
                                        <label>
                                            <input type="radio" class="theme-change" name="themes" id="theme-1" value="1" {{ setting('themes') == 1 ? 'checked' : '' }}>
                                            <!-- <span class="redious-border-5 select-box"></span> -->
                                            <div class="website-theme">
                                                <div class="website-thumb">
                                                    <img src="{{ static_asset('admin/img/theme/theme-1.png') }}" alt="Theme">
                                                </div>

                                                <div class="website-theme-active">
                                                    <span class="check-icon"><i class="las la-check"></i></span>
                                                </div>

                                                <div class="website-theme-activity">
                                                    <div class="d-flex justify-content-center align-items-center gap-20">
                                                        <a href="{{ route('theme.options') }}" class="btn sg-btn-primary">{{ __('header_footer') }}</a>
                                                        <a href="{{ route('hero.section') }}" class="btn sg-btn-primary">{{ __('hero_section') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.theme-change').on('change', function (e) {
                let selector = $(this).closest('form');
                let action = $(selector).attr("action");
                let method = $(selector).attr("method");

                $.ajax({
                    url: action,
                    type: method,
                    data: {
                        _token: '{{ csrf_token() }}',
                        themes: $(this).val(),
                    },
                    success: function (data) {
                        if (data.success) {
                            toastr.success(data.success);
                        } else {
                            toastr.error(data.error);
                        }
                    },
                    error: function (data) {
                        toastr.error(data.error);
                    }
                });
            });
        });
    </script>
@endpush
