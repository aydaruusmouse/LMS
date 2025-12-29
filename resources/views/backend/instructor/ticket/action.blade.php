<ul class="d-flex gap-30 justify-content-end">
    @if(hasPermission('tickets.edit'))
        <li>
            <a href="{{ route('tickets.show',$ticket->id) }}"><i
                    class="las la-reply"></i></a>
        </li>
    @endif
</ul>
