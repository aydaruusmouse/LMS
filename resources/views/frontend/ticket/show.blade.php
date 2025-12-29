@extends('frontend.layouts.master')
@section('title', __('ticket_details'))
@section('content')
    <section class="support-section p-t-35 p-t-sm-30 p-b-md-50 p-b-80">
        <div class="container container-1278">
            <div class="row">
                <div class="col-12">
                    <div class="section-title-v3 color-dark m-b-20">
                        <h4>{{ __('ticket_details') }}</h4>
                    </div>
                </div>


                <div class="col-xl-8 col-md-12">
                    @if(count($replies) > 0)
                        <div class="ticket-replies rounded-3 border-soft-white p-t-20 p-b-20 p-r-30 p-l-30">
                            <h2 class="m-b-20 ticket-title">{{ __('ticket_replies') }}</h2>
                            @foreach($replies as $key=> $reply)
                                <div
                                    class="user-replay rounded-3 {{ auth()->id() == $reply->user_id ? 'bg-soft-white' : 'bg-soft-green' }} p-t-20 p-b-20 p-r-20 p-l-20 m-b-20">
                                    <h3 class="user-name ticket-title">{{ $reply->user->name }} {{ auth()->id() != $reply->user_id ? '('.__('admin').')' : '' }}</h3>
                                    <p class="user-desc">{!! $reply->reply !!}</p>
                                </div>
                                @if($reply->file && count($reply->file) > 0)
                                    <div class="user-replay m-b-20">
                                        <div class="d-flex align-items-center gap-4">
                                            @foreach($reply->file as $file)
                                                @php
                                                    $image = $file['file_type'] == "image" ? get_media($file['original_image'], $file['storage']) : get_media($file['original_file'], $file['storage']);
                                                    $name = $file['file_type'] == "image" ? str_replace('images/','',$file['original_image']) : str_replace('files/','',$file['original_file']);
                                                @endphp
                                                <a target="_blank" class="sg-text-primary"
                                                   href="{{ $image }}"
                                                   download="{{ $name }}"><img src="{{ $image }}" alt="reply_image"></a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <div
                        class="ticket-replies rounded-3 border-soft-white p-t-20 p-b-20 p-r-30 p-l-30 {{ count($replies) > 0 ? 'm-t-30' : '' }} m-b-0 m-b-lg-30">
                        <h2 class="m-b-20 ticket-title">{{ __('write_replies') }}</h2>
                        <form method="post" action="{{ route('support-tickets.reply') }}"
                              class="user-form p-0 row ajax_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            <div class="col-12">
                                <textarea class="form-control" name="reply" id="message"
                                          placeholder="{{ __('your_message') }}"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <h2 class="m-b-20 ticket-title">{{ __('upload_file') }}</h2>
                                <input type="file" name="student_file" id="chooseFile">
                                <p class="fz-16">{{ __('valid_file_types') }}</p>
                            </div>
                            <div class="col-sm-3 m-t-20">
                                <button class="template-btn" type="submit">{{ __('submit') }}</button>
                                @include('components.frontend_loading_btn', ['class' => 'template-btn'])
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12">
                    <div class="ticket-status rounded-3 border-soft-white p-t-20 p-b-20 p-r-30 p-l-30">
                        <div class="d-flex align-items-center justify-content-between m-b-20">
                            <h2 class="ticket-title">{{ __('ticket_status') }} :</h2>
                            <button class="template-btn" type="submit">
                                @if($ticket->status == 'open')
                                    <span class="">{{ __('open') }}</span>
                                @elseif($ticket->status == 'pending')
                                    <span class="">{{ __('pending') }}</span>
                                @elseif($ticket->status == 'answered')
                                    <span class="">{{ __('answered') }}</span>
                                @elseif($ticket->status == 'close')
                                    <span class="">{{ __('close') }}</span>
                                @elseif($ticket->status == 'hold')
                                    <span class="">{{ __('hold') }}</span>
                                @endif
                            </button>
                        </div>

                        <div class="m-b-20">
                            <h2 class="ticket-title m-b-5">{{ __('ticket_id') }} :</h2>
                            <p>#{{ $ticket->ticket_id }}</p>
                        </div>

                        <div class="m-b-20">
                            <h2 class="ticket-title m-b-5">{{ __('subject') }} :</h2>
                            <p>{{ $ticket->subject }}</p>
                        </div>

                        <div class="m-b-20 ">
                            <h2 class="ticket-title m-b-5">{{ __('priority') }} :</h2>
                            <p class="text-capitalize">{{ $ticket->priority }}</p>
                        </div>

                        <div class="m-b-20 border-bottom-soft-white p-b-20">
                            <h2 class="ticket-title m-b-5">{{ __('ticket_attached_file') }} :</h2>
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

                        <ul>
                            <li>{{ __('opened') }}
                                : {{ \Illuminate\Support\Carbon::parse($ticket->created_at)->format('Y/m/d H:i:s a') }}</li>
                            @if(count($replies) > 0)
                                <li>{{ __('last_response') }} : {{ \Illuminate\Support\Carbon::parse($replies->first()->created_at)->format('Y/m/d H:i:s a') }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
