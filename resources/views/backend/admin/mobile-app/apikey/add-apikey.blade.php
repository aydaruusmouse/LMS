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
                            <form action="{{ route('apikeys.store')}}" class="form-validate form" method="POST">
                                @csrf
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{__('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="title" name="title"
                                                value="{{ old('title') }}" placeholder="{{ __('enter_title') }}">
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
                                                placeholder="{{ __('api_key') }}" value="{{ strtoupper(\Illuminate\Support\Str::random(16)) }}">
                                        <span class="input-group-text get_code" data-length="16"><i class="las la-redo-alt"></i></span>
                                    </div>
                                    <div class="nk-block-des text-danger">
                                        <p class="key_error error">{{ $errors->first('key') }}</p>
                                    </div>
                                </div>
                                <!-- End Add API Key -->

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
    <!-- End Oftions Section -->

@endsection
