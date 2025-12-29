@extends('backend.layouts.master')
@section('title', __('sms_templates'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{ __('sms_templates') }}</h3>
                <div class="bg-white redious-border p-20 p-sm-30">
                    <div class="authentication">
                        @foreach($sms_templates as $template)
                            <div class="list-view">
                                <div class="list-view-content">
                                    <h6>{{ __($template->key) }}</h6>
                                    <p>{{ $template->body }}</p>
                                </div>
                                @if(hasPermission('save.template'))
                                    <div class="list-view-icon">
                                        <a class="edit" href="#" data-template="{{ json_encode($template) }}"
                                           data-title="{{ __($template->key) }}" data-bs-toggle="modal"
                                           data-bs-target="#SMSTemplate"><i
                                                class="las la-edit"></i></a>
                                    </div>
                                @endif
                            </div>
                            <!-- End List View -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="SMSTemplate" tabindex="-1" aria-labelledby="SMSTemplateLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form action="{{ route('save.template') }}" method="post" class="form">@csrf
                    <h6 class="sub-title"><span class="title"></span><span>/{{ __('sms_template') }}</span></h6>
                    <button type="button" class="btn-close modal-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    <div class="row gx-20">
                        <input type="hidden" name="is_modal" class="is_modal" value="0">
                        <div class="col-lg-12">
                            <input type="hidden" name="key" class="key">
                            <input type="hidden" name="short_codes" class="short_codes">
                            <textarea class="form-control" name="body" placeholder="" id="floatingTextarea2"
                                      style="height: 250px"></textarea>
                            <small><span>{{ __('available_short_codes') }} : </span><span
                                    class="text-danger available_short_codes"></span></small>
                            <div class="nk-block-des text-danger">
                                <p class="body_error error"></p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mt-4">
                                <label for="template_id" class="form-label">{{ __('template_id') }}</label>
                                <input type="text" class="form-control rounded-2" id="template_id" name="template_id"
                                       placeholder="{{ __('template_id') }}">
                                <small class="text-info">{{ __('fast2_sms_approved_template_id') }}</small>
                                <div class="nk-block-des text-danger">
                                    <p class="template_id_error error"></p>
                                </div>
                            </div>
                        </div>
                        <!-- End SMS Confirmation -->
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-30">
                        <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.edit', function () {
                let template = $(this).data('template');
                let title = $(this).data('title');
                var key = template.key;
                var body = template.body;
                var short_codes = template.short_codes;
                var template_id = template.template_id;
                $('.key').val(key);
                $('.short_codes').val(short_codes);
                $('#floatingTextarea2').val(body);
                $('.title').text(title);
                $('.available_short_codes').text(short_codes);
                $('#template_id').val(template_id);
            });
        });
    </script>
@endpush
