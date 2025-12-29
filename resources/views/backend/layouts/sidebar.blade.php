<header class="navbar-dark-v1">
    <div class="header-position">
        <span class="sidebar-toggler">
            <i class="las la-times"></i>
        </span>
        <div class="dashboard-logo d-flex justify-content-center align-items-center py-20">
            <a class="logo" href="{{ route('admin.dashboard') }}">
                <img
                    src="{{ setting('admin_logo') && @is_file_exists(setting('admin_logo')['original_image']) ? get_media(setting('admin_logo')['original_image']) : get_media('images/default/logo/logo-green-white.png') }}"
                    alt="Logo">
            </a>
            <a class="logo-icon" href="{{ route('admin.dashboard') }}">
                <img
                    src="{{ setting('admin_mini_logo') && @is_file_exists(setting('admin_mini_logo')['original_image']) ? get_media(setting('admin_mini_logo')['original_image']) : get_media('images/default/logo/logo-green-mini.png') }}"
                    alt="Logo">
            </a>
        </div>
        <nav class="side-nav">
            <ul>
                @if(hasPermission('admin.dashboard'))
                    <li class="{{ menuActivation(['admin/dashboard', 'admin'], 'active') }}">
                        <a href="{{ route('admin.dashboard') }}" role="button" aria-expanded="false"
                           aria-controls="dashboard">
                            <i class="las la-tachometer-alt"></i>
                            <span>{{ __('dashboard') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('admin.enrollments'))
                    <li class="{{ menuActivation(['admin/enrollments'], 'active') }}">
                        <a href="{{ route('admin.enrollments') }}" role="button" aria-expanded="false"
                           aria-controls="dashboard">
                            <i class="las la-book-open"></i>
                            <span>{{ __('enrollments') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('courses.index') || hasPermission('category.index') || hasPermission('subjects.index') || hasPermission('tag.index') || hasPermission('level.index') || hasPermission('certificates.index'))
                    <li class="{{ menuActivation(['admin/category/*', 'admin/category', 'admin/subjects/*', 'admin/subjects', 'admin/tags/*', 'admin/tag', 'admin/level/*', 'admin/level', 'admin/courses/*', 'admin/courses', 'admin/quizzes*', 'admin/certificates*'], 'active') }}">
                        <a href="#course" class="dropdown-icon" data-bs-toggle="collapse" role="button"
                           aria-expanded="{{ menuActivation(['admin/category/*', 'admin/category', 'admin/subjects/*', 'admin/subjects', 'admin/tag/*', 'admin/tag', 'admin/level/*', 'admin/level', 'admin/courses/*', 'admin/courses', 'admin/quizzes*', 'admin/certificates*'], 'true', 'false') }}"
                           aria-controls="course">
                            <i class="las la-book"></i>
                            <span>{{ __('course') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/category/*', 'admin/category', 'admin/subjects/*', 'admin/subjects', 'admin/tag/*', 'admin/tag', 'admin/level/*', 'admin/level', 'admin/courses/*', 'admin/courses', 'admin/quizzes*', 'admin/certificates*'], 'show') }}"
                            id="course">
                            @if(hasPermission('courses.index'))
                                <li>
                                    <a class="{{ menuActivation(['admin/courses/*', 'admin/courses', 'admin/quizzes*'], 'active') }}"
                                       href="{{ route('courses.index') }}">{{ __('course_list') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('category.index'))
                                <li><a class="{{ menuActivation(['admin/category/*', 'admin/category'], 'active') }}"
                                       href="{{ route('category.index') }}">{{ __('category') }}</a></li>
                            @endif

                            @if(hasPermission('subjects.index'))
                                <li><a class="{{ menuActivation(['admin/subjects/*', 'admin/subjects'], 'active') }}"
                                       href="{{ route('subjects.index') }}">{{ __('subject') }}</a></li>
                            @endif
                            @if(hasPermission('tag.index'))
                                <li><a class="{{ menuActivation(['admin/tag/*', 'admin/tag'], 'active') }}"
                                       href="{{ route('tag.index') }}">{{ __('tags') }}</a></li>
                            @endif

                            @if(hasPermission('level.index'))
                                <li><a class="{{ menuActivation(['admin/level/*', 'admin/level'], 'active') }}"
                                       href="{{ route('level.index') }}">{{ __('levels') }}</a></li>
                            @endif

                            @if(hasPermission('certificates.index'))
                                <li><a class="{{ menuActivation(['admin/certificates*'], 'active') }}"
                                       href="{{ route('certificates.index') }}">{{ __('certificates') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(hasPermission('students.index'))
                    <li
                        class="{{ menuActivation(['admin/students', 'admin/students/*', 'admin/students/create'], 'active') }}">
                        <a href="{{ route('students.index') }}">
                            <i class="las la-certificate"></i>
                            <span>{{ __('manage_students') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('instructors.index') || hasPermission('instructors.create') || hasPermission('expertise.index'))
                    <li class="{{ menuActivation(['admin/instructors', 'admin/instructors/*', 'admin/instructors/create', 'admin/expertise', 'admin/expertise/*'], 'active') }}">
                        <a href="#manageInstructor" class="dropdown-icon" data-bs-toggle="collapse" role="button"
                           aria-expanded="{{ menuActivation(['admin/instructors', 'admin/instructors/*', 'admin/instructors/create', 'admin/expertise', 'admin/expertise/*'], 'true', 'false') }}"
                           aria-controls="manageInstructor">
                            <i class="las la-user-tie"></i>
                            <span>{{ __('manage_instructors') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/instructors', 'admin/instructors/*', 'admin/instructors/create', 'admin/expertise', 'admin/expertise/*'], 'show') }}"
                            id="manageInstructor">

                            @if(hasPermission('instructors.index'))
                                <li>
                                    <a class="{{ menuActivation(['admin/instructors'], 'active') }}"
                                       href="{{ route('instructors.index') }}">{{ __('instructor_list') }}</a>
                                </li>
                            @endif


                            @if(hasPermission('instructors.create'))
                                <li><a class="{{ menuActivation('admin/instructors/create', 'active') }}"
                                       href="{{ route('instructors.create') }}">{{ __('add_instructor') }}</a></li>
                            @endif

                            @if(hasPermission('expertise.index'))
                                <li>
                                    <a class="{{ menuActivation(['admin/expertise', 'admin/expertise/*'], 'active') }}"
                                       href="{{ route('expertise.index') }}">{{ __('expertises') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(hasPermission('organizations.index') || hasPermission('organizations.create'))
                    <li class="{{ menuActivation(['admin/organizations*'], 'active') }}">
                        <a href="#manageOrganisation" class="dropdown-icon" data-bs-toggle="collapse" role="button"
                           aria-expanded="{{ menuActivation(['admin/organizations*'], 'true', 'false') }}"
                           aria-controls="manageOrganisation">
                            <i class="las la-school"></i>
                            <span>{{ __('manage_organisation') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/organizations*'], 'show') }}"
                            id="manageOrganisation">

                            @if(hasPermission('organizations.index'))
                                <li>
                                    <a class="{{ menuActivation('admin/organizations', 'active') }}"
                                       href="{{ route('organizations.index') }}">{{ __('organisation_list') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('organizations.create'))
                                <li><a class="{{ menuActivation('admin/organizations/create', 'active') }}"
                                       href="{{ route('organizations.create') }}">{{ __('add_organisation') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(hasPermission('staffs.index') || hasPermission('roles.index'))
                    <li class="{{ menuActivation(['admin/staffs', 'admin/staffs/create','admin/staffs/*/edit','admin/roles/*/edit', 'admin/roles/create', 'admin/roles'], 'active') }}">
                        <a href="#staff" class="dropdown-icon" data-bs-toggle="collapse" role="button"
                           aria-expanded="{{ menuActivation(['admin/staffs', 'admin/staffs/create','admin/staffs/*/edit','admin/roles/*/edit', 'admin/roles/create', 'admin/roles'], 'true', 'false') }}"
                           aria-controls="staff">
                            <i class="las la-user-friends"></i>
                            <span>{{ __('staff') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/staffs', 'admin/roles/create', 'admin/staffs/create','admin/staffs/*/edit','admin/roles/*/edit', 'admin/roles'], 'show') }}"
                            id="staff">

                            @if(hasPermission('staffs.index'))
                                <li><a class="{{ menuActivation('admin/staff*', 'active') }}"
                                       href="{{ route('staffs.index') }}">{{ __('all_staff') }}</a></li>
                            @endif

                            @if(hasPermission('roles.index'))
                                <li><a class="{{ menuActivation('admin/roles*', 'active') }}"
                                       href="{{ route('roles.index') }}">{{ __('roles') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(hasPermission('media-library.index'))
                    <li class="{{ menuActivation('admin/media-library', 'active') }}">
                        <a href="{{ route('media-library.index') }}">
                            <i class="las la-images"></i>
                            <span>{{ __('media_library') }}</span>
                        </a>
                    </li>
                @endif

                @if(hasPermission('ai.assistant'))
                    <li class="{{ menuActivation('admin/ai.assistant', 'active') }}">
                        <a href="{{ route('ai.assistant') }}">
                            <i class="las la-robot"></i>
                            <span>{{ __('ai_assistant') }}</span>
                        </a>
                    </li>
                @endif

                @if(hasPermission('blogs.index') || hasPermission('blogs.create') || hasPermission('blog-categories.index'))
                    <li class="{{ menuActivation(['admin/blogs', 'admin/blogs/*', 'admin/blogs/create', 'admin/blog-categories', 'admin/blog-categories/*', 'admin/blog-categories/create'], 'active') }}">
                        <a href="#blog" class="dropdown-icon" data-bs-toggle="collapse" role="button"
                           aria-expanded="{{ menuActivation(['admin/blogs', 'admin/blogs/*', 'admin/blogs/create', 'admin/blog-categories', 'admin/blog-categories/*', 'admin/blog-categories/create'], 'true', 'false') }}"
                           aria-controls="blog">
                            <i class="las la-blog"></i>
                            <span>{{ __('blog') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/blogs', 'admin/blogs/*', 'admin/blogs/create', 'admin/blog-categories', 'admin/blog-categories/*', 'admin/blog-categories/create'], 'show') }}"
                            id="blog">
                            @if(hasPermission('blogs.index'))
                                <li>
                                    <a class="{{ menuActivation(['admin/blogs','admin/blogs/*'], 'active') }}"
                                       href="{{ route('blogs.index') }}">{{ __('all_post') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('blogs.create'))
                                <li><a class="{{ menuActivation('admin/blogs/create', 'active') }}"
                                       href="{{ route('blogs.create') }}">{{ __('add_new_post') }}</a></li>
                            @endif

                            @if(hasPermission('blog-categories.index'))
                                <li>
                                    <a class="{{ menuActivation(['admin/blog-categories', 'admin/blog-categories/*'], 'active') }}"
                                       href="{{ route('blog-categories.index') }}">{{ __('category') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(hasPermission('payment.gateway'))
                    <li class="{{ menuActivation('admin/payment-gateway', 'active') }}">
                        <a href="{{ route('payment.gateway') }}">
                            <i class="las la-credit-card"></i>
                            <span>{{ __('payment_gateway') }}</span>
                        </a>
                    </li>
                @endif


                @if (setting('wallet_system') && hasPermission('wallet.request'))
                    <li class="{{ menuActivation('admin/wallet-request', 'active') }}">
                        <a href="{{ route('wallet.request') }}">
                            <i class="las la-wallet"></i>
                            <span>{{ __('wallet_request') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('payouts.method-setting') || hasPermission('payouts.create') || hasPermission('payouts.index'))

                    <li class="{{ menuActivation(array('admin/payouts*'), 'active') }}">
                        <a href="#payout" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(array('admin/payouts*'), 'true', 'false') }}"
                           aria-controls="otp_settings">
                            <i class="las la-file-invoice-dollar"></i>
                            <span>{{__('payout') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/payouts*'], 'show') }}" id="payout">

                            @if(hasPermission('payouts.method-setting'))
                                <li><a class="{{ menuActivation(['admin/payouts/method-setting'], 'active') }}"
                                       href="{{ route('payouts.method-setting') }}">{{ __('payout_method') }}</a></li>
                            @endif

                            @if(hasPermission('payouts.create'))
                                <li><a class="{{ menuActivation(['admin/payouts/create'], 'active') }}"
                                       href="{{ route('payouts.create') }}">{{ __('payout_request') }}</a></li>
                            @endif


                            @if(hasPermission('payouts.index'))
                                <li><a class="{{ menuActivation(['admin/payouts'], 'active') }}"
                                       href="{{ route('payouts.index') }}">{{ __('payout_request_list') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(hasPermission('custom-notification.index') || hasPermission('pusher.notification') || hasPermission('onesignal.notification'))
                    <li class="{{ menuActivation(['admin/pusher-notification', 'admin/one-signal-notification', 'admin/custom-notification', 'admin/custom-notification*'], 'active') }}">
                        <a href="#notification" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(['admin/pusher-notification', 'admin/one-signal-notification', 'admin/custom-notification', 'admin/custom-notification*'], 'true', 'false') }}"
                           aria-controls="otp_settings">
                            <i class="las la-bell"></i>
                            <span>{{ __('notification') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/pusher-notification', 'admin/one-signal-notification', 'admin/custom-notification', 'admin/custom-notification*'], 'show') }}"
                            id="notification">

                            @if(hasPermission('custom-notification.index'))
                                <li>
                                    <a class="{{ menuActivation(['admin/custom-notification', 'admin/custom-notification*'], 'active') }}"
                                       href="{{ route('custom-notification.index') }}">{{ __('custom_notification') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('pusher.notification'))
                                <li><a class="{{ menuActivation('admin/pusher-notification', 'active') }}"
                                       href="{{ route('pusher.notification') }}">{{ __('pusher') }}</a></li>
                            @endif

                            @if(hasPermission('onesignal.notification'))
                                <li><a class="{{ menuActivation('admin/one-signal-notification', 'active') }}"
                                       href="{{ route('onesignal.notification') }}">{{ __('onesignal') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(hasPermission('tickets.index') || hasPermission('student-faqs.index') || hasPermission('departments.index'))
                    <li class="{{ menuActivation(['admin/departments', 'admin/departments/*', 'admin/tickets', 'admin/tickets/*'], 'active') }}">
                        <a href="#support" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(['admin/departments', 'admin/departments/*', 'admin/tickets', 'admin/tickets/*'], 'true', 'false') }}"
                           aria-controls="support">
                            <i class="las la-headset"></i>
                            <span>{{ __('support') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/departments', 'admin/departments/*', 'admin/tickets', 'admin/tickets/*', 'admin/student-faqs*'], 'show') }}"
                            id="support">

                            @if(hasPermission('tickets.index'))
                                <li><a class="{{ menuActivation(['admin/tickets', 'admin/tickets/*'], 'active') }}"
                                       href="{{ route('tickets.index') }}">{{ __('ticket') }}</a></li>
                            @endif


                            @if(hasPermission('student-faqs.index'))
                                <li>
                                    <a class="{{ menuActivation(['admin/student-faqs', 'admin/student-faqs/*'], 'active') }}"
                                       href="{{ route('student-faqs.index') }}">{{ __('faq') }}</a></li>
                            @endif


                            @if(hasPermission('departments.index'))
                                <li>
                                    <a class="{{ menuActivation(['admin/departments', 'admin/departments/*'], 'active') }}"
                                       href="{{ route('departments.index') }}">{{ __('department') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if((hasPermission('coupons.index') && setting('coupon_system')) || hasPermission('subscribers.index') || hasPermission('bulk.sms'))
                    <li class="{{ menuActivation(['admin/coupons', 'admin/coupons/*', 'admin/coupons/create', 'admin/subscribers', 'admin/bulk-sms'], 'active') }}">
                        <a href="#coupon" class="dropdown-icon" data-bs-toggle="collapse" role="button"
                           aria-expanded="{{ menuActivation(['admin/coupons', 'admin/coupons/*', 'admin/coupons/create', 'admin/subscribers', 'admin/bulk-sms'], 'true', 'false') }}"
                           aria-controls="coupon">
                            <i class="las la-th"></i>
                            <span>{{ __('marketing') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/coupons', 'admin/coupons/*', 'admin/coupons/create', 'admin/subscribers', 'admin/bulk-sms'], 'show') }}"
                            id="coupon">

                            @if(hasPermission('coupons.index') && setting('coupon_system'))
                                <li>
                                    <a class="{{ menuActivation(['admin/coupons', 'admin/coupons/*'], 'active') }}"
                                       href="{{ route('coupons.index') }}">{{ __('all_coupons') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('subscribers.index'))
                                <li><a class="{{ menuActivation('admin/subscribers', 'active') }}"
                                       href="{{ route('subscribers.index') }}">{{ __('subscribers') }}</a></li>
                            @endif

                            @if(hasPermission('bulk.sms'))
                                <li><a class="{{ menuActivation('admin/bulk-sms', 'active') }}"
                                       href="{{ route('bulk.sms') }}">{{ __('bulk_sms') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (addon_is_activated('accounts_system') && (hasPermission('accounts.index') || hasPermission('bank-accounts.index') || hasPermission('incomes.index') || hasPermission('expenses.index') || hasPermission('transfers.index')))
                    <li
                        class="{{ menuActivation(
                            [
                                'admin/accounts',
                                'admin/accounts/*',
                                'admin/bank-accounts',
                                'admin/bank-accounts/*',
                                'admin/incomes',
                                'admin/incomes/*',
                                'admin/expenses',
                                'admin/expenses/*',
                                'admin/transfers',
                                'admin/transfers/*',
                            ],
                            'active',
                        ) }}">
                        <a href="#accounts" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(
                                [
                                    'admin/accounts',
                                    'admin/accounts/*',
                                    'admin/bank-accounts',
                                    'admin/bank-accounts/*',
                                    'admin/incomes',
                                    'admin/incomes/*',
                                    'admin/expenses',
                                    'admin/expenses/*',
                                    'admin/transfers',
                                    'admin/transfers/*',
                                ],
                                'true',
                                'false',
                            ) }}"
                           aria-controls="accounts">
                            <i class="las la-dollar-sign"></i>
                            <span>{{ __('accounts') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(
                            [
                                'admin/accounts',
                                'admin/accounts/*',
                                'admin/bank-accounts',
                                'admin/bank-accounts/*',
                                'admin/incomes',
                                'admin/incomes/*',
                                'admin/expenses',
                                'admin/expenses/*',
                                'admin/transfers',
                                'admin/transfers/*',
                            ],
                            'show',
                        ) }}"
                            id="accounts">
                            @if(hasPermission('accounts.index'))
                                <li><a class="{{ menuActivation(['admin/accounts', 'admin/accounts/*'], 'active') }}"
                                       href="{{ route('accounts.index') }}">{{ __('accounts') }}</a></li>
                            @endif

                            @if(hasPermission('bank-accounts.index'))
                                <li>
                                    <a class="{{ menuActivation(['admin/bank-accounts', 'admin/bank-accounts/*'], 'active') }}"
                                       href="{{ route('bank-accounts.index') }}">{{ __('bank_accounts') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('incomes.index'))
                                <li><a class="{{ menuActivation(['admin/incomes', 'admin/incomes/*'], 'active') }}"
                                       href="{{ route('incomes.index') }}">{{ __('income') }}</a></li>
                            @endif

                            @if(hasPermission('expenses.index'))
                                <li><a class="{{ menuActivation(['admin/expenses', 'admin/expenses/*'], 'active') }}"
                                       href="{{ route('expenses.index') }}">{{ __('expense') }}</a></li>
                            @endif

                            @if(hasPermission('transfers.index'))
                                <li><a class="{{ menuActivation(['admin/transfers', 'admin/transfers/*'], 'active') }}"
                                       href="{{ route('transfers.index') }}">{{ __('transfer') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(hasPermission('backend.admin.report.course_sale') || hasPermission('backend.admin.report.commission_history') || hasPermission('backend.admin.report.payment_history') || hasPermission('backend.admin.report.payout_history') || hasPermission('backend.admin.report.wishlist'))
                    <li class="{{ menuActivation(['admin/book-sale', 'admin/course-sale', 'admin/commission-history', 'admin/payment-history', 'admin/payout-history', 'admin/wishlist'], 'active') }}">
                        <a href="#report" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(['admin/book-sale', 'admin/course-sale', 'admin/commission-history', 'admin/payment-history', 'admin/payout-history', 'admin/wishlist'], 'true', 'false') }}"
                           aria-controls="report">
                            <i class="las la-clipboard-list"></i>
                            <span>{{ __('reports') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/book-sale', 'admin/course-sale', 'admin/commission-history', 'admin/payment-history', 'admin/payout-history', 'admin/wishlist'], 'show') }}"
                            id="report">

                            @if(hasPermission('backend.admin.report.course_sale'))
                                <li><a class="{{ menuActivation(['admin/course-sale'], 'active') }}"
                                       href="{{ route('backend.admin.report.course_sale') }}">{{ __('course_sale') }}</a>
                                </li>
                            @endif


                            @if(hasPermission('backend.admin.report.commission_history'))
                                <li><a class="{{ menuActivation(['admin/commission-history'], 'active') }}"
                                       href="{{ route('backend.admin.report.commission_history') }}">{{ __('commission_history') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('backend.admin.report.payment_history'))
                                <li><a class="{{ menuActivation(['admin/payment-history'], 'active') }}"
                                       href="{{ route('backend.admin.report.payment_history') }}">{{ __('payment_history') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('backend.admin.report.payout_history'))
                                <li><a class="{{ menuActivation(['admin/payout-history'], 'active') }}"
                                       href="{{ route('backend.admin.report.payout_history') }}">{{ __('payout_history') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('backend.admin.report.wishlist'))
                                <li><a class="{{ menuActivation(['admin/wishlist'], 'active') }}"
                                       href="{{ route('backend.admin.report.wishlist') }}">{{ __('wishlist') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(hasPermission('onboards.index') || hasPermission('sliders.index') || hasPermission('apikeys.index') || hasPermission('android.setting') || hasPermission('ios.setting') || hasPermission('mobile.gdpr') || hasPermission('mobile.home.screen'))
                    <li id="home-screen"
                        class="{{ menuActivation(['admin/onboards','admin/onboards/*', 'admin/android-setting', 'admin/sliders','admin/sliders/*', 'admin/apikeys', 'admin/android', 'admin/ios*', 'admin/mobile-home-screen', 'admin/mobile-gdpr'], 'active') }}">
                        <a href="#mobileApp" class="dropdown-icon" data-bs-toggle="collapse" role="button"
                           aria-expanded="{{ menuActivation(['admin/onboards', 'admin/onboards/*','admin/android-setting', 'admin/sliders','admin/sliders/*', 'admin/apikeys', 'admin/android', 'admin/ios*', 'admin/mobile-home-screen', 'admin/mobile-gdpr'], 'true', 'false') }}"
                           aria-controls="mobileApp">
                            <i class="las la-mobile"></i>
                            <span>{{ __('mobile_app_settings') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/onboards', 'admin/onboards/*','admin/android-setting','admin/sliders/*', 'admin/sliders', 'admin/apikeys*', 'admin/android', 'admin/ios*', 'admin/mobile-home-screen', 'admin/mobile-gdpr'], 'show') }}"
                            id="mobileApp">

                            @if(hasPermission('onboards.index'))
                                <li><a class="{{ menuActivation('admin/onboards*', 'active') }}"
                                       href="{{ route('onboards.index') }}">{{ __('on_board') }}</a></li>
                            @endif

                            @if(hasPermission('sliders.index'))
                                <li><a class="{{ menuActivation('admin/sliders*', 'active') }}"
                                       href="{{ route('sliders.index') }}">{{ __('slider') }}</a></li>
                            @endif

                            @if(hasPermission('apikeys.index'))
                                <li><a class="{{ menuActivation('admin/apikeys*', 'active') }}"
                                       href="{{ route('apikeys.index') }}">{{ __('api_settings') }}</a></li>
                            @endif

                            @if(hasPermission('android.setting'))
                                <li><a class="{{ menuActivation('admin/android-setting', 'active') }}"
                                       href="{{ route('android.setting') }}">{{ __('android_settings') }}</a></li>
                            @endif

                            @if(hasPermission('ios.setting'))
                                <li><a class="{{ menuActivation('admin/ios*', 'active') }}"
                                       href="{{ route('ios.setting') }}">{{ __('ios_setting') }}</a></li>
                            @endif

                            @if(hasPermission('mobile.gdpr'))
                                <li><a class="{{ menuActivation('admin/mobile-gdpr', 'active') }}"
                                       href="{{ route('mobile.gdpr') }}">{{ __('gdpr') }}</a></li>
                            @endif

                            @if(hasPermission('mobile.home.screen'))
                                <li><a class="{{ menuActivation('admin/mobile-home-screen', 'active') }}"
                                       href="{{ route('mobile.home.screen') }}">{{ __('home_screen_settings') }}</a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif
                @if(hasPermission('pages.index') || hasPermission('success-stories.index') || hasPermission('testimonials.index') || hasPermission('brands.index'))
                    <li class="{{ menuActivation(['admin/success-stories*', 'admin/pages', 'admin/create-404*', 'admin/pages*', 'admin/testimonials*', 'admin/brands*'], 'active') }}">
                        <a href="#cms_settings" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(['admin/success-stories*', 'admin/create-404*', 'admin/pages', 'admin/pages*', 'admin/testimonials*', 'admin/brands*'], 'true', 'false') }}"
                           aria-controls="cms_settings">
                            <i class="las la-layer-group"></i>
                            <span>{{ __('cms') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/success-stories*', 'admin/create-404*', 'admin/pages', 'admin/pages*', 'admin/testimonials*', 'admin/brands*'], 'show') }}"
                            id="cms_settings">

                            @if(hasPermission('pages.index'))
                                <li><a class="{{ menuActivation('admin/pages*', 'active') }}"
                                       href="{{ route('pages.index') }}">{{ __('all_pages') }}</a></li>
                            @endif

                            @if(hasPermission('success-stories.index'))
                                <li><a class="{{ menuActivation('admin/success-stories*', 'active') }}"
                                       href="{{ route('success-stories.index') }}">{{ __('success_story') }}</a></li>
                            @endif

                            @if(hasPermission('testimonials.index'))
                                <li><a class="{{ menuActivation('admin/testimonials*', 'active') }}"
                                       href="{{ route('testimonials.index') }}">{{ __('testimonial') }}</a></li>
                            @endif
                            @if(hasPermission('brands.index'))
                                <li><a class="{{ menuActivation('admin/brands*', 'active') }}"
                                       href="{{ route('brands.index') }}">{{ __('brands') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(hasPermission('website.themes') || hasPermission('theme.options') || hasPermission('header.logo') || hasPermission('hero.section') || hasPermission('footer.social-links') ||
                    hasPermission('website.cta') || hasPermission('website.popup') || hasPermission('website.seo') || hasPermission('custom.js') || hasPermission('website.instructor_content') ||
                    hasPermission('custom.css') || hasPermission('admin.firebase') || hasPermission('chat.messenger') || hasPermission('google.setup') || hasPermission('fb.pixel') || hasPermission('gdpr') ||
                    hasPermission('home.page.builder'))

                    <li class="{{ menuActivation(
                        [
                            'admin/home-page',
                            'admin/call-to-action',
                            'admin/social-link-setting',
                            'admin/newsletter-setting',
                            'admin/useful-link-setting',
                            'admin/resource-link-setting',
                            'admin/quick-link-setting',
                            'admin/apps-link-setting',
                            'admin/payment-banner-setting',
                            'admin/copyright-setting',
                            'admin/become-instructor-content',
                            'admin/header-logo',
                            'admin/theme-options',
                            'admin/website-themes',
                            'admin/website-popup',
                            'admin/website-seo',
                            'admin/google-setup',
                            'admin/custom-js',
                            'admin/custom-css',
                            'admin/facebook-pixel',
                            'admin/gdpr',
                            'admin/header-menu',
                            'admin/hero-section',
                            'admin/header-topbar',
                            'admin/header-footer',
                            'admin/header-content',
                            'admin/footer-menu',
                            'admin/firebase',
                            'admin/storage-setting',
                            'admin/chat-messenger',
                        ],
                        'active',
                    ) }}">
                        <a href="#website_settings" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(
                            [
                                'admin/home-page',
                                'admin/social-link-setting',
                                'admin/newsletter-setting',
                                'admin/useful-link-setting',
                                'admin/resource-link-setting',
                                'admin/quick-link-setting',
                                'admin/apps-link-setting',
                                'admin/payment-banner-setting',
                                'admin/copyright-setting',
                                'admin/become-instructor-content',
                                'admin/call-to-action',
                                'admin/header-logo',
                                'admin/theme-options',
                                'admin/website-themes',
                                'admin/website-popup',
                                'admin/website-seo',
                                'admin/google-setup',
                                'admin/custom-js',
                                'admin/custom-css',
                                'admin/header-topbar',
                                'admin/facebook-pixel',
                                'admin/header-menu',
                                'admin/hero-section',
                                'admin/gdpr',
                                'admin/header-footer',
                                'admin/header-content',
                                'admin/footer-menu',
                                'admin/firebase',
                                'admin/storage-setting',
                                'admin/chat-messenger',
                            ],
                            'true',
                            'false',
                        ) }}"
                           aria-controls="website_settings">
                            <i class="las la-tools"></i>
                            <span>{{ __('website_settings') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(
                        [
                            'admin/home-page',
                            'admin/become-instructor-content',
                            'admin/call-to-action',
                            'admin/social-link-setting',
                            'admin/newsletter-setting',
                            'admin/useful-link-setting',
                            'admin/resource-link-setting',
                            'admin/quick-link-setting',
                            'admin/apps-link-setting',
                            'admin/payment-banner-setting',
                            'admin/copyright-setting',
                            'admin/header-topbar',
                            'admin/header-logo',
                            'admin/theme-options',
                            'admin/website-themes',
                            'admin/website-popup',
                            'admin/website-seo',
                            'admin/google-setup',
                            'admin/custom-js',
                            'admin/custom-css',
                            'admin/facebook-pixel',
                            'admin/gdpr',
                            'admin/header-topbar',
                            'admin/header-menu',
                            'admin/header-footer',
                            'admin/header-content',
                            'admin/hero-section',
                            'admin/footer-menu',
                            'admin/firebase',
                            'admin/storage-setting',
                            'admin/chat-messenger',
                        ],
                        'show',
                    ) }}"
                            id="website_settings">

                            @if(hasPermission('website.themes'))
                                <li><a class="{{ menuActivation('admin/website-themes', 'active') }}"
                                       href="{{ route('website.themes') }}">{{ __('website_themes') }}</a></li>
                            @endif

                            @if(hasPermission('theme.options'))
                                <li><a class="{{ menuActivation('admin/theme-options', 'active') }}"
                                       href="{{ route('theme.options') }}">{{ __('theme_options') }}</a></li>
                            @endif

                            @if(hasPermission('header.logo'))
                                <li>
                                    <a class="{{ menuActivation(['admin/header-logo', 'admin/header-topbar', 'admin/header-menu'], 'active') }}"
                                       href="{{ route('header.logo') }}">{{ __('header_content') }}</a></li>
                            @endif

                            @if(hasPermission('hero.section'))
                                <li><a class="{{ menuActivation('admin/hero-section', 'active') }}"
                                       href="{{ route('hero.section') }}">{{ __('hero_section') }}</a></li>
                            @endif

                            @if(hasPermission('footer.social-links'))
                                <li><a class="{{ menuActivation([
                                'admin/social-link-setting',
                                'admin/newsletter-setting',
                                'admin/useful-link-setting',
                                'admin/resource-link-setting',
                                'admin/quick-link-setting',
                                'admin/apps-link-setting',
                                'admin/payment-banner-setting',
                                'admin/copyright-setting'
                            ], 'active') }}"
                                       href="{{ route('footer.social-links') }}">{{ __('footer_content') }}</a></li>
                            @endif

                            @if(hasPermission('website.cta'))
                                <li><a class="{{ menuActivation('admin/call-to-action', 'active') }}"
                                       href="{{ route('website.cta') }}">{{ __('call_to_action_content') }}</a></li>
                            @endif

                            @if(hasPermission('website.popup'))
                                <li><a class="{{ menuActivation('admin/website-popup', 'active') }}"
                                       href="{{ route('website.popup') }}">{{ __('website_popup') }}</a></li>
                            @endif

                            @if(hasPermission('website.seo'))
                                <li><a class="{{ menuActivation('admin/website-seo', 'active') }}"
                                       href="{{ route('website.seo') }}">{{ __('website_seo') }}</a></li>
                            @endif
                            @if(hasPermission('custom.css'))
                                <li><a class="{{ menuActivation('admin/custom-css', 'active') }}"
                                       href="{{ route('custom.css') }}">{{ __('custom_css') }}</a></li>
                            @endif
                            @if(hasPermission('custom.js'))
                                <li><a class="{{ menuActivation('admin/custom-js', 'active') }}"
                                       href="{{ route('custom.js') }}">{{ __('custom_js') }}</a></li>
                            @endif

                            @if(hasPermission('website.instructor_content'))
                                <li><a class="{{ menuActivation('admin/become-instructor-content', 'active') }}"
                                       href="{{ route('website.instructor_content') }}">{{ __('instructor_content') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('google.setup'))
                                <li><a class="{{ menuActivation('admin/google-setup', 'active') }}"
                                       href="{{ route('google.setup') }}">{{ __('google_setup') }}</a></li>
                            @endif

                            @if(hasPermission('fb.pixel'))
                                <li><a class="{{ menuActivation('admin/facebook-pixel', 'active') }}"
                                       href="{{ route('fb.pixel') }}">{{ __('fb_pixel') }}</a></li>
                            @endif

                            @if(hasPermission('gdpr'))
                                <li><a class="{{ menuActivation('admin/gdpr', 'active') }}"
                                       href="{{ route('gdpr') }}">{{ __('gdpr') }}</a></li>
                            @endif
                            @if(hasPermission('admin.firebase'))
                                <li><a class="{{ menuActivation('admin/firebase', 'active') }}"
                                       href="{{ route('admin.firebase') }}">{{ __('firebase') }}</a></li>
                            @endif
                            @if(hasPermission('chat.messenger'))
                                <li><a class="{{ menuActivation('admin/chat-messenger', 'active') }}"
                                       href="{{ route('chat.messenger') }}">{{ __('chat_messenger') }}</a></li>
                            @endif
                            @if(hasPermission('home.page.builder'))
                                <li><a class="{{ menuActivation('admin/home-page', 'active') }}"
                                       href="{{ route('home.page.builder') }}">{{ __('home_page_builder') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(hasPermission('offline-methods.index'))
                    <li class="{{ menuActivation(['admin/offline-methods', 'admin/offline-methods*'], 'active') }}">
                        <a href="#offlineMethod" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(['admin/offline-methods', 'admin/offline-methods*'], 'true', 'false') }}"
                           aria-controls="offlineMethod">
                            <i class="las la-money-bill"></i>
                            <span>{{ __('offline_payment') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/offline-methods', 'admin/offline-methods*'], 'show') }}"
                            id="offlineMethod">
                            @if(hasPermission('offline-methods.index'))
                                <li>
                                    <a class="{{ menuActivation(['admin/offline-methods', 'admin/offline-methods*'], 'active') }}"
                                       href="{{ route('offline-methods.index') }}">{{ __('payment_methods') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(hasPermission('email.template') || hasPermission('email.server-configuration'))
                    <li class="{{ menuActivation(['admin/email/server-configuration*', 'admin/email/template*'], 'active') }}">
                        <a href="#emailSetting" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(['admin/email/server-configuration*', 'admin/email/template*'], 'true', 'false') }}"
                           aria-controls="emailSetting">
                            <i class="las la-envelope"></i>
                            <span>{{ __('email_settings') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/email/server-configuration*', 'admin/email/template*'], 'show') }}"
                            id="emailSetting">

                            @if(hasPermission('email.template'))
                                <li><a class="{{ menuActivation('admin/email/template*', 'active') }}"
                                       href="{{ route('email.template') }}">{{ __('email_template') }}</a></li>
                            @endif

                            @if(hasPermission('email.server-configuration'))
                                <li><a class="{{ menuActivation('admin/email/server-configuration*', 'active') }}"
                                       href="{{ route('email.server-configuration') }}">{{ __('server_configuration') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(hasPermission('otp.setting') || hasPermission('sms.templates'))
                    <li class="{{ menuActivation(['admin/otp-setting', 'admin/sms-templates'], 'active') }}">
                        <a href="#otp_settings" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(['admin/otp-setting', 'admin/sms-templates'], 'true', 'false') }}"
                           aria-controls="otp_settings">
                            <i class="las la-sms"></i>
                            <span>{{ __('sms_otp') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/otp-setting', 'admin/sms-templates'], 'show') }}"
                            id="otp_settings">
                            @if(hasPermission('otp.setting'))
                                <li><a class="{{ menuActivation('admin/otp-setting', 'active') }}"
                                       href="{{ route('otp.setting') }}">{{ __('otp_setting') }}</a></li>
                            @endif
                            @if(hasPermission('sms.templates'))
                                <li><a class="{{ menuActivation('admin/sms-templates', 'active') }}"
                                       href="{{ route('sms.templates') }}">{{ __('sms_templates') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(hasPermission('general.setting') || hasPermission('preference') || hasPermission('currencies.index') || hasPermission('languages.index') || hasPermission('admin.cache') ||
                    hasPermission('admin.panel-setting') || hasPermission('storage.setting') || hasPermission('miscellaneous.setting') ||
                    hasPermission('ai_writer.setting') || hasPermission('countries.index') || hasPermission('states.index') || hasPermission('cities.index') || hasPermission('admin.refund'))

                    <li class="{{ menuActivation(['admin/currencies','admin/countries','admin/states','admin/cities', 'admin/ai-writer-setting', 'admin/languages','admin/language/*', 'admin/system-setting', 'admin/cache','admin/preference', 'admin/storage-setting', 'admin/panel-setting', 'admin/miscellaneous-setting', 'admin/refund-setting'], 'active') }}">
                        <a href="#settingTools" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(['admin/currencies','admin/countries','admin/states','admin/cities', 'admin/ai-writer-setting', 'admin/languages','admin/language/*', 'admin/system-setting', 'admin/cache', 'admin/preference', 'admin/storage-setting', 'admin/panel-setting', 'admin/miscellaneous-setting', 'admin/refund-setting'], 'true', 'false') }}"
                           aria-controls="settingTools">
                            <i class="las la-cog"></i>
                            <span>{{ __('system_setting') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/currencies','admin/countries','admin/states','admin/cities', 'admin/ai-writer-setting', 'admin/languages','admin/language/*', 'admin/system-setting', 'admin/cache', 'admin/preference', 'admin/storage-setting', 'admin/panel-setting', 'admin/miscellaneous-setting', 'admin/refund-setting'], 'show') }}"
                            id="settingTools">
                            @if(hasPermission('general.setting'))
                                <li><a class="{{ menuActivation('admin/system-setting', 'active') }}"
                                       href="{{ route('general.setting') }}">{{ __('general_setting') }}</a></li>
                            @endif

                            @if(hasPermission('preference'))
                                <li><a href="{{ route('preference') }}"
                                       class="{{ menuActivation('admin/preference', 'active') }}">{{ __('preference') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('currencies.index'))
                                <li><a class="{{ menuActivation('admin/currencies', 'active') }}"
                                       href="{{ route('currencies.index') }}">{{ __('currency') }}</a></li>
                            @endif


                            @if(hasPermission('languages.index'))
                                <li><a class="{{ menuActivation(['admin/languages','admin/language/*'], 'active') }}"
                                       href="{{ route('languages.index') }}">{{ __('language_settings') }}</a></li>
                            @endif

                            @if(hasPermission('admin.cache'))
                                <li><a class="{{ menuActivation('admin/cache', 'active') }}"
                                       href="{{ route('admin.cache') }}">{{ __('cache_setting') }}</a></li>
                            @endif

                            @if(hasPermission('admin.panel-setting'))
                                <li><a class="{{ menuActivation('admin/panel-setting', 'active') }}"
                                       href="{{ route('admin.panel-setting') }}">{{ __('admin_panel_setting') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('storage.setting'))
                                <li><a class="{{ menuActivation('admin/storage-setting', 'active') }}"
                                       href="{{ route('storage.setting') }}">{{ __('storage_setting') }}</a></li>
                            @endif

                            {{-- @if('admin.refund')
                                <li><a class="{{ menuActivation('admin/refund-setting', 'active') }}"
                                        href="{{ route('admin.refund') }}">{{ __('refund_setting') }}</a></li>
                            @endif --}}

                            @if(hasPermission('miscellaneous.setting'))
                                <li><a class="{{ menuActivation('admin/miscellaneous-setting', 'active') }}"
                                       href="{{ route('miscellaneous.setting') }}">{{ __('miscellaneous') }}</a></li>
                            @endif

                            @if(hasPermission('ai_writer.setting'))
                                <li><a class="{{ menuActivation('admin/ai-writer-setting', 'active') }}"
                                       href="{{ route('ai_writer.setting') }}">{{ __('open_ai_setting') }}</a></li>
                            @endif
                            @if(hasPermission('countries.index'))
                                <li><a class="{{ menuActivation('admin/countries', 'active') }}"
                                       href="{{ route('countries.index') }}">{{ __('country') }}</a></li>
                            @endif
                            @if(hasPermission('states.index'))
                                <li><a class="{{ menuActivation('admin/states', 'active') }}"
                                       href="{{ route('states.index') }}">{{ __('state') }}</a></li>
                            @endif
                            @if(hasPermission('cities.index'))
                                <li><a class="{{ menuActivation('admin/cities', 'active') }}"
                                       href="{{ route('cities.index') }}">{{ __('city') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(hasPermission('addon.index'))
                    <li class="{{ menuActivation('admin/addon', 'active') }}">
                        <a href="{{ route('addon.index') }}">
                            <i class="las la-puzzle-piece"></i>
                            <span>{{ __('addon') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('system.edit') || hasPermission('server.info'))
                    <li class="{{ menuActivation(['admin/server-info', 'admin/system-info', 'admin/extension-library', 'admin/file-system-permission', 'admin/system-update'], 'active') }}">
                        <a href="#utility" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(['admin/server-info', 'admin/system-info', 'admin/extension-library', 'admin/file-system-permission', 'admin/system-update'], 'true', 'false') }}"
                           aria-controls="utility">
                            <i class="las la-cogs"></i>
                            <span>{{ __('utility') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/server-info', 'admin/system-info', 'admin/extension-library', 'admin/file-system-permission', 'admin/system-update'], 'show') }}"
                            id="utility">

                            @if(hasPermission('system.edit'))
                                <li><a class="{{ menuActivation(['admin/system-update'], 'active') }}"
                                       href="{{ route('system.update') }}">{{ __('system_update') }}</a></li>
                            @endif

                            @if(hasPermission('server.info'))
                                <li>
                                    <a class="{{ menuActivation(['admin/server-info', 'admin/system-info', 'admin/extension-library', 'admin/file-system-permission'], 'active') }}"
                                       href="{{ route('server.info') }}">{{ __('server_information') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</header>
