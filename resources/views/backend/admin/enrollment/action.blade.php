@if(hasPermission('enrollments.status'))
    <ul class="d-flex gap-30 justify-content-end align-items-center">
        <li>
            <a href="javascript:void(0)"
               onclick="delete_row('{{ route('enrollments.status', $checkout->id) }}')"
               data-toggle="tooltip"><i @class([
                'las la-check' => !$checkout->status,
                'las la-times' => $checkout->status
           ])></i></a>
        </li>
    </ul>
@endif
