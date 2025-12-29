@extends('backend.layouts.master')
@section('title', __('home_screen_settings'))
@section('content')
    <form action="{{ route('update.home.screen') }}" method="post" class="form">@csrf
        <input type="hidden" value="home_screen" name="type">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-9 col-xl-7 col-md-12">
                    <h3 class="section-title">{{ __('home_screen') }}</h3>
                    <div class="homepage-content" id="homepageContent">
                        @php
                            $i = 0;
                        @endphp
                        @foreach($sections as $key=> $section)
                            @php
                                $i++;
                            @endphp
                            @if($section->section == 'top_courses')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="top_courses">
                                    <input type="hidden" name="builder[top_courses_{{ $i }}]">
                                    <h2 class="accordion-header">
                                    <span class="accordion-button bef-iconRMV collapsed">
                                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                        <span>{{ __('top_courses') }}</span>
                                    </span>
                                        <a href="#" class="delete-icon"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div class="accordion-collapse collapse" aria-labelledby="top_courses">
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'instructors')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="instructors" id="instructors">
                                    <h2 class="accordion-header" id="instructor">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#instructors_section_{{$i}}" aria-expanded="false"
                                                aria-controls="instructorCollapse">
                                            <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                            <span>{{ __('instructor') }}</span>
                                        </button>
                                        <a href="javascript:void(0)" class="delete-icon"><i
                                                class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div id="instructors_section_{{$i}}" class="accordion-collapse collapse"
                                         aria-labelledby="instructor"
                                         data-bs-parent="#homepageContent">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label class="form-label">{{ __('select_instructor') }}</label>
                                                    <div class="multi-select-v2">
                                                        <select name="builder[instructors_{{$i}}][ids][]" multiple
                                                                placeholder="{{ __('select_instructor') }}"
                                                                class="form-select form-select-lg mb-3">
                                                            @foreach($instructors as $instructor)
                                                                <option
                                                                    value="{{ $instructor->id }}" {{ arrayCheck('ids', $section->contents) && in_array($instructor->id,$section->contents['ids']) ? 'selected' : '' }}>{{ $instructor->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- End Instructor -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($section->section == 'offer_courses')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="offer_courses">
                                    <input type="hidden" name="builder[offer_courses_{{ $i }}]">
                                    <h2 class="accordion-header">
                                    <span class="accordion-button bef-iconRMV collapsed">
                                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                        <span>{{ __('offer_courses') }}</span>
                                    </span>
                                        <a href="#" class="delete-icon"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div class="accordion-collapse collapse" aria-labelledby="offer_courses"></div>
                                </div>
                            @endif
                            @if($section->section == 'featured_courses')
                                <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                <div class="accordion-item" data-type="featured_courses">
                                    <input type="hidden" name="builder[featured_courses_{{ $i }}]">
                                    <h2 class="accordion-header">
                                    <span class="accordion-button bef-iconRMV collapsed">
                                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                        <span>{{ __('featured_courses') }}</span>
                                    </span>
                                        <a href="#" class="delete-icon"><i class="las la-trash-alt"></i></a>
                                    </h2>
                                    <div class="accordion-collapse collapse"
                                         aria-labelledby="featured_courses"></div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
                <div class="col-xxl-3 col-xl-5 col-md-12">
                    <h3 class="section-title">{{ __('add_module') }}</h3>
                    <div class="bg-white redious-border p-20 px-xl-3 py-xl-20">
                        <div class="builder-content" id="builderContent">
                            <div class="builder" data-target_id="top_courses" data-name="top_courses" data-var_type="">
                                <div class="icon">
                                    <img src="{{ static_asset('admin/img/icons/home-icon/book-opened.svg')}}"
                                         alt="Book Opened">
                                </div>
                                <h6 class="title">{{ __('top_courses') }}</h6>
                            </div>

                            <div class="builder" data-target_id="instructors" data-name="instructors"
                                 data-var_type="array">
                                <div class="icon">
                                    <img src="{{ static_asset('admin/img/icons/home-icon/person.svg')}}" alt="person">
                                </div>
                                <h6 class="title">{{ __('instructors') }}</h6>
                            </div>
                            <!-- End Builder -->

                            <div class="builder" data-target_id="offer_courses" data-name="offer_courses"
                                 data-var_type="">
                                <div class="icon">
                                    <img src="{{ static_asset('admin/img/icons/home-icon/notebook.svg')}}"
                                         alt="notebook">
                                </div>
                                <h6 class="title">{{ __('offer_courses') }}</h6>
                            </div>
                            <!-- End Builder -->

                            <div class="builder" data-target_id="featured_courses" data-name="featured_courses"
                                 data-var_type="">
                                <div class="icon">
                                    <img src="{{ static_asset('admin/img/icons/home-icon/book-opened.svg')}}"
                                         alt="book-opened">
                                </div>
                                <h6 class="title">{{ __('featured_courses') }}</h6>
                            </div>
                            <!-- End Builder -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="homepageFixBTN bg-white py-20 px-4">
            <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
            @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
        </div>
    </form>
    <div class="modal">
        <div class="accordion-item" data-type="top_courses" id="top_courses">
            <input type="hidden" name="builder[top_courses]">
            <h2 class="accordion-header">
                                    <span class="accordion-button bef-iconRMV collapsed">
                                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                        <span>{{ __('top_courses') }}</span>
                                    </span>
                <a href="#" class="delete-icon"><i class="las la-trash-alt"></i></a>
            </h2>
            <div class="accordion-collapse collapse" aria-labelledby="top_courses">
            </div>
        </div>
        <div class="accordion-item" data-type="instructors" id="instructors">
            <h2 class="accordion-header" id="instructor">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#instructorCollapse" aria-expanded="false"
                        aria-controls="instructorCollapse">
                    <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                    <span>{{ __('instructor') }}</span>
                </button>
                <a href="javascript:void(0)" class="delete-icon"><i class="las la-trash-alt"></i></a>
            </h2>
            <div id="instructorCollapse" class="accordion-collapse collapse" aria-labelledby="instructor"
                 data-bs-parent="#homepageContent">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label">{{ __('select_instructor') }}</label>
                            <div class="multi-select-v2">
                                <select name="builder[instructors]" multiple placeholder="{{ __('select_instructor') }}"
                                        class="form-select form-select-lg mb-3"></select>
                            </div>
                        </div>
                        <!-- End Instructor -->
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item" data-type="offer_courses" id="offer_courses">
            <input type="hidden" name="builder[offer_courses]">
            <h2 class="accordion-header">
                                    <span class="accordion-button bef-iconRMV collapsed">
                                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                        <span>{{ __('offer_courses') }}</span>
                                    </span>
                <a href="#" class="delete-icon"><i class="las la-trash-alt"></i></a>
            </h2>
            <div class="accordion-collapse collapse" aria-labelledby="offer_courses"></div>
        </div>
        <div class="accordion-item" data-type="featured_courses" id="featured_courses">
            <input type="hidden" name="builder[featured_courses]">
            <h2 class="accordion-header">
                                    <span class="accordion-button bef-iconRMV collapsed">
                                        <img src="{{ static_asset('admin/img/icons/maximize.svg')}}" alt="maximize">
                                        <span>{{ __('featured_courses') }}</span>
                                    </span>
                <a href="#" class="delete-icon"><i class="las la-trash-alt"></i></a>
            </h2>
            <div class="accordion-collapse collapse" aria-labelledby="featured_courses"></div>
        </div>
    </div>
@endsection
@push('js_asset')
    <script src="{{ static_asset('admin/js/sortable.min.js') }}"></script>
@endpush
