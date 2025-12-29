@if(hasPermission('subjects.edit'))
<ul class="d-flex gap-30 justify-content-end">
    @if(hasPermission('subjects.edit'))
        <li>
            <a href="{{ route('subjects.edit',$subject->id) }}"><i
                    class="las la-edit"></i></a>
        </li>
    @endif
</ul>
@endif
