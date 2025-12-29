@extends('frontend.layouts.master')
@section('title', __('meeting'))
@section('content')
    <!--====== Start Meeting Section ======-->
    <section class="meeting-section p-t-50 p-b-80 p-b-md-50 p-t-sm-30">
        <div class="container container-1278">
            <div class="row">
                @include('frontend.profile.sidebar')
                <div class="col-md-8">
                    <div class="meeting-content">
                        <h6 class="border-bottom-soft-white p-b-10 fw-semibold m-b-10">{{__('meeting') }}</h6>
                        <div class="assignment-table table-responsive">
                            <table class="table align-middle" style="min-width: 800px;">
                                <thead>
                                <tr>
                                    <th>{{__('title') }}</th>
                                    <th>{{__('meeting_method') }}</th>
                                    <th>{{__('start_date') }}</th>
                                    <th>{{__('end_date') }}</th>
                                    <th>{{__('status') }}</th>
                                    <th>{{__('action') }}</th>
                                </tr>
                                </thead>
                                <tbody class="border-top-0">
                                @foreach($my_meeting as $meeting)
                                    <tr>
                                        <td>
                                            <div class="assignment-item">
                                                <h6>{{ $meeting->title }}</h6>
                                            </div>
                                        </td>
                                        <td>{{ $meeting->meeting_method}}</td>
                                        <td>{{ date('d M Y', strtotime($meeting->start_at)) }}</td>
                                        <td>{{ date('d M Y', strtotime($meeting->end_at)) }}</td>

                                        <td>
                                            @if($meeting->status ==2)
                                                <span class="color-supernova">{{__('cancel') }}</span>
                                            @elseif($meeting->status ==1)
                                                <span class="color-supernova">{{__('complete') }}</span>
                                            @else
                                                <span class="color-supernova">{{__('pending') }}</span>
                                            @endif
                                        </td>
                                        <td>

                                            @if($meeting->end_at < date('Y-m-d h:i:s'))
                                                <a href="javascript:void(0)"
                                                   class="color-secondary">{{__('finished') }}</a>
                                            @else
                                                <a href="{{ $meeting->meeting_link }}"
                                                   class="template-btn">{{__('join') }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Meeting Section ======-->
@endsection
