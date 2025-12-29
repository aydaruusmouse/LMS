@if($ticket->status == 'open')
    <span class="text-danger">{{ __('open') }}</span>
@elseif($ticket->status == 'pending')
    <span class="text-warning">{{ __('pending') }}</span>
@elseif($ticket->status == 'answered')
    <span class="text-success">{{ __('answered') }}</span>
@elseif($ticket->status == 'close')
    <span class="sg-text-primary">{{ __('close') }}</span>
@elseif($ticket->status == 'hold')
    <span class="text-info">{{ __('hold') }}</span>
@endif
