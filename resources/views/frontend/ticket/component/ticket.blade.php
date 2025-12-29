<tr>
    <td>{{ $tickets->firstItem() + $key }}</td>
    <td>#{{ $ticket->ticket_id }}</td>
    <td>{{ $ticket->subject }}</td>
    <td>{{ $ticket->lastReply ? Carbon\Carbon::parse($ticket->lastReply->created_at)->format('d M,Y') : __('no_reply') }}</td>
    <td class="text-capitalize">{{ $ticket->priority }}</td>
    <td>
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
    </td>
    <td><a href="{{ route('support-tickets.show',$ticket->id) }}"
           class="template-btn">{{ __('view_details') }}</a></td>
</tr>
