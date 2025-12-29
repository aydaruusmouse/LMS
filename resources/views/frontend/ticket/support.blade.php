@extends('frontend.layouts.master')
@section('title', __('help_support'))
@section('content')
    <section class="support-section p-t-35 p-t-sm-30 p-b-md-50 p-b-80">
        <div class="container container-1278">
            <div class="row">
                <div class="col-12">
                    <div class="section-title-v3 color-dark m-b-80 m-b-sm-30">
                        <h4>{{ __('help_support') }}</h4>
                    </div>

                    <div class="common-heading text-center m-b-40">
                        <h3 class="m-b-5">{{ __('faqs') }}</h3>
                        <p>{{ __('everything_yuo_need') }}</p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="faq-tab">
                        <div class="accordion accordion-flush" id="faqAccordion">
                            @foreach($faqs as $key=> $faq)
                                <div class="accordion-item">
                                    <div class="accordion-header" id="course-faq-heading{{ $key }}">
                                        <div class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}" role="button" data-bs-toggle="collapse" data-bs-target="#course-faq-collapse{{ $key }}" aria-expanded="true" aria-controls="course-faq-collapseOne">
                                            {{ $faq->question }}
                                        </div>
                                    </div>
                                    <div id="course-faq-collapse{{ $key }}" class="accordion-collapse {{ $key == 0 ? 'collapse show' : 'collapse' }}" aria-labelledby="course-faq-heading{{ $key }}" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="common-heading text-center m-t-55">
                        <h3 class="m-b-5">{{ __('confusion') }}</h3>
                        <p>{{ __('open_ticket') }}</p>

                        <div class="support-btn-group m-t-35">
                            <a href="{{ route('support-tickets.index') }}" class="template-btn m-r-20">{{ __('view_tickets') }}</a>
                            <a href="{{ route('support-tickets.create') }}" class="template-btn bordered-btn-secondary">{{ __('create_ticket') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
