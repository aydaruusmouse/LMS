@push('js')
<script>
    $(document).ready(function () {
    $(document).on("change",".change-role", function (e) {
        e.preventDefault();
        var url = "{{ route('staffs.change-role') }}";
        var role_id = $(this).val();

        var formData = {
            role_id: role_id,
        };
        $.ajax({
            type: "GET",
            dataType: "html",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: url,
            success: function (data) {
                $("#permissions-table").html(data);
            },
            error: function (data) {},
        });
    });
});
</script>
@endpush
