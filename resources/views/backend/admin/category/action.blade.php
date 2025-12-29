@if(hasPermission('category.edit'))
    <ul class="d-flex gap-30 justify-content-end align-items-center">
        <li>
            <a href="{{ route('category.edit',$category->id) }}"><i class="las la-edit"></i></a>
        </li>
    </ul>
@endif

