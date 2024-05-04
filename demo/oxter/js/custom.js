$(function() {
    'use strict';
    var HtmlBody = $('html, body');


    $('[data-bg-image]').each(function() {
        var img = $(this).data('bg-image');
        $(this).css({
            background: 'url(' + img + ')',
        }).removeAttr('data-bg-image');
    });
    
    $('body').scrollspy({
		target: "#navigation",
		offset: 80
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

    /* ============================
                mooth Scroll 
        =============================== */
    $('a[href*="#"]:not([href="#').on('click', function() {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                HtmlBody.animate({
                    scrollTop: target.offset().top - 75
                }, 1000);
                return false;
            }
        }
    });
        

    /* =================================
                    Scrolling
    ======================================*/   
    /* ======================= Scroll functions js ================ */
    $(window).on("scroll", function() {
        var topFixed = $('.topFixed'),
            scrTop = $(window).scrollTop();
        if (scrTop > 0) {
            topFixed.addClass('top-fix');
        } else {
            topFixed.removeClass("top-fix");
        };

        if (scrTop > 200) {
			backtotop.fadeIn();
		} else {
			backtotop.fadeOut();
		}
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

    var backtotop = $("#backtotop");
	backtotop.on('click', function () {
		HtmlBody.animate({
			scrollTop: 0
		}, 2000);
	});

    /* ======================= Feature tabs ========================= */
    var tabItem = $('.f4-tabs');
    tabItem.on('click', function() {
        var tabSelect = $(this).attr('data-tabs');
        tabItem.removeClass('active');
        $(this).addClass('active');

        $('.tabs-result').removeClass('active');
        $('.' + tabSelect).addClass('active');
    });

    /* ======================= Action tabs ========================= */
    var tabList = $('.action-list li');
    tabList.on('click', function() {
        var tabSelect = $(this).attr('data-tabs');
        tabList.removeClass('active');
        $(this).addClass('active');

        $('.action-items').removeClass('active');
        $('.' + tabSelect).addClass('active');
    });

    /* ============================== FAQ js ============================= */
    // Head.first().next('.ans').slideDown();
    $('.accodian-js').each(function () {
        var $this = $(this);
        var head = $this.find('.head'),
            ans = $this.find('.ans');
        head.parent('.faq-item.active').find(ans).slideDown();
        head.on('click', function() {
            $(this).next().stop().slideToggle(500).parent('.faq-item').addClass('active');
            $(".faq-item .ans").not($(this).next()).slideUp(500).parent('.faq-item').removeClass('active');
        });
    });

    /* ============================== Bootstrap Progress Bar ============================= */
    var waypoints = $('.progress-bar').waypoint(function(direction) {
        $('.progressbar-v2 .progress .progress-bar').progressbar({ display_text: 'fill' });
        $('.progress .progress-bar').progressbar({ display_text: 'fill' });
    }, {
        offset: '90%'
    });

    /* ================================= Plugin JS ======================================*/
        var bannerfour = new Swiper('.banner-four', {
        loop: true,
        slidesPerView: 1,
        speed: 800,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 6000,
        },
    });

    var bannerSix = new Swiper('.banner-six', {
        loop: true,
        speed: 800,
        slidesPerView: 1,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 6000,
        },
    });

    var serviceCard = new Swiper('.service-card-active', {
        loop: true,
        slidesPerView: 4,
        speed: 800,
        autoplay: {
            delay: 8000,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            991: {
                slidesPerView: 3,
            },
            767: {
                slidesPerView: 2,
            },
            575: {
                slidesPerView: 1,
            }
        }
    });

    var blogOne = new Swiper('.blog-one', {
        loop: true,
        slidesPerView: 3,
        speed: 800,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 7000,
        },
        breakpoints: {
            991: {
                slidesPerView: 2, // from 991 to under will be sliderPerView 2 
            },
            575: {
                slidesPerView: 1,
            },
        },
    });

    var galleryOne = new Swiper('.gallery-one', {
        loop: true,
        slidesPerView: 3,
        speed: 800,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 3000,
        },
        centeredSlides: true,
        effect: 'coverflow',
        coverflowEffect: {
            rotate: 0,
            stretch: 80,
            depth: 300,
            modifier: 1,
            slideShadows: false,
        },
        breakpoints: {
            991: {
                slidesPerView: 2,
            },
            571: {
                slidesPerView: 1,
            }
        },
    });

    var testmonialOne = new Swiper('.testimonial-one', {
        loop: true,
        slidesPerView: 2,
        speed: 800,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 7000,
        },
        breakpoints: {
            767: {
                slidesPerView: 1,
            }
        }
    });

    var testimonialTwo = new Swiper('.testimonial-two', {
        loop: true,
        slidesPerView: 1,
        speed: 2000,
        // autoplay: {
        //     delay: 2000,
        //     disableOnInteraction: false,
        // },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    var galleryTwo = new Swiper('.gallery-two', {
        loop: true,
        slidesPerView: 1,
        speed: 2000,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.g2-button-next',
            prevEl: '.g2-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    var sPostImg = new Swiper('.s-post-img', {
        loop: true,
        slidesPerView: 1,
        speed: 800,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
        },
    });

