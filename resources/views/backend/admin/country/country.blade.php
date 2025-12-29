@php $currency_list = currencyList(); @endphp
<div class="modal fade" id="country" tabindex="-1" aria-labelledby="editCountryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <h6 class="sub-title create_sub_title">{{__('add_country') }}</h6>
            <h6 class="sub-title edit_sub_title d-none">{{__('edit_country') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('countries.store') }}" method="POST" class="form">
                @csrf
                <div class="row gx-20">
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="currencyName" class="form-label">{{__('name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-2 currency_name" id="currencyName"
                                   placeholder="{{ __('enter_name') }}" name="name" value="{{ old('name') }}">
                            <div class="nk-block-des text-danger">
                                <p class="name_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Currency Name -->

                    <div class="col-6">
                        <div class="mb-4">
                            <label for="iso3" class="form-label">{{__('iso3') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-2 symbol" id="iso3" placeholder="{{ __('iso3') }}"
                                   name="iso3">
                            <div class="nk-block-des text-danger">
                                <p class="iso3_error error"></p>
                            </div>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-4">
                            <label for="iso2" class="form-label">{{__('iso2') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-2 symbol" id="iso2" placeholder="{{ __('iso2') }}"
                                   name="iso2" value="{{ old('iso2') }}">
                            <div class="nk-block-des text-danger">
                                <p class="iso2_error error"></p>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="phonecode" class="form-label">{{__('phonecode') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-2 symbol" id="phonecode" placeholder="{{ __('phonecode') }}"
                                   name="phonecode" value="{{ old('phonecode') }}">
                            <div class="nk-block-des text-danger">
                                <p class="phonecode_error error"></p>
                            </div>

                        </div>
                    </div>
                    <!-- End Symbol -->

                    <div class="col-12">
                        <div class="mb-4">
                            <label for="currency" class="form-label">{{__('currency') }} <span class="text-danger">*</span></label>
                            <div class="select-type-v2">
                                <select id="currency" class="form-select form-select-lg mb-3 with_search code"
                                        name="currency">
                                    <option value="" selected>{{ __('select_currency_code') }}</option>
                                    @foreach($currency_list as $key => $value)
                                        <option value="{{ $key }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                                <div class="nk-block-des text-danger">
                                    <p class="currency_error error"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End Currency Code -->

                    <div class="col-12">
                        <label for="currency_symbol"
                               class="form-label">{{__('currency_symbol') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-2 exchange_rate" id="currency_symbol"
                               placeholder="{{ __('enter_currency_symbol') }}" name="currency_symbol"
                               value="">
                        <div class="nk-block-des text-danger">
                            <p class="currency_symbol_error error"></p>
                        </div>
                    </div>
                    <!-- End Currency Rate -->

                </div>
                <!-- END Permissions Tab====== -->
                <div class="d-flex justify-content-end align-items-center mt-30">
                    <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                </div>
            </form>
        </div>
    </div>
</div>
