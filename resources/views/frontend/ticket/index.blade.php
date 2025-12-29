@extends('frontend.layouts.master')
@section('title', __('help_support'))
@section('content')
    <section class="support-section p-t-35 p-t-sm-30 p-b-md-50 p-b-80">
        <div class="container container-1278">
            <div class="row">
                <div class="col-12">
                    <div class="section-title-v3 color-dark m-b-20">
                        <h4>{{ __('ticket_list') }}</h4>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="ticket-table table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('ticket_id') }}</th>
                                <th>{{ __('subject') }}</th>
                                <th>{{ __('last_response') }}</th>
                                <th>{{ __('priority') }}</th>
                                <th>{{ __('status') }}</th>
                                <th>{{ __('action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($tickets) > 0)
                                @foreach($tickets as $key=> $ticket)
                                    @include('frontend.ticket.component.ticket')
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center text-danger">{{ __('no_ticket_found') }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    @if($tickets->nextPageUrl())
                        <div class="m-t-20 text-center">
                            <a href="javascript:void(0)" data-page="{{ $tickets->currentPage() }}"
                               data-url="{{ route('support-tickets.index') }}"
                               class="template-btn load_more">{{__('more_history')}}</a>
                            @include('components.frontend_loading_btn', ['class' => 'template-btn see-more'])
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.load_more', function () {
                let that = this;
                let page = parseInt($(this).data('page')) + 1;
                let url = $(this).data('url');
                let selector = $(this).closest('div');
                $(that).addClass('d-none');
                $(selector).find('.loading_button').removeClass('d-none');
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        page: page,
                    },
                    success: function (data) {
                        $('.ticket-table tbody').append(data.html);
                        $(that).data('page', page);
                        if (data.next_page) {
                            $(selector).find('.loading_button').addClass('d-none');
                            $(that).removeClass('d-none');
                        } else {
                            $(selector).find('.loading_button').addClass('d-none');
                            $(that).addClass('d-none');
                        }
                    }
                });
            });
        });
    </script>
@endpush
