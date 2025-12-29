@php $currency_list = currencyList(); @endphp
<div class="modal fade" id="currency" tabindex="-1" aria-labelledby="editCurrencyLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <h6 class="sub-title create_sub_title">{{__('add_currency') }}</h6>
            <h6 class="sub-title edit_sub_title d-none">{{__('edit_currency') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('instructor.currencies.store') }}" method="POST" class="form">
                @csrf
                <div class="row gx-20">
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="currencyName" class="form-label">{{__('currency_name') }}</label>
                            <input type="text" class="form-control rounded-2 currency_name" id="currencyName"
                                   placeholder="Enter Name" name="name" value="{{ old('name') }}">
                            <div class="nk-block-des text-danger">
                                <p class="name_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Currency Name -->

                    <div class="col-12">
                        <div class="mb-4">
                            <label for="symbol" class="form-label">{{__('currency_symbol') }}</label>
                            <input type="text" class="form-control rounded-2 symbol" id="symbol" placeholder="Symbol"
                                   name="symbol" value="{{ old('symbol') }}">
                            <div class="nk-block-des text-danger">
                                <p class="symbol_error error"></p>
                            </div>

                        </div>
                    </div>
                    <!-- End Symbol -->

                    <div class="col-12">
                        <div class="mb-4">
                            <label for="currency" class="form-label">{{__('currency_code') }}</label>
                            <div class="select-type-v2">
                                <select id="currency" class="form-select form-select-lg mb-3 with_search code"
                                        name="code">
                                    <option value="" selected>{{ __('select_currency_code') }}</option>
                                    @foreach($currency_list as $key => $value)
                                        <option value="{{ $key }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                                <div class="nk-block-des text-danger">
                                    <p class="code_error error"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End Currency Code -->

                    <div class="col-12">
                        <label for="currencyRate"
                               class="form-label">{{__('currency_rate') }} {{__('1 USD =?') }}</label>
                        <input type="text" class="form-control rounded-2 exchange_rate" id="currencyRate"
                               placeholder="Exchange Rate" name="exchange_rate"
                               value="{{ old('exchange_rate') ? old('exchange_rate') : '' }}">
                        <div class="nk-block-des text-danger">
                            <p class="exchange_rate_error error"></p>
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
