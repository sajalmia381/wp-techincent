(function ($) {
    'use strict';


    var windo = $(window),
        HtmlBody = $('html, body');
    // pre-loader
    windo.on('load', function () {
        $('#pre-loader').delay(1000).fadeOut(600);
    });

    // IsToTop
    var istotop = $('#istotop');
    istotop.on('click', function () {
        HtmlBody.animate({
            scrollTop: 0
        }, 2000);
    });

    // navigation scroll 
    var navscrl = $('#navigation');

    // Scroll function
    windo.on('scroll', function () {
        var scrltop = windo.scrollTop();
        if (scrltop > 4000) {
            navscrl.addClass('nav-scrl').fadeIn(8000);
        } else {
            navscrl.removeClass('nav-scrl');
        }
        // istoptop 
        if (scrltop > 400) {
            istotop.fadeIn();
        } else {
            istotop.fadeOut();
        }
    });

    // Landing page scroll spay
    $('body').scrollspy({
        target: '#navigation',
        offset: 80
    });

    // nav window search
    var searchbar = $(".search-bar");
    searchbar.on('click', function () {
        var searchbox = $(".search-box");
        searchbox.toggle();
    });

    // Smooth Scroll

    $('a[href*="#"]:not([href="#').on('click', function () {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                HtmlBody.animate({
                    scrollTop: target.offset().top - 70
                }, 1000);
                return false;
            }
        }
    });

    /* Plugin js Start */
    // slider
    var owl = $('.owl-carousel.banner-active');
    owl.owlCarousel({
        items: 1,
        loop: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        margin: 0,
        autoHeight: true,
        smartSpeed: 1000,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut'
    });

    // Go to the next item
    $('.owl-next').click(function () {
        owl.trigger('next.owl.carousel', [900]);
    });
    // Go to the previous item
    $('.owl-prev').click(function () {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        owl.trigger('prev.owl.carousel', [900]);
    });

    // baner bg img set
    $(".owl-item.banner-item").each(function () {
        var Main = $(this).find('.item-bg img').attr('src');

        $(this).css({
            background: 'url(' + Main + ')'
        });
    });

    // prev and next
    function SliderArrow() {
        $('.owl-item').removeClass('prev next');

        var ActiveSlider = $('.banner-active .owl-item.active');
        ActiveSlider.next('.banner-active .owl-item').addClass('next');
        ActiveSlider.prev('.banner-active .owl-item').addClass('prev');

        var nextSlide = $('.banner-active .owl-item.next').find('.item-bg img').attr('src'),
            prevSlide = $('.banner-active .owl-item.prev').find('.item-bg img').attr('src');

        $('.banner-owl-nav .owl-prev').css({
            background: 'url(' + prevSlide + ')'
        });

        $('.banner-owl-nav .owl-next').css({
            background: 'url(' + nextSlide + ')'
        });
    }

    SliderArrow();

    owl.on('translated.owl.carousel', function () {
        SliderArrow();
    });
    // banner caption animation
    owl.on('translate.owl.carousel', function () {

        $('.banner-active .owl-item h4').removeClass('animated fadeInDown').hide();
        $('.banner-active .owl-item h3').removeClass('animated fadeInDown').hide();
        $('.banner-active .owl-item p').removeClass('animated fadeInDown').hide();
        $('.banner-active .owl-item a').removeClass('animated fadeInDown').hide();
    });

    owl.on('translated.owl.carousel', function () {

        $('.banner-active .owl-item.active h4').addClass('animated fadeInDown').show();
        $('.banner-active .owl-item.active h3').addClass('animated fadeInDown').show();
        $('.banner-active .owl-item.active p').addClass('animated fadeInDown').show();
        $('.banner-active .owl-item.active a').addClass('animated fadeInDown').show();
    });
    // single item slider
    var singleSlider = $('.single-slider');
    singleSlider.owlCarousel({
        items: 1,
        autoplay: true,
        loop: true,
        autoplayTimeout: 5000,
        smartSpeed: 2000,
    });
    // Testomonial slide
    var testimonialSlider = $('.testimonial-active');
    testimonialSlider.owlCarousel({
        items: 1,
        //		autoplay: true,
        autoplayTimeout: 6000,
        loop: true,
        dots: false,
        smartSpeed: 800,
        autoHeight: true,
        autoplayHoverPause: true
    });
    // blog slide
    var blogSlider = $('.blog-active');
    blogSlider.owlCarousel({
        items: 3,
        //		autoplay: true,
        autoplayTimeout: 5000,
        nav: false,
        dots: true,
        smartSpeed: 600,
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }

        }
    });
    // blog control
    $('.blog-next').on('click', function () {
        blogSlider.trigger('next.owl.carousel', [700]);
    });
    $('.blog-prev').on('click', function () {
        blogSlider.trigger('prev.owl.carousel', [700]);
    });

    // partner slide
    var partnerSlider = $('.partner-active');
    partnerSlider.owlCarousel({
        items: 5,
        autoplay: true,
        autoplayTimeout: 4000,
        navText: true,
        dots: true,
        loop: true,
        rtl: true,
        margin: 20,
        slideBy: 5,
        smartSpeed: 700,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2,
                slideBy: 2
            },
            576: {
                items: 2,
                slideBy: 2,
                margin: 10
            },
            768: {
                items: 4,
                slideBy: 4
            },
            992: {
                items: 5,
                slideBy: 5
            }

        }
    });
    //	partner Control
    $('.partner-next').on('click', function () {
        partnerSlider.trigger('next.owl.carousel', [700]);
    });
    $('.partner-prev').on('click', function () {
        partnerSlider.trigger('prev.owl.carousel', [700]);
    });

    // About video venobox
    $('.venobox-video').venobox({
        autoplay: true,
        closeColor: '#ffffff',
        spinner: 'double-bounce'
    });

    //venobox gallary images
    $('.venobox-image').venobox({});

    // Counter js
    //    $('.counter').counterUp({
    //        delay: 30,
    //        time: 2000
    //    });


    var waypoints = $('#counter-part').waypoint(function (direction) {
        $('.counting').each(function () {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 2000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    }, {
        triggerOnce: true,
        offset: '90%'
    });
    // Countdown
    var countDown = $('.countdown');
    countDown.countdown('2018/02/21 12:01:00', function (event) {
        $(this).html(event.strftime('' +
            '<span>%d</span> days ' +
            '<span>%H</span> hr ' +
            '<span>%M</span> min ' +
            '<span>%S</span> sec'));
    });

    /* Isotope js start */
    var grid = $(".grid");
    grid.isotope({
        itemSelector: '.grid-item',
        layoutMode: 'fitRows'
    })

    var filtercat = $('.filter-cato li');
    filtercat.on('click', function () {
        filtercat.removeClass('active');
        $(this).addClass('active');

        var selector = $(this).attr('data-filter');
        grid.isotope({
            filter: selector
        });
    });
    /* Isotope js end */

    // Parallax

    /* =============== Plugin js End ============== */
    $('#parallax-bg').stellar({
        verticalOffset: 70
    });
}(jQuery));
