@extends('backend.layouts.master')
@section('title', __('payout_story'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">{{__('payout_request_list') }}</h3>
                    </div>
                    <div class="bg-white redious-border p-20 p-sm-30 pt-sm-30">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="default-list-table table-responsive yajra-dataTable">
                                    {{ $dataTable->table() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.delete-script')
@endsection
@push('js')
    {{ $dataTable->scripts() }}
    <script>
        function statusUpdate(route, row_id,is_reload) {
            var url =  route;
            var token = "{{ @csrf_token() }}";
            Swal.fire({
                title: '<?php echo e(__('are_you_sure')); ?>',
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
                                if(is_reload)
                                {
                                    location.reload();
                                }else if(response.is_reload){
                                    location.reload();
                                }
                                else{
                                    $('.dataTable').DataTable().ajax.reload();
                                }
                            });

                        },
                        error: function (response) {
                            console.log(response)
                        }

                    });
                }
            });
        }
    </script>
@endpush
