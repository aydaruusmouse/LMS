<ul class="d-flex gap-30 justify-content-end">
    @if(hasPermission('tags.edit'))
        <li>
            <a href="{{ route('tag.edit',$tag->id) }}"><i
                    class="las la-edit"></i></a>
        </li>
    @endif
   
</ul>
