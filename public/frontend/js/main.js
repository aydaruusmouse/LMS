/*-----------------------------------------------------------------------------------
    Template Name: Faculty - LMS Online Education Course HTML Template
    Template URI: https://spagreen.net/faculty
    Author: Humayun Ahmed
    Author URI:  https://spagreen.net
    Version: 1.0

    Note: This is Main JS file
-----------------------------------------------------------------------------------
    Js INDEX
    ===================
    #. Main Menu
    #. Category Widget Dropdown
    #. Profile Dropdown
    #. Preview Slider
    #. Mentor Lesson Slider V1
    #. Mentor Lesson Slider V2
    #. Recent Video Slider
    #. Testimonial Slider
    #. Success Story Slider V1
    #. Success Story Slider V2
    #. Course Lesson Slider V1
    #. Course Lesson Slider V2
    #. Brand Slider
    #. Blog Post Slider V1
    #. Blog Post Slider V2
    #. Team Slider
    #. Book Slider
    #. About Slider
    #. Counter Up
    #. Scroll To Top
    #. Video Popup
    #. Recent Video Player
    #. Audio Player
    #. Sticky Header
    #. Nice Select
    #. User Avatar Dropdown
    #. Tooltips
    #. Video Lesson Player
    #. Course Video Lesson
    #. Toggle/Expandable Search Box
    #. Course Intro Video Player
    #. User Form Validation
    #. Password show & hide
    #. Cart Quantity
    #. Bootstrap Stop Propagation
    #. Course Sidebar Toggle Slide
    #. Pricing Slider
    #. Related Course Slider
    #. Show More Subject
    #. Show More Courses
    #. Show More Blog
    #. Notification Toggle
    #. OTP Form
    #. Select2
    #. Disable Clickable Menu
    #. Lesson Playlist Scrollbar
-----------------------------------------------------------------------------------*/

"use strict";

// ===== 01. Main Menu
function mainMenu() {
    const navbarToggler = $(".navbar-toggler"),
        navMenu = $(".nav-menu"),
        mobilePanel = $(".mobile-slide-panel"),
        mobilePanelMenu = $(".mobile-menu"),
        mobileOverly = $(".panel-overlay"),
        navClose = $(".panel-close");

    // Show Mobile Slide Panel
    navbarToggler.on("click", function (e) {
        e.preventDefault();
        mobilePanel.toggleClass("panel-on");
    });
    // Close Mobile Slide Panel
    navClose.add(mobileOverly).on("click", function (e) {
        e.preventDefault();
        mobilePanel.removeClass("panel-on");
    });
    // Adds toggle button to li items that have children
    navMenu.find("li a").each(function () {
        if ($(this).next().length > 0) {
            $(this).append(
                '<span class="dd-trigger"><i class="fas fa-angle-down"></i></span>'
            );
        }
    });
    mobilePanelMenu.find("li a").each(function () {
        if ($(this).next().length > 0) {
            $(this).append(
                '<span class="dd-trigger"><i class="fas fa-angle-down"></i></span>'
            );
        }
    });
    // Expands the dropdown menu on each click
    mobilePanelMenu.find(".dd-trigger").on("click", function (e) {
        e.preventDefault();
        $(this)
            .parent()
            .parent("li")
            .children("ul.sub-menu")
            .stop(true, true)
            .slideToggle(350);
        $(this).toggleClass("sub-menu-opened");
    });
    const offCanvasBtn = $(".cart-btn"),
        offCanvasClose = $(".canvas-close"),
        canvasOverly = $(".canvas-overlay"),
        offCanvasPanel = $(".off-canvas-wrapper");
    // Show Off canvas Panel
    offCanvasBtn.on("click", function (e) {
        e.preventDefault();
        offCanvasPanel.addClass("canvas-on");
    });

    // Hide Off canvas Panel
    offCanvasClose.add(canvasOverly).on("click", function (e) {
        e.preventDefault();
        offCanvasPanel.removeClass("canvas-on");
    });
}

