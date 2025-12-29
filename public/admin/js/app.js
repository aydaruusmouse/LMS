/*-----------------------------------------------------------------------------------
    Template Name: SG Admin Dashboard
    Template URI: https://spagreen.net/sg-dashboard
    Author: SpagreenCreative
    Author URI:  https://spagreen.net
    Version: 1.0

    Note: This is Main JS file
-----------------------------------------------------------------------------------
    Js INDEX
    ===================
    #. 01. Sidebar Nav
    #. 02. Settings Tools Nav
    #. 03. Choices Select Field
    #. 04. Editor
    #. 05. File Uploader Dropzone
    #. 06. Password show hide
-----------------------------------------------------------------------------------*/
const meta_token = document.head.querySelector('meta[name="csrf-token"]');
let token = "";
if (meta_token) {
    token = meta_token.content;
}
let single_choice = "";
let section = 0;
let base_url = $(".base_url").val();
let modal_id = "";

(function ($) {
    "use strict";
    // 01. Sidebar Nav
    $(document).ready(function () {
        $(document).on("click", ".copy_text", function () {
            let text = $(this).data("text");
            copyText(text);
        });
        $(document).on("change", "#lang", function () {
            $(this).closest("form").submit();
        });

        $(document).on("click", ".status-change", function (e) {
            let selector = $(this);
            var value = selector.val().split("/");
            let field_for = selector.data("field_for");
            var url = base_url + "/admin/" + value[0];

            if (field_for == "maintenance_mode") {
                if (selector.is(":checked")) {
                    e.preventDefault();
                    return $("#maintenance_mode").modal("show");
                } else {
                    $(".warning_text").addClass("d-none");
                }
            }

            if (field_for == "image_optimization") {
                if (selector.is(":checked")) {
                    $(".optimization_div").removeClass("d-none");
                } else {
                    $(".optimization_div").addClass("d-none");
                }
            }
            var id = selector.data("id");
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
                },
            };

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                url: url,
                method: "POST",
                data: form,
                success: function (response) {
                    toastr.clear();
                    if (
                        response.status == 200 ||
                        response.status == "success"
                    ) {
                        if (response.reload) {
                            toastr["success"](response.message);
                            location.reload();
                        } else {
                            toastr["success"](response.message);
                        }
                    } else {
                        selector.prop("checked", !status);
                        toastr["error"](response.message);
                    }
                },
                error: function (response) {
                    selector.prop("checked", !status);
                    if (response.status == 403) {
                        toastr.error(response.status+' '+response.statusText);
                    }
                    else{
                        toastr["error"](response.message);
                    }
                },
            });
        });

        // change published status

        $(document).on("click", ".pubished_status", function (e) {
            let selector = $(this);
            var value = selector.val().split("/");
            let field_for = selector.data("field_for");
            var url = base_url + "/admin/" + value[0];

            if (field_for == "maintenance_mode") {
                if (selector.is(":checked")) {
                    e.preventDefault();
                    return $("#maintenance_mode").modal("show");
                } else {
                    $(".warning_text").addClass("d-none");
                }
            }

            if (field_for == "image_optimization") {
                if (selector.is(":checked")) {
                    $(".optimization_div").removeClass("d-none");
                } else {
                    $(".optimization_div").addClass("d-none");
                }
            }
            var id = selector.data("id");
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
                },
            };

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                url: url,
                method: "POST",
                data: form,
                success: function (response) {
                    toastr.clear();

                    $("#dataTableBuilder").DataTable().ajax.reload();

                    if (
                        response.status == 200 ||
                        response.status == "success"
                    ) {
                        if (response.reload) {
                            toastr["success"](response.message);
                            location.reload();
                        } else {
                            toastr["success"](response.message);
                        }
                    } else {
                        selector.prop("checked", !status);
                        toastr["error"](response.message);
                    }
                },
                error: function (response) {
                    selector.prop("checked", !status);
                    if (response.status == 403) {
                        toastr.error(response.status+' '+response.statusText);
                    }
                    else{
                        toastr["error"](response.message);
                    }
                },
            });
        });

        // change published status

        //insturctor status change script
        $(document).on("click", ".instructor-status-change", function (e) {
            let selector = $(this);
            var value = selector.val().split("/");
            let field_for = selector.data("field_for");
            var url = base_url + "/organization/" + value[0];

            if (field_for == "maintenance_mode") {
                if (selector.is(":checked")) {
                    e.preventDefault();
                    return $("#maintenance_mode").modal("show");
                } else {
                    $(".warning_text").addClass("d-none");
                }
            }

            if (field_for == "image_optimization") {
                if (selector.is(":checked")) {
                    $(".optimization_div").removeClass("d-none");
                } else {
                    $(".optimization_div").addClass("d-none");
                }
            }
            var id = selector.data("id");
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
                },
            };

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                url: url,
                method: "POST",
                data: form,
                success: function (response) {
                    toastr.clear();
                    if (
                        response.status == 200 ||
                        response.status == "success"
                    ) {
                        if (response.reload) {
                            toastr["success"](response.message);
                            location.reload();
                        } else {
                            toastr["success"](response.message);
                        }
                    } else {
                        selector.prop("checked", !status);
                        toastr["error"](response.message);
                    }
                },
                error: function (response) {
                    selector.prop("checked", !status);
                    toastr["error"](response.message);
                },
            });
        });

        let sortable = document.getElementById("homepageContent");
        if (sortable) {
            new Sortable(sortable, {
                animation: 150,
            });
        }

        const popoverTriggerList = document.querySelectorAll(
            '[data-bs-toggle="popover"]'
        );
        const popoverList = [...popoverTriggerList].map(
            (popoverTriggerEl) => new bootstrap.Popover(popoverTriggerEl)
        );

        $("body").on("click", function (e) {
            //did not click a popover toggle or popover
            if (
                $(e.target).data("toggle") !== "popover" &&
                $(e.target).parents(".popover.in").length === 0
            ) {
                $('[data-bs-toggle="popover"]').popover("hide");
            }
        });

        //sidebar scrolling
        var activeMenuItem = $(".side-nav ul .active");
        if (activeMenuItem.length > 0) {
            var sidebarHeight = $(".side-nav").height();
            var menuItemOffset = activeMenuItem.position().top;
            var scrollPosition = menuItemOffset - sidebarHeight / 2;

            $(".side-nav").scrollTop(scrollPosition);
        }

        $(document).on("click", ".builder", function () {
            section++;
            let target_id = $(this).data("target_id");
            let name = $(this).data("name");
            let accordion = $(".modal").find("#" + target_id);

            let selector = accordion.clone().appendTo("#homepageContent");

            let id = target_id + "_section_" + section;

            let button = selector.find("button");

            if (button.length) {
                button.attr("data-bs-target", "#" + id);
            }
            selector.find(".accordion-collapse").attr("id", id);

            selector.find("*").each(function () {
                if ($(this).attr("name")) {
                    let type = $(this).data("type");
                    let is_array = $(this).data("is_array");
                    if (type) {
                        if (is_array) {
                            $(this).prop(
                                "name",
                                "builder[" +
                                    name +
                                    "_" +
                                    section +
                                    "]" +type
                            );
                        } else{
                            $(this).prop(
                                "name",
                                "builder[" +
                                name +
                                "_" +
                                section +
                                "][" +
                                type +
                                "]"
                            );
                        }
                    } else {
                        $(this).prop(
                            "name",
                            "builder[" +
                                name +
                                "_" +
                                section +
                                "]" +
                                (type == "array" ? "[ids][]" : "") +
                                ""
                        );
                    }
                    return true;
                }
            });

            window.scrollTo({
                behavior: "smooth",
                top: document.body.scrollHeight,
            });
        });

        $(document).on("click", ".accordion-header", function () {
            let id = $(this).attr("id");
            if ($(this).find(".form-select").hasClass("select2-hidden-accessible")) {
                $(this).find(".form-select").select2("destroy");
            }
            if (id == "instructor") {
                searchInstructor(
                    $(this).closest(".accordion-item").find(".form-select")
                );
            } else if (id == "featuredCourse" || id == "singleCourse") {
                searchCourse(
                    $(this).closest(".accordion-item").find(".form-select")
                );
            } else if (id == "subjects") {
                searchSubjects(
                    $(this).closest(".accordion-item").find(".form-select")
                );
            } else if (id == "mentor") {
                searchLessons(
                    $(this).closest(".accordion-item").find(".form-select")
                );
            } else if (id == "videoSlider") {
                $(this).closest(".accordion-item").find(".form-select").select2({
                    minimumResultsForSearch: Infinity,
                    placeholder: $(this).attr("placeholder"),
                });
            }
        });

        $(document).on("click", ".homepage-content .delete-icon", function () {
            $(this).closest(".accordion-item").remove();
        });
        $(document).on("change", ".file_picker", function (e) {
            let file = e.target.files[0];
            let selector = $(this).closest(".input_file_div");
            selector.find(".file-upload-text").text(file.name);
            selector
                .find(".selected-img")
                .attr("src", URL.createObjectURL(file));
        });
        $(".modal")
            .on("shown.bs.modal", function () {
                let id = $(this).attr("id");
                modal_id = $("#" + id);
                if (id == 'student_modal') {
                    searchCourse($('#select_course'));
                    searchUser($('#student'));
                } else if (id != "addMedia") {
                    modal_id.find(".with_search").select2({
                        placeholder: $(this).attr("placeholder"),
                        dropdownParent: modal_id,
                    });
                    modal_id.find(".without_search").select2({
                        minimumResultsForSearch: Infinity,
                        placeholder: $(this).attr("placeholder"),
                        dropdownParent: modal_id,
                    });
                }
            })
            .on("hidden.bs.modal", function () {
                modal_id.find("p.error").text("");
            });

        $(document).on("submit", ".form", function (e) {
            e.preventDefault();
            let selector = this;
            $(selector).find(".loading_button").removeClass("d-none");
            $(selector).find("p.error").text("");
            $(selector).find(":submit").addClass("d-none");
            let action = $(selector).attr("action");
            let method = $(selector).attr("method");
            let formData = new FormData(selector);
            let modal = $(selector).find(".is_modal").val();
            $.ajax({
                url: action,
                method: method,
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    window.scrollTo({
                        behavior: "smooth",
                        top: 0,
                    });
                    if (response.success) {
                        if (modal_id && !modal) {
                            $(selector)
                                .find(".loading_button")
                                .addClass("d-none");
                            $(selector).find(":submit").removeClass("d-none");
                            toastr.success(response.success);
                            modal_id.modal("hide");
                            $(selector).trigger("reset");
                            modal_id
                                .find(".create_sub_title")
                                .removeClass("d-none");
                            modal_id.find(".edit_sub_title").addClass("d-none");
                            $(".dataTable").DataTable().ajax.reload();
                        } else {
                            $(selector).find(".loading_button").addClass("d-none");
                            $(selector).find(":submit").removeClass("d-none");
                            if (response.route) {
                                window.location.href = response.route;
                            } else {
                                location.reload();
                            }
                        }
                    } else {
                        $(selector).find(".loading_button").addClass("d-none");
                        $(selector).find(":submit").removeClass("d-none");
                        toastr.error(response.error);
                    }
                },
                error: function (response) {
                    window.scrollTo({
                        behavior: "smooth",
                        top: 0,
                    });
                    $(selector).find(".loading_button").addClass("d-none");
                    $(selector).find(":submit").removeClass("d-none");
                    if (response.status == 422) {
                        if (formData.get("type") == "tab_form") {
                            instructorValidate(selector);
                        }
                        $.each(
                            response.responseJSON.errors,
                            function (key, value) {
                                $("." + key + "_error").text(value[0]);
                            }
                        );
                    } else if(response.status == 403){
                        toastr.error(response.status+' '+response.statusText);
                    }
                    else{
                        toastr.error(response.responseJSON.message);
                    }
                },
            });
        });

        $(document).on("change", ".thumb_picker", function (e) {
            let id = $(this).attr("id");
            let file = e.target.files[0];
            $(this)
                .siblings(".file-upload-text")
                .find(".file_name")
                .text(file.name);
        });
        $(document).on("click", ".edit_modal", function () {
            let id = $(this).attr("data-modal");
            modal_id = $("#" + id);
            modal_id.modal("show");
            modal_id.find(".create_sub_title").addClass("d-none");
            modal_id.find(".edit_sub_title").removeClass("d-none");
            let fetch_url = $(this).attr("data-fetch_url");
            let route = $(this).attr("data-route");
            modal_id.find("form").attr("action", route);
            $.ajax({
                type: "GET",
                url: fetch_url,
                success: function (response) {
                    if (response.html) {
                        modal_id.find(".form_div").html(response.html);
                        defaultEditor();
                        selectionFields();
                    } else {
                        let keys = Object.keys(response);
                        for (let i = 0; i < keys.length; i++) {
                            let selector = modal_id.find(
                                'form [name="' + keys[i] + '"]'
                            );
                            if (selector.attr("type") == "checkbox") {
                                selector.prop("checked", response[keys[i]]);
                            } else {
                                selector.val(response[keys[i]]);
                            }
                        }
                    }
                },
            });
        });
        $(document).on("click", ".tab_switcher", function () {
            let selector = $(this).closest(".default-tab-list");
            let current_tab = selector.find(".nav-link.active");
            let current_tab_target = current_tab.data("bs-target");
            let next_tab_li = current_tab.closest("li").siblings(":first");
            let next_tab = next_tab_li.find(".nav-link");
            let next_tab_target = next_tab.data("bs-target");
            current_tab.removeClass("active");
            $(current_tab_target).removeClass("active");
            $(current_tab_target).removeClass("show");
            next_tab.addClass("active");
            $(next_tab_target).addClass("active");
            $(next_tab_target).addClass("show");
        });

        $(document).on("click", ".get_code", function () {
            let length = $(this).attr("data-length");
            let input = $(this).closest(".input-group").find("input");
            var api_key = "";
            var string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

            for (var i = 0; i < length; i++)
                api_key += string.charAt(
                    Math.floor(Math.random() * string.length)
                );

            input.val(api_key);
        });
        $(document).on("change", ".sandbox_mode", function () {
            let id = $(this).attr("id");
            let payment_method_status = $(this).prop("checked");
            let input = $(this)
                .closest(".sandbox_mode_div")
                .find('input[name="' + id + '"]');
            if (payment_method_status) {
                input.val(1);
            } else {
                input.val(0);
            }
        });
        $(document).on("keyup", ".cross-origin", function (event) {
            var value = $(this).val();
            var input = $(this).closest("div").find(".cross_origin_input");
            input.val(btoa(value));
        });
        $(document).on("change", "#country", function () {
            var value = $(this).val();
            var url = $(this).attr("data-url");

            $.ajax({
                type: "GET",
                url: url,
                data: {
                    country_id: value,
                },
                success: function (response) {
                    if (response.error) {
                        return toastr.error(response.error);
                    } else {
                        reInitializeSelect($("#state"), response);
                    }
                },
                error: function (response) {
                    toastr.error(response.responseJSON.error);
                },
            });
        });
        $(document).on("change", "#state", function () {
            var value = $(this).val();
            var url = $(this).attr("data-url");
            let no_area = $(this).data("no_area");
            if (no_area == 1) {
                return false;
            }

            $.ajax({
                type: "GET",
                url: url,
                data: {
                    state_id: value,
                },
                success: function (response) {
                    if (response.error) {
                        return toastr.error(response.error);
                    } else {
                        reInitializeSelect($("#city"), response);
                    }
                },
                error: function (response) {
                    toastr.error(response.responseJSON.error);
                },
            });
        });
        $(document).on("change", "#ins_by_org", function () {
            var value = $(this).val();
            var url = $(this).attr("data-url");

            $.ajax({
                type: "GET",
                url: url,
                data: {
                    organization_id: value,
                },
                success: function (response) {
                    if (response.error) {
                        return toastr.error(response.error);
                    } else {
                        reInitializeSelect($("#instructor_ids"), response);
                    }
                },
                error: function (response) {
                    toastr.error(response.responseJSON.error);
                },
            });
        });
        $(document).on("change", "#section_id", function () {
            var value = $(this).val();
            var url = $(this).attr("data-url");

            $.ajax({
                type: "GET",
                url: url,
                data: {
                    section_id: value,
                },
                success: function (response) {
                    if (response.error) {
                        return toastr.error(response.error);
                    } else {
                        reInitializeSelect($("#lesson_id"), response);
                    }
                },
                error: function (response) {
                    toastr.error(response.responseJSON.error);
                },
            });
        });

        $(document).on("click", "#download_update", function () {
            let selector = $(this);
            var url = $(this).attr("data-url");
            var next_version = $(this).attr("data-version");
            $(".alert_div")
                .removeClass("alert-danger")
                .removeClass("alert-success")
                .addClass("d-none");
            $(".overlayText").removeClass("d-none");
            selector.addClass("d-none");
            $("#preloader").removeClass("d-none");
            setTimeout(function () {
                $.ajax({
                    method: "POST",
                    data: {
                        _token: token,
                        version: next_version,
                    },
                    url: url,
                    success: function (data) {
                        $(".alert_div")
                            .addClass("alert-" + data.class)
                            .removeClass("d-none");
                        $(".alert_div strong").text(data.type);
                        $(".alert_div span:first").text(data.message);
                        $(".overlayText").addClass("d-none");
                        selector.removeClass("d-none");
                        $("#preloader").addClass("d-none");
                        if (data.class == "success") {
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    },
                    error: function (data) {
                        $(".alert_div")
                            .addClass("alert-danger")
                            .removeClass("d-none");
                        $(".alert_div strong").text("Error !");
                        $(".alert_div span:first").text(data.statusText);
                        $(".overlayText").addClass("d-none");
                        selector.removeClass("d-none");
                        $("#preloader").addClass("d-none");
                    },
                });
            }, 500);
        });
        $(document).on("change", ".organization_balance", function () {
            var value = $(this).val();
            var url = $(this).attr("data-url");
            $.ajax({
                type: "post",
                url: url,
                data: {
                    organization: value,
                    _token: token,
                },
                success: function (response) {
                    if (response.error) {
                        return toastr.error(response.error);
                    } else {
                        $(".available_balance").empty().html(response.amount);
                    }
                },
                error: function (response) {
                    toastr.error(response.responseJSON.error);
                },
            });
        });
        $("#dateRangePicker").on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(
                    picker.startDate.format("MM/DD/YYYY") +
                        " - " +
                        picker.endDate.format("MM/DD/YYYY")
                );
            }
        );
    });

    passwordprotect();
    mainSidebar();
    settingTools();
    sideNav();
    selectionFields();
    defaultEditor();

    $(".lang").on("change", function () {
        $("#lang").submit();
    });
})(jQuery);

