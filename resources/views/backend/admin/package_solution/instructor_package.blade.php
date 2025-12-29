@extends('backend.layouts.master')
@section('title', __('packages'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex align-items-center justify-content-between mb-12">
                        <h3 class="section-title">{{__('all')}} {{__('packages')}}</h3>

                    </div>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row gx-20">
                            @foreach($packages as $package)
                                <div class="col-lg-4">
                                    <div class="package-default">
                                        <div class="package-header pt-40 px-30 text-center position-relative">
                                            @if($package->id == $most_popular_id)
                                            <span class="package-badge">{{__('most_popular')}}</span>
                                            @endif
                                            <h2 class="package-title mt-30">{{__($package->name)}} </h2>

                                            <hr style="margin: 12px 0;">

                                            <p>{{__($package->description)}}</p>


                                        </div>

                                        <div class="package-content text-center">
                                            <h2 class="package-pirce text-center">{{ get_price($package->price, userCurrency())}}</h2>

                                            <ul>
                                                <li class="d-flex align-items-center justify-content-center gap-1 py-3 px-30">
                                                    <p>{{__('course_upload_limit')}}</p>
                                                    <span>{{__($package->upload_limit)}}</span>
                                                </li>
                                                <li class="d-flex align-items-center justify-content-center gap-1 py-3 px-30">
                                                    <p>{{__('course_bundle')}}</p>
                                                    <span>{{__($package->bundle)}}</span>
                                                </li>
                                                <li class="d-flex align-items-center justify-content-center gap-1 py-3 px-30">
                                                    <p>{{__('expertise_add_limit')}}</p>
                                                    <span>{{__($package->add_limit)}}</span>
                                                </li>
                                                <li class="d-flex align-items-center justify-content-center gap-1 py-3 px-30">
                                                    <p>{{__('live_class_facilities')}}</p>
                                                    <span>{{ ($package->facilities == 1) ? __('yes'): __('no') }}</span>
                                                </li>
                                                <li class="d-flex align-items-center justify-content-center gap-1 py-3 px-30">
                                                    <p>{{__('package_validity')}}</p>
                                                    <span>{{ $package->validity }} {{__('months')}}</span>
                                                </li>
                                            </ul>
                                            <div class="mb-40 mt-12">
                                                @if(packageSubscription(auth()->user()->id, $package->id)->count() > 0)
                                                <a href="javascript:void(0)" class="btn btn-md sg-btn-primary">{{__('subscribed')}}</a>
                                                @else
                                                    <a href="javascript:void(0)" class="btn btn-md sg-btn-primary"
                                                       onclick="subscribe_now('{{ route('packages.subscribe', $package->id) }}')"
                                                       data-toggle="tooltip"
                                                       data-original-title="{{ __('subscription') }}">{{__('subscribe_now')}}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- End Oftions Section -->
    <!-- Modal For Add Package======================== -->
    <div class="modal fade" id="addPackage" tabindex="-1" aria-labelledby="addPackageLabel" aria-hidden="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <h6 class="sub-title">{{__('add_new_package')}}</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @include('backend.admin.package_solution.create')
            </div>
        </div>
    </div>
    <!-- END Modal For Add Package======================== -->
@endsection
@push('js')
    <script>
        function subscribe_now(route, row_id,is_reload) {
            var url =  route;
            var token = "{{ @csrf_token() }}";
            Swal.fire({
                title: '<?php echo e(__('are_you_sure_subscribe_this_package')); ?>',
                //text: "<?php echo e(__('you_will_not_be_able_to_revert_this')); ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<?php echo e(__('yes_do_it')); ?>',
                cancelButtonText: '<?php echo e(__('cancel')); ?>',
                confirmButtonColor: '#ff0000'
            }).then((confirmed) => {
                if (confirmed.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id:row_id,
                            _token: token
                        },
                        url: url,
                        success: function (response) {
                            Swal.fire(
                                response.title,
                                response.message,
                                response.status,
                                response.is_reload,
                            ).then((confirmed) => {
                                location.reload();
                            });
                        },
                        error: function (response) {
                            Swal.fire(
                                response.title,
                                response.message,
                                response.status
                            ).then((confirmed) => {
                            });
                        }

                    });
                }
            });
        }
    </script>

@endpush


