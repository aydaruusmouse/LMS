@if(hasPermission('tag.edit'))
    <ul class="d-flex gap-30 justify-content-end">
        <li>
            <a href="{{ route('tag.edit',$tag->id) }}"><i
                    class="las la-edit"></i></a>
        </li>
    </ul>
@endif