//=== 02. Category Widget Dropdown
function categoryDropdown() {
    const categoryLinkDropdown = $(".category-list-group");
    categoryLinkDropdown.find("li a").each(function () {
        if ($(this).next().length > 0) {
            $(this).append('<i class="dd-trigger fas fa-angle-down"></i>');
            $(this).addClass("has-dropdown");
        }
    });
    // Expands the dropdown menu on each click
    /*categoryLinkDropdown.find(".has-dropdown").on("click", function (e) {
        e.preventDefault();
        $(this)
            .parent()
            .parent("li")
            .children("ul")
            .stop(true, true)
            .slideToggle(350);
        $(this).toggleClass("sub-menu-opened");
    });*/
}

//=== 03. Profile Dropdown
function profileDropdown() {
    const categoryLinkDropdown = $(".profile-menu ul");
    categoryLinkDropdown.find("li a").each(function () {
        if ($(this).next().length > 0) {
            $(this).append('<i class="dd-trigger fas fa-angle-down"></i>');
            $(this).addClass("has-dropdown");
        }
    });
    // Expands the dropdown menu on each click
    categoryLinkDropdown.find(".has-dropdown").on("click", function (e) {
        e.preventDefault();
        $(this)
            .parent()
            .parent("li")
            .children("ul")
            .stop(true, true)
            .slideToggle(350);
        $(this).toggleClass("sub-menu-opened");
    });
    $(".profile-menu").on("click", function (event) {
        event.stopPropagation();
    });
}

// ===== 04. Preview Slider
function previewSlider() {
    const sliders = $(".preview-slider");
    sliders.slick({
        infinite: false,
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 500,
        swipe: true,
        swipeToSlide: true,
        fade: true,
        rtl: false,
    });
}

// ===== 05. Mentor Lesson Slider V1
function mentorLessonSliderOne() {
    const sliders = $(".video-lesson-slider-v1");
    sliders.slick({
        infinite: false,
        dots: true,
        arrows: true,
        prevArrow:
            '<button class="slick-arrow prev-arrow"><i class="fal fa-long-arrow-left"></i></button>',
        nextArrow:
            '<button class="slick-arrow next-arrow"><i class="fal fa-long-arrow-right"></i></button>',
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 500,
        swipe: true,
        swipeToSlide: true,
        rtl: false,
    });
}

// ===== 06. Mentor Lesson Slider V2
function mentorLessonSliderTwo() {
    const sliders = $(".video-lesson-slider-v2");
    sliders.slick({
        infinite: false,
        dots: false,
        arrows: true,
        prevArrow:
            '<button class="slick-arrow prev-arrow"><i class="fal fa-long-arrow-left"></i></button>',
        nextArrow:
            '<button class="slick-arrow next-arrow"><i class="fal fa-long-arrow-right"></i></button>',
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 500,
        swipe: true,
        swipeToSlide: true,
        rtl: false,
    });
}

// ===== 07. Recent Video Slider
function recentVideoSlider() {
    const sliders = $(".recent-video-slider");
    sliders.slick({
        infinite: false,
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 500,
        swipe: false,
        swipeToSlide: false,
        fade: true,
        rtl: false,
    });
}

// ===== 08. Testimonial Slider
function testimonialSlider() {
    const sliders = $(".testimonial-slider");
    sliders.slick({
        infinite: false,
        dots: true,
        arrows: true,
        slidesToShow: 1,
        speed: 800,
        swipe: true,
        swipeToSlide: true,
        fade: true,
        adaptiveHeight: true,
        rtl: false,
        prevArrow:
            '<button class="slick-arrow prev-arrow"><i class="fal fa-arrow-left"></i></button>',
        nextArrow:
            '<button class="slick-arrow next-arrow"><i class="fal fa-arrow-right"></i></button>',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                },
            },
            {
                breakpoint: 576,
                settings: {
                    arrows: false,
                },
            },
        ],
    });
}

// ===== 09. Success Story Slider V1
function successStorySliderOne() {
    const sliders = $(".success-story-slider-v1");
    sliders.slick({
        infinite: false,
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 500,
        swipe: true,
        swipeToSlide: true,
        autoplay: true,
        rtl: false,
    });
}

