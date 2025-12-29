@extends('backend.layouts.master')
@section('title', __('chat_messenger'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-6 col-md-9">
                <h3 class="section-title">{{__('chat_messenger')  }}</h3>
                <div class="default-tab-list default-tab-list-v2  bg-white redious-border p-20 p-sm-30">
                    <div class="email-tamplate-sidenav">
                        <ul class="nav pb-12 mb-20" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active ps-0" id="fb_link"  href="#" data-bs-toggle="pill" data-bs-target="#fb" role="tab" aria-controls="fb" aria-selected="true">{{ __('facebook') }}</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="permissions" aria-current="page" href="#"
                                   id="tawk_link" data-bs-toggle="pill" data-bs-target="#tawk" role="tab" aria-controls="tawk" aria-selected="true">{{ __('tawk') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="fb" role="tabpanel" aria-labelledby="fb" tabindex="0">
                                <form class="form" action="{{ route('chat.messenger') }}" method="POST">@csrf
                                    <div class="row">
                                        <input type="hidden" name="fb" value="1">
                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label for="facebook_page_id" class="form-label">{{__('page_id') }}</label>
                                                <input type="text" class="form-control rounded-2" id="facebook_page_id" name="facebook_page_id"
                                                       value="{{ stringMasking(setting('facebook_page_id'),'*') }}" placeholder="{{ __('enter_page_id') }}">
                                                <div class="nk-block-des text-danger">
                                                    <p class="facebook_page_id_error error"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End First Name -->

                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label for="facebook_messenger_color" class="form-label">{{__('chat_widget_color') }}</label>
                                                <input type="text" class="form-control rounded-2" id="facebook_messenger_color" name="facebook_messenger_color"
                                                       value="{{ stringMasking(setting('facebook_messenger_color'),'*') }}" placeholder="{{ __('enter_chat_widget_color') }}">
                                                <div class="nk-block-des text-danger">
                                                    <p class="facebook_messenger_color_error error"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Last Name -->
                                        <div class="col-12 status_div">
                                            <input type="hidden" name="is_facebook_messenger_activated" class="" value="0">
                                            <div class="price-checkbox d-flex gap-12 mb-2">
                                                <label for="checkbox2">{{ __('active') }}</label>
                                                <div class="setting-check">
                                                    <input type="checkbox" id="checkbox2" class="checkup_status" {{ setting('is_facebook_messenger_activated') ? 'checked' : '' }} value="0">
                                                    <label for="checkbox2"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center mt-30">
                                            <button type="submit" class="btn sg-btn-primary">{{__('save') }}</button>
                                            @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="tawk" role="tabpanel" aria-labelledby="tawk" tabindex="0">
                                <form class="form" action="{{ route('chat.messenger') }}" method="POST">@csrf
                                    <div class="row">
                                        <input type="hidden" name="tawk" value="1">
                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label for="tawk_property_id" class="form-label">{{__('tawk_property_id') }}</label>
                                                <input type="text" class="form-control rounded-2" id="tawk_property_id" name="tawk_property_id"
                                                       value="{{ stringMasking(setting('tawk_property_id'),'*') }}" placeholder="{{ __('enter_tawk_property_id') }}">
                                                <div class="nk-block-des text-danger">
                                                    <p class="facebook_page_id_error error"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End First Name -->

                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label for="tawk_widget_id" class="form-label">{{__('widget_id') }}</label>
                                                <input type="text" class="form-control rounded-2" id="tawk_widget_id" name="tawk_widget_id"
                                                       value="{{ stringMasking(setting('tawk_widget_id'),'*') }}" placeholder="{{ __('enter_tawk_widget_id') }}">
                                                <div class="nk-block-des text-danger">
                                                    <p class="tawk_widget_id_error error"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Last Name -->
                                        <div class="col-12 status_div">
                                            <input type="hidden" name="is_tawk_messenger_activated" value="0">
                                            <div class="price-checkbox d-flex gap-12 mb-2">
                                                <label for="checkbox">{{ __('active') }}</label>
                                                <div class="setting-check">
                                                    <input type="checkbox" id="checkbox" class="checkup_status" {{ setting('is_tawk_messenger_activated') ? 'checked' : '' }} value="0">
                                                    <label for="checkbox"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center mt-30">
                                            <button type="submit" class="btn sg-btn-primary">{{__('save') }}</button>
                                            @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function (){
            $(document).on('click','.checkup_status',function (){
                if($(this).is(':checked')){
                    $(this).closest('.status_div').find('input[type = "hidden"]').val(1);
                }else{
                    $(this).closest('.status_div').find('input[type = "hidden"]').val(0);
                }
            })
        })
    </script>
@endpush
