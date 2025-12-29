@php
    $organization_id = request()->route('org_id');
@endphp

<ul class="nav pb-12 mb-20">

    @if(hasPermission('organizations.overview'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('organizations.overview', $organization_id) }}"
               class="nav-link  ps-0 {{ menuActivation(['admin/organizations/*/overview'], 'active') }}" id="overview"
               aria-controls="organisationOverview" aria-selected="true">{{__('overview')  }}</a>
        </li>
    @endif
    @if(hasPermission('courses.organization'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('courses.organization', $organization_id) }}"
               class="nav-link  ps-0 {{ menuActivation(['admin/organizations/*/courses*'], 'active') }}" id="overview"
               aria-controls="organisationOverview" aria-selected="true">{{__('courses')  }}</a>
        </li>
    @endif

    @if(hasPermission('organizations.staff.index'))

    @endif
    <li class="nav-item" role="presentation">
        <a href="{{ route('organizations.staff.index',$organization_id) }}"
           class="nav-link  ps-0 {{ menuActivation(['admin/organizations/*/staff*'], 'active') }}" id="overview"
           aria-controls="organisationOverview" aria-selected="true">{{__('Staff')  }}</a>
    </li>

    @if(hasPermission('instructors.organization'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('instructors.organization', $organization_id) }}"
               class="nav-link  ps-0 {{ menuActivation(['admin/organizations/*/instructors*'], 'active') }}"
               id="overview"
               aria-controls="organisationOverview" aria-selected="true">{{__('instructor')  }}</a>
        </li>
    @endif
    @if(hasPermission('organizations.payment'))
        <li class="nav-item" role="presentation">
            {{-- <a class="nav-link" id="payment" data-bs-toggle="pill" data-bs-target="#organisationPayment" role="tab" aria-controls="organisationPayment" aria-selected="false">{{__('payment')  }}</a> --}}
            <a href="{{ route('organizations.payment', $organization_id) }}"
               class="nav-link  ps-0 {{ menuActivation(['admin/organizations/*/payment*'], 'active') }}" id="overview"
               aria-controls="organisationOverview" aria-selected="true">{{__('payout_setting')  }}</a>
        </li>
    @endif

    @if(hasPermission('organizations.settings'))
        <li class="nav-item" role="presentation">
            {{-- <a class="nav-link" id="settings" data-bs-toggle="pill" data-bs-target="#organisationSettings" role="tab" aria-controls="organisationSettings" aria-selected="false">{{__('settings') }}</a> --}}
            <a href="{{ route('organizations.settings', $organization_id) }}"
               class="nav-link  ps-0 {{ menuActivation(['admin/organizations/*/settings'], 'active') }}" id="overview"
               aria-controls="organisationOverview" aria-selected="true">{{__('settings')  }}</a>
        </li>
    @endif
</ul>
<!-- End Organisation Details Tab -->
