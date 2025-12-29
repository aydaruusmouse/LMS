<div class="modal fade" id="language" tabindex="-1" aria-labelledby="editCurrencyLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <h6 class="sub-title create_sub_title">{{__('add_language') }}</h6>
            <h6 class="sub-title edit_sub_title d-none">{{__('edit_language') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('languages.store') }}" method="POST" class="form">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <label class="form-label">{{__('language_name') }}</label>
                            <input type="text" class="form-control rounded-2"
                                   placeholder="{{__('language_name') }}" name="name" value="{{ old('name') }}">
                            <div class="nk-block-des text-danger">
                                <p class="name_error error">{{ $errors->first('name') }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Language Name -->

                    <div class="col-lg-12">
                        <div class="select-type-v2 mb-4 list-space">
                            <label class="form-label">{{__('locale') }}</label>
                            <select class="form-select form-select-lg mb-3 with_search"
                                    name="locale">
                                <option value="">{{__('select_local') }}</option>
                                @foreach (get_yrsetting('locale') as $locale)
                                    <option value="{{ $locale }}">{{ Str::upper($locale) }}</option>
                                @endforeach
                            </select>
                            <div class="nk-block-des text-danger">
                                <p class="locale_error error">{{ $errors->first('locale') }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Language Locale Selection -->
                    <div class="col-lg-12">
                        <div class="select-type-v2 mb-4 list-space">
                            <label class="form-label">{{__('flag') }}</label>
                            <select class="form-select form-select-lg mb-3 with_search" placeholder=""
                                    name="flag">
                                <option value="" selected>{{__('select_flag') }}</option>
                                @foreach ($flags as $flag)
                                    <option data-image="{{ static_asset($flag->image) }}"
                                            value='{{ $flag->image }}'>{{ $flag->title }}</option>
                                @endforeach
                            </select>
                                <div class="nk-block-des text-danger">
                                    <p class="flag_error error">{{ $errors->first('flag') }}</p>
                                </div>
                        </div>
                    </div>
                    <!-- End Language Flag -->

                    <div class="col-lg-12">
                        <div class="mb-4 d-flex gap-30">
                            <label for="text_direction">{{__('rtl') }}</label>
                            <div class="setting-check">
                                <input type="checkbox" id="text_direction" name="text_direction" value="rtl">
                                <label for="text_direction"></label>
                            </div>
                        </div>
                        <!-- End RTL -->

                        <div class="d-flex gap-12">
                            <label for="checkbox1">{{__('status') }}</label>
                            <div class="setting-check">
                                <input type="checkbox" id="checkbox1" value="1" checked name="status">
                                <label for="checkbox1"></label>
                            </div>
                        </div>
                        <!-- End Status -->
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