function instructorValidate(el) {
    let selector = $(el).closest(".default-tab-list");
    let current_tab = selector.find(".nav-link.active");
    let current_tab_target = current_tab.data("bs-target");
    current_tab.removeClass("active");
    $(current_tab_target).removeClass("active");
    $(current_tab_target).removeClass("show");
    selector.find(".nav-link:first").addClass("active");
    selector.find(".tab-pane:first").addClass("active");
    selector.find(".tab-pane:first").addClass("show");
}

// Copy Text
function copyText(text) {
    let success_txt = $(".text_copied").val();
    let error_txt = $(".text_copied_fail").val();
    navigator.clipboard
        .writeText(text)
        .then(() => {
            toastr["success"](success_txt);
        })
        .catch((err) => {
            toastr["error"](error_txt + ": ", err);
        });
}

// Main Sidebar
function mainSidebar() {
    const toggleBTN = $(".sidebar-toggler"),
        body = $("body");

    toggleBTN.on("click", function () {
        document.body.classList.toggle("sidebar-collapse");
    });

    $(window).on("resize", function () {
        const width = $(this).width();
        if (width >= 576 && width <= 991) {
            body.addClass("sidebar-collapse");
        } else {
            body.removeClass("sidebar-collapse");
        }
    });
}

// 02. Settings Tools Nav
function settingTools() {
    const settingToolsNav = $(".settings-tools-nav ul");
    settingToolsNav.find("li a").each(function () {
        if ($(this).next().length > 0) {
            $(this).append('<i class="dropdown-icon las la-angle-down"></i>');
            $(this).addClass("has-dropdown");
        }
    });
    // Expands dropdown menu on each click
    settingToolsNav.find(".has-dropdown").on("click", function (e) {
        e.preventDefault();
        $(this)
            .parent()
            .parent("li")
            .children("ul")
            .stop(true, true)
            .slideToggle(350);
        $(this).toggleClass("sub-menu-opened");
    });
    $(".settings-tools-nav").on("click", function (event) {
        event.stopPropagation();
    });
}

