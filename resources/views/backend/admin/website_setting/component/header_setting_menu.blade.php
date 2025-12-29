<ul class="nav pb-12 mb-20" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="{{ route('header.logo') }}"
           class="nav-link ps-0 {{ request()->routeIs('header.logo') ? 'active' : '' }}">
            <span>{{ __('logo') }}</span>
        </a>
    </li>
    @if(hasPermission('header.topbar'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('header.topbar') }}"
               class="nav-link ps-0 {{ request()->routeIs('header.topbar') ? 'active' : '' }}">
                <span>{{ __('topbar') }}</span>
            </a>
        </li>
    @endif
    @if(hasPermission('header.menu'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('header.menu') }}"
               class="nav-link ps-0 {{ request()->routeIs('header.menu') ? 'active' : '' }}">
                <span>{{ __('menu') }}</span>
            </a>
        </li>
    @endif
</ul>
