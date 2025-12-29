@extends('backend.layouts.master')
@section('title', __('refund_setting'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-6 col-md-9">
                <h3 class="section-title">{{ __('refund_setting') }}</h3>
                <div class="bg-white redious-border pt-30 p-20 p-sm-30">

                    <form action="{{ route('admin.refund') }}" method="post" class="form">@csrf
                        <div class="row gx-20">
                            <div class="col-12">
                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="refund_status" value="{{ setting('refund_status') == 1 ? 1 : 0 }}">
                                    <label class="form-label" for="refund_status">{{ __('status') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="refund_status" class="sandbox_mode" {{ setting('refund_status') == 1 ? 'checked' : '' }}>
                                        <label for="refund_status"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="refund_time" class="form-label">{{ __('refund_time') }} ({{ __('day') }})</label>
                                    <input type="number" class="form-control rounded-2" id="refund_time" name="refund_time" placeholder="{{ __('refund_time') }}" value="{{ setting('refund_time') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="refund_time_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="completion_percentage" class="form-label">{{ __('completion_percentage') }}</label>
                                    <input type="number" class="form-control rounded-2" id="completion_percentage" name="completion_percentage" placeholder="{{ __('completion_percentage') }}" value="{{ setting('completion_percentage') }}">
                                    <div class="nk-block-des text-danger">
                                        <p class="completion_percentage_error error"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-items-center mt-30">
                            <button type="submit" class="btn sg-btn-primary">{{ __('submit') }}</button>
                            @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
