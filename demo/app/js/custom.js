$(function() {
    "use strict";
    var windo = $(window),
        HtmlBody = $('html, body');

    windo.on('load', function () {
        $('.loader').fadeOut(1000).delay(500);
    });

    /* ------------------ mobile and side bar manu ---------------- */

    var Accordion = function(el, multiple) {
        this.el = el || {};

        this.multiple = multiple || false;

    $('.dropdownlink').parent().addClass('caret-dropdown');
    var dropdownlink = this.el.find('.dropdownlink');
    dropdownlink.on('click', {
            el: this.el,
            multiple: this.multiple
        },
        this.dropdown);
    };

    Accordion.prototype.dropdown = function(e) {
        e.preventDefault();
        var $el = e.data.el,
            $this = $(this),

            $next = $this.next();

        $next.slideToggle();
        $this.parent().toggleClass('open');

        if (!e.data.multiple) {
            //show only one menu at the same time
            $el.find('.submenuItems').not($next).slideUp().parent().removeClass('open');
        }
    }

    var accordion = new Accordion($('.mobile-manu'), false);

    $('.second-nav-toggler').on('click', function(e) {
        e.preventDefault();
        var mask = '<div class="mask-overlay">';

        $('body').toggleClass('active');
        $(mask).hide().appendTo('body').fadeIn('fast');
        $('.mask-overlay, .mobile-manu-close').on('click', function() {
            $('body').removeClass('active');
            $('.mask-overlay').remove();
        });
    });


    /* ======================= Scroll functions js ================ */
    windo.on("scroll", function() {
        var navigation = $('#navigation'),
            scrTop = windo.scrollTop();
        if (scrTop > 300) {
            navigation.addClass('top-fix');
        } else {
            navigation.removeClass("top-fix");
        };

        $('[data-parallax="image"]').each(function() {
            var actualHeight = $(this).position().top;
            var speed = $(this).data('parallax-speed');
            var reSize = actualHeight - $(window).scrollTop();
            var makeParallax = -(reSize / 2);
            var posValue = makeParallax + "px";
            $(this).css({
                backgroundPosition: '50% ' + posValue,
            });
        });
    });

     $('[data-parallax="image"]').each(function() {
        $(this).css({
            backgroundSize: 'cover',
            backgroundRepeat: 'no-repeat',
        });
    });

    /* ======================= FAQ js ================ */
    var Head = $('.head'),
        ans = $('.ans');
        // Head.first().next('.ans').slideDown();
        Head.parent('.item.active').find('.ans').slideDown();
    Head.on('click', function() {
        $(this).next().stop().slideToggle(500).parent('.item').addClass('active');
        $(".item .ans").not($(this).next()).slideUp(500).parent('.item').removeClass('active');
    });

    /* ======================== Nav Scrollspy ===================== */
    $('body').scrollspy({
        target: '#navigation',
        offset: 80
    })

    /* ============================ Smooth Scroll ===================== */
    $('a[href*="#"]:not([href="#').on('click', function() {
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
    
    /* ========================== bg images ========================== */
    $('[data-bg-image]').each(function() {
        var img = $(this).data('bg-image');
        $(this).css({
            background: 'url(' + img + ')',
        }).removeAttr('data-bg-image');
    });

    /* ======================= Feature tabs ========================= */
   

    /* ======================= Feature tabs ========================= */
    var tabItem = $('.sub-item');
    tabItem.on('click', function() {
        var tabSelect = $(this).attr('data-tabs');
        tabItem.removeClass('active');
        $(this).addClass('active');

        $('.main-feature').removeClass('active');
        $('.' + tabSelect).addClass('active');
    });

    /* =========================== Plugin Js =========================== */

    // Banner 3 js
    var banner3A = $('.banner-3-A');
    banner3A.owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 1000,
        nav: true,
        dots: false,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class ="fa fa-angle-right"></i>'],
    });

    // Banner 4 js
    var banner4A = $('.banner-4-A');
    banner4A.owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 1000,
        nav: true,
        dots: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class ="fa fa-angle-right"></i>'],
    });

    // game service 3 js
    var service2A = $('.service-2-A');
    service2A.owlCarousel({
        items: 4,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 1000,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            575: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            }
        }
    });

    // About Screen Shoot js
    var screentshotA = $('.screenshot-A');
    screentshotA.owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 1000,
        nav: true,
        dots: false,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class ="fa fa-angle-right"></i>'],
    });

    // Testimonial js
    var testimonialA = $('.testimonial-A');
    testimonialA.owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        nav: true,
        dots: false,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class ="fa fa-angle-right"></i>'],
        responsive: {
            768: {
                items: 2
            }
        }
    });

    // gallery slider
    var galleryA = $('.gallery-A');
    galleryA.owlCarousel({
        items: 5,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000, //default 5000
        smartSpeed: 600,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            575: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 5
            }
        }
    });

    var blogA = $('.blog-A');
    blogA.owlCarousel({
        items: 3,
        loop: true,
        autoplay: true,
        smartSpeed: 600,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            575: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });  

    var singlePostA = $('.s-post-img');
    singlePostA.owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 900,
        dots: false,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        nav: true
    });

    var partnerA = $('.partner-A');
    partnerA.owlCarousel({
        items: 5,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 900,
        dots: false,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 3
            },
            768: {
                items: 4
            },
            992: {
                items: 5
            }
        }
    });

    /* venobox js */
    var Video = $('.veno-video'),
        Image = $('.veno-image')
    Video.venobox({
        autoplay: true,
        spinner: 'three-bounce',
        closeColor: '#3399ff'
    });
    Image.venobox({
        spinner: 'three-bounce',
        closeColor: '#3399ff',
        arrowsColor: '#3399ff'
    });

    /* Counter js */
    $('.counting').counterUp({
        delay: 2,
        time: 1000
    });

    /* Wow animation */
    // $('.wow').css('visibility', 'hidden');
    // var wow = new WOW({
    //     offset: 80,
    //     mobile: false
    // });
    // wow.init();

    /* Magnific Popup*/
    
    //   var chartPopup = $('.popup-chart');
    // chartPopup.magnificPopup({
    //     type: 'inline',
    //     midClick: true,
    //     closeBtnInside: true
    // });

    /* ================================== Progress Bar =================================== */

    $('.progress').each(function () {
        var progressbarWidth = $(this).has('.progressbar-width-value').text();
        $(this).find('.progress-bar').css({
            width: progressbarWidth
        });
        console.log(progressbarWidth);
    });
    /* Plugin Js */
});

function initMap() {
    'use strict';
    var Location = {
        lat: 40.749278,
        lng: -73.985894
    };
    var Canvas = document.getElementById('map');
    var options = {
        center: Location,
        zoom: 18,
        scrollwheel: false
    };
    var map = new google.maps.Map(Canvas, options);

    var marker = new google.maps.Marker({
        position: Location,
        map: map,
        animation: google.maps.Animation.BOUNCE
    });

}