let page = 1;
let get_data_for = 'image';
let selection = 'single';
let selector = '';
let selected_images = []

Dropzone.autoDiscover = false;
$('.media-uploader').dropzone({
    url: $('.media_store_route').val(),
    uploadMultiple: false,
    maxFilesize: 20,
    dictDefaultMessage: '',
    clickable: ".media-message",
    // clickable: false,
    headers: {
        'X-CSRF-TOKEN': token
    },
    acceptedFiles: ".jpg,.jpeg,.png,.gif,.mp4,.mpg,.mpeg,.webp,.webm,.ogg,.avi,.mov,.flv,.swf,.mkv,.wmv,wma,.aac,.wav,.mp3,.zip,.rar,.7z,.doc,.txt,.docx,.pdf,.csv,.xml,.ods,.xlr,.xls,.xlsx",
    timeout: 180000,
    maxFiles: 20,
    init: function () {
        this.on("error", function (file, responseText) {
            toastr['error'](responseText)
        });
        this.on("success", function () {
            page = 1;
            $('#media_files').empty();
            load_modal_content();
        });

        this.on("complete", function (file) {
            if ($('.dropzone_file_container')) {
                let urlString = file.xhr.responseText;
                let path = urlString.replace(/\\/g, "")
                $('.dropzone_file_container').append(`<input type="hidden" name="file" value=${path}>`)
            }
        })
    },
    queuecomplete: function(){
        toastr['success']("file_upload_done")

    }
});
$(document).ready(function () {
    $(document).on('click', '.gallery-modal', function (e) {
        $('#addMedia').modal('show');
        get_data_for = $(this).attr('data-for');
        selection = $(this).attr('data-selection');
        selector = $(this).closest('.custom-image');
        console.log(selector);
        $('#media_files').empty();
        load_modal_content();
    });
    $(document).on('click', '#mediaFiles', function (e) {
        $('#media_files').empty();
        load_modal_content();
    });

    $(document).on('click', '#uploadMedia', function () {
        // Dropzone.forElement("form#media-upload").removeAllFiles(true);
        console.log("upload_done");
    });
    $(document).on('change', '.media_selector', function () {
        var id = $(this).val();
        var type = $(this).attr('data-type');
        var url = $(this).attr('data-url');
        var name = $(this).attr('data-name');
        var size = $(this).attr('data-size');
        var ext = $(this).attr('data-ext');
        var selected = $(this).is(':checked');
        if (selected) {
            if (selection == 'single') {
                let checkboxes = $('.media_selector');
                $.each(checkboxes, function (index, value) {
                    if (id != $(this).val()) {
                        $(this).prop('checked', false);
                    }
                });

                selected_images = [];
            }
            selected_images.push({
                id: id,
                type: type,
                url: url,
                name: name,
                size: size,
                ext: ext,
            });

        } else {
            let find = selected_images.findIndex(x => x.id == id);
            selected_images.splice(find, 1);
        }
        $('.file_counter').text(selected_images.length);
    });

    $(document).on('click', '.add-selected', function () {
        $('.new_uploaded_images').remove();
        selector.find('.selected-files .selected-files-item').addClass('d-none');
        for (let i = 0; i < selected_images.length; i++) {
            getImages(selected_images[i]);
        }
        selector.find('.file_selected').text(selected_images.length + ' ');
        selector.find('input[type="hidden"]').val(selected_images.map(a => a.id).join(','));
        selected_images = [];
    });

    $(document).on('click', '.remove-icon', function () {
        let id = $(this).data('id');

        selector = $(this).closest('.custom-image');
        get_data_for = $(this).attr('data-for');
        selection = $(this).attr('data-selection');

        let input_field = selector.find('input[type="hidden"]');
        let values = input_field.val().split(',');

        if (selection == 'multiple') {
            let ids = [];
            for (let i = 0; i < values.length; i++) {
                if (values[i] != id) {
                    ids.push(values[i]);
                }
            }
            selector.find('.file_selected').text(ids.length + ' ');
            selector.find('input[type="hidden"]').val(ids.join(','));

            if (ids.length == 0) {
                selector.find('.selected-files-item').removeClass('d-none');
            }
        }
        else {
            selector.find('.selected-files-item').removeClass('d-none');
            selector.find('.file_selected').text(0 + ' ');
            input_field.val('');
        }

        $(this).closest('.selected-files-item').remove();
    });

    $(document).on('click', '.load-button', function (e) {
        page++;
        load_modal_content();
    });

    $(document).on('keyup', '#search', function (e) {
        page = 1;
        load_modal_content(1);
    });

});



function load_modal_content(is_html) {

    $('.load-button').addClass('d-none');
    $('.loading-button').removeClass('d-none');

    let q = $('#search').val();

    var formData = {
        type: get_data_for,
        selection: selection,
        q: q,
        gallery_modal: 1,
        paginate: 25,
        page: page
    }

    $.ajax({
        type: "GET",
        dataType: 'json',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': token
        },
        url: $('.media_index_route').val(),
        success: function (data) {
            let element = $('#media_files');
            if (is_html) {
                element.html(data.list);
            } else {
                element.append(data.list);
            }

            $('.loading-button').addClass('d-none');
            if (data.next_page_url) {
                $('.load-button').removeClass('d-none');
            } else {
                $('.load-button').addClass('d-none');
            }

            let ids = selector.find('input[type="hidden"]').val().split(',');

            let checkboxes = $('.media_selector');
            $.each(checkboxes, function (index, value) {
                let find = ids.indexOf($(this).val());
                if (find > -1) {
                    $(this).prop('checked', true);
                }
            });

            let selected_checkboxes = $('.media_selector:checked');
            $.each(selected_checkboxes, function (index, value) {
                var id = $(this).val();
                var type = $(this).attr('data-type');
                var url = $(this).attr('data-url');
                var name = $(this).attr('data-name');
                var size = $(this).attr('data-size');
                var ext = $(this).attr('data-ext');
                selected_images.push({
                    id: id,
                    type: type,
                    url: url,
                    name: name,
                    size: size,
                    ext: ext,
                });
            });


        },
        error: function (data) {
        }
    });
}

function getImages(image) {
    let html = "<div class='selected-files-item new_uploaded_images'> " +
        "<img src='" + image.url + "' data-default='" + image + "' alt='" + image.name + "' class='selected-img'>" +
        "<div class='remove-icon' data-id='" + image.id + "'> " +
        "<i class='las la-times'></i>" +
        "</div></div>";
    $('#addMedia').modal('hide');
    selector.find('.selected-files').append(html);
}
