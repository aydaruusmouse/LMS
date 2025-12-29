<!-- Modal For Add Media======================== -->
<div class="modal fade" id="addMedia" tabindex="-1" aria-labelledby="addMediaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- <h6 class="sub-title">Upload New File</h6> -->


            <div class="col-lg-12">
                <div class="default-tab-list default-tab-list-v2 media-modal-tab">
                    <ul class="nav pb-12 mb-20" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active ps-0" id="mediaFiles" data-bs-toggle="pill"
                                data-bs-target="#mediaLibraryFiles" role="tab" aria-controls="mediaLibraryFiles"
                                aria-selected="true">{{ __('media_files') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="uploadMedia" data-bs-toggle="pill"
                                data-bs-target="#uploadMediaLibrary" role="tab" aria-controls="uploadMediaLibrary"
                                aria-selected="false">{{ __('upload_media') }}</a>
                        </li>
                        <button type="button" class="btn-close modal-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <li class="ms-auto">
                            <div class="oftions-content-search">
                                <input type="search" name="search" id="search" placeholder="Search">
                                <button type="button"><img src="{{ static_asset('admin/img/icons/search.svg') }}"
                                        alt="{{ __('search') }}"></button>
                            </div>
                        </li>
                    </ul>
                    <!-- End Media Library Tab -->

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="mediaLibraryFiles" role="tabpanel"
                            aria-labelledby="mediaFiles" tabindex="0">
                            <div class="media-flies-wrapper simplebar" id="simplebar">
                                <div class="row gx-20 gy-20" id="media_files">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-sm-flex justify-content-center mt-30">
                                        <button type="button"
                                            class="btn sg-btn-outline-primary load-button d-none">{{ __('load_more') }}</button>
                                        <button class="btn loading-button d-none"><img
                                                src="{{ static_asset('images/default/loading.gif') }}" alt="loading.gif"
                                                width="30"></button>
                                    </div>
                                    <div class="d-sm-flex justify-content-between align-items-center mt-30">
                                        <span><span class="file_counter">0</span> {{ __('files_selected') }}</span>
                                        <button type="button"
                                            class="btn sg-btn-primary add-selected">{{ __('add') }}</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Media File BTN -->
                        </div>
                        <!-- END Media Files Tab====== -->

                        <div class="tab-pane fade" id="uploadMediaLibrary" role="tabpanel" aria-labelledby="uploadMedia"
                            tabindex="0">
                            <form
                                action="{{ auth()->user()->role_id == 2 ? route('instructor.media-library.store') : route('media-library.store') }}"
                                method="post" enctype="multipart/form-data">@csrf
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
                        <!-- END Upload Media Tab====== -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END Modal For Add Media======================== -->

@if (auth()->user()->role_id == 2)
    <input type="hidden" class="media_index_route" value="{{ route('instructor.media-library.index') }}">
    <input type="hidden" class="media_store_route" value="{{ route('instructor.media-library.store') }}">

@elseif(auth()->user()->role_id == 5)
    <input type="hidden" class="media_index_route" value="{{ route('organization.media-library.index') }}">
    <input type="hidden" class="media_store_route" value="{{ route('organization.media-library.store') }}">

@else
    <input type="hidden" class="media_index_route" value="{{ route('media-library.index') }}">
    <input type="hidden" class="media_store_route" value="{{ route('media-library.store') }}">

@endif
