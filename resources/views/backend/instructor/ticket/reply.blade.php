@extends('backend.layouts.master')
@section('title', __('reply_ticket'))
@section('content')
    <form action="{{ route('ticket.reply') }}" class="form" method="POST">@csrf
        <div class="container-fluid">
            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
            <input type="hidden" name="is_modal" class="is_modal" value="0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between flex-wrap">
                        <h3 class="section-title">#{{ $ticket->ticket_id }} - {{ $ticket->subject }}</h3>

                        <div class="select-type-v2 pad-rt mb-20">
                            <select id="ticket_update" class="form-select form-select-lg mb-3 without_search"
                                    data-route="{{ route('tickets.update',$ticket->id) }}">
                                <option value="">{{ __('select_status') }}</option>
                                <option
                                    value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>{{ __('pending') }}</option>
                                <option
                                    value="answered" {{ $ticket->status == 'answered' ? 'selected' : '' }}>{{ __('answered') }}</option>
                                <option
                                    value="hold" {{ $ticket->status == 'on_hold' ? 'selected' : '' }}>{{ __('on_hold') }}</option>
                                <option
                                    value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>{{ __('open') }}</option>
                                <option
                                    value="close" {{ $ticket->status == 'close' ? 'selected' : '' }}>{{ __('close') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="bg-white redious-border p-20 p-md-30">

                        <!-- <h6 class="sub-title">Product Information</h6> -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-30 d-flex gap-20 align-items-center justify-content-between">
                                    <button class="btn sg-btn-primary">
                                        @if($ticket->status == 'open')
                                            {{ __('open') }}
                                        @elseif($ticket->status == 'pending')
                                            {{ __('pending') }}
                                        @elseif($ticket->status == 'answered')
                                            {{ __('answered') }}
                                        @elseif($ticket->status == 'close')
                                            {{ __('close') }}
                                        @elseif($ticket->status == 'hold')
                                            {{ __('hold') }}
                                        @endif
                                    </button>

                                    <div class="d-flex flex-wrap gap-20">
                                        <span
                                            class="badge badge-light-gray text-capitalize">{{ __('priority') }} : {{ $ticket->priority }}</span>
                                        <span
                                            class="badge badge-light-gray">{{ __('department') }} : {{ $ticket->department->title }}</span>
                                        @if($replies && count($replies) > 0)
                                            <span
                                                class="badge badge-light-gray">{{ __('last_reply') }} : {{ \Carbon\Carbon::parse($replies->last()->created_at)->diffForHumans() }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!--                            <div class="col-lg-6">
                                <div class="select-type-v2 mb-4">
                                    <label for="type" class="form-label">{{ __('status') }}</label>
                                    <select id="type" name="type"
                                            class="form-select form-select-lg mb-3 without_search">
                                        <option value="">{{ __('select_status') }}</option>
                                        <option value="pending">{{ __('pending') }}</option>
                                        <option value="answered">{{ __('answered') }}</option>
                                        <option value="on_hold">{{ __('on_hold') }}</option>
                                        <option value="open">{{ __('open') }}</option>
                                        <option value="close">{{ __('close') }}</option>
                                    </select>
                                    <div class="nk-block-des text-danger">
                                        <p class="type_error error"></p>
                                    </div>
                                </div>
                            </div>-->
                            <!-- End Status -->

                            <div class="col-lg-12">
                                <div class="editor-wrapper mb-4">
                                    <textarea id="product-update-editor" name="reply"></textarea>
                                    <div class="nk-block-des text-danger">
                                        <p class="reply_error error"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Text Editor -->

                            <div class="col-lg-12">

                                <div class="custom-checkbox mb-12">
                                    <label>
                                        <input type="checkbox" value="1" name="return_to_list" checked>
                                        <span>{{ __('return_to_ticket_list') }}</span>
                                    </label>
                                </div>
                            </div>
                            <!-- End Ticket checkbox -->

                            @include('backend.common.media-input',[
                                        'title' => 'Slider Image',
                                        'name'  => 'file_media_id',
                                        'col'   => 'col-12 mt-4',
                                        'size'  => '',
                                        'image' => old('image'),
                                        'label' => __('file'),
                                        'for' => '',
                                        'selection' => 'multiple',
                                    ])
                            <!-- End Attachments -->
                            <hr style="margin: 24px 0;">

                            <div class="d-flex justify-content-between">
                                <h3 class="section-title">{{ __('ticket_details') }}</h3>
                            </div>
                            <div class="col-lg-12">
                                <div class="reply-card">
                                    <div class="row align-items-center">
                                        <div class="col-lg-9">
                                            <div class="ticket-content">
                                                {!! $ticket->body !!}
                                                @foreach($ticket->file as $file)
                                                    <span class="mt-2 d-block">
                                                                <a target="_blank" class="sg-text-primary"
                                                                   href="{{ $file['file_type'] == "image" ? get_media($file['original_image'], $file['storage']) : get_media($file['original_file'], $file['storage']) }}"
                                                                   download="{{ $file['file_type'] == "image" ? $name = str_replace('images/','',$file['original_image']) : $name = str_replace('files/','',$file['original_file']) }}">{{ $name }}</a>
                                                            </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin: 24px 0;">

                            <div class="d-flex justify-content-between">
                                <h3 class="section-title">{{ __('replies') }}</h3>
                            </div>
                            @if($replies && count($replies) > 0)
                                @foreach($replies as $key=> $reply)
                                    <div class="col-lg-12">
                                        <div
                                            class="reply-card p-30 viewed {{ $key != 0 ? 'mt-4' : '' }}">

                                            <div class="reply-action-icon">
                                                <a href="#"><i class="las la-print"></i></a>
                                                <a href="{{ route('ticket.reply.edit',$reply->id) }}"><i
                                                        class="lar la-edit"></i></a>
                                                <a href="javascript:void(0)"
                                                   onclick="delete_row('{{ route('ticket.reply.delete', $reply->id) }}',null,true)"><i
                                                        class="lar la-trash-alt"></i></a>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col-lg-3">
                                                    <div class="submitter-info text-center mb-20 mb-lg-0">
                                                        <h4>{{ $reply->user->name }}</h4>
                                                        <p>{{ $reply->user->role->name }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="ticket-content">
                                                        {!! $reply->reply !!}
                                                        @foreach($reply->file as $file)
                                                            <span class="mt-2 d-block">
                                                                <a target="_blank" class="sg-text-primary"
                                                                   href="{{ $file['file_type'] == "image" ? get_media($file['original_image'], $file['storage']) : get_media($file['original_file'], $file['storage']) }}"
                                                                   download="{{ $file['file_type'] == "image" ? $name = str_replace('images/','',$file['original_image']) : $name = str_replace('files/','',$file['original_file']) }}">{{ $name }}</a>
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- END Add Reply Tab====== -->
                    </div>
                </div>
            </div>
        </div>

        <div class="homepageFixBTN bg-white py-2 px-4">
            <button type="submit" class="btn sg-btn-primary">{{ __('submit_response') }}</button>
            @include('backend.common.loading-btn', ['class' => 'btn sg-btn-primary'])
        </div>
    </form>
    @include('backend.common.gallery-modal')
    @include('backend.common.delete-script')
@endsection

@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
    <script>
        $(document).ready(function (){
           $(document).on('change','#ticket_update',function (e){
               let value = $(this).val();

               let url = $(this).data('route');


               window.location.href = url+'?status='+value;
           });
        });
    </script>
@endpush