// Sidenav
function sideNav() {
    const sideNav = $(".email-tamplate-sidenav ul");
    sideNav.find("li a").each(function () {
        if ($(this).next().length > 0) {
            $(this).append('<i class="arrow-icon las la-angle-down"></i>');
            $(this).addClass("has-dropdown");
        }
    });
    // Expands dropdown menu on each click
    sideNav.find(".has-dropdown").on("click", function (e) {
        e.preventDefault();
        $(this)
            .parent()
            .parent("li")
            .children("ul")
            .stop(true, true)
            .slideToggle(350);
        $(this).toggleClass("sub-menu-opened");
    });
    $(".settings-tools-nav").on("click", function (event) {
        event.stopPropagation();
    });
}

// 03. Choices Select Field
function selectionFields() {
    $(".without_search").select2({
        minimumResultsForSearch: Infinity,
        placeholder: $(this).attr("placeholder"),
    });

    $(".with_search, .multiple-select-1").select2({
        placeholder: $(this).attr("placeholder"),
        // dropdownParent: $('#addCurrency')
    });
}

function reInitializeSelect(selector, response) {
    var $Select = selector.select2();
    $Select.empty();
    if (modal_id) {
        $Select.select2({
            data: response,
            dropdownParent: modal_id,
        });
    } else {
        $Select.select2({
            data: response,
        });
    }
    $Select.trigger("change");
}

