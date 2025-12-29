@extends('backend.layouts.master')
@section('title', __('header_content'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('header_content') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('footer.update-menu') }}" method="POST" class="form">@csrf

                            <input type="hidden" name="menu_name" value="header_menu">
                            <div class="row gx-20">
                                <div class="col-12">
                                    <input type="hidden" name="r" value="{{ url()->current() }}" class="r">
                                    <div class="select-type-v2 mb-4 mb-xl-40">
                                        <select class="form-select form-select-lg mb-3 with_search" name="site_lang">
                                            @foreach(app('languages') as $language)
                                                <option value="{{ $language->locale }}" {{ $language->locale == app()->getLocale() ? 'selected' : '' }}>{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 input_file_div mb-4">
                                    <div class="mb-3">
                                        <label class="form-label mb-1">{{__('light_logo') }} (100X36)</label>
                                        <label for="light_logo"
                                               class="file-upload-text"><span>{{__('choose_file') }}</span></label>
                                        <input class="d-none file_picker" type="file" id="light_logo" name="light_logo">
                                        <div class="nk-block-des text-danger">
                                            <p class="light_logo_error error">{{ $errors->first('light_logo') }}</p>
                                        </div>
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ getFileLink('80x80',setting('light_logo')) }}" alt="light_logo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 input_file_div mb-4">
                                    <div class="mb-3">
                                        <label class="form-label mb-1">{{__('dark_logo') }} (100X36)</label>
                                        <label for="dark_logo"
                                               class="file-upload-text"><span>{{__('choose_file') }}</span></label>
                                        <input class="d-none file_picker" type="file" id="dark_logo" name="dark_logo">
                                        <div class="nk-block-des text-danger">
                                            <p class="dark_logo_error error">{{ $errors->first('dark_logo') }}</p>
                                        </div>
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ getFileLink('80x80',setting('dark_logo')) }}" alt="dark_logo">
                                        </div>
                                    </div>
                                </div>
                                <div class="pageTitle">
                                    <h6 class="sub-title">{{ __('menu') }}</h6>
                                </div>

                                <div class="col-lg-12">
                                    <div class="gray-badge mb-4">
                                        <span class="gray-badge-clr">If you want to use external link like (https://www.google.com/maps) then insert link, otherwise insert just slug ("blogs,products,brands")</span>
                                    </div>
                                </div>
                                    <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                        <input type="hidden" name="show_default_courses_link" value="{{ setting('show_default_courses_link') == 1 ? 1 : 0 }}">
                                        <label class="form-label"
                                               for="show_default_courses_link">{{ __('show_default_courses_link') }}</label>
                                        <div class="setting-check">
                                            <input type="checkbox" value="1" id="show_default_courses_link"
                                                   class="sandbox_mode" {{ setting('show_default_courses_link') == 1 ? 'checked' : '' }}>
                                            <label for="show_default_courses_link"></label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="cf sortable-menu-section ">
                                            <div class="dd" id="menuSortable">
                                                <ol class="dd-list" id="dd-list">
                                                @if($menu_language && is_array(setting('header_menu')) ? count(setting('header_menu')) : 0 != 0 && setting('header_menu') != [])
                                                    @foreach($menu_language as $key => $value)
                                                        <li class="dd-item dd3-item menu-item" data-id="0">
                                                            <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="1">
                                                            <input type="hidden" name="lang" id="lang" value="{{$lang}}">
                                                            <div class="dd-handle dd3-handle"></div>
                                                            <div class="dd3-content sortable-section mb-4">
                                                                <ul class="sortable-menu-icon">
                                                                    <li class="menuMove">
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" onclick="$(this).closest('.dd-item').remove()" class="delete-icon"><i
                                                                                class="las la-trash-alt"></i></a>
                                                                    </li>
                                                                </ul>
                                                                <div class="row gx-18 align-items-center">
                                                                    <div class="col-lg-3">
                                                                        <input type="text" name="label[]" id="label" value="{{ @$value['label'] }}" class="form-control rounded-2"
                                                                        required placeholder="{{__('Label')}}">
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="d-flex align-items-center gap-3">
                                                                            <input type="text" class="form-control rounded-2" name="url[]" value="{{ @$value['url'] == 'javascript:void(0)' ? '#' : @$value['url'] }}" required placeholder="{{__('Link')}}">
                                                                            <div class="custom-checkbox" id="mega-menu-area">
                                                                                <label class="d-flex align-items-center">
                                                                                    <input type="checkbox" class="mega_menu" value="" {{ @$value['mega_menu'] == true ? 'checked' : '' }}>
                                                                                    <span class="">Mega Menu</span>
                                                                                    <input type="hidden" name="mega_menu_position[]" value="{{ @$value['mega_menu'] == true ? 'true' : '' }}">

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if(count($value) > 3)
                                                            <ol class="dd-list">
                                                                @if(@is_array($value[0]))
                                                                    @foreach(array_splice($value, 3) as $j => $sub)

                                                                        <li class="dd-item dd3-item menu-item" data-id="">
                                                                            <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="2">
                                                                            <input type="hidden" name="lang" id="lang" value="{{$lang}}">
                                                                            <div class="dd-handle dd3-handle"></div>
                                                                            <div class="dd3-content sortable-section mb-4">
                                                                                <ul class="sortable-menu-icon">
                                                                                    <li class="menuMove">
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="#" class="delete-icon"><i
                                                                                                class="las la-trash-alt"></i></a>
                                                                                    </li>
                                                                                </ul>

                                                                                <div class="row gx-18 align-items-center">
                                                                                    <div class="col-lg-3">
                                                                                        <input type="text"
                                                                                               class="form-control rounded-2"
                                                                                               name="label[]" id="label" value="{{ @$sub['label'] }}" required placeholder="{{__('Label')}}">
                                                                                    </div>
                                                                                    <div class="col-lg-9">
                                                                                        <div class="d-flex align-items-center gap-3">
                                                                                            <input type="text"
                                                                                                   class="form-control rounded-2"  name="url[]" value="{{ @$sub['url'] == 'javascript:void(0)' ? '#' : @$sub['url'] }}" required placeholder="{{__('Link')}}">
                                                                                                <div class="custom-checkbox" id="mega-menu-area" style="display:none">
                                                                                                    <label class="d-flex align-items-center">
                                                                                                        <input type="checkbox" class="mega_menu" value="">
                                                                                                        <span class="">Mega Menu</span>
                                                                                                        <input type="hidden" name="mega_menu_position[]" value="">
                                                                                                    </label>
                                                                                                </div>
                                                                                         </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- End Sortable Section -->
                                                                        </li>

                                                                    @endforeach
                                                                @endif
                                                            </ol>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                    @else

                                                        <!-- Start Sortable Section -->
                                                        <li class="dd-item dd3-item menu-item" data-id="0">
                                                            <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="1">
                                                            <input type="hidden" name="lang" id="lang" value="">
                                                            <div class="dd-handle dd3-handle"></div>
                                                            <div class="dd3-content sortable-section mb-4">
                                                                <ul class="sortable-menu-icon">
                                                                    <li class="menuMove">
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" onclick="$(this).closest('.dd-item').remove()" class="delete-icon"><i
                                                                                class="las la-trash-alt"></i></a>
                                                                    </li>
                                                                </ul>
                                                                <div class="row gx-18 align-items-center">
                                                                    <div class="col-lg-3">
                                                                        <input type="text" name="label[]" class="form-control rounded-2"
                                                                            placeholder="Label" required>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="d-flex align-items-center gap-3">
                                                                            <input type="text" name="url[]" class="form-control rounded-2"
                                                                                placeholder="Link" required>
                                                                                <div class="custom-checkbox" id="mega-menu-area">
                                                                                    <label class="d-flex align-items-center">
                                                                                        <input type="checkbox" class="mega_menu" value="">
                                                                                        <span class="">Mega Menu</span>
                                                                                        <input type="hidden" name="mega_menu_position[]" value="">

                                                                                    </label>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <!-- End Sortable Section -->
                                                    @endif

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-30">
                                        <button type="button" class="btn btn-primary" id="add-menu-item">Add More</button>
                                        <button type="submit" class="btn btn-primary">{{ __('update') }}</button>
                                        @include('backend.common.loading-btn',['class' => 'btn btn-primary'])
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('backend.admin.website_setting.component.new_menu')
    @endsection
    @push('js_asset')
        <script src="{{ static_asset('admin/js/jquery.nestable.min.js') }}"></script>
    @endpush
    @push('js')
        <script>
            $(document).ready(function () {
                $('#menuSortable').nestable({
                group: 'list',
                animation: 200,
                ghostClass: 'ghost',
                maxDepth: 2,
                }).on('change', function (e) {
                    $('li.dd-item').each(function (list) {
                        if ($(this).parents('ol').length == 1) {
                            $(this).find('#mega-menu-area').show();
                        } else {
                            $(this).find('#mega-menu-area').hide().removeClass("d-flex");
                        }

                        if ($(this).parents('ol').length == 1) {

                            $(this).find('#menu_lenght').val(1);

                        } else if ($(this).parents('ol').length == 2) {

                            $(this).find('#menu_lenght').val(2);

                        }
                    });
                });
            });
            $(document).on("click",'#add-menu-item',function() {
                var selector = $('#clone_menu .menu-item');
                var id = $('#dd-list .menu-item').last().data("id");
                var $copy  = selector.clone().appendTo('#dd-list');
                if (isNaN(id))
                    id =0;

                $('#dd-list .menu-item').last().attr("data-id", ++id);

            });

            $('.mega_menu').click(function() {
                var hiddenField = $(this).closest('#mega-menu-area').find('input[type="hidden"]');
                if ($(this).is(':checked')) {
                    hiddenField.val('true');
                } else {
                    hiddenField.val('');
                }
            });

        </script>
    @endpush
