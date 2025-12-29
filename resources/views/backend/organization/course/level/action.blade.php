<ul class="d-flex gap-30 justify-content-end">
    @if(hasPermission('level.edit'))
        <li>
            <a href="{{ route('level.edit',$level->id) }}"><i
                    class="las la-edit"></i></a>
        </li>
    @endif
   
</ul>
