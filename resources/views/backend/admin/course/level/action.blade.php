@if(hasPermission('level.edit'))
    <ul class="d-flex gap-30 justify-content-end">
        <li>
            <a href="{{ route('level.edit',$level->id) }}"><i
                    class="las la-edit"></i></a>
        </li>
    </ul>
@endif
