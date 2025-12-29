@extends('backend.layouts.master')
@section('title', __('email_setting'))
@section('content')
    <div class="main-content-wrapper">
        <!-- Main content wrapper=== -->
        <!-- Product Details -->
        <div class="container-fluid">
            <div class="row">
                <!--            <div class="col-xxl-3 col-lg-4 col-md-4">
              <h3 class="section-title">{{__('email_template')  }}</h3>
{{--              @include('backend.admin.email-setup.sidebar')--}}
                </div>-->
                <div class="col-xxl-12 col-lg-12 col-md-12">
                    <h3 class="section-title">{{__('email_template')  }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="authentication">
                            @foreach($email_templates as $template)
                                <div class="list-view">
                                    <div class="list-view-content">
                                        <h6 class="text-capitalize">{{ __($template->title) }}</h6>
                                        <p>{{ substr(strip_tags($template->body),0,100) }}....</p>
                                    </div>
                                    @if(hasPermission('auth-template.edit'))
                                        <div class="list-view-icon">
                                            <a href="javascript:void(0)" class="template_edit"
                                               data-title="{{ __($template->title) }}"
                                               data-template="{{ json_encode($template) }}"><i
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
    </div>
    <!-- END Main Content Wrapper -->

    <!-- Modal For Edit Email Template======================== -->
    <div class="modal fade" id="emailTemplate" tabindex="-1" aria-labelledby="emailTemplateLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <form action="{{ route('email.template.update') }}" method="post" class="form">
                    @csrf
                    @method('put')
                    <h6 class="sub-title text-capitalize">{{__('email_confirmation')}}</h6>
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" class="is_modal" value="0">
                    <div class="row gx-20">
                        <div class="col-lg-12">
                            <p class="text-right mb-4">{{ __('short_codes') }} : <span class="short_codes"></span></p>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="subject" class="form-label">{{ __('subject') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-2" id="subject" name="subject"
                                       placeholder="{{ __('enter_title') }}">
                                <div class="nk-block-des text-danger">
                                    <p class="subject_error error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex w-100 justify-content-between">
                            <label class="form-label mb-1">{{__('email_body')}} <span
                                    class="text-danger">*</span></label>
                        </div>
                        <div class="col-12">
                            <div class="editor-wrapper">
                      <textarea class="template-body" id="product-update-editor" name="body">
                      </textarea>
                            </div>
                        </div>
                        <div class="nk-block-des text-danger">
                            <p class="body_error error"></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-30">
                        <button type="submit" class="btn sg-btn-primary">{{__('save')}}</button>
                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Modal For Edit Currency======================== -->

@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.template_edit', function () {
                let response = $(this).data('template');
                let title = $(this).data('title');
                $('#emailTemplate').modal('show');
                $('#subject').val(response.subject);
                $('.sub-title').text(title);
                $('.short_codes').text(response.short_codes);
                $(".template-body").summernote("code", response.body);
                $('#id').val(response.id);
            });
        });
    </script>
@endpush
