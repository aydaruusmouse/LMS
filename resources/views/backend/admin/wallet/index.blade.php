@extends('backend.layouts.master')
@section('title', __('wallet_request'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col col-lg-12 col-md-12">
                    <h3 class="section-title">{{__('wallet_request') }}</h3>
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
@endsection
@push('js')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function () {
            $(document).on('click', '.dropdown-item', function () {
                var url = $(this).data('route');
                var id = $(this).data('id');
                var value = $(this).data('value');
                var token = "{{ @csrf_token() }}";
                Swal.fire({
                    title: '<?php echo e(__('are_you_sure')); ?>',
                    text: "{{ __('you_will_not_be_able_to_revert_this') }}",
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
                            url: url,
                            data: {
                                id: id,
                                status: value,
                                _token: token
                            },
                            success: function (response) {
                                Swal.fire(
                                    response.title,
                                    response.message,
                                    response.status,
                                    response.is_reload,
                                ).then((confirmed) => {
                                    $('.dataTable').DataTable().ajax.reload();
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
            })
        })
    </script>
@endpush
