@push('js')
<script>
    $(document).ready(function(){
    });
    (function ($) {
    "use strict";

    //ajax modal
    $(document).ready(function () {
        $(document).on('click', '.modal-menu', function (e) {
            e.preventDefault();
            let selector = $('#dynamic-content');
            var title = $(this).data('title');
            if (title != "" && title != null) {
                $("#common-modal-title").text(title);
            }
            var url = $(this).data('url'); // it will get action url
            selector.html(''); // leave it blank before ajax call
            $.ajax({
                url:  url,
                type: 'get',
                dataType: 'html'
            }).done(function (data) {
                selector.html('').html(data);
                $('#modal-loader').hide(); // hide ajax loader
                $('.select2').select2({
                    dropdownParent: $('#addCurrency')
                });
                $('.selectric').selectric();
            })
                .fail(function () {
                    $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                });
        });
    });

})(window.jQuery);
</script>
@endpush
