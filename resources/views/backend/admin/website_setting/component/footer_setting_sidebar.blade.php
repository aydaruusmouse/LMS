<ul class="nav pb-12 mb-20" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="{{ route('footer.social-links') }}"
           class="nav-link ps-0 {{ request()->routeIs('footer.social-links') ? 'active' : '' }}">
            <span>{{ __('social_links') }}</span>
        </a>
    </li>
    @if(hasPermission('footer.newsletter-settings'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('footer.newsletter-settings') }}"
               class="nav-link ps-0 {{ request()->routeIs('footer.newsletter-settings') ? 'active' : '' }}">
                <span>{{ __('newsletter_settings') }}</span>
            </a>
        </li>
    @endif
    @if(hasPermission('footer.useful-links'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('footer.useful-links') }}"
               class="nav-link ps-0 {{ request()->routeIs('footer.useful-links') ? 'active' : '' }}">
                <span>{{ __('useful_links') }}</span>
            </a>
        </li>
    @endif
    @if(hasPermission('footer.resource-links'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('footer.resource-links') }}"
               class="nav-link ps-0 {{ request()->routeIs('footer.resource-links') ? 'active' : '' }}">
                <span>{{ __('resources_links') }}</span>
            </a>
        </li>
    @endif
    @if(hasPermission('footer.quick-links'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('footer.quick-links') }}"
               class="nav-link ps-0 {{ request()->routeIs('footer.quick-links') ? 'active' : '' }}">
                <span>{{ __('quick_links') }}</span>
            </a>
        </li>
    @endif
    @if(hasPermission('footer.apps-links'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('footer.apps-links') }}"
               class="nav-link ps-0 {{ request()->routeIs('footer.apps-links') ? 'active' : '' }}">
                <span>{{ __('apps_links') }}</span>
            </a>
        </li>
    @endif
    @if(hasPermission('footer.payment-banner-settings'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('footer.payment-banner-settings') }}"
               class="nav-link ps-0 {{ request()->routeIs('footer.payment-banner-settings') ? 'active' : '' }}">
                <span>{{ __('payment_method_banners') }}</span>
            </a>
        </li>
    @endif
    @if(hasPermission('footer.copyright'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('footer.copyright') }}"
               class="nav-link ps-0 {{ request()->routeIs('footer.copyright') ? 'active' : '' }}">
                <span>{{ __('copyright') }}</span>
            </a>
        </li>
    @endif
</ul>
