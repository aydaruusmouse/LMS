$(function () {
    'use strict';

    $(document).ready(function () {
        let btns = $('.btn-press');
        $.each(btns, function (index, btn) {

           if (index > 0)
           {
               $(this).addClass('d-none');
           }
        });
        $(document).on('click', '.ai_writer', function (e) {
            let selector = $(this);
            selector.find('.a_writer_text').addClass('d-none');
            selector.find('.a_writer_loader').removeClass('d-none');
            let name = selector.data('name');
            let length = selector.data('length');
            let topic = selector.data('topic');
            let keyword = $('.' + topic).val();
            let use_case = selector.data('use_case');
            if (!keyword)
            {
                toastr.error('Please Enter title/name first');
                selector.find('.a_writer_text').removeClass('d-none');
                selector.find('.a_writer_loader').addClass('d-none');
                return false;
            }

            let url = selector.data('url');
            let extra_description = selector.data('extra_query');
            let data = {
                prompt: `Generate meaningful content for ${use_case} on ${ keyword}`,
                _token: token,
                length: length,
                long_description: extra_description,
                variants: 1
            };
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function (response) {
                    if(response.error){
                        toastr.error(response.error);
                    }
                    selector.find('.a_writer_text').removeClass('d-none');
                    selector.find('.a_writer_loader').addClass('d-none');
                    let field = $('.'+name);

                    if (extra_description)
                    {
                        field.summernote("code", response.content);
                    }
                    else{
                        field.val(response.content);
                    }
                },
                error: function (error) {
                    selector.find('.a_writer_text').removeClass('d-none');
                    selector.find('.a_writer_loader').addClass('d-none');
                    toastr.error('Something went wrong, please try again later');
                },
                fail: function (error) {
                    selector.find('.a_writer_text').removeClass('d-none');
                    selector.find('.a_writer_loader').addClass('d-none');
                    toastr.error('Something went wrong, please try again later');
                }
            });
        });

        $(document).on('click', '.generate_content_for_me', function (e) {
            e.preventDefault();
            let selector = $(this);
            let loader_selector = $('.generator_loading_btn');
            selector.addClass('d-none');
            loader_selector.removeClass('d-none');
            let use_case = $('#use_case').val();
            let primary_keyword = $('#primary_keyword').val();
            let variants = $('#variants').val();
            let url = selector.data('url');

            if (!use_case || !primary_keyword || !variants)
            {
                toastr.error('Please Select All the necessary fields');
                selector.removeClass('d-none');
                loader_selector.addClass('d-none');
                return false;
            }

            let data = {
                prompt: `Generate meaningful content for ${use_case} on ${ primary_keyword} with ${ variants } different results`,
                _token: token,
                length: 269*parseInt(variants),
                variants: variants
            };

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function (response) {
                    selector.removeClass('d-none');
                    loader_selector.addClass('d-none');
                    if (response.error)
                    {
                        toastr.error(response.error);
                        return false;
                    }
                    else{
                        $('.ai_description').summernote("code", response.content);
                    }
                },
                error: function (error) {
                    selector.removeClass('d-none');
                    loader_selector.addClass('d-none');
                    alert('Something went wrong, please try again later');
                }
            });
        });
    });
});
