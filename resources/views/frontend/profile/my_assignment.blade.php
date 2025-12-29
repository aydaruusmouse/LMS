@extends('frontend.layouts.master')
@section('title', __('assignment'))
@section('content')
    <!--====== Start Assignment Section ======-->
    <section class="assignment-section p-t-50 p-b-80 p-b-md-50 p-t-sm-30">
        <div class="container container-1278">
            <div class="row">
                @include('frontend.profile.sidebar')
                <div class="col-md-8">
                    <div class="my-assignment-wrapper">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title-v3 color-dark m-b-40 m-b-sm-15">
                                    <h3>{{__('my_assignment')}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row icon-boxes-v5 gx-3 gx-md-4 m-b-40 m-b-sm-15">
                            <div class="col-lg-4 col-md-6 col-sm-4">
                                <div class="icon-box m-b-30" data-aos="fade-up" data-aos-delay="200">
                                    <div class="icon-box-icon">
                                        <svg width="46" height="43" viewBox="0 0 46 43" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M29.7081 32.0988C33.6717 32.0988 36.8849 28.8856 36.8849 24.9219C36.8849 20.9583 33.6717 17.7451 29.7081 17.7451C25.7444 17.7451 22.5312 20.9583 22.5312 24.9219C22.5312 28.8856 25.7444 32.0988 29.7081 32.0988Z"
                                                stroke="var(--color-secondary-4)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M24.9297 30.9023V41.6676L29.7142 38.0792L34.4988 41.6676V30.9023"
                                                  stroke="var(--color-secondary-4)" stroke-width="2"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                            <path
                                                d="M17.7459 34.4918H5.78455C4.51561 34.4918 3.29864 33.9877 2.40136 33.0905C1.50408 32.1932 1 30.9762 1 29.7073V5.78455C1 3.15305 3.15305 1 5.78455 1H39.2764C40.5453 1 41.7623 1.50408 42.6595 2.40136C43.5568 3.29864 44.0609 4.51561 44.0609 5.78455V29.7073C44.06 30.5463 43.8386 31.3704 43.4187 32.0968C42.9988 32.8232 42.3953 33.4264 41.6686 33.8459"
                                                stroke="var(--color-secondary-4)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8.17969 10.5674H36.887" stroke="var(--color-secondary-4)"
                                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8.17969 17.7451H15.3565" stroke="var(--color-secondary-4)"
                                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8.17969 24.9219H12.9642" stroke="var(--color-secondary-4)"
                                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="icon-box-content">
                                        <h5>{{ $due_assignments }}</h5>
                                        <p>{{__('due_assignment')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4">
                                <div class="icon-box m-b-30" data-aos="fade-up" data-aos-delay="400">
                                    <div class="icon-box-icon">
                                        <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M22 42C33.0457 42 42 33.0457 42 22C42 10.9543 33.0457 2 22 2C10.9543 2 2 10.9543 2 22C2 33.0457 10.9543 42 22 42Z"
                                                stroke="var(--color-secondary-4)" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15.3359 22.0011L19.7804 26.4455L28.6693 17.5566"
                                                  stroke="var(--color-secondary-4)" stroke-width="2.5"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="icon-box-content">
                                        <h5>{{ $complete_assignment }}</h5>
                                        <p>{{__('complete_assignment')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4">
                                <div class="icon-box m-b-30" data-aos="fade-up" data-aos-delay="600">
                                    <div class="icon-box-icon">
                                        <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M22 42C33.0457 42 42 33.0457 42 22C42 10.9543 33.0457 2 22 2C10.9543 2 2 10.9543 2 22C2 33.0457 10.9543 42 22 42Z"
                                                stroke="var(--color-secondary-4)" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M17.5547 17.5566L26.4436 26.4455M26.4436 17.5566L17.5547 26.4455"
                                                  stroke="var(--color-secondary-4)" stroke-width="2.5"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="icon-box-content">
                                        <h5>{{$failed_assignment}}</h5>
                                        <p>{{__('failed_assignment')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="border-bottom-soft-white p-b-10 fw-semibold m-b-10">{{__('assignment')}}</h6>

                        <div class="assignment-table table-responsive">
                            <table class="table align-middle" style="min-width: 800px;">
                                @if(count($assignments)>0)
                                <thead>
                                <tr>
                                    <th>{{__('title')}}</th>
                                    <th>{{__('start_date')}}</th>
                                    <th>{{__('deadline')}}</th>
                                    <th>{{__('grade')}}</th>
                                    <th>{{__('status')}}</th>
                                    <th>{{__('action')}}</th>
                                </tr>
                                </thead>
                                <tbody class="border-top-0 assignment_section_wrap">
                                        @foreach($assignments as $assignment)
                                            @include('frontend.profile.my_assignment_load_more')
                                        @endforeach
                                    @else
                                        @include('frontend.not_found',$data=['title'=> 'assignment'])
                                    </tbody>
                                @endif
                            </table>

                        </div>
                        @if($assignments->nextPageUrl())
                            <div class="assignment-pagination m-t-50 m-t-sm-30 text-align-center text-align-md-start">
                                <a data-page="{{ $assignments->currentPage() }}" href="javascript:void(0)"
                                   class="template-btn load_more">{{__('more_assignments') }}</a>
                                @include('components.frontend_loading_btn', ['class' => 'template-btn see-more'])
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Assignment Section ======-->
@endsection
@push('js')
    <script>
        $(document).on('click', '.load_more', function () {
            assignment('load_more');
        });

        function assignment(load_more) {
            var that = $('.load_more');
            if (load_more == 'load_more') {
                page = parseInt(that.data('page')) + 1;
            }
            var btn_selector = $('.assignment-pagination');
            btn_selector.find('.loading_button').removeClass('d-none');
            that.addClass('d-none');


            $.ajax({
                url: "{{ route('my-assignment') }}",
                type: "GET",
                data: {
                    page: page,
                },
                success: function (data) {
                    let selector = $('.assignment_section_wrap');
                    selector.append(data.assignments);

                    $('.header').html(data.header);
                    that.data('page', page);
                    initAOS();
                    activeNiceSelect();
                    if (data.next_page) {
                        btn_selector.find('.loading_button').addClass('d-none');
                        that.removeClass('d-none');
                    } else {
                        btn_selector.find('.loading_button').addClass('d-none');
                        that.addClass('d-none');
                    }
                }
            });
        }
    </script>
@endpush
