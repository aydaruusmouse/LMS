@extends('backend.layouts.master')
@section('title', __('languages'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-30 justify-content-end">
                        <div class="col-lg-12">
                            <div class="header-top d-flex justify-content-between align-items-center">
                                <h3 class="section-title">{{__('translation_keys') }}</h3>
                            </div>
                            <div class="bg-white redious-border p-20 p-sm-30 pt-sm-30"
                                 data-select2-id="select2-data-10-togg">
                                <div class="row">
                                    <div class="col-lg-12" data-select2-id="select2-data-9-e6eh">
                                        <form action="{{ route('language.translations.page') }}" method="get">
                                            <div class="row justify-content-end">
                                                <div class="col-lg-3">
                                                    <div class="mb-4">
                                                        <select name="lang" class="without_search" placeholder="{{ __('languages') }}" aria-hidden="true">
                                                            @foreach($languages as $lang)
                                                                <option value="{{ $lang->id }}" {{ $lang->id == $language->id ? 'selected' : '' }}>{{ $lang->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="inputGroup" name="q"
                                                               placeholder="{{ __('search') }}" value="{{ $search_query }}">
                                                        <span class="input-group-text search"><i class="las la-redo-alt"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <form action="{{ route('admin.language.key.update',$language->id) }}" method="POST"
                                          class="translation_form">@csrf
                                        <div class="col-lg-12 staff-role-heigh simplebar">
                                            <div class="default-list-table table-responsive lang-setting">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">{{ __('key') }}</th>
                                                        <th scope="col" class="text-capitalize">{{ config('app.locale') }}</th>
                                                        <th scope="col"
                                                            class="text-capitalize">{{ $language->locale }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($translations as $key => $item)
                                                        <tr>
                                                            <td width="30%">{{ $key }}</td>
                                                            <td width="30%">{{ $item }}</td>
                                                            <input type="hidden" name="keys[]" value="{{ $key }}">
                                                            <td width="30%">
                                                                <input type="text"
                                                                       class="form-control rounded-2 translation_input"
                                                                       name="translations[]"
                                                                       value="{{ $item }}"
                                                                       placeholder="{{ __('enter_title') }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('change', '.without_search', function () {
                $(this).closest('form').submit();
            });
            $(document).on('click', '.search', function () {
                if (!$('#inputGroup').val()) {
                    return false;
                }
                $(this).closest('form').submit();
            });
            $(document).on("submit", ".translation_form", function (e) {
                e.preventDefault();
                let selector = this;
                $(selector).find(".loading_button").removeClass("d-none");
                $(selector).find("p.error").text("");
                $(selector).find(":submit").addClass("d-none");
                let action = $(selector).attr("action");
                let method = $(selector).attr("method");
                let translations = $(selector).find("input[name^='translations']").serializeArray();
                let keys = $(selector).find("input[name^='keys']").serializeArray();
                $.ajax({
                    url: action,
                    method: method,
                    data: {
                        _token: "{{ csrf_token() }}",
                        keys: JSON.stringify(keys),
                        translations: JSON.stringify(translations)
                    },
                    success: function (response) {
                        if (response.success) {

                            $(selector).find(".loading_button").addClass("d-none");
                            $(selector).find(":submit").removeClass("d-none");
                            if (response.route) {
                                window.location.href = response.route;
                            } else {
                                location.reload();
                            }
                        } else {
                            $(selector).find(".loading_button").addClass("d-none");
                            $(selector).find(":submit").removeClass("d-none");
                            toastr.error(response.error);
                        }
                    },
                    error: function (response) {
                        $(selector).find(".loading_button").addClass("d-none");
                        $(selector).find(":submit").removeClass("d-none");
                        if (response.status == 422) {
                            if (formData.get("type") == "tab_form") {
                                instructorValidate(selector);
                            }
                            $.each(
                                response.responseJSON.errors,
                                function (key, value) {
                                    $("." + key + "_error").text(value[0]);
                                }
                            );
                        } else if (response.status == 403) {
                            toastr.error(response.status + ' ' + response.statusText);
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    },
                });
            });

        });
    </script>
@endpush
