@if(hasPermission('payouts.edit') || hasPermission('payouts.destroy'))
    <ul class="d-flex gap-30 justify-content-end align-items-center">
        @if(hasPermission('payouts.edit') && $payout->status == 0)
            <li>
                <a href="{{ route('payouts.edit',$payout->id) }}"><i
                        class="las la-edit"></i></a>
            </li>
        @endif
        @if(hasPermission('payouts.destroy') && $payout->status == 0)
            <li>
                <a href="javascript:void(0)"
                   onclick="delete_row('{{ route('payouts.destroy', $payout->id) }}')"
                   data-toggle="tooltip"
                   data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
            </li>
        @endif
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                <i class="las la-ellipsis-v"></i>
            </a>
            <ul class="dropdown-menu">
                @if(hasPermission('payouts.edit'))
                    @if($payout->status == 0)
                        <li><a href="javascript:void(0)" class="dropdown-item"
                               onclick="statusUpdate('{{ route('payouts.approved', $payout->id) }}')"
                               data-toggle="tooltip"
                               data-original-title="{{ __('approved') }}">{{__('approved')}}</a></li>
                        <li><a href="javascript:void(0)" class="dropdown-item"
                               onclick="statusUpdate('{{ route('payouts.complete', $payout->id) }}')"
                               data-toggle="tooltip"
                               data-original-title="{{ __('complete') }}">{{__('complete')}}</a></li>
                        <li><a href="javascript:void(0)" class="dropdown-item"
                               onclick="statusUpdate('{{ route('payouts.declined', $payout->id) }}')"
                               data-toggle="tooltip"
                               data-original-title="{{ __('declined') }}">{{__('declined')}}</a></li>
                    @elseif($payout->status == 1)
                        <li><a href="javascript:void(0)" class="dropdown-item"
                               onclick="statusUpdate('{{ route('payouts.complete', $payout->id) }}')"
                               data-toggle="tooltip"
                               data-original-title="{{ __('complete') }}">{{__('complete')}}</a></li>
                        <li><a href="javascript:void(0)" class="dropdown-item"
                               onclick="statusUpdate('{{ route('payouts.declined', $payout->id) }}')"
                               data-toggle="tooltip"
                               data-original-title="{{ __('declined') }}">{{__('declined')}}</a></li>
                    @endif
                @endif
            </ul>
        </div>
    </ul>
@endif
