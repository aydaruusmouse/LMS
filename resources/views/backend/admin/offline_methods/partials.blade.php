<div class="col-lg-12 mb-4 {{ isset($offline_method) && $offline_method->type == 'bank_payment' ? '' : 'd-none' }} " id="bank_info">
    <div class="row">
        <div class="col-lg-6">
            <h6>{{ __('bank_information') }}</h6>
        </div>
        <div class="col-lg-6 text-end">
            <a href="javascript:void(0)" class="btn btn-sm sg-btn-primary add_bank_row"><i
                    class="las la-plus"></i></a>
        </div>
        <div class="col-lg-12 mt-2">
            <div class="bank_info_table">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('bank_name') }}</th>
                        <th scope="col">{{ __('branch_name') }}</th>
                        <th scope="col">{{ __('account_name') }}</th>
                        <th scope="col">{{ __('account_number') }}</th>
                        <th scope="col">{{ __('routing_number') }}</th>
                        <th scope="col">{{ __('swift_code') }}</th>
                        <th scope="col">{{ __('action') }}</th>
                    </tr>
                    </thead>
                    <tbody class="bank_information">
                    @if(isset($offline_method) && $offline_method->type == 'bank_payment')
                        @foreach($offline_method->bank_details as $key=> $bank)
                            <tr>
                                <td>
                                    <input type="text" class="form-control rounded-2"
                                           name="bank_details[{{ $key }}][bank_name]"
                                           placeholder="{{ __('bank_name') }}"
                                           value="{{ $bank['bank_name'] }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control rounded-2"
                                           name="bank_details[{{ $key }}][branch_name]"
                                           placeholder="{{ __('branch_name') }}"
                                           value="{{ $bank['branch_name'] }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control rounded-2"
                                           name="bank_details[{{ $key }}][account_name]"
                                           placeholder="{{ __('account_name') }}"
                                           value="{{ $bank['account_name'] }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control rounded-2"
                                           name="bank_details[{{ $key }}][account_number]"
                                           placeholder="{{ __('account_number') }}"
                                           value="{{ $bank['account_number'] }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control rounded-2"
                                           name="bank_details[{{ $key }}][routing_number]"
                                           placeholder="{{ __('routing_number') }}"
                                           value="{{ $bank['routing_number'] }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control rounded-2"
                                           name="bank_details[{{ $key }}][swift_code]"
                                           placeholder="{{ __('swift_code') }}"
                                           value="{{ $bank['swift_code'] }}">
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                       class="btn sg-btn-danger btn-sm delete_bank"><i
                                            class="las la-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                <input type="text" class="form-control rounded-2"
                                       name="bank_details[0][bank_name]"
                                       placeholder="{{ __('bank_name') }}">
                            </td>
                            <td>
                                <input type="text" class="form-control rounded-2"
                                       name="bank_details[0][branch_name]"
                                       placeholder="{{ __('branch_name') }}">
                            </td>
                            <td>
                                <input type="text" class="form-control rounded-2"
                                       name="bank_details[0][account_name]"
                                       placeholder="{{ __('account_name') }}">
                            </td>
                            <td>
                                <input type="number" class="form-control rounded-2"
                                       name="bank_details[0][account_number]"
                                       placeholder="{{ __('account_number') }}">
                            </td>
                            <td>
                                <input type="number" class="form-control rounded-2"
                                       name="bank_details[0][routing_number]"
                                       placeholder="{{ __('routing_number') }}">
                            </td>
                            <td>
                                <input type="number" class="form-control rounded-2"
                                       name="bank_details[0][swift_code]"
                                       placeholder="{{ __('swift_code') }}">
                            </td>
                            <td>
                                <a href="javascript:void(0)"
                                   class="btn sg-btn-danger btn-sm delete_bank"><i
                                        class="las la-trash"></i></a>
                            </td>
                        </tr>
                    @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="bank_info_row">
    <table class="table">
        <tr>
            <td>
                <input type="text" class="form-control rounded-2" data-name="bank_name"
                       placeholder="{{ __('bank_name') }}">
            </td>
            <td>
                <input type="text" class="form-control rounded-2" data-name="branch_name"
                       placeholder="{{ __('branch_name') }}">
            </td>
            <td>
                <input type="text" class="form-control rounded-2" data-name="account_name"
                       placeholder="{{ __('account_name') }}">
            </td>
            <td>
                <input type="number" class="form-control rounded-2" data-name="account_number"
                       placeholder="{{ __('account_number') }}">
            </td>
            <td>
                <input type="number" class="form-control rounded-2" data-name="routing_number"
                       placeholder="{{ __('routing_number') }}">
            </td>
            <td>
                <input type="number" class="form-control rounded-2" data-name="swift_code"
                       placeholder="{{ __('swift_code') }}">
            </td>
            <td>
                <a href="javascript:void(0)"
                   class="btn sg-btn-danger btn-sm delete_bank"><i
                        class="las la-trash"></i></a>
            </td>
        </tr>
    </table>
</div>
@push('js')
    <script>
        $(document).ready(function () {
            let i=0;
            $(document).on('change', '#type', function () {
                var type = $(this).val();
                if (type == 'bank_payment') {
                    $('#bank_info').removeClass('d-none');
                } else {
                    $('#bank_info').addClass('d-none');
                }
            });
            $(document).on('click', '.add_bank_row', function () {
                var html = $('#bank_info_row table tr');
                i++;
                //change name of all input field
                $(html).find('input').each(function () {
                    var name = $(this).data('name');
                    $(this).attr('name', 'bank_details[' + i + '][' + name + ']');
                });

                html.clone().appendTo('#bank_info table tbody');
                $(html).find('input').each(function () {
                    $(this).attr('name', '');
                });
            });
            $(document).on('click', '.delete_bank', function () {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endpush
