@if(hasPermission('ticket.reply'))
    <ul class="d-flex gap-30 justify-content-end">
        <li>
            <a href="{{ url('admin/tickets',$ticket->id) }}"><i
                    class="las la-reply"></i></a>
        </li>
    </ul>
@endif
