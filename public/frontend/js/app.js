const meta_token = document.head.querySelector('meta[name="csrf-token"]');
let token = "";
if (meta_token) {
    token = meta_token.content;
}
const paginate = document.head.querySelector('meta[name="paginate"]').content;
var counter = paginate;
let modal_hide = localStorage.getItem('modal_hide');

(function ($) {
    'use strict';
    $(document).ready(function () {
        $(document).on('change', '#tnc', function () {
            let is_checked = $(this).is(":checked");
            if (is_checked) {
                localStorage.setItem('modal_hide', '1');
            } else {
                localStorage.setItem('modal_hide', '0');
            }
        });
        if (modal_hide != "1") {
            setTimeout(function () {
                $('#windowLoadModal').modal('show');
            }, 2000);
        }
        $(document).on("submit", ".ajax_form", function (e) {
            e.preventDefault();
            let selector = this;
            $(selector).find(".loading_button").removeClass("d-none");
            $(selector).find("p.error").text("");
            $(selector).find(":submit").addClass("d-none");
            let action = $(selector).attr("action");
            let method = $(selector).attr("method");
            let formData = new FormData(selector);
            let modal = $('.is_modal').val();
            let fetch_reply = $(selector).data('fetch_reply');
            $.ajax({
                url: action,
                method: method,
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $(selector).find(".loading_button").addClass("d-none");
                    $(selector).find(":submit").removeClass("d-none");
                    if (response.success) {
                        if (response.is_reload) {
                            if (response.route) {
                                window.location.href = response.route;
                            } else {
                                location.reload();
                            }
                        } else {
                            if (fetch_reply)
                            {
                                $(fetch_reply).html(response.html);
                            }
                            if(response.get_comments)
                            {
                                $(selector).addClass('d-none');
                                getComments();
                            }
                            toastr.success(response.success);
                            $(selector).trigger("reset");
                        }

                    } else {
                        toastr.error(response.error);
                    }
                },
                error: function (response) {
                    $(selector).find(".loading_button").addClass("d-none");
                    $(selector).find(":submit").removeClass("d-none");
                    if (response.status == 422) {
                        if (formData.get('type') == 'tab_form') {
                            instructorValidate(selector);
                        }
                        $.each(
                            response.responseJSON.errors,
                            function (key, value) {
                                $("." + key + "_error").text(value[0]);
                            }
                        );
                    } else {
                        toastr.error(response.responseJSON.error);
                    }
                },
            });
        });
        //===================== setting change ========================
        $(document).on("click", ".status-change", function (e) {
            let base_url = $(".base_url").val();
            let selector = $(this);
            var value = selector.val().split("/");
            let field_for = selector.data('field_for');
            var url = value[0];

            if (field_for == 'maintenance_mode') {
                if (selector.is(":checked")) {
                    e.preventDefault();
                    return $('#maintenance_mode').modal('show');
                } else {
                    $('.warning_text').addClass('d-none');
                }
            }

            if (field_for == 'image_optimization') {
                if (selector.is(":checked")) {
                    $('.optimization_div').removeClass('d-none');
                } else {
                    $('.optimization_div').addClass('d-none');
                }
            }
            var id = selector.data('id');
            if ($(this).is(":checked")) {
                var status = 1;
            } else {
                var status = 0;
            }

            let form = {
                id: id,
                status: status,
                data: {
                    name: value[1],
                    value: status,
                }
            };

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                url: url,
                method: "POST",
                data: form,
                success: function (response) {
                    if (response.status == 200 || response.status == 'success') {
                        toastr["success"](response.message);
                    } else {
                        selector.prop('checked', !status);
                        toastr["error"](response.message);
                    }
                },
                error: function (response) {
                    selector.prop('checked', !status);
                    toastr["error"](response.message);
                },
            });
        });

        //================= update notification ==========
        $(document).on('change', '.notification-action', function () {
            var selected_id = [];
            $("input[name='notification_id']:checked").each(function () {
                selected_id.push($(this).val());
            })
            var update_type = $(this).val();
            var route = $(this).attr("data-route");
            if (update_type != 2) {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    type: 'POST',
                    url: route,
                    data: {selected_id, update_type},
                    success: function (response) {
                        if (response.status == 200) {
                            toastr["success"](response.message);
                            window.location.reload();
                        } else {
                            toastr["error"](response.message);
                        }

                    },
                    error: function (response) {
                        toastr["error"](response.message);
                    }
                })
            } else {
                $('.notification_id').prop('checked', false);
            }

        });


        $(document).on('change', '#language-selector', function () {
            window.location.href = $(this).find(':selected').data('url');
        });

        $(document).on('keyup', '.header_search', function () {
            var val = $(this).val();

            if (val.length < 2) {
                return true;
            }
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                url: $(this).data('url'),
                type: "post",
                data: {
                    q: val
                },
                success: function (response) {
                    console.log(response.html);
                    $('.quick-search-result').html(response.html);
                },
                error: function (response) {
                    console.log(response)
                }
            });
        });


        $(document).on('change', '.changeWebSetting', function () {
            var primary_color = $('input[name="primary_color"]:checked').val();
            var header = $('input[name="header"]:checked').val();
            var footer = $('input[name="footer"]:checked').val();
            var route = $('.update_web_setting').val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                url: route,
                type: "post",
                data: {
                    primary_color: primary_color, header: header, footer: footer
                },
                success: function (response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    } else {
                        toastr["error"](response.message);
                    }
                    console.log(response);

                },
                error: function (response) {
                    toastr["error"](response.message);
                }
            });

        });

        $(document).on('click', '.changeWebLanguage', function () {
            if ($('input[name="language"]:checked')) {
                var lang = $(this).val();
                var url = $(this).attr("data-url");
                window.location.href = url;
            }
        });
        $(document).on('click', '.add_to_cart', function () {
            let selector = $(this);
            selector.addClass('d-none');
            selector.closest('.cart_area').find('.loading_button').removeClass('d-none');
            var id = $(this).attr('data-id');
            var type = $(this).attr('data-type');
            var route = $(this).attr('data-route');
            var quantity = $(this).attr('data-quantity');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                type: 'POST',
                data: {
                    id: id,
                    type: type,
                    quantity: quantity
                },
                url: route,
                success: function (response) {
                    selector.closest('.cart_area').find('.loading_button').addClass('d-none');
                    if (response.error) {
                        selector.removeClass('d-none');
                        toastr["error"](response.error);
                    } else {
                        $('.added_to_cart').removeClass('d-none');
                        $('.canvas-inner').html(response.html);
                        toastr["success"](response.success);
                        $('#cart_iteam_no').removeClass('d-none').val(response.total_items);
                    }
                },
                error: function (response) {
                    toastr["error"](response.error);
                }
            });
        });
        $(document).on('click', '.add_remove_wishlist', function () {
            let selector = $(this);
            selector.addClass('disable_btn');
            let fill = '<i class="fa-heart fas"></i>';
            let blank = '<i class="fa-heart fal"></i>';
            let iconContainer = $(this).find('.wishlist-icon');

            let id = $(this).attr('data-id');
            var type = $(this).attr('data-type');
            var route = $(this).attr('data-route');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                type: 'POST',
                data: {
                    id: id,
                    type: type,
                },
                url: route,
                success: function (response) {
                    selector.removeClass('disable_btn');
                    if(response.status == 0){
                        iconContainer.html(blank)
                    }else{
                        iconContainer.html(fill)
                    }
                    toastr["success"](response.success);
                },
                error: function (response) {
                    selector.removeClass('disable_btn');
                    toastr["error"](response.error);
                }
            });
        });

        $(document).on('click', '.cart-btn', function (e) {
            e.preventDefault();
            $('.off-canvas-wrapper').addClass('canvas-on');
        });
        $(document).on('click', '.canvas-close', function (e) {
            e.preventDefault();
            $(this).add('.canvas-overlay').removeClass('canvas-on');
            $('.off-canvas-wrapper').removeClass('canvas-on');
        });
        $(document).on('change', '.lang', function () {
            $("#lang").submit();
        });
    });
})(jQuery);

function submitForm(form_name) {
    $('#' + form_name).submit();
}