// ===== 10. Success Story Slider V2
function successStorySliderTwo() {
    let selector1 = $(".success-story-author-preview");
    var sliderfor = selector1.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        fade: true,
        rtl: selector1.data("direction") == "rtl",
        asNavFor: ".success-story-content, .success-story-author",
    });
    let selector2 = $(".success-story-content");
    var slidernav = selector2.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        rtl: selector2.data("direction") == "rtl",
        asNavFor: ".success-story-author, .success-story-author-preview",
        arrows: false,
        adaptiveHeight: true,
    });
    let selector3 = $(".success-story-author");
    selector3.slick({
        arrows: false,
        infinite: true,
        slidesToShow: 4,
        dots: true,
        rtl: selector3.data("direction") == "rtl",
        asNavFor: ".success-story-content, .success-story-author-preview",
        focusOnSelect: true,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 475,
                settings: {
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 2,
                },
            },
        ],
    });
}

// ===== 11. Course Lesson Slider V1
function courseLessonSliderOne() {
    const sliders = $(".course-lesson-slider-v1");
    sliders.slick({
        infinite: true,
        dots: false,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        speed: 800,
        centerPadding: "10%",
        centerMode: true,
        swipe: true,
        autoplay: true,
        rtl: false,
        responsive: [
            {
                breakpoint: 1920,
                settings: {
                    slidesToShow: 4,
                    centerPadding: "10%",
                },
            },
            {
                breakpoint: 1718,
                settings: {
                    slidesToShow: 3,
                    centerPadding: "8%",
                },
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    centerPadding: "4%",
                },
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    centerPadding: "8%",
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    centerPadding: "5%",
                },
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    centerPadding: "15%",
                    adaptiveHeight: true,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    centerPadding: "10%",
                    adaptiveHeight: true,
                },
            },
        ],
    });
}

// ===== 12. Course Lesson Slider V2
function courseLessonSliderTwo() {
    const sliders = $(".course-lesson-slider-v2");
    sliders.slick({
        infinite: false,
        dots: true,
        arrows: false,
        slidesToShow: 4,
        speed: 800,
        swipe: true,
        swipeToSlide: true,
        rtl: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    centerPadding: "10%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerPadding: "20%",
                    centerMode: true,
                    infinite: true,
                    dots: false,
                },
            },
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerPadding: "0%",
                    centerMode: true,
                    infinite: false,
                    dots: false,
                },
            },
        ],
    });
}

// ===== 13. Brand Slider
function brandSlider() {
    const slider = $(".brand-slider");

    slider.slick({
        infinite: true,
        dots: false,
        arrows: false,
        speed: 500,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        rtl: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 340,
                settings: {
                    slidesToShow: 1,
                },
            },
        ],
    });
}

// ===== 14. Blog Post Slider V1
function blogPostSliderOne() {
    const sliders = $(".blog-post-slider-v1");
    sliders.slick({
        infinite: false,
        dots: true,
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        speed: 800,
        swipe: true,
        // centerMode: true,
        // centerPadding: '0%',
        rtl: false,
        responsive: [
            {
                breakpoint: 1150,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 420,
                settings: {
                    slidesToShow: 1,
                },
            },
        ],
    });
}

// ===== 15. Blog Post Slider V2
function blogPostSliderTwo() {
    const sliders = $(".blog-post-slider-v2");
    sliders.slick({
        // infinite: true,
        dots: true,
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        speed: 800,
        swipe: true,
        // swipeToSlide: true,
        centerMode: true,
        // centerPadding: '10%',
        rtl: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 420,
                settings: {
                    slidesToShow: 1,
                    centerPadding: "10px",
                },
            },
        ],
    });
}

// ===== 16. Team Slider
function teamSlider() {
    const sliders = $(".team-slider");
    sliders.slick({
        infinite: false,
        dots: true,
        arrows: false,
        slidesToShow: 4,
        speed: 800,
        swipe: true,
        rtl: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    centerPadding: "15%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    centerPadding: "10%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    centerPadding: "24%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 1,
                    centerPadding: "10%",
                    centerMode: true,
                    infinite: true,
                },
            },
        ],
    });
}

