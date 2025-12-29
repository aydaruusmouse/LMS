<div class="modal fade" id="currency_format" tabindex="-1" aria-labelledby="addCurrencyLabel" aria-hidden="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <h6 class="sub-title">{{__('set_currency_format') }} </h6>
        <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>

        <form action="{{ route('set.currency.format') }}" method="post">@csrf
          @csrf
            <div class="col-12">
              <div class="mb-4">
                <label class="form-label">{{__('symbol_format') }}</label>
                <div class="select-type-v2">
                  <select class="form-select form-select-lg without_search mb-3" name="currency_symbol_format">
                      <option value="amount_symbol" {{ setting('currency_symbol_format') == 'amount_symbol' ? 'selected' : ''}}>[{{__('Amount')}}][{{__('Symbol')}}]</option>
                      <option value="symbol_amount" {{ setting('currency_symbol_format') == 'symbol_amount' ? 'selected' : ''}}>[{{__('Symbol')}}][{{__('Amount')}}]</option>
                      <option value="amount__symbol" {{ setting('currency_symbol_format') == 'amount__symbol' ? 'selected' : ''}}>[{{__('Amount')}}][{{__('Space')}}][{{__('Symbol')}}]</option>
                      <option value="symbol__amount" {{ setting('currency_symbol_format') == 'symbol__amount' ? 'selected' : ''}}>[{{__('Symbol')}}][{{__('Space')}}][{{__('Amount')}}]</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-4">
                <label class="form-label">{{__('decimal_separator') }}</label>
                <div class="select-type-v2">
                  <select class="form-select form-select-lg without_search mb-3" name="decimal_separator">
                      <option value="." {{ setting('decimal_separator') == '.' ? 'selected' : ''}}>{{ __('1,23,456.78') }}</option>
                      <option value="," {{ setting('decimal_separator') == ',' ? 'selected' : ''}}>{{ __('1.23.456,78') }}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-4">
                <label class="form-label">{{__('no_of_decimals') }}</label>
                <div class="select-type-v2 mb-3 mb-sm-30">
                  <select class="form-select form-select-lg without_search mb-3" name="no_of_decimals">
                      <option value="3" {{ setting('no_of_decimals') == '3' ? 'selected' : '' }}>12.345</option>
                      <option value="2" {{ setting('no_of_decimals') == '2' ? 'selected' : '' }}>123.45</option>
                      <option value="1" {{ setting('no_of_decimals') == '1' ? 'selected' : '' }}>1234.5</option>
                      <option value="0" {{ setting('no_of_decimals') == '0' ? 'selected' : '' }}>12345</option>
                  </select>
                </div>
              </div>
            </div>
          <div class="d-flex justify-content-end align-items-center mt-30">
            <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END Modal For Add Currency======================== -->
