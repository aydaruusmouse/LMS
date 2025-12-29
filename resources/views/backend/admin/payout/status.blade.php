@if($payout->status == 0)
    <span class="text-warning">{{__('pending')}}</span>
@elseif($payout->status == 1)
    <span class="text-success">{{__('approved')}}</span>
@elseif($payout->status == 2)
    <span class="text-primary">{{__('complete')}}</span>
@elseif($payout->status == 3)
    <span class="text-danger">{{__('declined')}}</span>
@endif