// ===== 17. Book Slider
function bookSlider() {
    const sliders = $(".book-list-slider");
    sliders.slick({
        infinite: false,
        dots: true,
        arrows: false,
        slidesToShow: 4,
        speed: 800,
        swipe: true,
        swipeToSlide: true,
        rtl: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    centerPadding: "15%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    centerPadding: "10%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    centerPadding: "24%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 1,
                    centerPadding: "10%",
                    centerMode: true,
                    infinite: true,
                },
            },
        ],
    });
}

// ===== 18. About Slider
function aboutSlider() {
    const sliders = $(".about-slider");
    sliders.slick({
        infinite: false,
        dots: true,
        arrows: false,
        slidesToShow: 1,
        speed: 800,
        swipe: true,
        swipeToSlide: true,
        rtl: false,
    });
}

// ===== 19. Counter Up
function counterUp() {
    $(".counter").each(function () {
        $(this)
            .prop("Counter", 0)
            .animate(
                {
                    Counter: $(this).text(),
                },
                {
                    duration: 2500,
                    easing: "swing",
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                        $(this).text(
                            $(this)
                                .text()
                                .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
                        );
                    },
                }
            );
    });
}

// ===== 20. Scroll To Top
function scrollToTop() {
    var $scrollUp = $("#fixed-scroll-top"),
        $footerScrollUp = $("#scroll-top"),
        $window = $(window);

    $window.on("scroll", function () {
        if ($window.scrollTop() > 200) {
            $scrollUp.addClass("show");
        } else {
            $scrollUp.removeClass("show");
        }
    });

    $scrollUp.on("click", function (evt) {
        $("html, body").animate({ scrollTop: 0 }, 300);
        evt.preventDefault();
    });
    $footerScrollUp.on("click", function (evt) {
        $("html, body").animate({ scrollTop: 0 }, 300);
        evt.preventDefault();
    });
}

// ==== 21. Video Popup
function videoPopup() {
    $(".popup-video").each(function () {
        $(this).magnificPopup({
            type: "iframe",
        });
    });
}

// ==== 22. Recent Video Player
function recentVideoPlayer() {
    const recentVideoPlayer = Plyr.setup(".recent-video-player");
}

// ==== 23. Audio Player
function audioPodcast() {
    const audioPodcast = Plyr.setup(".audio-podcast");
}

// ==== 24. Sticky Header
function stickyHeader() {
    const scroll_top = $(window).scrollTop(),
        siteHeader = $(".header-navigation");

    if (siteHeader.hasClass("sticky-header")) {
        if (scroll_top < 110) {
            siteHeader.removeClass("sticky-on");
        } else {
            siteHeader.addClass("sticky-on");
        }
    }
}

// ===== 25. Nice Select
function activeNiceSelect() {
    $("select:not(.select2)").niceSelect();
}
function initAOS() {
    AOS.init({
        disable: "mobile",
        easing: "ease",
        duration: 500,
        once: true,
        delay: 200,
    });
}
// ===== 26. User Avatar Dropdown
function setUserDropdownListener() {
    const userAvatar = $(".user-dropdown");

    function toggleClass(el, className) {
        if (el.hasClass(className)) {
            el.removeClass(className);
        } else {
            el.addClass(className);
        }
    }

    userAvatar.on("click", function (e) {
        const dropdown = $(this).children(".dropdown-list");
        toggleClass(dropdown, "dropdown-active");
    });
}

// ===== 27. Tooltips
var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

// ==== 28. Video Lesson Player
function videoLessonPlayer() {
    const videoLessonPlayer = Plyr.setup(".video-lesson-player");
}

// ==== 29. Course Video Lesson
function courseVideoLesson() {
    const courseVideoLesson = Plyr.setup(".course-video-lesson");
}

// ==== 30. Toggle/Expandable Search Box
function toggleSearchbar() {
    var submitIcon = $(".searchbox-icon");
    var inputBox = $(".searchbox-input");
    var searchBox = $(".searchbox");
    var isOpen = false;
    submitIcon.click(function () {
        if (isOpen == false) {
            searchBox.addClass("searchbox-open");
            inputBox.focus();
            isOpen = true;
        } else {
            searchBox.removeClass("searchbox-open");
            inputBox.focusout();
            isOpen = false;
        }
    });
    submitIcon.mouseup(function () {
        return false;
    });
    searchBox.mouseup(function () {
        return false;
    });
    $(document).mouseup(function () {
        if (isOpen == true) {
            $(".searchbox-icon").css("display", "block");
            submitIcon.click();
        }
    });
}

