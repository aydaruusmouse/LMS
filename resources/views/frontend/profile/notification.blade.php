@extends('frontend.layouts.master')
@section('title', __('home'))
@push('css')
    <style>
        .paginate {
            float: right;
        }
    </style>
@endpush
@section('content')
    <!--====== Start Notification Section ======-->
    <section class="notification-section p-t-50 p-b-60 p-b-md-30 p-t-sm-30">
        <div class="container container-1278">
            <div class="row">
                @include('frontend.profile.sidebar')
                <div class="col-md-8">
                    <div class="notification-wrapper">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title-v3 color-dark m-b-40 m-b-sm-20">
                                    <h3>{{__('all_notification') }}</h3>
                                    <div class="sort-right">
                                        <a href="javascript:void(0)" class="nt-delete"
                                           data-url="notification.delete">{{__('delete') }}</a>
                                        <div class="notification-dropdown" data-route="notification.update">
                                            <select class="notification-action">
                                                <option value="">{{__('select') }}</option>
                                                <option value="1">{{__('select_read') }}</option>
                                                <option value="0">{{__('select_unread') }}</option>
                                                <option value="2">{{__('unselect_all') }}</option>
                                            </select>
                                        </div>
                                        <p>{{__('showing') }}  {{ $notifications->count() }}  {{__('of') }} {{ $total_notifications }} {{__('results') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="notification-wrap">
                            @foreach($notifications as $notification)
                                <div
                                    class="nt-card {{ ($notification->is_read == 0) ? 'nt-unread': '' }} row g-0 m-b-20 m-b-sm-15">
                                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-4">
                                        <div class="nt-card-left">
                                            <div class="nt-card-check">
                                                <label>
                                                    <input type="checkbox" value="{{ $notification->id }}"
                                                           name="notification_id" class="notification_id">
                                                    <span>{{__($notification->title) }}</span>
                                                </label>
                                            </div>
                                            <time
                                                datetime="2022-09-14 12:26">{{ date('d M', strtotime($notification->created_at)) }}
                                                | {{ date('h:i', strtotime($notification->created_at)) }}</time>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-8">
                                        <div class="nt-card-text">
                                            <p>{{ ($notification->description)  }}</p>
                                            <a href="#" class="details">{{__('details') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="paginate">
                                {{ $notifications->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Notification Section ======-->
@endsection
@push('js')
    <script>
        //=========== delete script ===========
        $(document).on('click', '.nt-delete', function () {
            var selected_id = [];
            $("input[name='notification_id']:checked").each(function () {
                selected_id.push($(this).val());
            })
            var token = "{{ @csrf_token() }}";
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                type: 'POST',
                url: "{{ route('notification.delete') }}",
                data: {selected_id},
                success: function (response) {
                    if (response.status == 200) {
                        toastr["success"](response.message);
                        window.location.reload();
                    } else {
                        toastr["error"](response.message);
                    }

                },
                error: function (response) {
                    toastr["error"](response.message);
                }
            })
        })
    </script>

@endpush
