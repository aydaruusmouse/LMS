<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ setting('system_title') != '' ? setting('system_title') : 'Faculty' }}</title>

    @php
        $icon = setting('admin_favicon');
    @endphp
    @if ($icon)
        <link rel="apple-touch-icon" sizes="57x57"
              href="{{ $icon != [] && @is_file_exists($icon['image_57x57_url']) ? static_asset($icon['image_57x57_url']) : static_asset('images/default/favicon/favicon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60"
              href="{{ $icon != [] && @is_file_exists($icon['image_60x60_url']) ? static_asset($icon['image_60x60_url']) : static_asset('images/default/favicon/favicon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72"
              href="{{ $icon != [] && @is_file_exists($icon['image_72x72_url']) ? static_asset($icon['image_72x72_url']) : static_asset('images/default/favicon/favicon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76"
              href="{{ $icon != [] && @is_file_exists($icon['image_76x76_url']) ? static_asset($icon['image_76x76_url']) : static_asset('images/default/favicon/favicon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114"
              href="{{ $icon != [] && @is_file_exists($icon['image_114x114_url']) ? static_asset($icon['image_114x114_url']) : static_asset('images/default/favicon/favicon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120"
              href="{{ $icon != [] && @is_file_exists($icon['image_120x120_url']) ? static_asset($icon['image_120x120_url']) : static_asset('images/default/favicon/favicon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144"
              href="{{ $icon != [] && @is_file_exists($icon['image_144x144_url']) ? static_asset($icon['image_144x144_url']) : static_asset('images/default/favicon/favicon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152"
              href="{{ $icon != [] && @is_file_exists($icon['image_152x152_url']) ? static_asset($icon['image_152x152_url']) : static_asset('images/default/favicon/favicon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180"
              href="{{ $icon != [] && @is_file_exists($icon['image_180x180_url']) ? static_asset($icon['image_180x180_url']) : static_asset('images/default/favicon/favicon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"
              href="{{ $icon != [] && @is_file_exists($icon['image_192x192_url']) ? static_asset($icon['image_192x192_url']) : static_asset('images/favicon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32"
              href="{{ $icon != [] && @is_file_exists($icon['image_32x32_url']) ? static_asset($icon['image_32x32_url']) : static_asset('images/default/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96"
              href="{{ $icon != [] && @is_file_exists($icon['image_96x96_url']) ? static_asset($icon['image_96x96_url']) : static_asset('images/default/favicon/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16"
              href="{{ $icon != [] && @is_file_exists($icon['image_16x16_url']) ? static_asset($icon['image_16x16_url']) : static_asset('images/default/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ static_asset('images/default/favicon/manifest.json') }}">

        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage"
              content="{{ $icon != [] && @is_file_exists($icon['image_144x144_url']) ? static_asset($icon['image_144x144_url']) : static_asset('images/default/favicon/favicon-144x144.png') }}">
    @else
        <link rel="shortcut icon" href="{{ static_asset('images/default/favicon/favicon-96x96.png') }}">
    @endif
    <!-- CSS Files -->
    <!--====== LineAwesome ======-->
    <link rel="stylesheet" href="{{ static_asset('admin/css/line-awesome.min.css') }}">
    <!--====== select2 CSS ======-->
    <link rel="stylesheet" href="{{ static_asset('admin/css/select2.min.css') }}">
    <!--====== Nestable CSS ======-->
    <link rel="stylesheet" href="{{ static_asset('admin/css/nestable.css') }}">
    <!--====== Summernote CSS ======-->
    <link rel="stylesheet" href="{{ static_asset('admin/css/summernote-lite.min.css') }}">
    <!--====== datatable ======-->
    <link href="{{ static_asset('admin/css/jquery.dataTables.min.css') }}" rel="stylesheet">

    <!--====== AppCSS ======-->
    @stack('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/app.css') }}?v={{ setting('current_version') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/style.css') }}?v={{ setting('current_version') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/responsive.min.css') }}">
    @stack('css')
</head>

<body>
<input type="hidden" class="base_url" value="{{ url('/') }}">

@yield('base.content')

<script src="{{ static_asset('admin/js/jquery.min.js') }}"></script>
<!--====== Bootstrap & Popper JS ======-->
<script src="{{ static_asset('admin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ static_asset('admin/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ static_asset('admin/js/dataTables.responsive.min.js') }}"></script>
<!--====== NiceScroll ======-->
<script src="{{ static_asset('admin/js/jquery.nicescroll.min.js') }}"></script>
<!--====== Summernote JS ======-->
<script src="{{ static_asset('admin/js/summernote-lite.min.js') }}"></script>
<!--====== select2 JS ======-->
<script src="{{ static_asset('admin/js/select2.min.js') }}"></script>
<!--====== Chart JS ======-->
<script src="{{ static_asset('admin/js/chart.min.js') }}"></script>
<!--====== datatable ======-->


<!--====== MainJS ======-->
<script src="{{ static_asset('admin/js/app.js') }}?v={{ setting('current_version') }}"></script>
<!--============= toastr=======-->
<script src="{{ static_asset('admin/js/toastr.min.js') }}"></script>
{!! Toastr::message() !!}
<script src="{{ static_asset('admin/js/sweetalert211.min.js') }}"></script>
@if (auth()->check() && auth()->user()->role_id > 1)
    <script src="{{ static_asset('admin/js/OneSignalSDK.js') }}" defer></script>
@endif
@stack('js_asset')
@stack('js')
@if (setting('is_pusher_notification_active') && auth()->check())
    <script src="{{ static_asset('admin/js/pusher.min.js') }}"></script>
    <script>
        const pusher = new Pusher('{{ setting('pusher_app_key') }}', {
            cluster: '{{ setting('pusher_app_cluster') }}',
            encrypted: true
        });

        const channel = pusher.subscribe('notification-send-{{ auth()->id() }}');
        channel.bind('App\\Events\\PusherNotification', (data) => {
            toastr[data.message_type](data.message);
        });
    </script>
@endif

@if (auth()->check() && auth()->user()->role_id > 1)
    <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function () {
            OneSignal.init({
                appId: "{{ setting('onesignal_app_id') }}",
                safari_web_id: "{{ setting('safari_web_id') }}",
                notifyButton: {
                    enable: true,
                },
                serviceWorker: {
                    path: "{{ static_asset('admin/js/OneSignalSDKWorker.js') }}",
                }
            });
            OneSignal.on('subscriptionChange', function (isSubscribed) {
                if (isSubscribed) {
                    OneSignal.getUserId().then(function (userId) {
                        $.ajax({
                            url: '/update-subscription',
                            method: 'POST',
                            data: {
                                player_id: userId,
                                subscribed: true
                            }
                        });
                    });

                }
            });
        });
    </script>
@endif

</body>

</html>