// ==== 31. Course Intro Video Player
function courseIntroVideo() {
    const courseIntroVideo = Plyr.setup(".course-intro-video");
}

// ==== 32. User Form Validation
(function () {
    "use strict";

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll(".needs-validation");

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add("was-validated");
            },
            false
        );
    });
})();

// ==== 33. Password show & hide
function passwordEye() {
    $(".toggle-password").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("id"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
}

// ==== 34. Cart Quantity
function cartQuantity() {
    var inputs = document.querySelectorAll(".qtyinput");
    inputs.forEach(function (input) {
        var btnminus = input.parentElement.querySelector(".qtyminus");
        var btnplus = input.parentElement.querySelector(".qtyplus");
        if (
            input !== undefined &&
            btnminus !== undefined &&
            btnplus !== undefined &&
            input !== null &&
            btnminus !== null &&
            btnplus !== null
        ) {
            var min = Number(input.getAttribute("min"));
            var max = Number(input.getAttribute("max"));
            var step = Number(input.getAttribute("step"));

            function qtyminus(e) {
                var current = Number(input.value);
                var newval = current - step;
                if (newval < min) {
                    newval = min;
                } else if (newval > max) {
                    newval = max;
                }
                input.value = Number(newval);
                e.preventDefault();
            }

            function qtyplus(e) {
                var current = Number(input.value);
                var newval = current + step;
                if (newval > max) newval = max;
                input.value = Number(newval);
                e.preventDefault();
            }

            btnminus.addEventListener("click", qtyminus);
            btnplus.addEventListener("click", qtyplus);
        }
    });
}

// ===== 35. Bootstrap Stop Propagation
/*$(".dropdown-menu").on("click", function (event) {
    event.stopPropagation();
});*/

// ===== 37. Course Sidebar Toggle Slide
function SidebarToggleSide() {
    const sidebarToggler = $(".toggle-icon"),
        courseSidebar = $(".course-sidebar"),
        blogSidebar = $(".blog-sidebar");

    sidebarToggler.on("click", function (e) {
        e.preventDefault();
        courseSidebar.toggleClass("panel-on");
        blogSidebar.toggleClass("panel-on");
    });
}

// ====== 38. Pricing Slider
function pricingSlider() {
    const sliders = $(".pricing-slider");
    sliders.slick({
        infinite: false,
        dots: false,
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        speed: 800,
        swipe: true,
        rtl: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    centerPadding: "15%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    centerPadding: "10%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 1,
                    centerPadding: "24%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 1,
                    centerPadding: "10%",
                    centerMode: true,
                    infinite: true,
                },
            },
        ],
    });
}

// ====== 39. Related Course Slider
function relatedCourseSlider() {
    const sliders = $(".course-slider");
    sliders.slick({
        infinite: false,
        dots: false,
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        speed: 800,
        swipe: true,
        rtl: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    centerPadding: "10%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    centerPadding: "5%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    centerPadding: "5%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 1,
                    centerPadding: "20%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 1,
                    centerPadding: "8%",
                    centerMode: true,
                    infinite: true,
                },
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    centerPadding: "8%",
                    centerMode: true,
                    infinite: true,
                },
            },
        ],
    });
}

// ====== 40. Show More Subject
function showMoreSubject() {
    $(".more-subject").click(function (event) {
        event.preventDefault();
        $(".course-subject-item").removeClass("d-none d-sm-block");
        $(".more-subject").addClass("d-none");
    });
}

// ====== 41. Show More Courses
function showMOreCourses() {
    $(".more-courses").click(function (event) {
        event.preventDefault();
        $(".course-item").removeClass("d-none d-sm-block");
        $(".more-courses").addClass("d-none");
    });
}