/* ================================= Venobox JS ======================================*/
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

    /* ================================= Counter js ======================================*/
    $('.counting').counterUp({
        delay: 2,
        time: 1000
    });

});

/* ================================= Map activation ======================================*/
function initMap() {
    'use strict';
    var Location = {
        lat: 40.749278,
        lng: -73.985894
    };
    var Canvas = document.getElementById('map');
    var options = {
        center: Location,
        zoom: 16,
        scrollwheel: false
    };
    var map = new google.maps.Map(Canvas, options);

    var marker = new google.maps.Marker({
        position: Location,
        map: map,
        animation: google.maps.Animation.BOUNCE
    });
}
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJjdXN0b20uanMiXSwic291cmNlc0NvbnRlbnQiOlsiJChmdW5jdGlvbigpIHtcclxuICAgICd1c2Ugc3RyaWN0JztcclxuICAgIHZhciBIdG1sQm9keSA9ICQoJ2h0bWwsIGJvZHknKTtcclxuXHJcblxyXG4gICAgJCgnW2RhdGEtYmctaW1hZ2VdJykuZWFjaChmdW5jdGlvbigpIHtcclxuICAgICAgICB2YXIgaW1nID0gJCh0aGlzKS5kYXRhKCdiZy1pbWFnZScpO1xyXG4gICAgICAgICQodGhpcykuY3NzKHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogJ3VybCgnICsgaW1nICsgJyknLFxyXG4gICAgICAgIH0pLnJlbW92ZUF0dHIoJ2RhdGEtYmctaW1hZ2UnKTtcclxuICAgIH0pO1xyXG4gICAgXHJcbiAgICAkKCdib2R5Jykuc2Nyb2xsc3B5KHtcclxuXHRcdHRhcmdldDogXCIjbmF2aWdhdGlvblwiLFxyXG5cdFx0b2Zmc2V0OiA4MFxyXG5cdH0pO1xyXG5cclxuICAgIC8qIC0tLS0tLS0tLS0tLS0tLS0tLSBtb2JpbGUgYW5kIHNpZGUgYmFyIG1hbnUgLS0tLS0tLS0tLS0tLS0tLSAqL1xyXG4gICAgdmFyIEFjY29yZGlvbiA9IGZ1bmN0aW9uKGVsLCBtdWx0aXBsZSkge1xyXG4gICAgICAgIHRoaXMuZWwgPSBlbCB8fCB7fTtcclxuXHJcbiAgICAgICAgdGhpcy5tdWx0aXBsZSA9IG11bHRpcGxlIHx8IGZhbHNlO1xyXG5cclxuICAgICAgICAkKCcuZHJvcGRvd25saW5rJykucGFyZW50KCkuYWRkQ2xhc3MoJ2NhcmV0LWRyb3Bkb3duJyk7XHJcbiAgICAgICAgdmFyIGRyb3Bkb3dubGluayA9IHRoaXMuZWwuZmluZCgnLmRyb3Bkb3dubGluaycpO1xyXG4gICAgICAgIGRyb3Bkb3dubGluay5vbignY2xpY2snLCB7XHJcbiAgICAgICAgICAgICAgICBlbDogdGhpcy5lbCxcclxuICAgICAgICAgICAgICAgIG11bHRpcGxlOiB0aGlzLm11bHRpcGxlXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHRoaXMuZHJvcGRvd24pO1xyXG4gICAgfTtcclxuXHJcbiAgICBBY2NvcmRpb24ucHJvdG90eXBlLmRyb3Bkb3duID0gZnVuY3Rpb24oZSkge1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB2YXIgJGVsID0gZS5kYXRhLmVsLFxyXG4gICAgICAgICAgICAkdGhpcyA9ICQodGhpcyksXHJcblxyXG4gICAgICAgICAgICAkbmV4dCA9ICR0aGlzLm5leHQoKTtcclxuXHJcbiAgICAgICAgJG5leHQuc2xpZGVUb2dnbGUoKTtcclxuICAgICAgICAkdGhpcy5wYXJlbnQoKS50b2dnbGVDbGFzcygnb3BlbicpO1xyXG5cclxuICAgICAgICBpZiAoIWUuZGF0YS5tdWx0aXBsZSkge1xyXG4gICAgICAgICAgICAvL3Nob3cgb25seSBvbmUgbWVudSBhdCB0aGUgc2FtZSB0aW1lXHJcbiAgICAgICAgICAgICRlbC5maW5kKCcuc3VibWVudUl0ZW1zJykubm90KCRuZXh0KS5zbGlkZVVwKCkucGFyZW50KCkucmVtb3ZlQ2xhc3MoJ29wZW4nKTtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgdmFyIGFjY29yZGlvbiA9IG5ldyBBY2NvcmRpb24oJCgnLm1vYmlsZS1tYW51JyksIGZhbHNlKTtcclxuXHJcbiAgICAkKCcuc2Vjb25kLW5hdi10b2dnbGVyJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB2YXIgbWFzayA9ICc8ZGl2IGNsYXNzPVwibWFzay1vdmVybGF5XCI+JztcclxuXHJcbiAgICAgICAgJCgnYm9keScpLnRvZ2dsZUNsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgICAkKG1hc2spLmhpZGUoKS5hcHBlbmRUbygnYm9keScpLmZhZGVJbignZmFzdCcpO1xyXG4gICAgICAgICQoJy5tYXNrLW92ZXJsYXksIC5tb2JpbGUtbWFudS1jbG9zZScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICAkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICAgICAkKCcubWFzay1vdmVybGF5JykucmVtb3ZlKCk7XHJcbiAgICAgICAgfSk7XHJcbiAgICB9KTtcclxuXHJcbiAgICAvKiA9PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbiAgICAgICAgICAgICAgICBtb290aCBTY3JvbGwgXHJcbiAgICAgICAgPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PSAqL1xyXG4gICAgJCgnYVtocmVmKj1cIiNcIl06bm90KFtocmVmPVwiIycpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIGlmIChsb2NhdGlvbi5wYXRobmFtZS5yZXBsYWNlKC9eXFwvLywgJycpID09PSB0aGlzLnBhdGhuYW1lLnJlcGxhY2UoL15cXC8vLCAnJykgJiYgbG9jYXRpb24uaG9zdG5hbWUgPT09IHRoaXMuaG9zdG5hbWUpIHtcclxuICAgICAgICAgICAgdmFyIHRhcmdldCA9ICQodGhpcy5oYXNoKTtcclxuICAgICAgICAgICAgdGFyZ2V0ID0gdGFyZ2V0Lmxlbmd0aCA/IHRhcmdldCA6ICQoJ1tuYW1lPScgKyB0aGlzLmhhc2guc2xpY2UoMSkgKyAnXScpO1xyXG4gICAgICAgICAgICBpZiAodGFyZ2V0Lmxlbmd0aCkge1xyXG4gICAgICAgICAgICAgICAgSHRtbEJvZHkuYW5pbWF0ZSh7XHJcbiAgICAgICAgICAgICAgICAgICAgc2Nyb2xsVG9wOiB0YXJnZXQub2Zmc2V0KCkudG9wIC0gNzVcclxuICAgICAgICAgICAgICAgIH0sIDEwMDApO1xyXG4gICAgICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbiAgICAgICAgXHJcblxyXG4gICAgLyogPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbiAgICAgICAgICAgICAgICAgICAgU2Nyb2xsaW5nXHJcbiAgICA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PSovICAgXHJcbiAgICAvKiA9PT09PT09PT09PT09PT09PT09PT09PSBTY3JvbGwgZnVuY3Rpb25zIGpzID09PT09PT09PT09PT09PT0gKi9cclxuICAgICQod2luZG93KS5vbihcInNjcm9sbFwiLCBmdW5jdGlvbigpIHtcclxuICAgICAgICB2YXIgdG9wRml4ZWQgPSAkKCcudG9wRml4ZWQnKSxcclxuICAgICAgICAgICAgc2NyVG9wID0gJCh3aW5kb3cpLnNjcm9sbFRvcCgpO1xyXG4gICAgICAgIGlmIChzY3JUb3AgPiAwKSB7XHJcbiAgICAgICAgICAgIHRvcEZpeGVkLmFkZENsYXNzKCd0b3AtZml4Jyk7XHJcbiAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgdG9wRml4ZWQucmVtb3ZlQ2xhc3MoXCJ0b3AtZml4XCIpO1xyXG4gICAgICAgIH07XHJcblxyXG4gICAgICAgIGlmIChzY3JUb3AgPiAyMDApIHtcclxuXHRcdFx0YmFja3RvdG9wLmZhZGVJbigpO1xyXG5cdFx0fSBlbHNlIHtcclxuXHRcdFx0YmFja3RvdG9wLmZhZGVPdXQoKTtcclxuXHRcdH1cclxuICAgICAgICAkKCdbZGF0YS1wYXJhbGxheD1cImltYWdlXCJdJykuZWFjaChmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgdmFyIGFjdHVhbEhlaWdodCA9ICQodGhpcykucG9zaXRpb24oKS50b3A7XHJcbiAgICAgICAgICAgIHZhciBzcGVlZCA9ICQodGhpcykuZGF0YSgncGFyYWxsYXgtc3BlZWQnKTtcclxuICAgICAgICAgICAgdmFyIHJlU2l6ZSA9IGFjdHVhbEhlaWdodCAtICQod2luZG93KS5zY3JvbGxUb3AoKTtcclxuICAgICAgICAgICAgdmFyIG1ha2VQYXJhbGxheCA9IC0ocmVTaXplIC8gMik7XHJcbiAgICAgICAgICAgIHZhciBwb3NWYWx1ZSA9IG1ha2VQYXJhbGxheCArIFwicHhcIjtcclxuICAgICAgICAgICAgJCh0aGlzKS5jc3Moe1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZFBvc2l0aW9uOiAnNTAlICcgKyBwb3NWYWx1ZSxcclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfSk7XHJcbiAgICB9KTtcclxuXHJcbiAgICAkKCdbZGF0YS1wYXJhbGxheD1cImltYWdlXCJdJykuZWFjaChmdW5jdGlvbigpIHtcclxuICAgICAgICAkKHRoaXMpLmNzcyh7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmRTaXplOiAnY292ZXInLFxyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kUmVwZWF0OiAnbm8tcmVwZWF0JyxcclxuICAgICAgICB9KTtcclxuICAgIH0pO1xyXG5cclxuICAgIHZhciBiYWNrdG90b3AgPSAkKFwiI2JhY2t0b3RvcFwiKTtcclxuXHRiYWNrdG90b3Aub24oJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xyXG5cdFx0SHRtbEJvZHkuYW5pbWF0ZSh7XHJcblx0XHRcdHNjcm9sbFRvcDogMFxyXG5cdFx0fSwgMjAwMCk7XHJcblx0fSk7XHJcblxyXG4gICAgLyogPT09PT09PT09PT09PT09PT09PT09PT0gRmVhdHVyZSB0YWJzID09PT09PT09PT09PT09PT09PT09PT09PT0gKi9cclxuICAgIHZhciB0YWJJdGVtID0gJCgnLmY0LXRhYnMnKTtcclxuICAgIHRhYkl0ZW0ub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgdmFyIHRhYlNlbGVjdCA9ICQodGhpcykuYXR0cignZGF0YS10YWJzJyk7XHJcbiAgICAgICAgdGFiSXRlbS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgJCh0aGlzKS5hZGRDbGFzcygnYWN0aXZlJyk7XHJcblxyXG4gICAgICAgICQoJy50YWJzLXJlc3VsdCcpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgICAkKCcuJyArIHRhYlNlbGVjdCkuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgfSk7XHJcblxyXG4gICAgLyogPT09PT09PT09PT09PT09PT09PT09PT0gQWN0aW9uIHRhYnMgPT09PT09PT09PT09PT09PT09PT09PT09PSAqL1xyXG4gICAgdmFyIHRhYkxpc3QgPSAkKCcuYWN0aW9uLWxpc3QgbGknKTtcclxuICAgIHRhYkxpc3Qub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgdmFyIHRhYlNlbGVjdCA9ICQodGhpcykuYXR0cignZGF0YS10YWJzJyk7XHJcbiAgICAgICAgdGFiTGlzdC5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgJCh0aGlzKS5hZGRDbGFzcygnYWN0aXZlJyk7XHJcblxyXG4gICAgICAgICQoJy5hY3Rpb24taXRlbXMnKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgJCgnLicgKyB0YWJTZWxlY3QpLmFkZENsYXNzKCdhY3RpdmUnKTtcclxuICAgIH0pO1xyXG5cclxuICAgIC8qID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PSBGQVEganMgPT09PT09PT09PT09PT09PT09PT09PT09PT09PT0gKi9cclxuICAgIC8vIEhlYWQuZmlyc3QoKS5uZXh0KCcuYW5zJykuc2xpZGVEb3duKCk7XHJcbiAgICAkKCcuYWNjb2RpYW4tanMnKS5lYWNoKGZ1bmN0aW9uICgpIHtcclxuICAgICAgICB2YXIgJHRoaXMgPSAkKHRoaXMpO1xyXG4gICAgICAgIHZhciBoZWFkID0gJHRoaXMuZmluZCgnLmhlYWQnKSxcclxuICAgICAgICAgICAgYW5zID0gJHRoaXMuZmluZCgnLmFucycpO1xyXG4gICAgICAgIGhlYWQucGFyZW50KCcuZmFxLWl0ZW0uYWN0aXZlJykuZmluZChhbnMpLnNsaWRlRG93bigpO1xyXG4gICAgICAgIGhlYWQub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICQodGhpcykubmV4dCgpLnN0b3AoKS5zbGlkZVRvZ2dsZSg1MDApLnBhcmVudCgnLmZhcS1pdGVtJykuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICAgICAkKFwiLmZhcS1pdGVtIC5hbnNcIikubm90KCQodGhpcykubmV4dCgpKS5zbGlkZVVwKDUwMCkucGFyZW50KCcuZmFxLWl0ZW0nKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgfSk7XHJcbiAgICB9KTtcclxuXHJcbiAgICAvKiA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT0gQm9vdHN0cmFwIFByb2dyZXNzIEJhciA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PSAqL1xyXG4gICAgdmFyIHdheXBvaW50cyA9ICQoJy5wcm9ncmVzcy1iYXInKS53YXlwb2ludChmdW5jdGlvbihkaXJlY3Rpb24pIHtcclxuICAgICAgICAkKCcucHJvZ3Jlc3NiYXItdjIgLnByb2dyZXNzIC5wcm9ncmVzcy1iYXInKS5wcm9ncmVzc2Jhcih7IGRpc3BsYXlfdGV4dDogJ2ZpbGwnIH0pO1xyXG4gICAgICAgICQoJy5wcm9ncmVzcyAucHJvZ3Jlc3MtYmFyJykucHJvZ3Jlc3NiYXIoeyBkaXNwbGF5X3RleHQ6ICdmaWxsJyB9KTtcclxuICAgIH0sIHtcclxuICAgICAgICBvZmZzZXQ6ICc5MCUnXHJcbiAgICB9KTtcclxuXHJcbiAgICAvKiA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT0gUGx1Z2luIEpTID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09Ki9cclxuICAgICAgICB2YXIgYmFubmVyZm91ciA9IG5ldyBTd2lwZXIoJy5iYW5uZXItZm91cicsIHtcclxuICAgICAgICBsb29wOiB0cnVlLFxyXG4gICAgICAgIHNsaWRlc1BlclZpZXc6IDEsXHJcbiAgICAgICAgc3BlZWQ6IDgwMCxcclxuICAgICAgICBuYXZpZ2F0aW9uOiB7XHJcbiAgICAgICAgICAgIG5leHRFbDogJy5zd2lwZXItYnV0dG9uLW5leHQnLFxyXG4gICAgICAgICAgICBwcmV2RWw6ICcuc3dpcGVyLWJ1dHRvbi1wcmV2JyxcclxuICAgICAgICB9LFxyXG4gICAgICAgIGF1dG9wbGF5OiB7XHJcbiAgICAgICAgICAgIGRlbGF5OiA2MDAwLFxyXG4gICAgICAgIH0sXHJcbiAgICB9KTtcclxuXHJcbiAgICB2YXIgYmFubmVyU2l4ID0gbmV3IFN3aXBlcignLmJhbm5lci1zaXgnLCB7XHJcbiAgICAgICAgbG9vcDogdHJ1ZSxcclxuICAgICAgICBzcGVlZDogODAwLFxyXG4gICAgICAgIHNsaWRlc1BlclZpZXc6IDEsXHJcbiAgICAgICAgcGFnaW5hdGlvbjoge1xyXG4gICAgICAgICAgICBlbDogJy5zd2lwZXItcGFnaW5hdGlvbicsXHJcbiAgICAgICAgICAgIGNsaWNrYWJsZTogdHJ1ZSxcclxuICAgICAgICB9LFxyXG4gICAgICAgIGF1dG9wbGF5OiB7XHJcbiAgICAgICAgICAgIGRlbGF5OiA2MDAwLFxyXG4gICAgICAgIH0sXHJcbiAgICB9KTtcclxuXHJcbiAgICB2YXIgc2VydmljZUNhcmQgPSBuZXcgU3dpcGVyKCcuc2VydmljZS1jYXJkLWFjdGl2ZScsIHtcclxuICAgICAgICBsb29wOiB0cnVlLFxyXG4gICAgICAgIHNsaWRlc1BlclZpZXc6IDQsXHJcbiAgICAgICAgc3BlZWQ6IDgwMCxcclxuICAgICAgICBhdXRvcGxheToge1xyXG4gICAgICAgICAgICBkZWxheTogODAwMCxcclxuICAgICAgICB9LFxyXG4gICAgICAgIG5hdmlnYXRpb246IHtcclxuICAgICAgICAgICAgbmV4dEVsOiAnLnN3aXBlci1idXR0b24tbmV4dCcsXHJcbiAgICAgICAgICAgIHByZXZFbDogJy5zd2lwZXItYnV0dG9uLXByZXYnLFxyXG4gICAgICAgIH0sXHJcbiAgICAgICAgYnJlYWtwb2ludHM6IHtcclxuICAgICAgICAgICAgOTkxOiB7XHJcbiAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiAzLFxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICA3Njc6IHtcclxuICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDIsXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIDU3NToge1xyXG4gICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogMSxcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG5cclxuICAgIHZhciBibG9nT25lID0gbmV3IFN3aXBlcignLmJsb2ctb25lJywge1xyXG4gICAgICAgIGxvb3A6IHRydWUsXHJcbiAgICAgICAgc2xpZGVzUGVyVmlldzogMyxcclxuICAgICAgICBzcGVlZDogODAwLFxyXG4gICAgICAgIG5hdmlnYXRpb246IHtcclxuICAgICAgICAgICAgbmV4dEVsOiAnLnN3aXBlci1idXR0b24tbmV4dCcsXHJcbiAgICAgICAgICAgIHByZXZFbDogJy5zd2lwZXItYnV0dG9uLXByZXYnLFxyXG4gICAgICAgIH0sXHJcbiAgICAgICAgYXV0b3BsYXk6IHtcclxuICAgICAgICAgICAgZGVsYXk6IDcwMDAsXHJcbiAgICAgICAgfSxcclxuICAgICAgICBicmVha3BvaW50czoge1xyXG4gICAgICAgICAgICA5OTE6IHtcclxuICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDIsIC8vIGZyb20gOTkxIHRvIHVuZGVyIHdpbGwgYmUgc2xpZGVyUGVyVmlldyAyIFxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICA1NzU6IHtcclxuICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDEsXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgfSxcclxuICAgIH0pO1xyXG5cclxuICAgIHZhciBnYWxsZXJ5T25lID0gbmV3IFN3aXBlcignLmdhbGxlcnktb25lJywge1xyXG4gICAgICAgIGxvb3A6IHRydWUsXHJcbiAgICAgICAgc2xpZGVzUGVyVmlldzogMyxcclxuICAgICAgICBzcGVlZDogODAwLFxyXG4gICAgICAgIG5hdmlnYXRpb246IHtcclxuICAgICAgICAgICAgbmV4dEVsOiAnLnN3aXBlci1idXR0b24tbmV4dCcsXHJcbiAgICAgICAgICAgIHByZXZFbDogJy5zd2lwZXItYnV0dG9uLXByZXYnLFxyXG4gICAgICAgIH0sXHJcbiAgICAgICAgYXV0b3BsYXk6IHtcclxuICAgICAgICAgICAgZGVsYXk6IDMwMDAsXHJcbiAgICAgICAgfSxcclxuICAgICAgICBjZW50ZXJlZFNsaWRlczogdHJ1ZSxcclxuICAgICAgICBlZmZlY3Q6ICdjb3ZlcmZsb3cnLFxyXG4gICAgICAgIGNvdmVyZmxvd0VmZmVjdDoge1xyXG4gICAgICAgICAgICByb3RhdGU6IDAsXHJcbiAgICAgICAgICAgIHN0cmV0Y2g6IDgwLFxyXG4gICAgICAgICAgICBkZXB0aDogMzAwLFxyXG4gICAgICAgICAgICBtb2RpZmllcjogMSxcclxuICAgICAgICAgICAgc2xpZGVTaGFkb3dzOiBmYWxzZSxcclxuICAgICAgICB9LFxyXG4gICAgICAgIGJyZWFrcG9pbnRzOiB7XHJcbiAgICAgICAgICAgIDk5MToge1xyXG4gICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogMixcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgNTcxOiB7XHJcbiAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiAxLFxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSxcclxuICAgIH0pO1xyXG5cclxuICAgIHZhciB0ZXN0bW9uaWFsT25lID0gbmV3IFN3aXBlcignLnRlc3RpbW9uaWFsLW9uZScsIHtcclxuICAgICAgICBsb29wOiB0cnVlLFxyXG4gICAgICAgIHNsaWRlc1BlclZpZXc6IDIsXHJcbiAgICAgICAgc3BlZWQ6IDgwMCxcclxuICAgICAgICBwYWdpbmF0aW9uOiB7XHJcbiAgICAgICAgICAgIGVsOiAnLnN3aXBlci1wYWdpbmF0aW9uJyxcclxuICAgICAgICAgICAgY2xpY2thYmxlOiB0cnVlLFxyXG4gICAgICAgIH0sXHJcbiAgICAgICAgYXV0b3BsYXk6IHtcclxuICAgICAgICAgICAgZGVsYXk6IDcwMDAsXHJcbiAgICAgICAgfSxcclxuICAgICAgICBicmVha3BvaW50czoge1xyXG4gICAgICAgICAgICA3Njc6IHtcclxuICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDEsXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuXHJcbiAgICB2YXIgdGVzdGltb25pYWxUd28gPSBuZXcgU3dpcGVyKCcudGVzdGltb25pYWwtdHdvJywge1xyXG4gICAgICAgIGxvb3A6IHRydWUsXHJcbiAgICAgICAgc2xpZGVzUGVyVmlldzogMSxcclxuICAgICAgICBzcGVlZDogMjAwMCxcclxuICAgICAgICAvLyBhdXRvcGxheToge1xyXG4gICAgICAgIC8vICAgICBkZWxheTogMjAwMCxcclxuICAgICAgICAvLyAgICAgZGlzYWJsZU9uSW50ZXJhY3Rpb246IGZhbHNlLFxyXG4gICAgICAgIC8vIH0sXHJcbiAgICAgICAgcGFnaW5hdGlvbjoge1xyXG4gICAgICAgICAgICBlbDogJy5zd2lwZXItcGFnaW5hdGlvbicsXHJcbiAgICAgICAgICAgIGNsaWNrYWJsZTogdHJ1ZSxcclxuICAgICAgICB9LFxyXG4gICAgfSk7XHJcblxyXG4gICAgdmFyIGdhbGxlcnlUd28gPSBuZXcgU3dpcGVyKCcuZ2FsbGVyeS10d28nLCB7XHJcbiAgICAgICAgbG9vcDogdHJ1ZSxcclxuICAgICAgICBzbGlkZXNQZXJWaWV3OiAxLFxyXG4gICAgICAgIHNwZWVkOiAyMDAwLFxyXG4gICAgICAgIGF1dG9wbGF5OiB7XHJcbiAgICAgICAgICAgIGRlbGF5OiAyMDAwLFxyXG4gICAgICAgICAgICBkaXNhYmxlT25JbnRlcmFjdGlvbjogZmFsc2UsXHJcbiAgICAgICAgfSxcclxuICAgICAgICBuYXZpZ2F0aW9uOiB7XHJcbiAgICAgICAgICAgIG5leHRFbDogJy5nMi1idXR0b24tbmV4dCcsXHJcbiAgICAgICAgICAgIHByZXZFbDogJy5nMi1idXR0b24tcHJldicsXHJcbiAgICAgICAgfSxcclxuICAgICAgICBwYWdpbmF0aW9uOiB7XHJcbiAgICAgICAgICAgIGVsOiAnLnN3aXBlci1wYWdpbmF0aW9uJyxcclxuICAgICAgICAgICAgY2xpY2thYmxlOiB0cnVlLFxyXG4gICAgICAgIH0sXHJcbiAgICB9KTtcclxuXHJcbiAgICB2YXIgc1Bvc3RJbWcgPSBuZXcgU3dpcGVyKCcucy1wb3N0LWltZycsIHtcclxuICAgICAgICBsb29wOiB0cnVlLFxyXG4gICAgICAgIHNsaWRlc1BlclZpZXc6IDEsXHJcbiAgICAgICAgc3BlZWQ6IDgwMCxcclxuICAgICAgICBuYXZpZ2F0aW9uOiB7XHJcbiAgICAgICAgICAgIG5leHRFbDogJy5zd2lwZXItYnV0dG9uLW5leHQnLFxyXG4gICAgICAgICAgICBwcmV2RWw6ICcuc3dpcGVyLWJ1dHRvbi1wcmV2JyxcclxuICAgICAgICB9LFxyXG4gICAgICAgIGF1dG9wbGF5OiB7XHJcbiAgICAgICAgICAgIGRlbGF5OiA1MDAwLFxyXG4gICAgICAgIH0sXHJcbiAgICB9KTtcclxuXHJcbi8qID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PSBWZW5vYm94IEpTID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09Ki9cclxuICAgIHZhciBWaWRlbyA9ICQoJy52ZW5vLXZpZGVvJyksXHJcbiAgICBJbWFnZSA9ICQoJy52ZW5vLWltYWdlJylcclxuICAgIFZpZGVvLnZlbm9ib3goe1xyXG4gICAgICAgIGF1dG9wbGF5OiB0cnVlLFxyXG4gICAgICAgIHNwaW5uZXI6ICd0aHJlZS1ib3VuY2UnLFxyXG4gICAgICAgIGNsb3NlQ29sb3I6ICcjMzM5OWZmJ1xyXG4gICAgfSk7XHJcbiAgICBJbWFnZS52ZW5vYm94KHtcclxuICAgICAgICBzcGlubmVyOiAndGhyZWUtYm91bmNlJyxcclxuICAgICAgICBjbG9zZUNvbG9yOiAnIzMzOTlmZicsXHJcbiAgICAgICAgYXJyb3dzQ29sb3I6ICcjMzM5OWZmJ1xyXG4gICAgfSk7XHJcblxyXG4gICAgLyogPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09IENvdW50ZXIganMgPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT0qL1xyXG4gICAgJCgnLmNvdW50aW5nJykuY291bnRlclVwKHtcclxuICAgICAgICBkZWxheTogMixcclxuICAgICAgICB0aW1lOiAxMDAwXHJcbiAgICB9KTtcclxuXHJcbn0pO1xyXG5cclxuLyogPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09IE1hcCBhY3RpdmF0aW9uID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09Ki9cclxuZnVuY3Rpb24gaW5pdE1hcCgpIHtcclxuICAgICd1c2Ugc3RyaWN0JztcclxuICAgIHZhciBMb2NhdGlvbiA9IHtcclxuICAgICAgICBsYXQ6IDQwLjc0OTI3OCxcclxuICAgICAgICBsbmc6IC03My45ODU4OTRcclxuICAgIH07XHJcbiAgICB2YXIgQ2FudmFzID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ21hcCcpO1xyXG4gICAgdmFyIG9wdGlvbnMgPSB7XHJcbiAgICAgICAgY2VudGVyOiBMb2NhdGlvbixcclxuICAgICAgICB6b29tOiAxNixcclxuICAgICAgICBzY3JvbGx3aGVlbDogZmFsc2VcclxuICAgIH07XHJcbiAgICB2YXIgbWFwID0gbmV3IGdvb2dsZS5tYXBzLk1hcChDYW52YXMsIG9wdGlvbnMpO1xyXG5cclxuICAgIHZhciBtYXJrZXIgPSBuZXcgZ29vZ2xlLm1hcHMuTWFya2VyKHtcclxuICAgICAgICBwb3NpdGlvbjogTG9jYXRpb24sXHJcbiAgICAgICAgbWFwOiBtYXAsXHJcbiAgICAgICAgYW5pbWF0aW9uOiBnb29nbGUubWFwcy5BbmltYXRpb24uQk9VTkNFXHJcbiAgICB9KTtcclxufSJdLCJmaWxlIjoiY3VzdG9tLmpzIn0=
