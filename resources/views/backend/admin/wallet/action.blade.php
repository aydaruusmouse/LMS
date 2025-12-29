
@if($wallet->status != 1 && hasPermission('wallet.status.change'))
    <ul class="d-flex gap-30 justify-content-end">
        @if(in_array($wallet->status,[0,2]))
            <li>
                <a class="dropdown-item" href="javascript:void(0)"
                   data-route="{{ route('wallet.status.change') }}"
                   data-value="1" data-id="{{ $wallet->id }}"
                   data-toggle="tooltip"
                   data-original-title="{{ __('approve') }}"><i
                        class="las la-check"></i>
                </a>
            </li>
        @endif
        @if(in_array($wallet->status,[0,1]))
            <li>
                <a class="dropdown-item" href="javascript:void(0)"
                   data-route="{{ route('wallet.status.change') }}"
                   data-value="2" data-id="{{ $wallet->id }}"
                   data-toggle="tooltip"
                   data-original-title="{{ __('reject') }}"><i
                        class="las la-times"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
