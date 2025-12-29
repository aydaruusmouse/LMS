<ul class="d-flex gap-30 justify-content-end align-items-center">
    @if(hasPermission('organizations.edit'))
        <li>
            <a class="edit_modal" href="{{ route('organizations.settings', $organization->id) }}"><i
                    class="las la-cog"></i></a>
        </li>
    @endif
    @if(hasPermission('organizations.delete'))
        <li>
            <a href="javascript:void(0)"
               onclick="delete_row('{{ route('organizations.delete', $organization->id) }}')"
               data-toggle="tooltip"
               data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a>
        </li>
    @endif
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <i class="las la-ellipsis-v"></i>
        </a>
        <ul class="dropdown-menu">
            @if(hasPermission('organizations.create'))
                <li><a class="dropdown-item"
                       href="{{ route('organizations.overview', $organization->id) }}">{{__('view_details')}}</a></li>
                <li><a class="dropdown-item"
                       href="{{ route('courses.organization', $organization->id) }}">{{__('courses')}}</a></li>
                <li><a class="dropdown-item"
                       href="{{ route('instructors.organization', $organization->id) }}">{{__('instructors')}}</a></li>
                <li><a class="dropdown-item"
                       href="{{ route('organizations.payment', $organization->id) }}">{{__('payout_setting')}}</a></li>
            @endif
        </ul>
    </div>
</ul>