// ====== 43. Notification Toggle
function notificationToggle() {
    $(".details").click(function (event) {
        event.preventDefault();
        $(this).prev("p").toggleClass("toggle");
        if ($(this).text() === "Details") {
            $(this).text("See less");
        } else {
            $(this).text("Details");
        }
    });
    $(".details").each(function () {
        if ($(this).prev("p").height() <= 50.38) {
            $(this).remove();
        }
    });
}

// ====== 44. OTP Form
function otpForm() {
    let $inputs = $(".otp-form input[type='number']");
    let values = Array(4);
    let clipData;
    $inputs.eq(0).focus();

    $inputs.each(function (index) {
        let $tag = $(this);
        $tag.on("keyup", function (event) {
            if (event.code === "Backspace" && hasNoValue(index)) {
                if (index > 0) $inputs.eq(index - 1).focus();
            }

            //else if any input move focus to next or out
            else if ($tag.val() !== "") {
                index < $inputs.length - 1
                    ? $inputs.eq(index + 1).focus()
                    : $tag.blur();
            }

            //add val to array to track prev vals
            values[index] = event.target.value;
        });

        $tag.on("keyup", function () {
            //replace digit if already exists
            if ($tag.val() > 10) {
                $tag.val($tag.val() % 10);
            }
        });

        $tag.on("input", function () {
            // set the value to the first character of the input value
            $tag.val($tag.val().charAt(0));
        });

        $tag.on("paste", function (event) {
            event.preventDefault();
            clipData = event.originalEvent.clipboardData
                .getData("text/plain")
                .split("");
            filldata(index);
        });
    });

    function filldata(index) {
        for (let i = index; i < $inputs.length; i++) {
            $inputs.eq(i).val(clipData.shift());
        }
    }

    function hasNoValue(index) {
        if (values[index] || values[index] === 0) return false;

        return true;
    }
}

// ====== 45. Select2
function activeSelect2() {
    $(".select2").select2({
        placeholder: "Select organization",
        allowClear: true,
        // multiple: true,
        // dir: "rtl",
        width: "100%",
        templateSelection: function (selected, container) {
            // Add a class to the select2-selection element
            container.parent().addClass("custom-select");

            // Return the default markup for the selected option
            return selected.text;
        },
    });
}

// ====== 46. Disable Clickable Menu
$('.nav-menu a[data-bs-toggle="dropdown"]')
    .removeAttr("data-bs-toggle")
    .next(".dropdown-menu")
    .removeClass("dropdown-menu");

// ====== 48. Lesson Playlist Scrollbar
function lessonPlaylistScrollBar() {
    var elementHeight = $(".lesson-playlist-items").height();
    if (elementHeight > 450) {
        $(".lesson-playlist-items").addClass("scroll-bar-active");
    }
}

/*---------------------
=== Window Scroll  ===
----------------------*/
$(window).on("scroll", function () {
    stickyHeader();
    AOS.refresh();
});

/*------------------
=== WINDOW LOAD  ===
--------------------*/
$(window).on("load", function () {
    AOS.init({
        disable: "mobile",
        easing: "ease",
        duration: 500,
        once: true,
        delay: 200,
    });
});

/*-------------------
=== Window Load  ===
--------------------*/
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

mainMenu();
categoryDropdown();
profileDropdown();
activeNiceSelect();
videoPopup();
previewSlider();
mentorLessonSliderOne();
mentorLessonSliderTwo();
recentVideoSlider();
testimonialSlider();
successStorySliderOne();
successStorySliderTwo();
courseLessonSliderOne();
courseLessonSliderTwo();
blogPostSliderOne();
blogPostSliderTwo();
teamSlider();
bookSlider();
aboutSlider();
counterUp();
brandSlider();
scrollToTop();
setUserDropdownListener();
toggleSearchbar();
passwordEye();
cartQuantity();
SidebarToggleSide();
videoLessonPlayer();
courseVideoLesson();
recentVideoPlayer();
audioPodcast();
// courseIntroVideo();
pricingSlider();
relatedCourseSlider();
showMoreSubject();
showMOreCourses();
notificationToggle();
otpForm();
lessonPlaylistScrollBar();