// 04. Editor
function defaultEditor() {
    $("#product-update-editor").summernote({
        tabsize: 2,
        height: 350,
        fontNames: ["sans-serif", "Arial"],
        fontsize: "16",
        disableResize: true,
        disableResizeEditor: true,
        resize: false,
        toolbar: [
            ["font", ["bold", "underline"]],
            ["fontname", ["fontname"]],
            ["fontsize", ["fontsize"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["table", ["table"]],
            ["insert", ["link", "picture", "video"]],
            ["view", ["fullscreen", "help"]],
        ],
    });
    $(".summernote").summernote({
        tabsize: 2,
        height: 350,
        fontNames: ["sans-serif", "Arial"],
        fontsize: "16",
        disableResize: true,
        disableResizeEditor: true,
        resize: false,
        toolbar: [
            ["font", ["bold", "underline"]],
            ["fontname", ["fontname"]],
            ["fontsize", ["fontsize"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["table", ["table"]],
            ["insert", ["link", "picture", "video"]],
            ["view", ["fullscreen", "help"]],
        ],
    });
}

// 05. File Uploader Dropzone
// Dropzone.autoDiscover = false;

// 06. Password show hide
function passwordprotect() {
    $(document).on("click", ".toggle-password", function () {
        var passwordFieldId = $(this).prev("input").attr("id");
        var passwordField = $(this)
            .closest(".user-password")
            .find(".passField");
        var toggleBtn = $(this);

        if (passwordField.attr("type") === "password") {
            passwordField.attr("type", "text");
            toggleBtn.html("<i class='lar la-eye-slash'></i>");
        } else {
            passwordField.attr("type", "password");
            toggleBtn.html("<i class='lar la-eye'></i>");
        }
    });
}

function searchInstructor(el) {
    let route = el.data("route") ? el.data("route") : base_url + "/ajax/instructors";
    el.select2(select2Options(el, route));
}
function searchUser(el) {
    let route = el.data("route") ? el.data("route") : base_url + "/ajax/users";
    let fields = {
        role_id: el.data("role_id"),
    }
    el.select2(select2Options(el, route, fields));
}
function searchBlog(el) {
    let route = el.data("route");
    el.select2(select2Options(el, route));
}
function searchBook(el) {
    let route = el.data("route");
    el.select2(select2Options(el, route));
}
function searchCategory(el) {
    let route = el.data("route") ? el.data("route") : base_url + "/ajax/categories";
    el.select2(select2Options(el, route));
}
function searchOrganization(el) {
    let route = el.data("route") ? el.data("route") : base_url + "/ajax/organizations";
    el.select2(select2Options(el, route));
}

function searchCourse(el) {
    let route = el.data("route") ? el.data("route") : base_url + "/ajax/courses";
    let fields = {
        is_featured: el.data("is_featured") ? 1 : 0,
    }
    el.select2(select2Options(el, route, fields));
}

function searchSubjects(el) {
    let route = el.data("route") ? el.data("route") : base_url + "/ajax/subjects";
    el.select2(select2Options(el, route));
}

function searchLessons(el) {
    let route = el.data("route") ? el.data("route") : base_url + "/ajax/lessons";
    el.select2(select2Options(el, route));
}
function select2Options(el, route , fields) {
    fields = fields ? fields : {};
    let options = {
        placeholder: el.attr("placeholder"),
        ajax: {
            url: route,
            dataType: "json",
            data: function (params) {
                fields.q = params.term;
                return fields;
            },
            processResults: function (data) {
                return {
                    results: data,
                };
            },
            cache: true,
        },
        minimumInputLength: 2,
    };

    if (modal_id) {
        options.dropdownParent = modal_id;
    }
    return options;
}

window.onload = function () {
    const progressBarLength =
        document.querySelectorAll(".line-progress").length;
    const dataProgressLength = document.querySelectorAll(
        ".line-progress [data-progress]"
    ).length;
    const dataProgress = document.querySelectorAll(
        ".line-progress [data-progress]"
    );

    if (progressBarLength > 0 && dataProgressLength > 0) {
        dataProgress.forEach((x) => AnimateProgress(x));
    }
};
function AnimateProgress(el) {
    el.className = "animate-progress";
    el.setAttribute(
        "style",
        `--animate-progress:${el.getAttribute("data-progress")}%;`
    );
}
