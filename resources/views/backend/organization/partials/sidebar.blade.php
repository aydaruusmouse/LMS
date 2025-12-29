<header class="navbar-dark-v1">
    <div class="header-position">
        <span class="sidebar-toggler">
            <i class="las la-times"></i>
        </span>
        <div class="dashboard-logo d-flex justify-content-center align-items-center py-20">
            <a class="logo" href="{{ route('organization.dashboard') }}">
                <img src="{{ setting('admin_logo') && @is_file_exists(setting('admin_logo')['original_image']) ? get_media(setting('admin_logo')['original_image']) : get_media('images/default/logo/logo-green-white.png') }}"
                    alt="Logo">
            </a>
            <a class="logo-icon" href="{{ route('organization.dashboard') }}">
                <img src="{{ setting('admin_mini_logo') && @is_file_exists(setting('admin_mini_logo')['original_image']) ? get_media(setting('admin_mini_logo')['original_image']) : get_media('images/default/logo/logo-green-mini.png') }}"
                    alt="Logo">
            </a>
        </div>
        <nav class="side-nav">
            <ul>


                <li class="{{ menuActivation(['organization'], 'active') }}">
                    <a href="{{ route('organization.dashboard') }}" role="button" aria-expanded="false"
                        aria-controls="dashboard">
                        <i class="las la-tachometer-alt"></i>
                        <span>{{ __('dashboard') }}</span>
                    </a>
                </li>


                @can('manage_course')
                    <li class="{{ menuActivation(['organization/courses', 'organization/courses/*'], 'active') }}">
                        <a href="{{ route('organization.courses.index') }}">
                            <i class="las la-book"></i>
                            <span>{{ __('manage_courses') }}</span>
                        </a>
                    </li>
                @endcan


                @can('manage_student')
                    <li
                        class="{{ menuActivation(['organization/students', 'organization/students/*', 'organization/students/create'], 'active') }}">
                        <a href="{{ route('organization.students.index') }}">
                            <i class="las la-user-graduate"></i>
                            <span>{{ __('manage_students') }}</span>
                        </a>
                    </li>
                @endcan

                @can('manage_instructor')
                <li
                    class="{{ menuActivation(['organization/instructors', 'organization/instructors/*', 'organization/instructors/create', 'organization/expertise', 'organization/expertise/*'], 'active') }}">
                    <a href="{{ route('organization.instructors.index') }}">
                        <i class="las la-user-tie"></i>
                        <span>{{ __('manage_instructors') }}</span>
                    </a>
                </li>
            @endcan

                @can('manage_certificate')
                    <li>
                        <a class="{{ menuActivation(['organization/certificates*'], 'active') }}"
                            href="{{ route('organization.certificates.index') }}"><i class="las la-certificate"></i>

                            <span>{{ __('certificates') }}</span>
                        </a>
                    </li>
                @endcan

                @can('manage_media_library')
                    <li class="{{ menuActivation('organization/media-library', 'active') }}">
                        <a href="{{ route('organization.media-library.index') }}">
                            <i class="las la-images"></i>
                            <span>{{ __('media_library') }}</span>
                        </a>
                    </li>
                @endcan

                @can('manage_finance')
                <li
                    class="{{ menuActivation(['organization/payout'], 'active') }}">
                    <a href="{{ route('organization.payout') }}">
                        <i class="las la-money-bill"></i>
                        <span>{{ __('payout') }}</span>
                    </a>
                </li>
                @endcan

                @can('manage_staff')
                    <li
                        class="{{ menuActivation(['organization/staff', 'organization/staff/*', 'organization/staff/create', 'organization/expertise', 'organization/expertise/*'], 'active') }}">
                        <a href="{{ route('organization.staff.index') }}">
                            <i class="las la-user-tie"></i>
                            <span>{{ __('manage_staff') }}</span>
                        </a>
                    </li>
                @endcan

                @can('manage_setting')
                    <li class="{{ menuActivation(['organization/edit-organization','organization/payout-setting'], 'active') }}">
                        <a href="#manageInstructor" class="dropdown-icon" data-bs-toggle="collapse" role="button"
                            aria-expanded="{{ menuActivation(['organization/edit-organization','organization/payout-setting'], 'true', 'false') }}"
                            aria-controls="manageInstructor">
                            <i class="las la-cog"></i>
                            <span>{{ __('setting') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['organization/edit-organization','organization/payout-setting'], 'show') }}"
                            id="manageInstructor">
                            <li>
                                <a class="{{ menuActivation(['organization/edit-organization'], 'active') }}"
                                    href="{{ route('organization.organizations.edit') }}">{{ __('organisation_setting') }}</a>
                            </li>
                            <li>
                                <a class="{{ menuActivation(['organization/payout-setting'], 'active') }}"
                                    href="{{ route('organization.payout-setting') }}">{{ __('payout_setting') }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan

            </ul>
        </nav>
    </div>
</header>
