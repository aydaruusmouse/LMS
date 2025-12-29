@extends('backend.layouts.master')
@section('title', __('media_library'))
@section('content')

    <!-- Media Library -->
    <section class="media-library-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{ __('media_library') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row align-items-end media-sortField">
                            <div class="col-xxl-7 col-lg-12">
                                <div class="row gx-12 gx-sm-20">

                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="select-type-v2 mb-3 mb-sm-30">
                                            <label for="fileType" class="form-label">{{ __('file_type') }}</label>
                                            <select id="fileType" class="form-select form-select-lg without_search mb-3"
                                                aria-label=".form-select-lg example">
                                                <option value="" selected>{{ __('all_media_items') }}</option>
                                                <option value="image"
                                                    {{ isset($type) && $type == 'image' ? 'selected' : '' }}>
                                                    {{ __('image') }}</option>
                                                <option value="audio"
                                                    {{ isset($type) && $type == 'audio' ? 'selected' : '' }}>
                                                    {{ __('audio') }}</option>
                                                <option value="video"
                                                    {{ isset($type) && $type == 'video' ? 'selected' : '' }}>
                                                    {{ __('video') }}</option>
                                                <option value="document"
                                                    {{ isset($type) && $type == 'document' ? 'selected' : '' }}>
                                                    {{ __('document') }}</option>
                                                <option value="pdf"
                                                    {{ isset($type) && $type == 'pdf' ? 'selected' : '' }}>
                                                    {{ __('pdf') }}</option>
                                                <option value="archive"
                                                    {{ isset($type) && $type == 'archive' ? 'selected' : '' }}>
                                                    {{ __('zip_file') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End File Type -->

                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="select-type-v2 mb-3 mb-sm-30">
                                            <label for="dateRangePicker" class="form-label">{{ __('date') }}</label>
                                            <input id="dateRangePicker" placeholder="{{ __('select_date') }}"
                                                name="date" type="text" class="form-control rounded-2"
                                                value="{{ isset($start_date) ? Carbon\Carbon::parse($start_date)->format('m/d/Y') . '-' . Carbon\Carbon::parse($end_date)->format('m/d/Y') : '' }}">
                                        </div>
                                    </div>
                                    <!-- End Date -->

                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="select-type-v2 mb-3 mb-sm-30">
                                            <label for="bulkAction" class="form-label">{{ __('bulk_action') }}</label>
                                            <select id="bulkAction" class="form-select form-select-lg without_search mb-3">
                                                <option value="" selected>{{ __('select') }}</option>
                                                <option value="copy">{{ __('copy_link') }}</option>
                                                <option value="download">{{ __('download_file') }}</option>
                                                <option value="delete_file">{{ __('delete_file') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Bulk Action -->
                                </div>

                            </div>

                            <div class="col-xxl-4 col-lg-12 mb-30 ms-auto">
                                <div class="oftions-content-right">
                                    <form action="#" class="oftions-content-search">
                                        <input type="search" name="search" id="search" value="{{ $q ?? '' }}"
                                            placeholder="{{ __('search') }}">
                                        <button type="button"><img src="{{ static_asset('admin/img/icons/search.svg') }}"
                                                alt="{{ __('search') }}">
                                        </button>
                                    </form>

                                    <a href="#" class="d-flex align-items-center button-default gap-2 px-20"
                                        data-bs-toggle="modal" data-bs-target="#addMedia">
                                        <i class="las la-plus"></i>
                                        <span>{{ __('upload') }}</span>
                                    </a>
                                </div>
                            </div>
                            <!-- End Action Section -->
                        </div>
                        <div class="row gx-20 gy-20 media_list">
                            @include('backend.instructor.media-library.media_list')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Media Library -->

    <!-- Modal For Edit Currency======================== -->
    <div class="modal fade" id="addMedia" tabindex="-1" aria-labelledby="addMediaLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <h6 class="sub-title">{{ __('upload_new_file') }}</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <form action="{{ route('instructor.media-library.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-20">
                        <div class="col-12">
                            <div class="media-uploader dropzone dropzone-multiple p-0 text-center">
                                <div class="media-message">
                                    <h6 class="d-block">{{ __('drop_file_to_upload') }}</h6>
                                    <span class="d-block">{{ __('or') }}</span>
                                    <button type="button"
                                        class="btn sg-btn-outline-primary">{{ __('select_file') }}</button>
                                    <span class="d-block">{{ __('maximum_upload_file_size') }} : 10
                                        {{ __('mb') }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Modal For Edit Currency======================== -->

    <div class="modal fade" id="file_info" tabindex="-1" aria-labelledby="addMediaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <h6 class="sub-title">{{ __('file_information') }}</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="row gx-20">
                    <div class="col-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">{{ __('file_name') }}</th>
                                    <td id="file_name"></td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('file_type') }}</th>
                                    <td class="text-capitalize" id="file_type"></td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('file_size') }}</th>
                                    <td id="file_size"></td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('file_url') }}</th>
                                    <td><a target="_blank" href="" id="file_url"></a></td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('file_created_at') }}</th>
                                    <td id="file_created_at"></td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('uploaded_by') }}</th>
                                    <td id="uploaded_by"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.common.delete-script')
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/daterangepicker.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/daterangepicker.js') }}"></script>
@endpush
@push('js')
    <script>
        Dropzone.autoDiscover = false;

        $(document).ready(function() {
            @isset($start_date)
                $('#dateRangePicker').daterangepicker({
                    startDate: '{{ Carbon\Carbon::parse($start_date)->format('m/d/Y') }}',
                    endDate: '{{ Carbon\Carbon::parse($end_date)->format('m/d/Y') }}',
                });
            @else
                $('#dateRangePicker').daterangepicker({
                    autoUpdateInput: false
                });
            @endisset


            $('.media-uploader').dropzone({
                url: '{{ route('instructor.media-library.store') }}',
                uploadMultiple: false,
                maxFilesize: 10,
                dictDefaultMessage: '',
                clickable: ".media-message",
                // clickable: true
                headers: {
                    'X-CSRF-TOKEN': token
                },
                acceptedFiles: ".jpg,.jpeg,.png,.gif,.mp4,.mpg,.mpeg,.webp,.webm,.ogg,.avi,.mov,.flv,.swf,.mkv,.wmv,wma,.aac,.wav,.mp3,.zip,.rar,.7z,.doc,.txt,.docx,.pdf,.csv,.xml,.ods,.xlr,.xls,.xlsx",
                timeout: 180000,
                maxFiles: 20,
                init: function() {
                    this.on("error", function(file, responseText) {
                        toastr['error'](responseText)
                    });
                    this.on("success", function() {
                        fetch_data();
                    });
                }
            });
            $(document).on('change', '#fileType', function() {
                let val = $(this).val();
                changeUrl('type', val)
                fetch_data();
            });
            $(document).on('keyup', '#search', function() {
                let val = $(this).val();
                let type = 'q';
                changeUrl(type, val);
                fetch_data();
            });
            $(document).on('click', '.file_info', function() {
                let media = $(this).data('media');
                let file_url = $(this).data('file_url');
                let created_at = $(this).data('created_at');
                let file_size = $(this).data('file_size');
                let uploaded_by = $(this).data('uploaded_by');
                $('#file_name').text(media.name);
                $('#file_type').text(media.type);
                $('#file_size').text(file_size);
                $('#file_url').text(file_url).attr('href', file_url);
                $('#file_created_at').text(created_at);
                $('#uploaded_by').text(uploaded_by);
            });
            $(document).on('change', '#bulkAction', function() {
                let val = $(this).find(':selected').val();
                let checked_checkboxes = $('.select_media:checked');
                let length = checked_checkboxes.length;
                if (length > 0) {
                    if (val == 'delete_file') {
                        let ids = [];
                        $.each(checked_checkboxes, function(index, element) {
                            let id = $(element).val();
                            ids.push(id);
                        });
                        delete_row('{{ route('instructor.media.destroy') }}', ids, true);
                    } else if (val == 'copy') {
                        let all_text = [];
                        $.each(checked_checkboxes, function(index, element) {
                            let media = $(element).data('text');
                            all_text.push(media);
                        });
                        copyText(all_text.join('\n'));
                    } else if (val == 'download') {
                        $.each(checked_checkboxes, function(index, element) {
                            let media = $(element).data('text');
                            let name = $(element).data('name');
                            const link = document.createElement("a");
                            link.href = media;
                            link.download = name;

                            // Simulate a click on the link tag to start the download
                            document.body.appendChild(link);
                            link.click();
                        });
                    }
                } else {
                    toastr.error('{{ __('please_select_at_least_one_item') }}');
                }
            });
            $(document).on('click', '.applyBtn', function() {
                let val = $('#dateRangePicker').val();
                let splitted_data = val.split(' - ');
                let start_date = splitted_data[0];
                let end_date = splitted_data[1];

                changeUrl('start_date', start_date);
                changeUrl('end_date', end_date);
                fetch_data();
            });
        });

        function fetch_data() {

            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);

            $.ajax({
                url: '{{ route('instructor.media-library.index') }}',
                type: 'GET',
                data: {
                    page: 1,
                    type: urlParams.get('type'),
                    q: urlParams.get('q'),
                    start_date: urlParams.get('start_date'),
                    end_date: urlParams.get('end_date'),
                },
                success: function(data) {
                    $('.media_list').html(data.list);
                }
            })
        }

        function changeUrl(type, val) {
            var url = new URL(window.location.href);
            var params = new URLSearchParams(url.search);

            params.set(type, val);

            var newUrl = url.origin + url.pathname + '?' + params.toString();
            window.history.pushState({
                path: newUrl
            }, '', newUrl);
        }
    </script>
@endpush
