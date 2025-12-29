<script>
    function delete_row(route, row_id,is_reload) {
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
                    type: 'DELETE',
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
