"use strict";

$.fn.customTab = function (tabContents) {
  var parent_active = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  var activeNav = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'active-tab';
  var activeContent = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 'active-content';
  var tabItem = this; // active = 'active-tab',
  // activeContent = 'active-content';

  $(tabContents).each(function () {
    /* Hide Content Item Without List active-tab item */
    if (!$(this).hasClass(activeContent)) {
      $(this).not($(tabItem).attr('href')).hide();
    }
  }); // for parent

  if (parent_active) {
    tabItem.each(function () {
      if ($(this).hasClass(activeNav)) {
        $(this).parent().addClass('active-tab-parent');
      }
    });
  } // $(tabItem.attr('href')).show();


  tabItem.on('click', function (e) {
    e.preventDefault();
    var $this = $(this),
        tabContentId = $this.attr('href'); // for parent

    if (parent_active) {
      tabItem.each(function () {
        $(this).parent().removeClass('active-tab-parent');
      });
    }

    if (!$this.hasClass(activeNav)) {
      // tab
      tabItem.removeClass(activeNav);
      $this.addClass(activeNav); // for parent

      if (parent_active) {
        $this.parent().addClass('active-tab-parent');
      } // tab content


      $(tabContents).removeClass(activeContent).hide();
      $(tabContentId).addClass(activeContent).fadeIn('show');
    }
  });
};
/*  ========================== click Toggle fucntion ============================ */


$.fn.customClickToggle = function (content) {
  var fade = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  var clicker = this;
  var newContent = $(content);
  newContent.slideUp();
  clicker.on('click', function () {
    if (fade == true) {
      newContent.stop().fadeToggle('show');
    } else {
      newContent.stop().slideToggle('show');
    }
  });
};
/* ===================================== Image Average Color Pick Replace First Later Background Color ============================= */


function getAverageRGB(imgEl) {
  var blockSize = 5,
      // only visit every 5 pixels
  defaultRGB = {
    r: 0,
    g: 0,
    b: 0
  },
      // for non-supporting envs
  canvas = document.createElement('canvas'),
      context = canvas.getContext && canvas.getContext('2d'),
      data,
      width,
      height,
      i = -4,
      length,
      rgb = {
    r: 0,
    g: 0,
    b: 0
  },
      count = 0;

  if (!context) {
    return defaultRGB;
  }

  height = canvas.height = imgEl.naturalHeight || imgEl.offsetHeight || imgEl.height;
  width = canvas.width = imgEl.naturalWidth || imgEl.offsetWidth || imgEl.width;
  context.drawImage(imgEl, 0, 0); // console.log(context.drawImage(imgEl, 0, 0));

  try {
    data = context.getImageData(0, 0, width, height);
  } catch (e) {
    // /* security error, img on diff domain */alert('x');
    return defaultRGB;
  }

  length = data.data.length;

  while ((i += blockSize * 4) < length) {
    ++count;
    rgb.r += data.data[i];
    rgb.g += data.data[i + 1];
    rgb.b += data.data[i + 2];
  } // ~~ used to floor values


  rgb.r = ~~(rgb.r / count);
  rgb.g = ~~(rgb.g / count);
  rgb.b = ~~(rgb.b / count);
  return rgb;
}

$.fn.getImageColor = function () {
  $(this).each(function () {
    var $this = $(this);
    var imgSelect = $this.find('.item-img a img'); // console.log(imgSelect);

    imgSelect.map(function (index, item) {
      var rgb = getAverageRGB(item); // console.log(item);
      // console.log('index ', index , ' ', 'rgb('+rgb.r+','+rgb.g+','+rgb.b+')');

      $this.find('.first-letter').css('background', 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')');
    });
  });
};
"use strict";

/* ========================================== Document Ready =========================== */
$(document).ready(function () {
  // Global Variables
  var $window = $(window); // inline to background image

  $('[data-bg-image]').each(function () {
    var img = $(this).data('bg-image');
    $(this).css({
      background: 'url(' + img + ')'
    }); // .removeAttr('data-bg-image')
  });
  $('[data-bg-color]').each(function () {
    var color = $(this).data('bg-color');
    $(this).css({
      background: color
    }); // .removeAttr('data-bg-color')
  });
  /* ======================= Navbar sticky ======================= */

  var headerNavbarWrap = $('.im-header-sticky-js');
  var navbarOffsetTop = headerNavbarWrap.offset().top;
  var navbarClintHeight = headerNavbarWrap.height(); // console.log(headerNavbarWrapElement);
  // console.log(navbarScrollHeight);
  // console.log(navbarClintHeight);
  // console.log(headerNavbarWrap.height());

  $window.on('scroll', function () {
    if ($window.scrollTop() > navbarOffsetTop) {
      headerNavbarWrap.css('height', navbarClintHeight).children().addClass('im-fixed-sticky');
    } else {
      headerNavbarWrap.children().removeClass('im-fixed-sticky');
    }
  }); // $('body').on('resize', function() {
  //     if (document.body.clientHeight > document.body.clientHeight || document.body.clientHeight < document.body.clientHeight) {
  //         console.log("window Resize",  document.body.clientHeight);
  //     }
  //     console.log("document",  document.body.clientHeight);
  // });
  // // console.log("window height",  $window.height());
  // console.log("document",  document.body.clientHeight);

  /* ------------------ Mobile Sidebar Manu ---------------- */

  var Accordion = function Accordion(el, multiple) {
    this.el = el || {};
    this.multiple = multiple || false;
    $('.dropdownlink').parent().addClass('caret-dropdown');
    var dropdownlink = this.el.find('.dropdownlink');
    dropdownlink.on('click', {
      el: this.el,
      multiple: this.multiple
    }, this.dropdown);
  };

  Accordion.prototype.dropdown = function (e) {
    e.preventDefault();
    var $el = e.data.el,
        $this = $(this),
        $next = $this.next();
    $next.slideToggle();
    $this.parent().toggleClass('open');

    if (!e.data.multiple) {
      // Show only one menu at the same time
      $el.find('.submenuItems').not($next).slideUp().parent().removeClass('open');
    }
  };

  var accordion = new Accordion($('.im-mobile-menu-js'), false);
  $('.im-mobile-menu-caller-js').on('click', function (e) {
    e.preventDefault();
    var mask = '<div class="mask-overlay">';
    $('body').toggleClass('active');
    $(mask).hide().appendTo('body').fadeIn('fast');
    $('.mask-overlay, .im-mobile-menu-close-js').on('click', function () {
      $('body').removeClass('active');
      $('.mask-overlay').fadeOut().remove();
    });
  });
  /* ------------------ Mobile Sidebar Menu ---------------- */

  var accordionOffcanvas = new Accordion($('.im-offcanvas-menu-js'), false);
  $('.im-offcanvas-btn-js').on('click', function (e) {
    e.preventDefault();
    var mask = '<div class="mask-overlay">';
    $('body').toggleClass('active');
    $(mask).hide().appendTo('body').fadeIn('fast');
    $('.mask-overlay, .im-offcanvas-menu-close-js').on('click', function () {
      $('body').removeClass('active');
      $('.mask-overlay').fadeOut().remove();
    });
  });
  /* ------------------ compare Sidebar Menu ---------------- */

  $('.im-compare-pop-btn-js').on('click', function (e) {
    e.preventDefault();
    var mask = '<div class="mask-overlay">';
    $('body').toggleClass('compare-sidebar-active');
    $(mask).hide().appendTo('body').fadeIn('fast');
    $('.mask-overlay, .im-compare-sidebar-close-js').on('click', function () {
      $('body').removeClass('compare-sidebar-active');
      $('.mask-overlay').fadeOut().remove();
    });
  });
  /* ==================== click toggle function ==================== */
  // Language Click

  var langClicker = $('.header-lang-js');
  langClicker.customClickToggle('.header-lang-wrap-js'); // Form Click Fucntion

  var searchClicker = $('.header-search-icon-js');
  searchClicker.on('click', function () {
    $(this).toggleClass('show');
    $('.header-search-form-wrap-js').animate({
      width: 'toggle'
    }, 700);
  }); // searchClicker.customClickToggle('.header-search-form-wrap-js', {
  //     fade: true,
  // });

  /* Ads Pop Up Hiding */

  var adsPopRemoveButton = $('.im-popup-ads .remove_btn');
  adsPopRemoveButton.on('click', function () {
    $('.im-popup-ads').slideUp('show');
  }); // /* Benchmark Tab */

  var benchmarkCatItem = $('.benchmark-category-js li a');
  benchmarkCatItem.customTab('.beachmark-product-item-js');
  var runingProductCatItem = $('.im-runing-tab-navbar-list-js li a');
  runingProductCatItem.customTab('.im-runing-tab-item-js');
  /* Product Detail Tab */
  // var productDetalsTab = $('.im-tab2-navbar-js li a');
  // productDetalsTab.customTab('.im-tab2-items-js');

  $('.im-price-history-market li a').customTab('.im-price-full-chart-content .im-price-full-chart-item');
  $('.im-price-filter-time li a').customTab('.im-price-history-chart-content .im-price-history-chart');
  $('.im-feature-product-2-navbar-js li a').customTab('.im-feature-2-tab-content-js .product-item'); //// Feature Product click

  $('.im-feature-tab-navbar-js li a').customTab('.im-feature-tab-content .content-item', function () {
    var parent_active = true;
  }); //// Comapre product sidebar

  $('.im-compare-sidebar-navbar-js li a').customTab('.im-compare-tab-contact-js .tab-item'); // =========================== Star Counting

  var rangeSlider = function rangeSlider() {
    var slider = $('.im-range-slider'),
        range = $('.im-range-slider-range'),
        value = $('.im-range-slider-value');
    slider.each(function () {
      value.each(function () {
        var value = $(this).prev().attr('value');
        $(this).html(value);
      });
      range.on('input', function () {
        $(this).next(value).html(this.value);
      });
    });
  };

  rangeSlider(); // Filtering Js

  var filterItem = $('.filter-for-view button');
  filterItem.on('click', function () {
    var $this = $(this);
    filterItem.not($this).removeClass('active');

    if ($this.hasClass('im-grid-filter-js')) {
      $this.addClass('active');
      $('.im-for-view-js').removeClass('im-list-view').addClass('im-grid-view');
    } else if ($this.hasClass('im-list-filter-js')) {
      $this.addClass('active');
      $('.im-for-view-js').removeClass('im-grid-view').addClass('im-list-view');
    }
  });
  var counterJs = $('.count-js'); // counterJs.each(function () {
  //     // Plugin Name Counter Js
  //     $(this).counterUp({
  //         delay: 10,
  //         time: 2000
  //     });
  // });

  var staickySidebar = $('.widget-sticky');
  staickySidebar.stick_in_parent({
    offset_top: 75
  });
  /* ====================== Product review Progress bar ====================== */

  /* ----------------------------- Bootstrap ProgressBar ------------------------------- */

  var waypoints = $('.progress-bar').waypoint(function (direction) {
    $('.progress .progress-bar').progressbar({
      display_text: 'fill'
    });
    $('.progress .progress-bar').progressbar({
      display_text: 'fill'
    });
  }, {
    offset: '140%'
  });
  $(".im-counting-progress").knob({
    width: '20',
    height: '20',
    bgColor: '#d7d7d7',
    fgColor: '#01bd1b',
    readOnly: true,
    lineCap: 'round'
  });
  /* ======================== Veno Box ========================= */
  // Video Pop up

  var videoPopUpVenobox = $('.im-video-pop-js');
  videoPopUpVenobox.venobox({
    autoplay: true,
    spinner: 'double-bounce'
  });
  /* ==================== Slick SliderActive ================== */
  // Widget Top Comment

  $('.im-banner-slider-js').slick({
    // plugin Name: Slick Carousel, for Home Product banner
    autoplay: false,
    autoplaySpeed: 5000,
    dots: false,
    arrows: false,
    infinite: true,
    speed: 700,
    slidesToShow: 1,
    slidesToScroll: 1
  }); // Widget Top Comment

  var sidebarCommentSlier = $('.im-widget-top-comment-active-js');
  sidebarCommentSlier.each(function () {
    sidebarCommentSlier.slick({
      autoplay: true,
      autoplaySpeed: 5000,
      dots: true,
      arrows: false,
      infinite: true,
      speed: 700,
      slidesToShow: 1,
      slidesToScroll: 1
    });
  }); // Widget Coupon

  var sidebarCouponSlider = $('.widget-coupon-active');
  sidebarCouponSlider.each(function () {
    sidebarCouponSlider.slick({
      autoplay: true,
      autoplaySpeed: 5000,
      dots: false,
      arrows: true,
      prevArrow: '.widget-coupon-arrows .arrow-prev',
      nextArrow: '.widget-coupon-arrows .arrow-next',
      infinite: true,
      speed: 700,
      slidesToShow: 1,
      slidesToScroll: 1
    });
  }); // Widget Coupon

  $('.widget-pros-active').slick({
    autoplay: true,
    autoplaySpeed: 5000,
    dots: false,
    arrows: true,
    prevArrow: '.widget-pros-arrows .arrow-prev',
    nextArrow: '.widget-pros-arrows .arrow-next',
    infinite: true,
    speed: 700,
    slidesToShow: 1,
    slidesToScroll: 1
  }); // Review Item slider

  $('.review-slider-active').slick({
    autoplay: true,
    autoplaySpeed: 5000,
    fade: true,
    dots: false,
    arrows: true,
    prevArrow: '.review-arrows .arrow-prev',
    nextArrow: '.review-arrows .arrow-next',
    infinite: true,
    speed: 700,
    slidesToShow: 1,
    slidesToScroll: 1
  });
  $('.review-slider-2-active').slick({
    autoplay: true,
    autoplaySpeed: 5000,
    fade: true,
    dots: false,
    arrows: true,
    prevArrow: '.review-arrows-2 .arrow-prev',
    nextArrow: '.review-arrows-2 .arrow-next',
    infinite: true,
    speed: 700,
    slidesToShow: 1,
    slidesToScroll: 1
  });
  var productSliderWrap = $('.im-product-slider-wrap-js');
  productSliderWrap.slick({
    // plugin: Slick, Product Slider in BEST PRODUCT PROMOTIONS OF THE WEEK of 'Home-Product' page
    autoplay: true,
    autoplaySpeed: 5000,
    fade: true,
    dots: false,
    arrows: true,
    prevArrow: '.im-el-product-slider .arrow-prev',
    nextArrow: '.im-el-product-slider .arrow-next',
    infinite: true,
    speed: 700,
    slidesToShow: 1,
    slidesToScroll: 1,
    lazyLoad: 'ondemand'
  });
  $('.im-product-full-wrap-js').slick({
    autoplay: false,
    autoplaySpeed: 5000,
    // fade: true,
    dots: false,
    arrows: false,
    // prevArrow: '.review-arrows-2 .arrow-prev',
    // nextArrow: '.review-arrows-2 .arrow-next',
    infinite: true,
    speed: 700,
    slidesToShow: 5,
    slidesToScroll: 5,
    responsive: [{
      breakpoint: 1399,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 4
      }
    }, {
      breakpoint: 1199,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3
      }
    }, {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }, {
      breakpoint: 575,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  });
  $('.im-big-offer-item-js').slick({
    autoplay: true,
    autoplaySpeed: 5000,
    // fade: true,
    dots: false,
    arrows: false,
    infinite: true,
    speed: 700,
    slidesToShow: 1,
    slidesToScroll: 1
  });
  $('.im-product-gallery').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    infinite: true,
    dots: false,
    draggable: false,
    autoplay: false,
    autoplaySpeed: 2000,
    asNavFor: '.im-product-gallery-thumb'
  });
  $('.im-product-gallery-thumb').slick({
    slidesToShow: 5,
    slidesToScroll: 5,
    asNavFor: '.im-product-gallery',
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    arrows: false,
    responsive: [{
      breakpoint: 768,
      settings: {
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 576,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    }]
  }); // Reviews rating

  $('.im-rating-market-js').slick({
    slidesToShow: 6,
    slidesToScroll: 6,
    arrows: false,
    // prevArrow: '.testi_prev',
    // nextArrow: '.testi_next',
    // fade: true,
    infinite: true,
    dots: false,
    autoplay: true,
    autoplaySpeed: 4000,
    responsive: [{
      breakpoint: 1200,
      settings: {
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4
      }
    }, {
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3
      }
    }, {
      breakpoint: 768,
      settings: {
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }, {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  }); // Reviews rating

  $('.im-rating-market-js-review').slick({
    slidesToShow: 6,
    slidesToScroll: 6,
    arrows: false,
    infinite: true,
    dots: false,
    autoplay: true,
    autoplaySpeed: 4000,
    responsive: [{
      breakpoint: 1200,
      settings: {
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4
      }
    }, {
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3
      }
    }, {
      breakpoint: 768,
      settings: {
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }, {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  }); // Reviews rating

  $('.im-partner-slider-wrap-js').slick({
    ////  'Slick Slider' For Partner Slider
    slidesToShow: 6,
    slidesToScroll: 6,
    arrows: true,
    prevArrow: '.partner-slider-prev',
    nextArrow: '.partner-slider-next',
    // fade: true,
    infinite: true,
    dots: false,
    autoplay: true,
    autoplaySpeed: 4000,
    speed: 700,
    responsive: [{
      breakpoint: 1200,
      settings: {
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4
      }
    }, {
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3
      }
    }, {
      breakpoint: 768,
      settings: {
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }, {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  });
  /* ======================= Product Compare ============================= */

  $('.im-compare-product-js').slick({
    slidesToShow: 4,
    slidesToScroll: 4,
    arrows: false,
    infinite: false,
    dots: false,
    autoplay: true,
    autoplaySpeed: 4000,
    responsive: [{
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3
      }
    }, {
      breakpoint: 992,
      settings: {
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }, {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  });
  $('.im-compare-market-js').slick({
    slidesToShow: 4,
    slidesToScroll: 4,
    arrows: true,
    prevArrow: '.market-compare-arrows .arrow-prev',
    nextArrow: '.market-compare-arrows .arrow-next',
    infinite: false,
    dots: false,
    autoplay: false,
    autoplaySpeed: 4000,
    responsive: [{
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3
      }
    }, {
      breakpoint: 992,
      settings: {
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }, {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  }); // For height Matching

  $.fn.SAME_HEIGHT = function () {
    var selector = this;
    var heights = []; // Save the heights of every element into an array

    selector.each(function () {
      var height = $(this).height();
      heights.push(height);
    }); // Get the biggest height

    var maxHeight = Math.max.apply(null, heights); // Set the maxHeight to every selected element

    selector.each(function () {
      $(this).height(maxHeight);
    });
  }; // Compare chart table row make equal height.


  var totalRow = $('.compare-title li').length;

  for (var i = 0; i <= totalRow; i++) {
    $('.table-row-' + i).SAME_HEIGHT();
  }

  $(window).resize(function () {
    for (var i = 0; i <= totalRow; i++) {
      $('.table-row-' + i).SAME_HEIGHT();
    }
  });
  /* =====================================  By Jquery Ui ============================= */
  // ==== Filter Page Number

  var uiNumberJs = $(".number-js");
  uiNumberJs.selectmenu().selectmenu("menuWidget").addClass("im-filter-dropdown-manu");
  $(".date-js").selectmenu().selectmenu("menuWidget").addClass("im-filter-date-dropdown-manu");
  $(".im-header-form-select-js").selectmenu().selectmenu("menuWidget").addClass("im-header-form-select-dropdown"); // Big Search 

  $(".im-big-search-select-js").selectmenu().selectmenu("menuWidget").addClass("im-big-search-select-dropdown"); // Widget Filter

  $(".im-filter-market-list-js").selectable();
  $(".im-filter-color-list-js").selectable(); // __price
  // $('.filter-price-wrap .price-range').hide();

  $('.widget-filter-price-submit').hide();
  $(".widget-filter-min-price, .widget-filter-max-price").on('change', function () {
    $('.widget-filter-price-submit').shoe();
    var min_price_range = parseInt($(".widget-filter-min-price").val());
    var max_price_range = parseInt($(".widget-filter-max-pricee").val());

    if (min_price_range > max_price_range) {
      $('.widget-filter-max-price').val(min_price_range);
    }

    $(".im-price-filter-range-js").slider({
      values: [min_price_range, max_price_range]
    });
  });
  $(".widget-filter-min-price, .widget-filter-max-price").on("paste keyup", function () {
    $('.widget-filter-price-submit').show();
    var min_price_range = parseInt($(".widget-filter-min-price").val());
    var max_price_range = parseInt($(".widget-filter-max-price").val());

    if (min_price_range == max_price_range) {
      max_price_range = min_price_range + 100;
      $(".widget-filter-min-price").val(min_price_range);
      $(".widget-filter-max-price").val(max_price_range);
    }

    $(".im-price-filter-range-js").slider({
      values: [min_price_range, max_price_range]
    });
  });
  $(function () {
    $(".im-price-filter-range-js").slider({
      range: true,
      orientation: "horizontal",
      min: 0,
      max: 10000,
      values: [0, 10000],
      step: 100,
      slide: function slide(event, ui) {
        if (ui.values[0] == ui.values[1]) {
          return false;
        }

        $(".widget-filter-min-price").val(ui.values[0]);
        $(".widget-filter-max-price").val(ui.values[1]);
      }
    });
    $(".widget-filter-min-price").val($(".im-price-filter-range-js").slider("values", 0));
    $(".widget-filter-max-price").val($(".im-price-filter-range-js").slider("values", 1));
  });
  var currentMinPrice = $('.widget-filter-min-price').val();
  var currentMaxPrice = $('.widget-filter-max-price').val();
  console.log(currentMinPrice);
  $(".min-price").text(currentMinPrice);
  $(".max-price").text(currentMaxPrice);
  $(".im-price-filter-range-js").on('click', function () {
    $(".min-price").text(currentMinPrice);
    $(".max-price").text(currentMaxPrice);
  });
  /* ===================================== Image Average Color Pick Replace First Later Background Color ============================= */
  // Home Review Page Review Item 

  var homeReviewItem = $('.im-review-content .review-item-wrap .review-item'); // Review Page

  var reviewReviewItem = $('.im-grid-view .review-row .review-item'); // Single Slider 

  var singelProductSlider = $('.im-el-product-slider .product-slider-wrap .slider-item');
  homeReviewItem.getImageColor();
  singelProductSlider.getImageColor();
  reviewReviewItem.getImageColor();
});
var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/

x = document.getElementsByClassName("select-label-js");

for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/

  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/

  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");

  for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function (e) {
      /*when an item is clicked, update the original select box,
      and the selected item:*/
      var y, i, k, s, h;
      s = this.parentNode.parentNode.getElementsByTagName("select")[0];
      h = this.parentNode.previousSibling;

      for (i = 0; i < s.length; i++) {
        if (s.options[i].innerHTML == this.innerHTML) {
          s.selectedIndex = i;
          h.innerHTML = this.innerHTML;
          y = this.parentNode.getElementsByClassName("same-as-selected");

          for (k = 0; k < y.length; k++) {
            y[k].removeAttribute("class");
          }

          this.setAttribute("class", "same-as-selected");
          break;
        }
      }

      h.click();
    });
    b.appendChild(c);
  }

  x[i].appendChild(b);
  a.addEventListener("click", function (e) {
    /*when the select box is clicked, close any other select boxes,
    and open/close the current select box:*/
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x,
      y,
      i,
      arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");

  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i);
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }

  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/


document.addEventListener("click", closeAllSelect);
"use strict";

/* ======================= Product Review Chart Bg Red ========================== */
var barChartHorizontal = document.querySelector(".bar-chart-horizontal");

if (barChartHorizontal) {
  var barChartHorizontal = barChartHorizontal.getContext('2d');
  new Chart(barChartHorizontal, {
    type: 'horizontalBar',
    backgroundColor: '#000000',
    responsive: true,
    data: {
      labels: ["MACBOOK PRO", "MACBOOK AIR", "SUREFAKE PRO", "LENOVO CBOOK", "NAVBIA SHEILD", "HP Stream", "Supernob Pro", "Air Pad 4"],
      datasets: [{
        label: "",
        backgroundColor: "rgba(0,0,0, .5",
        data: [15, 14, 13, 11, 9, 7, 5, 3, 16],
        borderWidth: 1
      }]
    },
    options: {
      // 	legend: { display: false },
      // 	title: {
      // 		display: true,
      // 		text: 'Predicted world population (millions) in 2050'
      // 	}
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          ticks: {
            fontColor: "#000000",
            fontSize: 14,
            stepSize: 1,
            beginAtZero: true
          }
        }],
        xAxes: [{
          ticks: {
            fontColor: "#000000",
            fontSize: 15,
            stepSize: 1,
            beginAtZero: true
          }
        }]
      }
    }
  });
}

;
/* ======================= Product Chart Tab Charts ========================== */
//  ========== Epay

var ctx = document.getElementById("im-chart-epay-caller-1");

if (ctx) {
  var ctx = ctx.getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["2008", "2010", "2012", "2014", "2016", "2018"],
      datasets: [{
        label: 'PRICE CHART',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
        borderColor: ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
}

;
var ctx = document.getElementById("im-chart-epay-caller-2");

if (ctx) {
  var ctx = ctx.getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["2008", "2010", "2012", "2014", "2016", "2018"],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
        borderColor: ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
}

; // ============= Uliexpress

var ctx = document.getElementById("im-chart-uliexpress-caller-1");

if (ctx) {
  var ctx = ctx.getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["2008", "2010", "2012", "2014", "2016", "2018"],
      datasets: [{
        label: 'PRICE CHART',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
        borderColor: ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
}

;
var ctx = document.getElementById("im-chart-uliexpress-caller-2");

if (ctx) {
  var ctx = ctx.getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["2008", "2010", "2012", "2014", "2016", "2018"],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
        borderColor: ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
}

;
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImN1c3RvbS1wbHVnaW4uanMiLCJjdXN0b20uanMiLCJjaGFydC5qcyJdLCJuYW1lcyI6WyIkIiwiZm4iLCJjdXN0b21UYWIiLCJ0YWJDb250ZW50cyIsInBhcmVudF9hY3RpdmUiLCJhY3RpdmVOYXYiLCJhY3RpdmVDb250ZW50IiwidGFiSXRlbSIsImVhY2giLCJoYXNDbGFzcyIsIm5vdCIsImF0dHIiLCJoaWRlIiwicGFyZW50IiwiYWRkQ2xhc3MiLCJvbiIsImUiLCJwcmV2ZW50RGVmYXVsdCIsIiR0aGlzIiwidGFiQ29udGVudElkIiwicmVtb3ZlQ2xhc3MiLCJmYWRlSW4iLCJjdXN0b21DbGlja1RvZ2dsZSIsImNvbnRlbnQiLCJmYWRlIiwiY2xpY2tlciIsIm5ld0NvbnRlbnQiLCJzbGlkZVVwIiwic3RvcCIsImZhZGVUb2dnbGUiLCJzbGlkZVRvZ2dsZSIsImdldEF2ZXJhZ2VSR0IiLCJpbWdFbCIsImJsb2NrU2l6ZSIsImRlZmF1bHRSR0IiLCJyIiwiZyIsImIiLCJjYW52YXMiLCJkb2N1bWVudCIsImNyZWF0ZUVsZW1lbnQiLCJjb250ZXh0IiwiZ2V0Q29udGV4dCIsImRhdGEiLCJ3aWR0aCIsImhlaWdodCIsImkiLCJsZW5ndGgiLCJyZ2IiLCJjb3VudCIsIm5hdHVyYWxIZWlnaHQiLCJvZmZzZXRIZWlnaHQiLCJuYXR1cmFsV2lkdGgiLCJvZmZzZXRXaWR0aCIsImRyYXdJbWFnZSIsImdldEltYWdlRGF0YSIsImdldEltYWdlQ29sb3IiLCJpbWdTZWxlY3QiLCJmaW5kIiwibWFwIiwiaW5kZXgiLCJpdGVtIiwiY3NzIiwicmVhZHkiLCIkd2luZG93Iiwid2luZG93IiwiaW1nIiwiYmFja2dyb3VuZCIsImNvbG9yIiwiaGVhZGVyTmF2YmFyV3JhcCIsIm5hdmJhck9mZnNldFRvcCIsIm9mZnNldCIsInRvcCIsIm5hdmJhckNsaW50SGVpZ2h0Iiwic2Nyb2xsVG9wIiwiY2hpbGRyZW4iLCJBY2NvcmRpb24iLCJlbCIsIm11bHRpcGxlIiwiZHJvcGRvd25saW5rIiwiZHJvcGRvd24iLCJwcm90b3R5cGUiLCIkZWwiLCIkbmV4dCIsIm5leHQiLCJ0b2dnbGVDbGFzcyIsImFjY29yZGlvbiIsIm1hc2siLCJhcHBlbmRUbyIsImZhZGVPdXQiLCJyZW1vdmUiLCJhY2NvcmRpb25PZmZjYW52YXMiLCJsYW5nQ2xpY2tlciIsInNlYXJjaENsaWNrZXIiLCJhbmltYXRlIiwiYWRzUG9wUmVtb3ZlQnV0dG9uIiwiYmVuY2htYXJrQ2F0SXRlbSIsInJ1bmluZ1Byb2R1Y3RDYXRJdGVtIiwicmFuZ2VTbGlkZXIiLCJzbGlkZXIiLCJyYW5nZSIsInZhbHVlIiwicHJldiIsImh0bWwiLCJmaWx0ZXJJdGVtIiwiY291bnRlckpzIiwic3RhaWNreVNpZGViYXIiLCJzdGlja19pbl9wYXJlbnQiLCJvZmZzZXRfdG9wIiwid2F5cG9pbnRzIiwid2F5cG9pbnQiLCJkaXJlY3Rpb24iLCJwcm9ncmVzc2JhciIsImRpc3BsYXlfdGV4dCIsImtub2IiLCJiZ0NvbG9yIiwiZmdDb2xvciIsInJlYWRPbmx5IiwibGluZUNhcCIsInZpZGVvUG9wVXBWZW5vYm94IiwidmVub2JveCIsImF1dG9wbGF5Iiwic3Bpbm5lciIsInNsaWNrIiwiYXV0b3BsYXlTcGVlZCIsImRvdHMiLCJhcnJvd3MiLCJpbmZpbml0ZSIsInNwZWVkIiwic2xpZGVzVG9TaG93Iiwic2xpZGVzVG9TY3JvbGwiLCJzaWRlYmFyQ29tbWVudFNsaWVyIiwic2lkZWJhckNvdXBvblNsaWRlciIsInByZXZBcnJvdyIsIm5leHRBcnJvdyIsInByb2R1Y3RTbGlkZXJXcmFwIiwibGF6eUxvYWQiLCJyZXNwb25zaXZlIiwiYnJlYWtwb2ludCIsInNldHRpbmdzIiwiZHJhZ2dhYmxlIiwiYXNOYXZGb3IiLCJjZW50ZXJNb2RlIiwiZm9jdXNPblNlbGVjdCIsIlNBTUVfSEVJR0hUIiwic2VsZWN0b3IiLCJoZWlnaHRzIiwicHVzaCIsIm1heEhlaWdodCIsIk1hdGgiLCJtYXgiLCJhcHBseSIsInRvdGFsUm93IiwicmVzaXplIiwidWlOdW1iZXJKcyIsInNlbGVjdG1lbnUiLCJzZWxlY3RhYmxlIiwic2hvZSIsIm1pbl9wcmljZV9yYW5nZSIsInBhcnNlSW50IiwidmFsIiwibWF4X3ByaWNlX3JhbmdlIiwidmFsdWVzIiwic2hvdyIsIm9yaWVudGF0aW9uIiwibWluIiwic3RlcCIsInNsaWRlIiwiZXZlbnQiLCJ1aSIsImN1cnJlbnRNaW5QcmljZSIsImN1cnJlbnRNYXhQcmljZSIsImNvbnNvbGUiLCJsb2ciLCJ0ZXh0IiwiaG9tZVJldmlld0l0ZW0iLCJyZXZpZXdSZXZpZXdJdGVtIiwic2luZ2VsUHJvZHVjdFNsaWRlciIsIngiLCJqIiwic2VsRWxtbnQiLCJhIiwiYyIsImdldEVsZW1lbnRzQnlDbGFzc05hbWUiLCJnZXRFbGVtZW50c0J5VGFnTmFtZSIsInNldEF0dHJpYnV0ZSIsImlubmVySFRNTCIsIm9wdGlvbnMiLCJzZWxlY3RlZEluZGV4IiwiYXBwZW5kQ2hpbGQiLCJhZGRFdmVudExpc3RlbmVyIiwieSIsImsiLCJzIiwiaCIsInBhcmVudE5vZGUiLCJwcmV2aW91c1NpYmxpbmciLCJyZW1vdmVBdHRyaWJ1dGUiLCJjbGljayIsInN0b3BQcm9wYWdhdGlvbiIsImNsb3NlQWxsU2VsZWN0IiwibmV4dFNpYmxpbmciLCJjbGFzc0xpc3QiLCJ0b2dnbGUiLCJlbG1udCIsImFyck5vIiwiaW5kZXhPZiIsImFkZCIsImJhckNoYXJ0SG9yaXpvbnRhbCIsInF1ZXJ5U2VsZWN0b3IiLCJDaGFydCIsInR5cGUiLCJiYWNrZ3JvdW5kQ29sb3IiLCJsYWJlbHMiLCJkYXRhc2V0cyIsImxhYmVsIiwiYm9yZGVyV2lkdGgiLCJsZWdlbmQiLCJkaXNwbGF5Iiwic2NhbGVzIiwieUF4ZXMiLCJ0aWNrcyIsImZvbnRDb2xvciIsImZvbnRTaXplIiwic3RlcFNpemUiLCJiZWdpbkF0WmVybyIsInhBeGVzIiwiY3R4IiwiZ2V0RWxlbWVudEJ5SWQiLCJteUNoYXJ0IiwiYm9yZGVyQ29sb3IiXSwibWFwcGluZ3MiOiI7O0FBQUFBLENBQUMsQ0FBQ0MsRUFBRixDQUFLQyxTQUFMLEdBQWlCLFVBQVVDLFdBQVYsRUFBMEc7QUFBQSxNQUFuRkMsYUFBbUYsdUVBQW5FLEtBQW1FO0FBQUEsTUFBNURDLFNBQTRELHVFQUFoRCxZQUFnRDtBQUFBLE1BQWxDQyxhQUFrQyx1RUFBbEIsZ0JBQWtCO0FBQ3ZILE1BQUlDLE9BQU8sR0FBRyxJQUFkLENBRHVILENBRXZIO0FBQ0E7O0FBQ0FQLEVBQUFBLENBQUMsQ0FBQ0csV0FBRCxDQUFELENBQWVLLElBQWYsQ0FBb0IsWUFBWTtBQUM1QjtBQUNBLFFBQUksQ0FBRVIsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRUyxRQUFSLENBQWlCSCxhQUFqQixDQUFOLEVBQXdDO0FBQ3BDTixNQUFBQSxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFVLEdBQVIsQ0FBWVYsQ0FBQyxDQUFDTyxPQUFELENBQUQsQ0FBV0ksSUFBWCxDQUFnQixNQUFoQixDQUFaLEVBQXFDQyxJQUFyQztBQUNIO0FBQ0osR0FMRCxFQUp1SCxDQVd2SDs7QUFDQSxNQUFJUixhQUFKLEVBQW1CO0FBQ2ZHLElBQUFBLE9BQU8sQ0FBQ0MsSUFBUixDQUFhLFlBQVk7QUFDckIsVUFBSVIsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRUyxRQUFSLENBQWlCSixTQUFqQixDQUFKLEVBQWlDO0FBQzdCTCxRQUFBQSxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFhLE1BQVIsR0FBaUJDLFFBQWpCLENBQTBCLG1CQUExQjtBQUNIO0FBQ0osS0FKRDtBQUtILEdBbEJzSCxDQW9Cdkg7OztBQUVBUCxFQUFBQSxPQUFPLENBQUNRLEVBQVIsQ0FBVyxPQUFYLEVBQW9CLFVBQVVDLENBQVYsRUFBYTtBQUM3QkEsSUFBQUEsQ0FBQyxDQUFDQyxjQUFGO0FBQ0EsUUFBSUMsS0FBSyxHQUFHbEIsQ0FBQyxDQUFDLElBQUQsQ0FBYjtBQUFBLFFBQ0ltQixZQUFZLEdBQUdELEtBQUssQ0FBQ1AsSUFBTixDQUFXLE1BQVgsQ0FEbkIsQ0FGNkIsQ0FLN0I7O0FBQ0EsUUFBSVAsYUFBSixFQUFtQjtBQUNmRyxNQUFBQSxPQUFPLENBQUNDLElBQVIsQ0FBYSxZQUFZO0FBQ3JCUixRQUFBQSxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFhLE1BQVIsR0FBaUJPLFdBQWpCLENBQTZCLG1CQUE3QjtBQUNILE9BRkQ7QUFHSDs7QUFFRCxRQUFJLENBQUNGLEtBQUssQ0FBQ1QsUUFBTixDQUFlSixTQUFmLENBQUwsRUFBZ0M7QUFDNUI7QUFDQUUsTUFBQUEsT0FBTyxDQUFDYSxXQUFSLENBQW9CZixTQUFwQjtBQUNBYSxNQUFBQSxLQUFLLENBQUNKLFFBQU4sQ0FBZVQsU0FBZixFQUg0QixDQUs1Qjs7QUFDQSxVQUFJRCxhQUFKLEVBQW1CO0FBQ2ZjLFFBQUFBLEtBQUssQ0FBQ0wsTUFBTixHQUFlQyxRQUFmLENBQXdCLG1CQUF4QjtBQUNILE9BUjJCLENBVTVCOzs7QUFDQWQsTUFBQUEsQ0FBQyxDQUFDRyxXQUFELENBQUQsQ0FBZWlCLFdBQWYsQ0FBMkJkLGFBQTNCLEVBQTBDTSxJQUExQztBQUNBWixNQUFBQSxDQUFDLENBQUNtQixZQUFELENBQUQsQ0FBZ0JMLFFBQWhCLENBQXlCUixhQUF6QixFQUF3Q2UsTUFBeEMsQ0FBK0MsTUFBL0M7QUFDSDtBQUVKLEdBM0JEO0FBNEJILENBbEREO0FBb0RBOzs7QUFDQXJCLENBQUMsQ0FBQ0MsRUFBRixDQUFLcUIsaUJBQUwsR0FBeUIsVUFBVUMsT0FBVixFQUFpQztBQUFBLE1BQWRDLElBQWMsdUVBQVAsS0FBTztBQUN0RCxNQUFJQyxPQUFPLEdBQUcsSUFBZDtBQUNBLE1BQUlDLFVBQVUsR0FBRzFCLENBQUMsQ0FBQ3VCLE9BQUQsQ0FBbEI7QUFDQUcsRUFBQUEsVUFBVSxDQUFDQyxPQUFYO0FBQ0FGLEVBQUFBLE9BQU8sQ0FBQ1YsRUFBUixDQUFXLE9BQVgsRUFBb0IsWUFBWTtBQUM1QixRQUFJUyxJQUFJLElBQUksSUFBWixFQUFrQjtBQUNkRSxNQUFBQSxVQUFVLENBQUNFLElBQVgsR0FBa0JDLFVBQWxCLENBQTZCLE1BQTdCO0FBQ0gsS0FGRCxNQUVPO0FBQ0hILE1BQUFBLFVBQVUsQ0FBQ0UsSUFBWCxHQUFrQkUsV0FBbEIsQ0FBOEIsTUFBOUI7QUFDSDtBQUNKLEdBTkQ7QUFPSCxDQVhEO0FBY0U7OztBQUNBLFNBQVNDLGFBQVQsQ0FBdUJDLEtBQXZCLEVBQThCO0FBRTVCLE1BQUlDLFNBQVMsR0FBRyxDQUFoQjtBQUFBLE1BQW1CO0FBQ2ZDLEVBQUFBLFVBQVUsR0FBRztBQUFDQyxJQUFBQSxDQUFDLEVBQUMsQ0FBSDtBQUFLQyxJQUFBQSxDQUFDLEVBQUMsQ0FBUDtBQUFTQyxJQUFBQSxDQUFDLEVBQUM7QUFBWCxHQURqQjtBQUFBLE1BQ2dDO0FBQzVCQyxFQUFBQSxNQUFNLEdBQUdDLFFBQVEsQ0FBQ0MsYUFBVCxDQUF1QixRQUF2QixDQUZiO0FBQUEsTUFHSUMsT0FBTyxHQUFHSCxNQUFNLENBQUNJLFVBQVAsSUFBcUJKLE1BQU0sQ0FBQ0ksVUFBUCxDQUFrQixJQUFsQixDQUhuQztBQUFBLE1BSUlDLElBSko7QUFBQSxNQUlVQyxLQUpWO0FBQUEsTUFJaUJDLE1BSmpCO0FBQUEsTUFLSUMsQ0FBQyxHQUFHLENBQUMsQ0FMVDtBQUFBLE1BTUlDLE1BTko7QUFBQSxNQU9JQyxHQUFHLEdBQUc7QUFBQ2IsSUFBQUEsQ0FBQyxFQUFDLENBQUg7QUFBS0MsSUFBQUEsQ0FBQyxFQUFDLENBQVA7QUFBU0MsSUFBQUEsQ0FBQyxFQUFDO0FBQVgsR0FQVjtBQUFBLE1BUUlZLEtBQUssR0FBRyxDQVJaOztBQVNBLE1BQUksQ0FBQ1IsT0FBTCxFQUFjO0FBQ1YsV0FBT1AsVUFBUDtBQUNIOztBQUVEVyxFQUFBQSxNQUFNLEdBQUdQLE1BQU0sQ0FBQ08sTUFBUCxHQUFnQmIsS0FBSyxDQUFDa0IsYUFBTixJQUF1QmxCLEtBQUssQ0FBQ21CLFlBQTdCLElBQTZDbkIsS0FBSyxDQUFDYSxNQUE1RTtBQUNBRCxFQUFBQSxLQUFLLEdBQUdOLE1BQU0sQ0FBQ00sS0FBUCxHQUFlWixLQUFLLENBQUNvQixZQUFOLElBQXNCcEIsS0FBSyxDQUFDcUIsV0FBNUIsSUFBMkNyQixLQUFLLENBQUNZLEtBQXhFO0FBRUFILEVBQUFBLE9BQU8sQ0FBQ2EsU0FBUixDQUFrQnRCLEtBQWxCLEVBQXlCLENBQXpCLEVBQTRCLENBQTVCLEVBbEI0QixDQW1CNUI7O0FBQ0EsTUFBSTtBQUNBVyxJQUFBQSxJQUFJLEdBQUdGLE9BQU8sQ0FBQ2MsWUFBUixDQUFxQixDQUFyQixFQUF3QixDQUF4QixFQUEyQlgsS0FBM0IsRUFBa0NDLE1BQWxDLENBQVA7QUFDSCxHQUZELENBRUUsT0FBTTdCLENBQU4sRUFBUztBQUNQO0FBQ0EsV0FBT2tCLFVBQVA7QUFDSDs7QUFFRGEsRUFBQUEsTUFBTSxHQUFHSixJQUFJLENBQUNBLElBQUwsQ0FBVUksTUFBbkI7O0FBRUEsU0FBUSxDQUFDRCxDQUFDLElBQUliLFNBQVMsR0FBRyxDQUFsQixJQUF1QmMsTUFBL0IsRUFBd0M7QUFDcEMsTUFBRUUsS0FBRjtBQUNBRCxJQUFBQSxHQUFHLENBQUNiLENBQUosSUFBU1EsSUFBSSxDQUFDQSxJQUFMLENBQVVHLENBQVYsQ0FBVDtBQUNBRSxJQUFBQSxHQUFHLENBQUNaLENBQUosSUFBU08sSUFBSSxDQUFDQSxJQUFMLENBQVVHLENBQUMsR0FBQyxDQUFaLENBQVQ7QUFDQUUsSUFBQUEsR0FBRyxDQUFDWCxDQUFKLElBQVNNLElBQUksQ0FBQ0EsSUFBTCxDQUFVRyxDQUFDLEdBQUMsQ0FBWixDQUFUO0FBQ0gsR0FsQzJCLENBb0M1Qjs7O0FBQ0FFLEVBQUFBLEdBQUcsQ0FBQ2IsQ0FBSixHQUFRLENBQUMsRUFBRWEsR0FBRyxDQUFDYixDQUFKLEdBQU1jLEtBQVIsQ0FBVDtBQUNBRCxFQUFBQSxHQUFHLENBQUNaLENBQUosR0FBUSxDQUFDLEVBQUVZLEdBQUcsQ0FBQ1osQ0FBSixHQUFNYSxLQUFSLENBQVQ7QUFDQUQsRUFBQUEsR0FBRyxDQUFDWCxDQUFKLEdBQVEsQ0FBQyxFQUFFVyxHQUFHLENBQUNYLENBQUosR0FBTVksS0FBUixDQUFUO0FBQ0EsU0FBT0QsR0FBUDtBQUNIOztBQUVEaEQsQ0FBQyxDQUFDQyxFQUFGLENBQUt1RCxhQUFMLEdBQXFCLFlBQVc7QUFDNUJ4RCxFQUFBQSxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFRLElBQVIsQ0FBYyxZQUFXO0FBQ3JCLFFBQUlVLEtBQUssR0FBR2xCLENBQUMsQ0FBQyxJQUFELENBQWI7QUFDQSxRQUFJeUQsU0FBUyxHQUFHdkMsS0FBSyxDQUFDd0MsSUFBTixDQUFXLGlCQUFYLENBQWhCLENBRnFCLENBR3JCOztBQUNBRCxJQUFBQSxTQUFTLENBQUNFLEdBQVYsQ0FBYyxVQUFTQyxLQUFULEVBQWdCQyxJQUFoQixFQUFzQjtBQUNoQyxVQUFJYixHQUFHLEdBQUdqQixhQUFhLENBQUM4QixJQUFELENBQXZCLENBRGdDLENBRWhDO0FBQ0E7O0FBQ0EzQyxNQUFBQSxLQUFLLENBQUN3QyxJQUFOLENBQVcsZUFBWCxFQUE0QkksR0FBNUIsQ0FBZ0MsWUFBaEMsRUFBOEMsU0FBT2QsR0FBRyxDQUFDYixDQUFYLEdBQWEsR0FBYixHQUFpQmEsR0FBRyxDQUFDWixDQUFyQixHQUF1QixHQUF2QixHQUEyQlksR0FBRyxDQUFDWCxDQUEvQixHQUFpQyxHQUEvRTtBQUNILEtBTEQ7QUFNSCxHQVZEO0FBV0gsQ0FaRDs7O0FDL0dBO0FBQ0FyQyxDQUFDLENBQUN1QyxRQUFELENBQUQsQ0FBWXdCLEtBQVosQ0FBa0IsWUFBWTtBQUMxQjtBQUNBLE1BQUlDLE9BQU8sR0FBR2hFLENBQUMsQ0FBQ2lFLE1BQUQsQ0FBZixDQUYwQixDQUkxQjs7QUFDQWpFLEVBQUFBLENBQUMsQ0FBQyxpQkFBRCxDQUFELENBQXFCUSxJQUFyQixDQUEwQixZQUFZO0FBQ2xDLFFBQUkwRCxHQUFHLEdBQUdsRSxDQUFDLENBQUMsSUFBRCxDQUFELENBQVEyQyxJQUFSLENBQWEsVUFBYixDQUFWO0FBQ0EzQyxJQUFBQSxDQUFDLENBQUMsSUFBRCxDQUFELENBQVE4RCxHQUFSLENBQVk7QUFDUkssTUFBQUEsVUFBVSxFQUFFLFNBQVNELEdBQVQsR0FBZTtBQURuQixLQUFaLEVBRmtDLENBSTlCO0FBQ1AsR0FMRDtBQU1BbEUsRUFBQUEsQ0FBQyxDQUFDLGlCQUFELENBQUQsQ0FBcUJRLElBQXJCLENBQTBCLFlBQVk7QUFDbEMsUUFBSTRELEtBQUssR0FBR3BFLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUTJDLElBQVIsQ0FBYSxVQUFiLENBQVo7QUFDQTNDLElBQUFBLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUThELEdBQVIsQ0FBWTtBQUNSSyxNQUFBQSxVQUFVLEVBQUVDO0FBREosS0FBWixFQUZrQyxDQUk5QjtBQUNQLEdBTEQ7QUFPQTs7QUFDQSxNQUFJQyxnQkFBZ0IsR0FBR3JFLENBQUMsQ0FBQyxzQkFBRCxDQUF4QjtBQUNBLE1BQUlzRSxlQUFlLEdBQUdELGdCQUFnQixDQUFDRSxNQUFqQixHQUEwQkMsR0FBaEQ7QUFDQSxNQUFJQyxpQkFBaUIsR0FBR0osZ0JBQWdCLENBQUN4QixNQUFqQixFQUF4QixDQXJCMEIsQ0F1QjFCO0FBQ0E7QUFDQTtBQUNBOztBQUdBbUIsRUFBQUEsT0FBTyxDQUFDakQsRUFBUixDQUFXLFFBQVgsRUFBcUIsWUFBWTtBQUNuQyxRQUFJaUQsT0FBTyxDQUFDVSxTQUFSLEtBQXNCSixlQUExQixFQUEwQztBQUNoQ0QsTUFBQUEsZ0JBQWdCLENBQUNQLEdBQWpCLENBQXFCLFFBQXJCLEVBQStCVyxpQkFBL0IsRUFBa0RFLFFBQWxELEdBQTZEN0QsUUFBN0QsQ0FBc0UsaUJBQXRFO0FBQ1QsS0FGRCxNQUVPO0FBQ051RCxNQUFBQSxnQkFBZ0IsQ0FBQ00sUUFBakIsR0FBNEJ2RCxXQUE1QixDQUF3QyxpQkFBeEM7QUFDTTtBQUNKLEdBTkQsRUE3QjBCLENBcUMxQjtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUNBOztBQUNBLE1BQUl3RCxTQUFTLEdBQUcsU0FBWkEsU0FBWSxDQUFTQyxFQUFULEVBQWFDLFFBQWIsRUFBdUI7QUFDbkMsU0FBS0QsRUFBTCxHQUFVQSxFQUFFLElBQUksRUFBaEI7QUFFQSxTQUFLQyxRQUFMLEdBQWdCQSxRQUFRLElBQUksS0FBNUI7QUFFQTlFLElBQUFBLENBQUMsQ0FBQyxlQUFELENBQUQsQ0FBbUJhLE1BQW5CLEdBQTRCQyxRQUE1QixDQUFxQyxnQkFBckM7QUFDQSxRQUFJaUUsWUFBWSxHQUFHLEtBQUtGLEVBQUwsQ0FBUW5CLElBQVIsQ0FBYSxlQUFiLENBQW5CO0FBQ0FxQixJQUFBQSxZQUFZLENBQUNoRSxFQUFiLENBQWdCLE9BQWhCLEVBQXlCO0FBQ2pCOEQsTUFBQUEsRUFBRSxFQUFFLEtBQUtBLEVBRFE7QUFFakJDLE1BQUFBLFFBQVEsRUFBRSxLQUFLQTtBQUZFLEtBQXpCLEVBSUksS0FBS0UsUUFKVDtBQUtILEdBWkQ7O0FBY0FKLEVBQUFBLFNBQVMsQ0FBQ0ssU0FBVixDQUFvQkQsUUFBcEIsR0FBK0IsVUFBU2hFLENBQVQsRUFBWTtBQUN2Q0EsSUFBQUEsQ0FBQyxDQUFDQyxjQUFGO0FBQ0EsUUFBSWlFLEdBQUcsR0FBR2xFLENBQUMsQ0FBQzJCLElBQUYsQ0FBT2tDLEVBQWpCO0FBQUEsUUFDSTNELEtBQUssR0FBR2xCLENBQUMsQ0FBQyxJQUFELENBRGI7QUFBQSxRQUdJbUYsS0FBSyxHQUFHakUsS0FBSyxDQUFDa0UsSUFBTixFQUhaO0FBS0FELElBQUFBLEtBQUssQ0FBQ3JELFdBQU47QUFDQVosSUFBQUEsS0FBSyxDQUFDTCxNQUFOLEdBQWV3RSxXQUFmLENBQTJCLE1BQTNCOztBQUVBLFFBQUksQ0FBQ3JFLENBQUMsQ0FBQzJCLElBQUYsQ0FBT21DLFFBQVosRUFBc0I7QUFDbEI7QUFDQUksTUFBQUEsR0FBRyxDQUFDeEIsSUFBSixDQUFTLGVBQVQsRUFBMEJoRCxHQUExQixDQUE4QnlFLEtBQTlCLEVBQXFDeEQsT0FBckMsR0FBK0NkLE1BQS9DLEdBQXdETyxXQUF4RCxDQUFvRSxNQUFwRTtBQUNIO0FBQ0osR0FkRDs7QUFnQkEsTUFBSWtFLFNBQVMsR0FBRyxJQUFJVixTQUFKLENBQWM1RSxDQUFDLENBQUMsb0JBQUQsQ0FBZixFQUF1QyxLQUF2QyxDQUFoQjtBQUVBQSxFQUFBQSxDQUFDLENBQUMsMkJBQUQsQ0FBRCxDQUErQmUsRUFBL0IsQ0FBa0MsT0FBbEMsRUFBMkMsVUFBU0MsQ0FBVCxFQUFZO0FBQ25EQSxJQUFBQSxDQUFDLENBQUNDLGNBQUY7QUFDQSxRQUFJc0UsSUFBSSxHQUFHLDRCQUFYO0FBRUF2RixJQUFBQSxDQUFDLENBQUMsTUFBRCxDQUFELENBQVVxRixXQUFWLENBQXNCLFFBQXRCO0FBQ0FyRixJQUFBQSxDQUFDLENBQUN1RixJQUFELENBQUQsQ0FBUTNFLElBQVIsR0FBZTRFLFFBQWYsQ0FBd0IsTUFBeEIsRUFBZ0NuRSxNQUFoQyxDQUF1QyxNQUF2QztBQUNBckIsSUFBQUEsQ0FBQyxDQUFDLHlDQUFELENBQUQsQ0FBNkNlLEVBQTdDLENBQWdELE9BQWhELEVBQXlELFlBQVc7QUFDaEVmLE1BQUFBLENBQUMsQ0FBQyxNQUFELENBQUQsQ0FBVW9CLFdBQVYsQ0FBc0IsUUFBdEI7QUFDQXBCLE1BQUFBLENBQUMsQ0FBQyxlQUFELENBQUQsQ0FBbUJ5RixPQUFuQixHQUE2QkMsTUFBN0I7QUFDSCxLQUhEO0FBSUgsR0FWRDtBQVlBOztBQUNBLE1BQUlDLGtCQUFrQixHQUFHLElBQUlmLFNBQUosQ0FBYzVFLENBQUMsQ0FBQyx1QkFBRCxDQUFmLEVBQTBDLEtBQTFDLENBQXpCO0FBQ0FBLEVBQUFBLENBQUMsQ0FBQyxzQkFBRCxDQUFELENBQTBCZSxFQUExQixDQUE2QixPQUE3QixFQUFzQyxVQUFTQyxDQUFULEVBQVk7QUFDOUNBLElBQUFBLENBQUMsQ0FBQ0MsY0FBRjtBQUNBLFFBQUlzRSxJQUFJLEdBQUcsNEJBQVg7QUFDQXZGLElBQUFBLENBQUMsQ0FBQyxNQUFELENBQUQsQ0FBVXFGLFdBQVYsQ0FBc0IsUUFBdEI7QUFDQXJGLElBQUFBLENBQUMsQ0FBQ3VGLElBQUQsQ0FBRCxDQUFRM0UsSUFBUixHQUFlNEUsUUFBZixDQUF3QixNQUF4QixFQUFnQ25FLE1BQWhDLENBQXVDLE1BQXZDO0FBQ0FyQixJQUFBQSxDQUFDLENBQUMsNENBQUQsQ0FBRCxDQUFnRGUsRUFBaEQsQ0FBbUQsT0FBbkQsRUFBNEQsWUFBVztBQUNuRWYsTUFBQUEsQ0FBQyxDQUFDLE1BQUQsQ0FBRCxDQUFVb0IsV0FBVixDQUFzQixRQUF0QjtBQUNBcEIsTUFBQUEsQ0FBQyxDQUFDLGVBQUQsQ0FBRCxDQUFtQnlGLE9BQW5CLEdBQTZCQyxNQUE3QjtBQUNILEtBSEQ7QUFJSCxHQVREO0FBV0E7O0FBQ0ExRixFQUFBQSxDQUFDLENBQUMsd0JBQUQsQ0FBRCxDQUE0QmUsRUFBNUIsQ0FBK0IsT0FBL0IsRUFBd0MsVUFBU0MsQ0FBVCxFQUFZO0FBQ2hEQSxJQUFBQSxDQUFDLENBQUNDLGNBQUY7QUFDQSxRQUFJc0UsSUFBSSxHQUFHLDRCQUFYO0FBQ0F2RixJQUFBQSxDQUFDLENBQUMsTUFBRCxDQUFELENBQVVxRixXQUFWLENBQXNCLHdCQUF0QjtBQUNBckYsSUFBQUEsQ0FBQyxDQUFDdUYsSUFBRCxDQUFELENBQVEzRSxJQUFSLEdBQWU0RSxRQUFmLENBQXdCLE1BQXhCLEVBQWdDbkUsTUFBaEMsQ0FBdUMsTUFBdkM7QUFDQXJCLElBQUFBLENBQUMsQ0FBQyw2Q0FBRCxDQUFELENBQWlEZSxFQUFqRCxDQUFvRCxPQUFwRCxFQUE2RCxZQUFXO0FBQ3BFZixNQUFBQSxDQUFDLENBQUMsTUFBRCxDQUFELENBQVVvQixXQUFWLENBQXNCLHdCQUF0QjtBQUNBcEIsTUFBQUEsQ0FBQyxDQUFDLGVBQUQsQ0FBRCxDQUFtQnlGLE9BQW5CLEdBQTZCQyxNQUE3QjtBQUNILEtBSEQ7QUFJSCxHQVREO0FBV0E7QUFDQTs7QUFDQSxNQUFJRSxXQUFXLEdBQUc1RixDQUFDLENBQUMsaUJBQUQsQ0FBbkI7QUFDQTRGLEVBQUFBLFdBQVcsQ0FBQ3RFLGlCQUFaLENBQThCLHNCQUE5QixFQXRIMEIsQ0F3SDFCOztBQUNBLE1BQUl1RSxhQUFhLEdBQUc3RixDQUFDLENBQUMsd0JBQUQsQ0FBckI7QUFDQTZGLEVBQUFBLGFBQWEsQ0FBQzlFLEVBQWQsQ0FBaUIsT0FBakIsRUFBMEIsWUFBWTtBQUNsQ2YsSUFBQUEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRcUYsV0FBUixDQUFvQixNQUFwQjtBQUNBckYsSUFBQUEsQ0FBQyxDQUFDLDZCQUFELENBQUQsQ0FBaUM4RixPQUFqQyxDQUF5QztBQUN0Q2xELE1BQUFBLEtBQUssRUFBRTtBQUQrQixLQUF6QyxFQUVHLEdBRkg7QUFHSCxHQUxELEVBMUgwQixDQWdJMUI7QUFDQTtBQUNBOztBQUdBOztBQUNBLE1BQUltRCxrQkFBa0IsR0FBRy9GLENBQUMsQ0FBQywyQkFBRCxDQUExQjtBQUNBK0YsRUFBQUEsa0JBQWtCLENBQUNoRixFQUFuQixDQUFzQixPQUF0QixFQUErQixZQUFZO0FBQ3ZDZixJQUFBQSxDQUFDLENBQUMsZUFBRCxDQUFELENBQW1CMkIsT0FBbkIsQ0FBMkIsTUFBM0I7QUFDSCxHQUZELEVBdkkwQixDQTJJMUI7O0FBQ0EsTUFBSXFFLGdCQUFnQixHQUFHaEcsQ0FBQyxDQUFDLDZCQUFELENBQXhCO0FBQ0FnRyxFQUFBQSxnQkFBZ0IsQ0FBQzlGLFNBQWpCLENBQTJCLDRCQUEzQjtBQUVBLE1BQUkrRixvQkFBb0IsR0FBR2pHLENBQUMsQ0FBQyxvQ0FBRCxDQUE1QjtBQUNBaUcsRUFBQUEsb0JBQW9CLENBQUMvRixTQUFyQixDQUErQix3QkFBL0I7QUFFQTtBQUNBO0FBQ0E7O0FBQ0FGLEVBQUFBLENBQUMsQ0FBQywrQkFBRCxDQUFELENBQW1DRSxTQUFuQyxDQUE2Qyx3REFBN0M7QUFDQUYsRUFBQUEsQ0FBQyxDQUFDLDRCQUFELENBQUQsQ0FBZ0NFLFNBQWhDLENBQTBDLHlEQUExQztBQUNBRixFQUFBQSxDQUFDLENBQUMsc0NBQUQsQ0FBRCxDQUEwQ0UsU0FBMUMsQ0FBb0QsNENBQXBELEVBdkowQixDQXdKMUI7O0FBQ0FGLEVBQUFBLENBQUMsQ0FBQyxnQ0FBRCxDQUFELENBQW9DRSxTQUFwQyxDQUE4Qyx1Q0FBOUMsRUFBdUYsWUFBVztBQUFDLFFBQUlFLGFBQWEsR0FBRyxJQUFwQjtBQUEwQixHQUE3SCxFQXpKMEIsQ0EwSjFCOztBQUNBSixFQUFBQSxDQUFDLENBQUMsb0NBQUQsQ0FBRCxDQUF3Q0UsU0FBeEMsQ0FBa0Qsc0NBQWxELEVBM0owQixDQThKMUI7O0FBQ0EsTUFBSWdHLFdBQVcsR0FBRyxTQUFkQSxXQUFjLEdBQVk7QUFDMUIsUUFBSUMsTUFBTSxHQUFHbkcsQ0FBQyxDQUFDLGtCQUFELENBQWQ7QUFBQSxRQUNJb0csS0FBSyxHQUFHcEcsQ0FBQyxDQUFDLHdCQUFELENBRGI7QUFBQSxRQUVJcUcsS0FBSyxHQUFHckcsQ0FBQyxDQUFDLHdCQUFELENBRmI7QUFJQW1HLElBQUFBLE1BQU0sQ0FBQzNGLElBQVAsQ0FBWSxZQUFZO0FBRXBCNkYsTUFBQUEsS0FBSyxDQUFDN0YsSUFBTixDQUFXLFlBQVk7QUFDbkIsWUFBSTZGLEtBQUssR0FBR3JHLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUXNHLElBQVIsR0FBZTNGLElBQWYsQ0FBb0IsT0FBcEIsQ0FBWjtBQUNBWCxRQUFBQSxDQUFDLENBQUMsSUFBRCxDQUFELENBQVF1RyxJQUFSLENBQWFGLEtBQWI7QUFDSCxPQUhEO0FBS0FELE1BQUFBLEtBQUssQ0FBQ3JGLEVBQU4sQ0FBUyxPQUFULEVBQWtCLFlBQVk7QUFDMUJmLFFBQUFBLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUW9GLElBQVIsQ0FBYWlCLEtBQWIsRUFBb0JFLElBQXBCLENBQXlCLEtBQUtGLEtBQTlCO0FBQ0gsT0FGRDtBQUdILEtBVkQ7QUFXSCxHQWhCRDs7QUFpQkFILEVBQUFBLFdBQVcsR0FoTGUsQ0FrTDFCOztBQUNBLE1BQUlNLFVBQVUsR0FBR3hHLENBQUMsQ0FBQyx5QkFBRCxDQUFsQjtBQUNBd0csRUFBQUEsVUFBVSxDQUFDekYsRUFBWCxDQUFjLE9BQWQsRUFBdUIsWUFBVztBQUM5QixRQUFJRyxLQUFLLEdBQUdsQixDQUFDLENBQUMsSUFBRCxDQUFiO0FBQ0F3RyxJQUFBQSxVQUFVLENBQUM5RixHQUFYLENBQWVRLEtBQWYsRUFBc0JFLFdBQXRCLENBQWtDLFFBQWxDOztBQUNBLFFBQUlGLEtBQUssQ0FBQ1QsUUFBTixDQUFlLG1CQUFmLENBQUosRUFBeUM7QUFDckNTLE1BQUFBLEtBQUssQ0FBQ0osUUFBTixDQUFlLFFBQWY7QUFDQWQsTUFBQUEsQ0FBQyxDQUFDLGlCQUFELENBQUQsQ0FBcUJvQixXQUFyQixDQUFpQyxjQUFqQyxFQUFpRE4sUUFBakQsQ0FBMEQsY0FBMUQ7QUFDSCxLQUhELE1BSUssSUFBR0ksS0FBSyxDQUFDVCxRQUFOLENBQWUsbUJBQWYsQ0FBSCxFQUF3QztBQUN6Q1MsTUFBQUEsS0FBSyxDQUFDSixRQUFOLENBQWUsUUFBZjtBQUNBZCxNQUFBQSxDQUFDLENBQUMsaUJBQUQsQ0FBRCxDQUFxQm9CLFdBQXJCLENBQWlDLGNBQWpDLEVBQWlETixRQUFqRCxDQUEwRCxjQUExRDtBQUNIO0FBQ0osR0FYRDtBQWNBLE1BQUkyRixTQUFTLEdBQUd6RyxDQUFDLENBQUMsV0FBRCxDQUFqQixDQWxNMEIsQ0FtTTFCO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBLE1BQUkwRyxjQUFjLEdBQUkxRyxDQUFDLENBQUMsZ0JBQUQsQ0FBdkI7QUFDQTBHLEVBQUFBLGNBQWMsQ0FBQ0MsZUFBZixDQUErQjtBQUMzQkMsSUFBQUEsVUFBVSxFQUFFO0FBRGUsR0FBL0I7QUFNQTs7QUFDQTs7QUFDQSxNQUFJQyxTQUFTLEdBQUc3RyxDQUFDLENBQUMsZUFBRCxDQUFELENBQW1COEcsUUFBbkIsQ0FBNEIsVUFBVUMsU0FBVixFQUFxQjtBQUM3RC9HLElBQUFBLENBQUMsQ0FBQyx5QkFBRCxDQUFELENBQTZCZ0gsV0FBN0IsQ0FBeUM7QUFDckNDLE1BQUFBLFlBQVksRUFBRTtBQUR1QixLQUF6QztBQUdBakgsSUFBQUEsQ0FBQyxDQUFDLHlCQUFELENBQUQsQ0FBNkJnSCxXQUE3QixDQUF5QztBQUNyQ0MsTUFBQUEsWUFBWSxFQUFFO0FBRHVCLEtBQXpDO0FBSUgsR0FSZSxFQVFiO0FBQ0MxQyxJQUFBQSxNQUFNLEVBQUU7QUFEVCxHQVJhLENBQWhCO0FBWUF2RSxFQUFBQSxDQUFDLENBQUMsdUJBQUQsQ0FBRCxDQUEyQmtILElBQTNCLENBQWdDO0FBQzVCdEUsSUFBQUEsS0FBSyxFQUFFLElBRHFCO0FBRTVCQyxJQUFBQSxNQUFNLEVBQUUsSUFGb0I7QUFHNUJzRSxJQUFBQSxPQUFPLEVBQUUsU0FIbUI7QUFJNUJDLElBQUFBLE9BQU8sRUFBRSxTQUptQjtBQUs1QkMsSUFBQUEsUUFBUSxFQUFFLElBTGtCO0FBTTVCQyxJQUFBQSxPQUFPLEVBQUU7QUFObUIsR0FBaEM7QUFTQTtBQUNBOztBQUNBLE1BQUlDLGlCQUFpQixHQUFHdkgsQ0FBQyxDQUFDLGtCQUFELENBQXpCO0FBQ0F1SCxFQUFBQSxpQkFBaUIsQ0FBQ0MsT0FBbEIsQ0FBMEI7QUFDdEJDLElBQUFBLFFBQVEsRUFBRSxJQURZO0FBRXRCQyxJQUFBQSxPQUFPLEVBQUU7QUFGYSxHQUExQjtBQUtBO0FBQ0E7O0FBQ0ExSCxFQUFBQSxDQUFDLENBQUMsc0JBQUQsQ0FBRCxDQUEwQjJILEtBQTFCLENBQWdDO0FBQzVCO0FBQ0FGLElBQUFBLFFBQVEsRUFBRSxLQUZrQjtBQUc1QkcsSUFBQUEsYUFBYSxFQUFFLElBSGE7QUFJNUJDLElBQUFBLElBQUksRUFBRSxLQUpzQjtBQUs1QkMsSUFBQUEsTUFBTSxFQUFFLEtBTG9CO0FBTTVCQyxJQUFBQSxRQUFRLEVBQUUsSUFOa0I7QUFPNUJDLElBQUFBLEtBQUssRUFBRSxHQVBxQjtBQVE1QkMsSUFBQUEsWUFBWSxFQUFFLENBUmM7QUFTNUJDLElBQUFBLGNBQWMsRUFBRTtBQVRZLEdBQWhDLEVBblAwQixDQStQMUI7O0FBQ0EsTUFBSUMsbUJBQW1CLEdBQUduSSxDQUFDLENBQUMsa0NBQUQsQ0FBM0I7QUFDQW1JLEVBQUFBLG1CQUFtQixDQUFDM0gsSUFBcEIsQ0FBMEIsWUFBVztBQUNqQzJILElBQUFBLG1CQUFtQixDQUFDUixLQUFwQixDQUEwQjtBQUN0QkYsTUFBQUEsUUFBUSxFQUFFLElBRFk7QUFFdEJHLE1BQUFBLGFBQWEsRUFBRSxJQUZPO0FBR3RCQyxNQUFBQSxJQUFJLEVBQUUsSUFIZ0I7QUFJdEJDLE1BQUFBLE1BQU0sRUFBRSxLQUpjO0FBS3RCQyxNQUFBQSxRQUFRLEVBQUUsSUFMWTtBQU10QkMsTUFBQUEsS0FBSyxFQUFFLEdBTmU7QUFPdEJDLE1BQUFBLFlBQVksRUFBRSxDQVBRO0FBUXRCQyxNQUFBQSxjQUFjLEVBQUU7QUFSTSxLQUExQjtBQVVILEdBWEQsRUFqUTBCLENBOFExQjs7QUFDQSxNQUFJRSxtQkFBbUIsR0FBR3BJLENBQUMsQ0FBQyx1QkFBRCxDQUEzQjtBQUNBb0ksRUFBQUEsbUJBQW1CLENBQUM1SCxJQUFwQixDQUEwQixZQUFXO0FBQ2pDNEgsSUFBQUEsbUJBQW1CLENBQUNULEtBQXBCLENBQTBCO0FBQ3RCRixNQUFBQSxRQUFRLEVBQUUsSUFEWTtBQUV0QkcsTUFBQUEsYUFBYSxFQUFFLElBRk87QUFHdEJDLE1BQUFBLElBQUksRUFBRSxLQUhnQjtBQUl0QkMsTUFBQUEsTUFBTSxFQUFFLElBSmM7QUFLdEJPLE1BQUFBLFNBQVMsRUFBRSxtQ0FMVztBQU10QkMsTUFBQUEsU0FBUyxFQUFFLG1DQU5XO0FBT3RCUCxNQUFBQSxRQUFRLEVBQUUsSUFQWTtBQVF0QkMsTUFBQUEsS0FBSyxFQUFFLEdBUmU7QUFTdEJDLE1BQUFBLFlBQVksRUFBRSxDQVRRO0FBVXRCQyxNQUFBQSxjQUFjLEVBQUU7QUFWTSxLQUExQjtBQVlILEdBYkQsRUFoUjBCLENBK1IxQjs7QUFDQWxJLEVBQUFBLENBQUMsQ0FBQyxxQkFBRCxDQUFELENBQXlCMkgsS0FBekIsQ0FBK0I7QUFDM0JGLElBQUFBLFFBQVEsRUFBRSxJQURpQjtBQUUzQkcsSUFBQUEsYUFBYSxFQUFFLElBRlk7QUFHM0JDLElBQUFBLElBQUksRUFBRSxLQUhxQjtBQUkzQkMsSUFBQUEsTUFBTSxFQUFFLElBSm1CO0FBSzNCTyxJQUFBQSxTQUFTLEVBQUUsaUNBTGdCO0FBTTNCQyxJQUFBQSxTQUFTLEVBQUUsaUNBTmdCO0FBTzNCUCxJQUFBQSxRQUFRLEVBQUUsSUFQaUI7QUFRM0JDLElBQUFBLEtBQUssRUFBRSxHQVJvQjtBQVMzQkMsSUFBQUEsWUFBWSxFQUFFLENBVGE7QUFVM0JDLElBQUFBLGNBQWMsRUFBRTtBQVZXLEdBQS9CLEVBaFMwQixDQTZTMUI7O0FBQ0FsSSxFQUFBQSxDQUFDLENBQUMsdUJBQUQsQ0FBRCxDQUEyQjJILEtBQTNCLENBQWlDO0FBQzdCRixJQUFBQSxRQUFRLEVBQUUsSUFEbUI7QUFFN0JHLElBQUFBLGFBQWEsRUFBRSxJQUZjO0FBRzdCcEcsSUFBQUEsSUFBSSxFQUFFLElBSHVCO0FBSTdCcUcsSUFBQUEsSUFBSSxFQUFFLEtBSnVCO0FBSzdCQyxJQUFBQSxNQUFNLEVBQUUsSUFMcUI7QUFNN0JPLElBQUFBLFNBQVMsRUFBRSw0QkFOa0I7QUFPN0JDLElBQUFBLFNBQVMsRUFBRSw0QkFQa0I7QUFRN0JQLElBQUFBLFFBQVEsRUFBRSxJQVJtQjtBQVM3QkMsSUFBQUEsS0FBSyxFQUFFLEdBVHNCO0FBVTdCQyxJQUFBQSxZQUFZLEVBQUUsQ0FWZTtBQVc3QkMsSUFBQUEsY0FBYyxFQUFFO0FBWGEsR0FBakM7QUFjQWxJLEVBQUFBLENBQUMsQ0FBQyx5QkFBRCxDQUFELENBQTZCMkgsS0FBN0IsQ0FBbUM7QUFDL0JGLElBQUFBLFFBQVEsRUFBRSxJQURxQjtBQUUvQkcsSUFBQUEsYUFBYSxFQUFFLElBRmdCO0FBRy9CcEcsSUFBQUEsSUFBSSxFQUFFLElBSHlCO0FBSS9CcUcsSUFBQUEsSUFBSSxFQUFFLEtBSnlCO0FBSy9CQyxJQUFBQSxNQUFNLEVBQUUsSUFMdUI7QUFNL0JPLElBQUFBLFNBQVMsRUFBRSw4QkFOb0I7QUFPL0JDLElBQUFBLFNBQVMsRUFBRSw4QkFQb0I7QUFRL0JQLElBQUFBLFFBQVEsRUFBRSxJQVJxQjtBQVMvQkMsSUFBQUEsS0FBSyxFQUFFLEdBVHdCO0FBVS9CQyxJQUFBQSxZQUFZLEVBQUUsQ0FWaUI7QUFXL0JDLElBQUFBLGNBQWMsRUFBRTtBQVhlLEdBQW5DO0FBY0EsTUFBSUssaUJBQWlCLEdBQUd2SSxDQUFDLENBQUMsNEJBQUQsQ0FBekI7QUFDQXVJLEVBQUFBLGlCQUFpQixDQUFDWixLQUFsQixDQUF3QjtBQUNwQjtBQUNBRixJQUFBQSxRQUFRLEVBQUUsSUFGVTtBQUdwQkcsSUFBQUEsYUFBYSxFQUFFLElBSEs7QUFJcEJwRyxJQUFBQSxJQUFJLEVBQUUsSUFKYztBQUtwQnFHLElBQUFBLElBQUksRUFBRSxLQUxjO0FBTXBCQyxJQUFBQSxNQUFNLEVBQUUsSUFOWTtBQU9wQk8sSUFBQUEsU0FBUyxFQUFFLG1DQVBTO0FBUXBCQyxJQUFBQSxTQUFTLEVBQUUsbUNBUlM7QUFTcEJQLElBQUFBLFFBQVEsRUFBRSxJQVRVO0FBVXBCQyxJQUFBQSxLQUFLLEVBQUUsR0FWYTtBQVdwQkMsSUFBQUEsWUFBWSxFQUFFLENBWE07QUFZcEJDLElBQUFBLGNBQWMsRUFBRSxDQVpJO0FBYXBCTSxJQUFBQSxRQUFRLEVBQUU7QUFiVSxHQUF4QjtBQWdCQXhJLEVBQUFBLENBQUMsQ0FBQywwQkFBRCxDQUFELENBQThCMkgsS0FBOUIsQ0FBb0M7QUFDaENGLElBQUFBLFFBQVEsRUFBRSxLQURzQjtBQUVoQ0csSUFBQUEsYUFBYSxFQUFFLElBRmlCO0FBR2hDO0FBQ0FDLElBQUFBLElBQUksRUFBRSxLQUowQjtBQUtoQ0MsSUFBQUEsTUFBTSxFQUFFLEtBTHdCO0FBTWhDO0FBQ0E7QUFDQUMsSUFBQUEsUUFBUSxFQUFFLElBUnNCO0FBU2hDQyxJQUFBQSxLQUFLLEVBQUUsR0FUeUI7QUFVaENDLElBQUFBLFlBQVksRUFBRSxDQVZrQjtBQVdoQ0MsSUFBQUEsY0FBYyxFQUFFLENBWGdCO0FBWWhDTyxJQUFBQSxVQUFVLEVBQUUsQ0FBQztBQUNMQyxNQUFBQSxVQUFVLEVBQUUsSUFEUDtBQUVMQyxNQUFBQSxRQUFRLEVBQUU7QUFDTlYsUUFBQUEsWUFBWSxFQUFFLENBRFI7QUFFTkMsUUFBQUEsY0FBYyxFQUFFO0FBRlY7QUFGTCxLQUFELEVBT1I7QUFDSVEsTUFBQUEsVUFBVSxFQUFFLElBRGhCO0FBRUlDLE1BQUFBLFFBQVEsRUFBRTtBQUNOVixRQUFBQSxZQUFZLEVBQUUsQ0FEUjtBQUVOQyxRQUFBQSxjQUFjLEVBQUU7QUFGVjtBQUZkLEtBUFEsRUFjUjtBQUNJUSxNQUFBQSxVQUFVLEVBQUUsR0FEaEI7QUFFSUMsTUFBQUEsUUFBUSxFQUFFO0FBQ05WLFFBQUFBLFlBQVksRUFBRSxDQURSO0FBRU5DLFFBQUFBLGNBQWMsRUFBRTtBQUZWO0FBRmQsS0FkUSxFQXFCUjtBQUNJUSxNQUFBQSxVQUFVLEVBQUUsR0FEaEI7QUFFSUMsTUFBQUEsUUFBUSxFQUFFO0FBQ05WLFFBQUFBLFlBQVksRUFBRSxDQURSO0FBRU5DLFFBQUFBLGNBQWMsRUFBRTtBQUZWO0FBRmQsS0FyQlE7QUFab0IsR0FBcEM7QUEyQ0FsSSxFQUFBQSxDQUFDLENBQUMsdUJBQUQsQ0FBRCxDQUEyQjJILEtBQTNCLENBQWlDO0FBQzdCRixJQUFBQSxRQUFRLEVBQUUsSUFEbUI7QUFFN0JHLElBQUFBLGFBQWEsRUFBRSxJQUZjO0FBRzdCO0FBQ0FDLElBQUFBLElBQUksRUFBRSxLQUp1QjtBQUs3QkMsSUFBQUEsTUFBTSxFQUFFLEtBTHFCO0FBTTdCQyxJQUFBQSxRQUFRLEVBQUUsSUFObUI7QUFPN0JDLElBQUFBLEtBQUssRUFBRSxHQVBzQjtBQVE3QkMsSUFBQUEsWUFBWSxFQUFFLENBUmU7QUFTN0JDLElBQUFBLGNBQWMsRUFBRTtBQVRhLEdBQWpDO0FBWUFsSSxFQUFBQSxDQUFDLENBQUMscUJBQUQsQ0FBRCxDQUF5QjJILEtBQXpCLENBQStCO0FBQzNCTSxJQUFBQSxZQUFZLEVBQUUsQ0FEYTtBQUUzQkMsSUFBQUEsY0FBYyxFQUFFLENBRlc7QUFHM0JKLElBQUFBLE1BQU0sRUFBRSxLQUhtQjtBQUkzQkMsSUFBQUEsUUFBUSxFQUFFLElBSmlCO0FBSzNCRixJQUFBQSxJQUFJLEVBQUUsS0FMcUI7QUFNM0JlLElBQUFBLFNBQVMsRUFBRSxLQU5nQjtBQU8zQm5CLElBQUFBLFFBQVEsRUFBRSxLQVBpQjtBQVEzQkcsSUFBQUEsYUFBYSxFQUFFLElBUlk7QUFTM0JpQixJQUFBQSxRQUFRLEVBQUU7QUFUaUIsR0FBL0I7QUFZQTdJLEVBQUFBLENBQUMsQ0FBQywyQkFBRCxDQUFELENBQStCMkgsS0FBL0IsQ0FBcUM7QUFDakNNLElBQUFBLFlBQVksRUFBRSxDQURtQjtBQUVqQ0MsSUFBQUEsY0FBYyxFQUFFLENBRmlCO0FBR2pDVyxJQUFBQSxRQUFRLEVBQUUscUJBSHVCO0FBSWpDaEIsSUFBQUEsSUFBSSxFQUFFLEtBSjJCO0FBS2pDaUIsSUFBQUEsVUFBVSxFQUFFLEtBTHFCO0FBTWpDQyxJQUFBQSxhQUFhLEVBQUUsSUFOa0I7QUFPakNqQixJQUFBQSxNQUFNLEVBQUUsS0FQeUI7QUFRakNXLElBQUFBLFVBQVUsRUFBRSxDQUFDO0FBQ0xDLE1BQUFBLFVBQVUsRUFBRSxHQURQO0FBRUxDLE1BQUFBLFFBQVEsRUFBRTtBQUNOWixRQUFBQSxRQUFRLEVBQUUsSUFESjtBQUVORSxRQUFBQSxZQUFZLEVBQUUsQ0FGUjtBQUdOQyxRQUFBQSxjQUFjLEVBQUU7QUFIVjtBQUZMLEtBQUQsRUFRUjtBQUNJUSxNQUFBQSxVQUFVLEVBQUUsR0FEaEI7QUFFSUMsTUFBQUEsUUFBUSxFQUFFO0FBQ05WLFFBQUFBLFlBQVksRUFBRSxDQURSO0FBRU5DLFFBQUFBLGNBQWMsRUFBRTtBQUZWO0FBRmQsS0FSUTtBQVJxQixHQUFyQyxFQTlaMEIsQ0F3YjFCOztBQUNBbEksRUFBQUEsQ0FBQyxDQUFDLHNCQUFELENBQUQsQ0FBMEIySCxLQUExQixDQUFnQztBQUM1Qk0sSUFBQUEsWUFBWSxFQUFFLENBRGM7QUFFNUJDLElBQUFBLGNBQWMsRUFBRSxDQUZZO0FBRzVCSixJQUFBQSxNQUFNLEVBQUUsS0FIb0I7QUFJNUI7QUFDQTtBQUNBO0FBQ0FDLElBQUFBLFFBQVEsRUFBRSxJQVBrQjtBQVE1QkYsSUFBQUEsSUFBSSxFQUFFLEtBUnNCO0FBUzVCSixJQUFBQSxRQUFRLEVBQUUsSUFUa0I7QUFVNUJHLElBQUFBLGFBQWEsRUFBRSxJQVZhO0FBVzVCYSxJQUFBQSxVQUFVLEVBQUUsQ0FBQztBQUNMQyxNQUFBQSxVQUFVLEVBQUUsSUFEUDtBQUVMQyxNQUFBQSxRQUFRLEVBQUU7QUFDTlosUUFBQUEsUUFBUSxFQUFFLElBREo7QUFFTkUsUUFBQUEsWUFBWSxFQUFFLENBRlI7QUFHTkMsUUFBQUEsY0FBYyxFQUFFO0FBSFY7QUFGTCxLQUFELEVBUVI7QUFDSVEsTUFBQUEsVUFBVSxFQUFFLEdBRGhCO0FBRUlDLE1BQUFBLFFBQVEsRUFBRTtBQUNOVixRQUFBQSxZQUFZLEVBQUUsQ0FEUjtBQUVOQyxRQUFBQSxjQUFjLEVBQUU7QUFGVjtBQUZkLEtBUlEsRUFlUjtBQUNJUSxNQUFBQSxVQUFVLEVBQUUsR0FEaEI7QUFFSUMsTUFBQUEsUUFBUSxFQUFFO0FBQ05aLFFBQUFBLFFBQVEsRUFBRSxJQURKO0FBRU5FLFFBQUFBLFlBQVksRUFBRSxDQUZSO0FBR05DLFFBQUFBLGNBQWMsRUFBRTtBQUhWO0FBRmQsS0FmUSxFQXVCUjtBQUNJUSxNQUFBQSxVQUFVLEVBQUUsR0FEaEI7QUFFSUMsTUFBQUEsUUFBUSxFQUFFO0FBQ05WLFFBQUFBLFlBQVksRUFBRSxDQURSO0FBRU5DLFFBQUFBLGNBQWMsRUFBRTtBQUZWO0FBRmQsS0F2QlE7QUFYZ0IsR0FBaEMsRUF6YjBCLENBcWUxQjs7QUFDQWxJLEVBQUFBLENBQUMsQ0FBQyw2QkFBRCxDQUFELENBQWlDMkgsS0FBakMsQ0FBdUM7QUFDbkNNLElBQUFBLFlBQVksRUFBRSxDQURxQjtBQUVuQ0MsSUFBQUEsY0FBYyxFQUFFLENBRm1CO0FBR25DSixJQUFBQSxNQUFNLEVBQUUsS0FIMkI7QUFJbkNDLElBQUFBLFFBQVEsRUFBRSxJQUp5QjtBQUtuQ0YsSUFBQUEsSUFBSSxFQUFFLEtBTDZCO0FBTW5DSixJQUFBQSxRQUFRLEVBQUUsSUFOeUI7QUFPbkNHLElBQUFBLGFBQWEsRUFBRSxJQVBvQjtBQVFuQ2EsSUFBQUEsVUFBVSxFQUFFLENBQUM7QUFDTEMsTUFBQUEsVUFBVSxFQUFFLElBRFA7QUFFTEMsTUFBQUEsUUFBUSxFQUFFO0FBQ05aLFFBQUFBLFFBQVEsRUFBRSxJQURKO0FBRU5FLFFBQUFBLFlBQVksRUFBRSxDQUZSO0FBR05DLFFBQUFBLGNBQWMsRUFBRTtBQUhWO0FBRkwsS0FBRCxFQVFSO0FBQ0lRLE1BQUFBLFVBQVUsRUFBRSxHQURoQjtBQUVJQyxNQUFBQSxRQUFRLEVBQUU7QUFDTlYsUUFBQUEsWUFBWSxFQUFFLENBRFI7QUFFTkMsUUFBQUEsY0FBYyxFQUFFO0FBRlY7QUFGZCxLQVJRLEVBZVI7QUFDSVEsTUFBQUEsVUFBVSxFQUFFLEdBRGhCO0FBRUlDLE1BQUFBLFFBQVEsRUFBRTtBQUNOWixRQUFBQSxRQUFRLEVBQUUsSUFESjtBQUVORSxRQUFBQSxZQUFZLEVBQUUsQ0FGUjtBQUdOQyxRQUFBQSxjQUFjLEVBQUU7QUFIVjtBQUZkLEtBZlEsRUF1QlI7QUFDSVEsTUFBQUEsVUFBVSxFQUFFLEdBRGhCO0FBRUlDLE1BQUFBLFFBQVEsRUFBRTtBQUNOVixRQUFBQSxZQUFZLEVBQUUsQ0FEUjtBQUVOQyxRQUFBQSxjQUFjLEVBQUU7QUFGVjtBQUZkLEtBdkJRO0FBUnVCLEdBQXZDLEVBdGUwQixDQStnQjFCOztBQUNBbEksRUFBQUEsQ0FBQyxDQUFDLDRCQUFELENBQUQsQ0FBZ0MySCxLQUFoQyxDQUFzQztBQUNsQztBQUNBTSxJQUFBQSxZQUFZLEVBQUUsQ0FGb0I7QUFHbENDLElBQUFBLGNBQWMsRUFBRSxDQUhrQjtBQUlsQ0osSUFBQUEsTUFBTSxFQUFFLElBSjBCO0FBS2xDTyxJQUFBQSxTQUFTLEVBQUUsc0JBTHVCO0FBTWxDQyxJQUFBQSxTQUFTLEVBQUUsc0JBTnVCO0FBT2xDO0FBQ0FQLElBQUFBLFFBQVEsRUFBRSxJQVJ3QjtBQVNsQ0YsSUFBQUEsSUFBSSxFQUFFLEtBVDRCO0FBVWxDSixJQUFBQSxRQUFRLEVBQUUsSUFWd0I7QUFXbENHLElBQUFBLGFBQWEsRUFBRSxJQVhtQjtBQVlsQ0ksSUFBQUEsS0FBSyxFQUFFLEdBWjJCO0FBYWxDUyxJQUFBQSxVQUFVLEVBQUUsQ0FBQztBQUNMQyxNQUFBQSxVQUFVLEVBQUUsSUFEUDtBQUVMQyxNQUFBQSxRQUFRLEVBQUU7QUFDTlosUUFBQUEsUUFBUSxFQUFFLElBREo7QUFFTkUsUUFBQUEsWUFBWSxFQUFFLENBRlI7QUFHTkMsUUFBQUEsY0FBYyxFQUFFO0FBSFY7QUFGTCxLQUFELEVBUVI7QUFDSVEsTUFBQUEsVUFBVSxFQUFFLEdBRGhCO0FBRUlDLE1BQUFBLFFBQVEsRUFBRTtBQUNOVixRQUFBQSxZQUFZLEVBQUUsQ0FEUjtBQUVOQyxRQUFBQSxjQUFjLEVBQUU7QUFGVjtBQUZkLEtBUlEsRUFlUjtBQUNJUSxNQUFBQSxVQUFVLEVBQUUsR0FEaEI7QUFFSUMsTUFBQUEsUUFBUSxFQUFFO0FBQ05aLFFBQUFBLFFBQVEsRUFBRSxJQURKO0FBRU5FLFFBQUFBLFlBQVksRUFBRSxDQUZSO0FBR05DLFFBQUFBLGNBQWMsRUFBRTtBQUhWO0FBRmQsS0FmUSxFQXVCUjtBQUNJUSxNQUFBQSxVQUFVLEVBQUUsR0FEaEI7QUFFSUMsTUFBQUEsUUFBUSxFQUFFO0FBQ05WLFFBQUFBLFlBQVksRUFBRSxDQURSO0FBRU5DLFFBQUFBLGNBQWMsRUFBRTtBQUZWO0FBRmQsS0F2QlE7QUFic0IsR0FBdEM7QUE4Q0E7O0FBQ0FsSSxFQUFBQSxDQUFDLENBQUMsd0JBQUQsQ0FBRCxDQUE0QjJILEtBQTVCLENBQWtDO0FBQzlCTSxJQUFBQSxZQUFZLEVBQUUsQ0FEZ0I7QUFFOUJDLElBQUFBLGNBQWMsRUFBRSxDQUZjO0FBRzlCSixJQUFBQSxNQUFNLEVBQUUsS0FIc0I7QUFJOUJDLElBQUFBLFFBQVEsRUFBRSxLQUpvQjtBQUs5QkYsSUFBQUEsSUFBSSxFQUFFLEtBTHdCO0FBTTlCSixJQUFBQSxRQUFRLEVBQUUsSUFOb0I7QUFPOUJHLElBQUFBLGFBQWEsRUFBRSxJQVBlO0FBUTlCYSxJQUFBQSxVQUFVLEVBQUUsQ0FDUjtBQUNJQyxNQUFBQSxVQUFVLEVBQUUsSUFEaEI7QUFFSUMsTUFBQUEsUUFBUSxFQUFFO0FBQ05WLFFBQUFBLFlBQVksRUFBRSxDQURSO0FBRU5DLFFBQUFBLGNBQWMsRUFBRTtBQUZWO0FBRmQsS0FEUSxFQVFSO0FBQ0lRLE1BQUFBLFVBQVUsRUFBRSxHQURoQjtBQUVJQyxNQUFBQSxRQUFRLEVBQUU7QUFDTlosUUFBQUEsUUFBUSxFQUFFLElBREo7QUFFTkUsUUFBQUEsWUFBWSxFQUFFLENBRlI7QUFHTkMsUUFBQUEsY0FBYyxFQUFFO0FBSFY7QUFGZCxLQVJRLEVBZ0JSO0FBQ0lRLE1BQUFBLFVBQVUsRUFBRSxHQURoQjtBQUVJQyxNQUFBQSxRQUFRLEVBQUU7QUFDTlYsUUFBQUEsWUFBWSxFQUFFLENBRFI7QUFFTkMsUUFBQUEsY0FBYyxFQUFFO0FBRlY7QUFGZCxLQWhCUTtBQVJrQixHQUFsQztBQWlDQWxJLEVBQUFBLENBQUMsQ0FBQyx1QkFBRCxDQUFELENBQTJCMkgsS0FBM0IsQ0FBaUM7QUFDN0JNLElBQUFBLFlBQVksRUFBRSxDQURlO0FBRTdCQyxJQUFBQSxjQUFjLEVBQUUsQ0FGYTtBQUc3QkosSUFBQUEsTUFBTSxFQUFFLElBSHFCO0FBSTdCTyxJQUFBQSxTQUFTLEVBQUUsb0NBSmtCO0FBSzdCQyxJQUFBQSxTQUFTLEVBQUUsb0NBTGtCO0FBTTdCUCxJQUFBQSxRQUFRLEVBQUUsS0FObUI7QUFPN0JGLElBQUFBLElBQUksRUFBRSxLQVB1QjtBQVE3QkosSUFBQUEsUUFBUSxFQUFFLEtBUm1CO0FBUzdCRyxJQUFBQSxhQUFhLEVBQUUsSUFUYztBQVU3QmEsSUFBQUEsVUFBVSxFQUFFLENBQ1I7QUFDSUMsTUFBQUEsVUFBVSxFQUFFLElBRGhCO0FBRUlDLE1BQUFBLFFBQVEsRUFBRTtBQUNOVixRQUFBQSxZQUFZLEVBQUUsQ0FEUjtBQUVOQyxRQUFBQSxjQUFjLEVBQUU7QUFGVjtBQUZkLEtBRFEsRUFRUjtBQUNJUSxNQUFBQSxVQUFVLEVBQUUsR0FEaEI7QUFFSUMsTUFBQUEsUUFBUSxFQUFFO0FBQ05aLFFBQUFBLFFBQVEsRUFBRSxJQURKO0FBRU5FLFFBQUFBLFlBQVksRUFBRSxDQUZSO0FBR05DLFFBQUFBLGNBQWMsRUFBRTtBQUhWO0FBRmQsS0FSUSxFQWdCUjtBQUNJUSxNQUFBQSxVQUFVLEVBQUUsR0FEaEI7QUFFSUMsTUFBQUEsUUFBUSxFQUFFO0FBQ05WLFFBQUFBLFlBQVksRUFBRSxDQURSO0FBRU5DLFFBQUFBLGNBQWMsRUFBRTtBQUZWO0FBRmQsS0FoQlE7QUFWaUIsR0FBakMsRUFobUIwQixDQW9vQjFCOztBQUNBbEksRUFBQUEsQ0FBQyxDQUFDQyxFQUFGLENBQUsrSSxXQUFMLEdBQW1CLFlBQVc7QUFDMUIsUUFBSUMsUUFBUSxHQUFHLElBQWY7QUFDQSxRQUFJQyxPQUFPLEdBQUcsRUFBZCxDQUYwQixDQUcxQjs7QUFDQUQsSUFBQUEsUUFBUSxDQUFDekksSUFBVCxDQUFjLFlBQVU7QUFDeEIsVUFBSXFDLE1BQU0sR0FBRzdDLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUTZDLE1BQVIsRUFBYjtBQUNBcUcsTUFBQUEsT0FBTyxDQUFDQyxJQUFSLENBQWF0RyxNQUFiO0FBQ0MsS0FIRCxFQUowQixDQVExQjs7QUFDQSxRQUFJdUcsU0FBUyxHQUFHQyxJQUFJLENBQUNDLEdBQUwsQ0FBU0MsS0FBVCxDQUFlLElBQWYsRUFBcUJMLE9BQXJCLENBQWhCLENBVDBCLENBVTFCOztBQUNBRCxJQUFBQSxRQUFRLENBQUN6SSxJQUFULENBQWMsWUFBVTtBQUN4QlIsTUFBQUEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRNkMsTUFBUixDQUFldUcsU0FBZjtBQUNDLEtBRkQ7QUFHSCxHQWRELENBcm9CMEIsQ0FxcEIxQjs7O0FBQ0EsTUFBSUksUUFBUSxHQUFHeEosQ0FBQyxDQUFDLG1CQUFELENBQUQsQ0FBdUIrQyxNQUF0Qzs7QUFDQSxPQUFLLElBQUlELENBQUMsR0FBRyxDQUFiLEVBQWdCQSxDQUFDLElBQUkwRyxRQUFyQixFQUErQjFHLENBQUMsRUFBaEMsRUFBb0M7QUFDaEM5QyxJQUFBQSxDQUFDLENBQUMsZ0JBQWM4QyxDQUFmLENBQUQsQ0FBbUJrRyxXQUFuQjtBQUNIOztBQUNEaEosRUFBQUEsQ0FBQyxDQUFDaUUsTUFBRCxDQUFELENBQVV3RixNQUFWLENBQWlCLFlBQVU7QUFDdkIsU0FBSyxJQUFJM0csQ0FBQyxHQUFHLENBQWIsRUFBZ0JBLENBQUMsSUFBSTBHLFFBQXJCLEVBQStCMUcsQ0FBQyxFQUFoQyxFQUFvQztBQUNoQzlDLE1BQUFBLENBQUMsQ0FBQyxnQkFBYzhDLENBQWYsQ0FBRCxDQUFtQmtHLFdBQW5CO0FBQ0g7QUFDSixHQUpEO0FBTUE7QUFDQTs7QUFDQSxNQUFJVSxVQUFVLEdBQUcxSixDQUFDLENBQUUsWUFBRixDQUFsQjtBQUNBMEosRUFBQUEsVUFBVSxDQUFDQyxVQUFYLEdBQXdCQSxVQUF4QixDQUFtQyxZQUFuQyxFQUFpRDdJLFFBQWpELENBQTJELHlCQUEzRDtBQUVBZCxFQUFBQSxDQUFDLENBQUUsVUFBRixDQUFELENBQWdCMkosVUFBaEIsR0FBNkJBLFVBQTdCLENBQXdDLFlBQXhDLEVBQXNEN0ksUUFBdEQsQ0FBZ0UsOEJBQWhFO0FBQ0FkLEVBQUFBLENBQUMsQ0FBRSwyQkFBRixDQUFELENBQWlDMkosVUFBakMsR0FBOENBLFVBQTlDLENBQXlELFlBQXpELEVBQXVFN0ksUUFBdkUsQ0FBZ0YsZ0NBQWhGLEVBdHFCMEIsQ0F3cUIxQjs7QUFDQWQsRUFBQUEsQ0FBQyxDQUFFLDBCQUFGLENBQUQsQ0FBZ0MySixVQUFoQyxHQUE2Q0EsVUFBN0MsQ0FBd0QsWUFBeEQsRUFBc0U3SSxRQUF0RSxDQUErRSwrQkFBL0UsRUF6cUIwQixDQTRxQjFCOztBQUNBZCxFQUFBQSxDQUFDLENBQUMsMkJBQUQsQ0FBRCxDQUErQjRKLFVBQS9CO0FBQ0E1SixFQUFBQSxDQUFDLENBQUMsMEJBQUQsQ0FBRCxDQUE4QjRKLFVBQTlCLEdBOXFCMEIsQ0FnckIxQjtBQUNBOztBQUVBNUosRUFBQUEsQ0FBQyxDQUFDLDZCQUFELENBQUQsQ0FBaUNZLElBQWpDO0FBRUFaLEVBQUFBLENBQUMsQ0FBQyxvREFBRCxDQUFELENBQXdEZSxFQUF4RCxDQUEyRCxRQUEzRCxFQUFxRSxZQUFZO0FBRWpGZixJQUFBQSxDQUFDLENBQUMsNkJBQUQsQ0FBRCxDQUFpQzZKLElBQWpDO0FBQ0ksUUFBSUMsZUFBZSxHQUFHQyxRQUFRLENBQUMvSixDQUFDLENBQUMsMEJBQUQsQ0FBRCxDQUE4QmdLLEdBQTlCLEVBQUQsQ0FBOUI7QUFFQSxRQUFJQyxlQUFlLEdBQUdGLFFBQVEsQ0FBQy9KLENBQUMsQ0FBQywyQkFBRCxDQUFELENBQStCZ0ssR0FBL0IsRUFBRCxDQUE5Qjs7QUFFQSxRQUFJRixlQUFlLEdBQUdHLGVBQXRCLEVBQXVDO0FBQ3ZDakssTUFBQUEsQ0FBQyxDQUFDLDBCQUFELENBQUQsQ0FBOEJnSyxHQUE5QixDQUFrQ0YsZUFBbEM7QUFDQzs7QUFFRDlKLElBQUFBLENBQUMsQ0FBQywyQkFBRCxDQUFELENBQStCbUcsTUFBL0IsQ0FBc0M7QUFDdEMrRCxNQUFBQSxNQUFNLEVBQUUsQ0FBQ0osZUFBRCxFQUFrQkcsZUFBbEI7QUFEOEIsS0FBdEM7QUFJSCxHQWZEO0FBa0JBakssRUFBQUEsQ0FBQyxDQUFDLG9EQUFELENBQUQsQ0FBd0RlLEVBQXhELENBQTJELGFBQTNELEVBQTBFLFlBQVk7QUFFbEZmLElBQUFBLENBQUMsQ0FBQyw2QkFBRCxDQUFELENBQWlDbUssSUFBakM7QUFFQSxRQUFJTCxlQUFlLEdBQUdDLFFBQVEsQ0FBQy9KLENBQUMsQ0FBQywwQkFBRCxDQUFELENBQThCZ0ssR0FBOUIsRUFBRCxDQUE5QjtBQUVBLFFBQUlDLGVBQWUsR0FBR0YsUUFBUSxDQUFDL0osQ0FBQyxDQUFDLDBCQUFELENBQUQsQ0FBOEJnSyxHQUE5QixFQUFELENBQTlCOztBQUVBLFFBQUdGLGVBQWUsSUFBSUcsZUFBdEIsRUFBc0M7QUFFbENBLE1BQUFBLGVBQWUsR0FBR0gsZUFBZSxHQUFHLEdBQXBDO0FBRUE5SixNQUFBQSxDQUFDLENBQUMsMEJBQUQsQ0FBRCxDQUE4QmdLLEdBQTlCLENBQWtDRixlQUFsQztBQUNBOUosTUFBQUEsQ0FBQyxDQUFDLDBCQUFELENBQUQsQ0FBOEJnSyxHQUE5QixDQUFrQ0MsZUFBbEM7QUFDSDs7QUFFRGpLLElBQUFBLENBQUMsQ0FBQywyQkFBRCxDQUFELENBQStCbUcsTUFBL0IsQ0FBc0M7QUFDdEMrRCxNQUFBQSxNQUFNLEVBQUUsQ0FBQ0osZUFBRCxFQUFrQkcsZUFBbEI7QUFEOEIsS0FBdEM7QUFJSCxHQXBCRDtBQXVCQWpLLEVBQUFBLENBQUMsQ0FBQyxZQUFZO0FBQ1ZBLElBQUFBLENBQUMsQ0FBQywyQkFBRCxDQUFELENBQStCbUcsTUFBL0IsQ0FBc0M7QUFDdENDLE1BQUFBLEtBQUssRUFBRSxJQUQrQjtBQUV0Q2dFLE1BQUFBLFdBQVcsRUFBRSxZQUZ5QjtBQUd0Q0MsTUFBQUEsR0FBRyxFQUFFLENBSGlDO0FBSXRDZixNQUFBQSxHQUFHLEVBQUUsS0FKaUM7QUFLdENZLE1BQUFBLE1BQU0sRUFBRSxDQUFDLENBQUQsRUFBSSxLQUFKLENBTDhCO0FBTXRDSSxNQUFBQSxJQUFJLEVBQUUsR0FOZ0M7QUFRdENDLE1BQUFBLEtBQUssRUFBRSxlQUFVQyxLQUFWLEVBQWlCQyxFQUFqQixFQUFxQjtBQUN4QixZQUFJQSxFQUFFLENBQUNQLE1BQUgsQ0FBVSxDQUFWLEtBQWdCTyxFQUFFLENBQUNQLE1BQUgsQ0FBVSxDQUFWLENBQXBCLEVBQWtDO0FBQzlCLGlCQUFPLEtBQVA7QUFDSDs7QUFFRGxLLFFBQUFBLENBQUMsQ0FBQywwQkFBRCxDQUFELENBQThCZ0ssR0FBOUIsQ0FBa0NTLEVBQUUsQ0FBQ1AsTUFBSCxDQUFVLENBQVYsQ0FBbEM7QUFDQWxLLFFBQUFBLENBQUMsQ0FBQywwQkFBRCxDQUFELENBQThCZ0ssR0FBOUIsQ0FBa0NTLEVBQUUsQ0FBQ1AsTUFBSCxDQUFVLENBQVYsQ0FBbEM7QUFDSDtBQWZxQyxLQUF0QztBQWtCQWxLLElBQUFBLENBQUMsQ0FBQywwQkFBRCxDQUFELENBQThCZ0ssR0FBOUIsQ0FBa0NoSyxDQUFDLENBQUMsMkJBQUQsQ0FBRCxDQUErQm1HLE1BQS9CLENBQXNDLFFBQXRDLEVBQWdELENBQWhELENBQWxDO0FBQ0FuRyxJQUFBQSxDQUFDLENBQUMsMEJBQUQsQ0FBRCxDQUE4QmdLLEdBQTlCLENBQWtDaEssQ0FBQyxDQUFDLDJCQUFELENBQUQsQ0FBK0JtRyxNQUEvQixDQUFzQyxRQUF0QyxFQUFnRCxDQUFoRCxDQUFsQztBQUVILEdBdEJBLENBQUQ7QUF3QkEsTUFBSXVFLGVBQWUsR0FBRzFLLENBQUMsQ0FBQywwQkFBRCxDQUFELENBQThCZ0ssR0FBOUIsRUFBdEI7QUFDQSxNQUFJVyxlQUFlLEdBQUczSyxDQUFDLENBQUMsMEJBQUQsQ0FBRCxDQUE4QmdLLEdBQTlCLEVBQXRCO0FBQ0FZLEVBQUFBLE9BQU8sQ0FBQ0MsR0FBUixDQUFZSCxlQUFaO0FBRUExSyxFQUFBQSxDQUFDLENBQUMsWUFBRCxDQUFELENBQWdCOEssSUFBaEIsQ0FBcUJKLGVBQXJCO0FBQ0ExSyxFQUFBQSxDQUFDLENBQUMsWUFBRCxDQUFELENBQWdCOEssSUFBaEIsQ0FBcUJILGVBQXJCO0FBRUEzSyxFQUFBQSxDQUFDLENBQUMsMkJBQUQsQ0FBRCxDQUErQmUsRUFBL0IsQ0FBa0MsT0FBbEMsRUFBMkMsWUFBWTtBQUNuRGYsSUFBQUEsQ0FBQyxDQUFDLFlBQUQsQ0FBRCxDQUFnQjhLLElBQWhCLENBQXFCSixlQUFyQjtBQUNBMUssSUFBQUEsQ0FBQyxDQUFDLFlBQUQsQ0FBRCxDQUFnQjhLLElBQWhCLENBQXFCSCxlQUFyQjtBQUNILEdBSEQ7QUFRQTtBQUVBOztBQUNBLE1BQUlJLGNBQWMsR0FBRy9LLENBQUMsQ0FBQyxtREFBRCxDQUF0QixDQXh3QjBCLENBMHdCMUI7O0FBQ0EsTUFBSWdMLGdCQUFnQixHQUFJaEwsQ0FBQyxDQUFDLHdDQUFELENBQXpCLENBM3dCMEIsQ0E2d0IxQjs7QUFDQSxNQUFJaUwsbUJBQW1CLEdBQUlqTCxDQUFDLENBQUMseURBQUQsQ0FBNUI7QUFHQStLLEVBQUFBLGNBQWMsQ0FBQ3ZILGFBQWY7QUFDQXlILEVBQUFBLG1CQUFtQixDQUFDekgsYUFBcEI7QUFDQXdILEVBQUFBLGdCQUFnQixDQUFDeEgsYUFBakI7QUFFSCxDQXJ4QkQ7QUF1eEJBLElBQUkwSCxDQUFKLEVBQU9wSSxDQUFQLEVBQVVxSSxDQUFWLEVBQWFDLFFBQWIsRUFBdUJDLENBQXZCLEVBQTBCaEosQ0FBMUIsRUFBNkJpSixDQUE3QjtBQUNBOztBQUNBSixDQUFDLEdBQUczSSxRQUFRLENBQUNnSixzQkFBVCxDQUFnQyxpQkFBaEMsQ0FBSjs7QUFDQSxLQUFLekksQ0FBQyxHQUFHLENBQVQsRUFBWUEsQ0FBQyxHQUFHb0ksQ0FBQyxDQUFDbkksTUFBbEIsRUFBMEJELENBQUMsRUFBM0IsRUFBK0I7QUFDN0JzSSxFQUFBQSxRQUFRLEdBQUdGLENBQUMsQ0FBQ3BJLENBQUQsQ0FBRCxDQUFLMEksb0JBQUwsQ0FBMEIsUUFBMUIsRUFBb0MsQ0FBcEMsQ0FBWDtBQUNBOztBQUNBSCxFQUFBQSxDQUFDLEdBQUc5SSxRQUFRLENBQUNDLGFBQVQsQ0FBdUIsS0FBdkIsQ0FBSjtBQUNBNkksRUFBQUEsQ0FBQyxDQUFDSSxZQUFGLENBQWUsT0FBZixFQUF3QixpQkFBeEI7QUFDQUosRUFBQUEsQ0FBQyxDQUFDSyxTQUFGLEdBQWNOLFFBQVEsQ0FBQ08sT0FBVCxDQUFpQlAsUUFBUSxDQUFDUSxhQUExQixFQUF5Q0YsU0FBdkQ7QUFDQVIsRUFBQUEsQ0FBQyxDQUFDcEksQ0FBRCxDQUFELENBQUsrSSxXQUFMLENBQWlCUixDQUFqQjtBQUNBOztBQUNBaEosRUFBQUEsQ0FBQyxHQUFHRSxRQUFRLENBQUNDLGFBQVQsQ0FBdUIsS0FBdkIsQ0FBSjtBQUNBSCxFQUFBQSxDQUFDLENBQUNvSixZQUFGLENBQWUsT0FBZixFQUF3QiwwQkFBeEI7O0FBQ0EsT0FBS04sQ0FBQyxHQUFHLENBQVQsRUFBWUEsQ0FBQyxHQUFHQyxRQUFRLENBQUNySSxNQUF6QixFQUFpQ29JLENBQUMsRUFBbEMsRUFBc0M7QUFDcEM7O0FBRUFHLElBQUFBLENBQUMsR0FBRy9JLFFBQVEsQ0FBQ0MsYUFBVCxDQUF1QixLQUF2QixDQUFKO0FBQ0E4SSxJQUFBQSxDQUFDLENBQUNJLFNBQUYsR0FBY04sUUFBUSxDQUFDTyxPQUFULENBQWlCUixDQUFqQixFQUFvQk8sU0FBbEM7QUFDQUosSUFBQUEsQ0FBQyxDQUFDUSxnQkFBRixDQUFtQixPQUFuQixFQUE0QixVQUFTOUssQ0FBVCxFQUFZO0FBQ3BDOztBQUVBLFVBQUkrSyxDQUFKLEVBQU9qSixDQUFQLEVBQVVrSixDQUFWLEVBQWFDLENBQWIsRUFBZ0JDLENBQWhCO0FBQ0FELE1BQUFBLENBQUMsR0FBRyxLQUFLRSxVQUFMLENBQWdCQSxVQUFoQixDQUEyQlgsb0JBQTNCLENBQWdELFFBQWhELEVBQTBELENBQTFELENBQUo7QUFDQVUsTUFBQUEsQ0FBQyxHQUFHLEtBQUtDLFVBQUwsQ0FBZ0JDLGVBQXBCOztBQUNBLFdBQUt0SixDQUFDLEdBQUcsQ0FBVCxFQUFZQSxDQUFDLEdBQUdtSixDQUFDLENBQUNsSixNQUFsQixFQUEwQkQsQ0FBQyxFQUEzQixFQUErQjtBQUM3QixZQUFJbUosQ0FBQyxDQUFDTixPQUFGLENBQVU3SSxDQUFWLEVBQWE0SSxTQUFiLElBQTBCLEtBQUtBLFNBQW5DLEVBQThDO0FBQzVDTyxVQUFBQSxDQUFDLENBQUNMLGFBQUYsR0FBa0I5SSxDQUFsQjtBQUNBb0osVUFBQUEsQ0FBQyxDQUFDUixTQUFGLEdBQWMsS0FBS0EsU0FBbkI7QUFDQUssVUFBQUEsQ0FBQyxHQUFHLEtBQUtJLFVBQUwsQ0FBZ0JaLHNCQUFoQixDQUF1QyxrQkFBdkMsQ0FBSjs7QUFDQSxlQUFLUyxDQUFDLEdBQUcsQ0FBVCxFQUFZQSxDQUFDLEdBQUdELENBQUMsQ0FBQ2hKLE1BQWxCLEVBQTBCaUosQ0FBQyxFQUEzQixFQUErQjtBQUM3QkQsWUFBQUEsQ0FBQyxDQUFDQyxDQUFELENBQUQsQ0FBS0ssZUFBTCxDQUFxQixPQUFyQjtBQUNEOztBQUNELGVBQUtaLFlBQUwsQ0FBa0IsT0FBbEIsRUFBMkIsa0JBQTNCO0FBQ0E7QUFDRDtBQUNGOztBQUNEUyxNQUFBQSxDQUFDLENBQUNJLEtBQUY7QUFDSCxLQW5CRDtBQW9CQWpLLElBQUFBLENBQUMsQ0FBQ3dKLFdBQUYsQ0FBY1AsQ0FBZDtBQUNEOztBQUNESixFQUFBQSxDQUFDLENBQUNwSSxDQUFELENBQUQsQ0FBSytJLFdBQUwsQ0FBaUJ4SixDQUFqQjtBQUNBZ0osRUFBQUEsQ0FBQyxDQUFDUyxnQkFBRixDQUFtQixPQUFuQixFQUE0QixVQUFTOUssQ0FBVCxFQUFZO0FBQ3BDOztBQUVBQSxJQUFBQSxDQUFDLENBQUN1TCxlQUFGO0FBQ0FDLElBQUFBLGNBQWMsQ0FBQyxJQUFELENBQWQ7QUFDQSxTQUFLQyxXQUFMLENBQWlCQyxTQUFqQixDQUEyQkMsTUFBM0IsQ0FBa0MsYUFBbEM7QUFDQSxTQUFLRCxTQUFMLENBQWVDLE1BQWYsQ0FBc0IscUJBQXRCO0FBQ0QsR0FQSDtBQVFEOztBQUNELFNBQVNILGNBQVQsQ0FBd0JJLEtBQXhCLEVBQStCO0FBQzdCOztBQUVBLE1BQUkxQixDQUFKO0FBQUEsTUFBT2EsQ0FBUDtBQUFBLE1BQVVqSixDQUFWO0FBQUEsTUFBYStKLEtBQUssR0FBRyxFQUFyQjtBQUNBM0IsRUFBQUEsQ0FBQyxHQUFHM0ksUUFBUSxDQUFDZ0osc0JBQVQsQ0FBZ0MsY0FBaEMsQ0FBSjtBQUNBUSxFQUFBQSxDQUFDLEdBQUd4SixRQUFRLENBQUNnSixzQkFBVCxDQUFnQyxpQkFBaEMsQ0FBSjs7QUFDQSxPQUFLekksQ0FBQyxHQUFHLENBQVQsRUFBWUEsQ0FBQyxHQUFHaUosQ0FBQyxDQUFDaEosTUFBbEIsRUFBMEJELENBQUMsRUFBM0IsRUFBK0I7QUFDN0IsUUFBSThKLEtBQUssSUFBSWIsQ0FBQyxDQUFDakosQ0FBRCxDQUFkLEVBQW1CO0FBQ2pCK0osTUFBQUEsS0FBSyxDQUFDMUQsSUFBTixDQUFXckcsQ0FBWDtBQUNELEtBRkQsTUFFTztBQUNMaUosTUFBQUEsQ0FBQyxDQUFDakosQ0FBRCxDQUFELENBQUs0SixTQUFMLENBQWVoSCxNQUFmLENBQXNCLHFCQUF0QjtBQUNEO0FBQ0Y7O0FBQ0QsT0FBSzVDLENBQUMsR0FBRyxDQUFULEVBQVlBLENBQUMsR0FBR29JLENBQUMsQ0FBQ25JLE1BQWxCLEVBQTBCRCxDQUFDLEVBQTNCLEVBQStCO0FBQzdCLFFBQUkrSixLQUFLLENBQUNDLE9BQU4sQ0FBY2hLLENBQWQsQ0FBSixFQUFzQjtBQUNwQm9JLE1BQUFBLENBQUMsQ0FBQ3BJLENBQUQsQ0FBRCxDQUFLNEosU0FBTCxDQUFlSyxHQUFmLENBQW1CLGFBQW5CO0FBQ0Q7QUFDRjtBQUNGO0FBQ0Q7Ozs7QUFFQXhLLFFBQVEsQ0FBQ3VKLGdCQUFULENBQTBCLE9BQTFCLEVBQW1DVSxjQUFuQzs7O0FDLzFCQTtBQUVBLElBQUlRLGtCQUFrQixHQUFHekssUUFBUSxDQUFDMEssYUFBVCxDQUF1Qix1QkFBdkIsQ0FBekI7O0FBRUEsSUFBR0Qsa0JBQUgsRUFBdUI7QUFDbkIsTUFBSUEsa0JBQWtCLEdBQUdBLGtCQUFrQixDQUFDdEssVUFBbkIsQ0FBOEIsSUFBOUIsQ0FBekI7QUFDQSxNQUFJd0ssS0FBSixDQUFVRixrQkFBVixFQUE4QjtBQUMxQkcsSUFBQUEsSUFBSSxFQUFFLGVBRG9CO0FBRTFCQyxJQUFBQSxlQUFlLEVBQUUsU0FGUztBQUcxQjNFLElBQUFBLFVBQVUsRUFBRSxJQUhjO0FBSTFCOUYsSUFBQUEsSUFBSSxFQUFFO0FBQ0YwSyxNQUFBQSxNQUFNLEVBQUUsQ0FBQyxhQUFELEVBQWdCLGFBQWhCLEVBQStCLGNBQS9CLEVBQStDLGNBQS9DLEVBQStELGVBQS9ELEVBQWdGLFdBQWhGLEVBQ0osY0FESSxFQUNZLFdBRFosQ0FETjtBQUlGQyxNQUFBQSxRQUFRLEVBQUUsQ0FBQztBQUNQQyxRQUFBQSxLQUFLLEVBQUUsRUFEQTtBQUVQSCxRQUFBQSxlQUFlLEVBQUUsZ0JBRlY7QUFHUHpLLFFBQUFBLElBQUksRUFBRSxDQUFDLEVBQUQsRUFBSyxFQUFMLEVBQVMsRUFBVCxFQUFhLEVBQWIsRUFBaUIsQ0FBakIsRUFBb0IsQ0FBcEIsRUFBdUIsQ0FBdkIsRUFBMEIsQ0FBMUIsRUFBNkIsRUFBN0IsQ0FIQztBQUlQNkssUUFBQUEsV0FBVyxFQUFFO0FBSk4sT0FBRDtBQUpSLEtBSm9CO0FBZTFCN0IsSUFBQUEsT0FBTyxFQUFFO0FBQ0w7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOEIsTUFBQUEsTUFBTSxFQUFFO0FBQ0pDLFFBQUFBLE9BQU8sRUFBRTtBQURMLE9BTkg7QUFTTEMsTUFBQUEsTUFBTSxFQUFFO0FBQ0pDLFFBQUFBLEtBQUssRUFBRSxDQUFDO0FBQ0pDLFVBQUFBLEtBQUssRUFBRTtBQUNIQyxZQUFBQSxTQUFTLEVBQUUsU0FEUjtBQUVIQyxZQUFBQSxRQUFRLEVBQUUsRUFGUDtBQUdIQyxZQUFBQSxRQUFRLEVBQUUsQ0FIUDtBQUlIQyxZQUFBQSxXQUFXLEVBQUU7QUFKVjtBQURILFNBQUQsQ0FESDtBQVNKQyxRQUFBQSxLQUFLLEVBQUUsQ0FBQztBQUNKTCxVQUFBQSxLQUFLLEVBQUU7QUFDSEMsWUFBQUEsU0FBUyxFQUFFLFNBRFI7QUFFSEMsWUFBQUEsUUFBUSxFQUFFLEVBRlA7QUFHSEMsWUFBQUEsUUFBUSxFQUFFLENBSFA7QUFJSEMsWUFBQUEsV0FBVyxFQUFFO0FBSlY7QUFESCxTQUFEO0FBVEg7QUFUSDtBQWZpQixHQUE5QjtBQTRDSDs7QUFBQTtBQUlEO0FBQ0E7O0FBQ0EsSUFBSUUsR0FBRyxHQUFHNUwsUUFBUSxDQUFDNkwsY0FBVCxDQUF3Qix3QkFBeEIsQ0FBVjs7QUFDQSxJQUFHRCxHQUFILEVBQU87QUFDSCxNQUFJQSxHQUFHLEdBQUdBLEdBQUcsQ0FBQ3pMLFVBQUosQ0FBZSxJQUFmLENBQVY7QUFDQSxNQUFJMkwsT0FBTyxHQUFHLElBQUluQixLQUFKLENBQVVpQixHQUFWLEVBQWU7QUFDekJoQixJQUFBQSxJQUFJLEVBQUUsTUFEbUI7QUFFekJ4SyxJQUFBQSxJQUFJLEVBQUU7QUFDRjBLLE1BQUFBLE1BQU0sRUFBRSxDQUFDLE1BQUQsRUFBUyxNQUFULEVBQWlCLE1BQWpCLEVBQXlCLE1BQXpCLEVBQWlDLE1BQWpDLEVBQXlDLE1BQXpDLENBRE47QUFFRkMsTUFBQUEsUUFBUSxFQUFFLENBQUM7QUFDUEMsUUFBQUEsS0FBSyxFQUFFLGFBREE7QUFFUDVLLFFBQUFBLElBQUksRUFBRSxDQUFDLEVBQUQsRUFBSyxFQUFMLEVBQVMsQ0FBVCxFQUFZLENBQVosRUFBZSxDQUFmLEVBQWtCLENBQWxCLENBRkM7QUFHUHlLLFFBQUFBLGVBQWUsRUFBRSxDQUNiLHlCQURhLEVBRWIseUJBRmEsRUFHYix5QkFIYSxFQUliLHlCQUphLEVBS2IsMEJBTGEsRUFNYix5QkFOYSxDQUhWO0FBV1BrQixRQUFBQSxXQUFXLEVBQUUsQ0FDVCxvQkFEUyxFQUVULHVCQUZTLEVBR1QsdUJBSFMsRUFJVCx1QkFKUyxFQUtULHdCQUxTLEVBTVQsdUJBTlMsQ0FYTjtBQW1CUGQsUUFBQUEsV0FBVyxFQUFFO0FBbkJOLE9BQUQ7QUFGUixLQUZtQjtBQTBCekI3QixJQUFBQSxPQUFPLEVBQUU7QUFDTDhCLE1BQUFBLE1BQU0sRUFBRTtBQUNKQyxRQUFBQSxPQUFPLEVBQUU7QUFETCxPQURIO0FBSUxDLE1BQUFBLE1BQU0sRUFBRTtBQUNKQyxRQUFBQSxLQUFLLEVBQUUsQ0FBQztBQUNKQyxVQUFBQSxLQUFLLEVBQUU7QUFDSEksWUFBQUEsV0FBVyxFQUFDO0FBRFQ7QUFESCxTQUFEO0FBREg7QUFKSDtBQTFCZ0IsR0FBZixDQUFkO0FBdUNIOztBQUFBO0FBR0QsSUFBSUUsR0FBRyxHQUFHNUwsUUFBUSxDQUFDNkwsY0FBVCxDQUF3Qix3QkFBeEIsQ0FBVjs7QUFDQSxJQUFHRCxHQUFILEVBQU87QUFDSCxNQUFJQSxHQUFHLEdBQUdBLEdBQUcsQ0FBQ3pMLFVBQUosQ0FBZSxJQUFmLENBQVY7QUFDQSxNQUFJMkwsT0FBTyxHQUFHLElBQUluQixLQUFKLENBQVVpQixHQUFWLEVBQWU7QUFDekJoQixJQUFBQSxJQUFJLEVBQUUsTUFEbUI7QUFFekJ4SyxJQUFBQSxJQUFJLEVBQUU7QUFDRjBLLE1BQUFBLE1BQU0sRUFBRSxDQUFDLE1BQUQsRUFBUyxNQUFULEVBQWlCLE1BQWpCLEVBQXlCLE1BQXpCLEVBQWlDLE1BQWpDLEVBQXlDLE1BQXpDLENBRE47QUFFRkMsTUFBQUEsUUFBUSxFQUFFLENBQUM7QUFDUEMsUUFBQUEsS0FBSyxFQUFFLFlBREE7QUFFUDVLLFFBQUFBLElBQUksRUFBRSxDQUFDLEVBQUQsRUFBSyxFQUFMLEVBQVMsQ0FBVCxFQUFZLENBQVosRUFBZSxDQUFmLEVBQWtCLENBQWxCLENBRkM7QUFHUHlLLFFBQUFBLGVBQWUsRUFBRSxDQUNiLHlCQURhLEVBRWIseUJBRmEsRUFHYix5QkFIYSxFQUliLHlCQUphLEVBS2IsMEJBTGEsRUFNYix5QkFOYSxDQUhWO0FBV1BrQixRQUFBQSxXQUFXLEVBQUUsQ0FDVCxvQkFEUyxFQUVULHVCQUZTLEVBR1QsdUJBSFMsRUFJVCx1QkFKUyxFQUtULHdCQUxTLEVBTVQsdUJBTlMsQ0FYTjtBQW1CUGQsUUFBQUEsV0FBVyxFQUFFO0FBbkJOLE9BQUQ7QUFGUixLQUZtQjtBQTBCekI3QixJQUFBQSxPQUFPLEVBQUU7QUFDTDhCLE1BQUFBLE1BQU0sRUFBRTtBQUNKQyxRQUFBQSxPQUFPLEVBQUU7QUFETCxPQURIO0FBSUxDLE1BQUFBLE1BQU0sRUFBRTtBQUNKQyxRQUFBQSxLQUFLLEVBQUUsQ0FBQztBQUNKQyxVQUFBQSxLQUFLLEVBQUU7QUFDSEksWUFBQUEsV0FBVyxFQUFDO0FBRFQ7QUFESCxTQUFEO0FBREg7QUFKSDtBQTFCZ0IsR0FBZixDQUFkO0FBdUNIOztBQUFBLEMsQ0FHRDs7QUFDQSxJQUFJRSxHQUFHLEdBQUc1TCxRQUFRLENBQUM2TCxjQUFULENBQXdCLDhCQUF4QixDQUFWOztBQUNBLElBQUdELEdBQUgsRUFBTztBQUNILE1BQUlBLEdBQUcsR0FBR0EsR0FBRyxDQUFDekwsVUFBSixDQUFlLElBQWYsQ0FBVjtBQUNBLE1BQUkyTCxPQUFPLEdBQUcsSUFBSW5CLEtBQUosQ0FBVWlCLEdBQVYsRUFBZTtBQUN6QmhCLElBQUFBLElBQUksRUFBRSxNQURtQjtBQUV6QnhLLElBQUFBLElBQUksRUFBRTtBQUNGMEssTUFBQUEsTUFBTSxFQUFFLENBQUMsTUFBRCxFQUFTLE1BQVQsRUFBaUIsTUFBakIsRUFBeUIsTUFBekIsRUFBaUMsTUFBakMsRUFBeUMsTUFBekMsQ0FETjtBQUVGQyxNQUFBQSxRQUFRLEVBQUUsQ0FBQztBQUNQQyxRQUFBQSxLQUFLLEVBQUUsYUFEQTtBQUVQNUssUUFBQUEsSUFBSSxFQUFFLENBQUMsRUFBRCxFQUFLLEVBQUwsRUFBUyxDQUFULEVBQVksQ0FBWixFQUFlLENBQWYsRUFBa0IsQ0FBbEIsQ0FGQztBQUdQeUssUUFBQUEsZUFBZSxFQUFFLENBQ2IseUJBRGEsRUFFYix5QkFGYSxFQUdiLHlCQUhhLEVBSWIseUJBSmEsRUFLYiwwQkFMYSxFQU1iLHlCQU5hLENBSFY7QUFXUGtCLFFBQUFBLFdBQVcsRUFBRSxDQUNULG9CQURTLEVBRVQsdUJBRlMsRUFHVCx1QkFIUyxFQUlULHVCQUpTLEVBS1Qsd0JBTFMsRUFNVCx1QkFOUyxDQVhOO0FBbUJQZCxRQUFBQSxXQUFXLEVBQUU7QUFuQk4sT0FBRDtBQUZSLEtBRm1CO0FBMEJ6QjdCLElBQUFBLE9BQU8sRUFBRTtBQUNMOEIsTUFBQUEsTUFBTSxFQUFFO0FBQ0pDLFFBQUFBLE9BQU8sRUFBRTtBQURMLE9BREg7QUFJTEMsTUFBQUEsTUFBTSxFQUFFO0FBQ0pDLFFBQUFBLEtBQUssRUFBRSxDQUFDO0FBQ0pDLFVBQUFBLEtBQUssRUFBRTtBQUNISSxZQUFBQSxXQUFXLEVBQUM7QUFEVDtBQURILFNBQUQ7QUFESDtBQUpIO0FBMUJnQixHQUFmLENBQWQ7QUF1Q0g7O0FBQUE7QUFHRCxJQUFJRSxHQUFHLEdBQUc1TCxRQUFRLENBQUM2TCxjQUFULENBQXdCLDhCQUF4QixDQUFWOztBQUNBLElBQUdELEdBQUgsRUFBTztBQUNILE1BQUlBLEdBQUcsR0FBR0EsR0FBRyxDQUFDekwsVUFBSixDQUFlLElBQWYsQ0FBVjtBQUNBLE1BQUkyTCxPQUFPLEdBQUcsSUFBSW5CLEtBQUosQ0FBVWlCLEdBQVYsRUFBZTtBQUN6QmhCLElBQUFBLElBQUksRUFBRSxNQURtQjtBQUV6QnhLLElBQUFBLElBQUksRUFBRTtBQUNGMEssTUFBQUEsTUFBTSxFQUFFLENBQUMsTUFBRCxFQUFTLE1BQVQsRUFBaUIsTUFBakIsRUFBeUIsTUFBekIsRUFBaUMsTUFBakMsRUFBeUMsTUFBekMsQ0FETjtBQUVGQyxNQUFBQSxRQUFRLEVBQUUsQ0FBQztBQUNQQyxRQUFBQSxLQUFLLEVBQUUsWUFEQTtBQUVQNUssUUFBQUEsSUFBSSxFQUFFLENBQUMsRUFBRCxFQUFLLEVBQUwsRUFBUyxDQUFULEVBQVksQ0FBWixFQUFlLENBQWYsRUFBa0IsQ0FBbEIsQ0FGQztBQUdQeUssUUFBQUEsZUFBZSxFQUFFLENBQ2IseUJBRGEsRUFFYix5QkFGYSxFQUdiLHlCQUhhLEVBSWIseUJBSmEsRUFLYiwwQkFMYSxFQU1iLHlCQU5hLENBSFY7QUFXUGtCLFFBQUFBLFdBQVcsRUFBRSxDQUNULG9CQURTLEVBRVQsdUJBRlMsRUFHVCx1QkFIUyxFQUlULHVCQUpTLEVBS1Qsd0JBTFMsRUFNVCx1QkFOUyxDQVhOO0FBbUJQZCxRQUFBQSxXQUFXLEVBQUU7QUFuQk4sT0FBRDtBQUZSLEtBRm1CO0FBMEJ6QjdCLElBQUFBLE9BQU8sRUFBRTtBQUNMOEIsTUFBQUEsTUFBTSxFQUFFO0FBQ0pDLFFBQUFBLE9BQU8sRUFBRTtBQURMLE9BREg7QUFJTEMsTUFBQUEsTUFBTSxFQUFFO0FBQ0pDLFFBQUFBLEtBQUssRUFBRSxDQUFDO0FBQ0pDLFVBQUFBLEtBQUssRUFBRTtBQUNISSxZQUFBQSxXQUFXLEVBQUM7QUFEVDtBQURILFNBQUQ7QUFESDtBQUpIO0FBMUJnQixHQUFmLENBQWQ7QUF1Q0g7O0FBQUEiLCJmaWxlIjoiY3VzdG9tLmpzIiwic291cmNlc0NvbnRlbnQiOlsiJC5mbi5jdXN0b21UYWIgPSBmdW5jdGlvbiAodGFiQ29udGVudHMsIHBhcmVudF9hY3RpdmUgPSBmYWxzZSwgYWN0aXZlTmF2ID0gJ2FjdGl2ZS10YWInLCBhY3RpdmVDb250ZW50ID0gJ2FjdGl2ZS1jb250ZW50Jykge1xyXG4gICAgdmFyIHRhYkl0ZW0gPSB0aGlzO1xyXG4gICAgLy8gYWN0aXZlID0gJ2FjdGl2ZS10YWInLFxyXG4gICAgLy8gYWN0aXZlQ29udGVudCA9ICdhY3RpdmUtY29udGVudCc7XHJcbiAgICAkKHRhYkNvbnRlbnRzKS5lYWNoKGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAvKiBIaWRlIENvbnRlbnQgSXRlbSBXaXRob3V0IExpc3QgYWN0aXZlLXRhYiBpdGVtICovXHJcbiAgICAgICAgaWYgKCEoJCh0aGlzKS5oYXNDbGFzcyhhY3RpdmVDb250ZW50KSkpIHtcclxuICAgICAgICAgICAgJCh0aGlzKS5ub3QoJCh0YWJJdGVtKS5hdHRyKCdocmVmJykpLmhpZGUoKTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuXHJcbiAgICAvLyBmb3IgcGFyZW50XHJcbiAgICBpZiAocGFyZW50X2FjdGl2ZSkge1xyXG4gICAgICAgIHRhYkl0ZW0uZWFjaChmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIGlmICgkKHRoaXMpLmhhc0NsYXNzKGFjdGl2ZU5hdikpIHtcclxuICAgICAgICAgICAgICAgICQodGhpcykucGFyZW50KCkuYWRkQ2xhc3MoJ2FjdGl2ZS10YWItcGFyZW50Jyk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICAvLyAkKHRhYkl0ZW0uYXR0cignaHJlZicpKS5zaG93KCk7XHJcblxyXG4gICAgdGFiSXRlbS5vbignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB2YXIgJHRoaXMgPSAkKHRoaXMpLFxyXG4gICAgICAgICAgICB0YWJDb250ZW50SWQgPSAkdGhpcy5hdHRyKCdocmVmJyk7XHJcblxyXG4gICAgICAgIC8vIGZvciBwYXJlbnRcclxuICAgICAgICBpZiAocGFyZW50X2FjdGl2ZSkge1xyXG4gICAgICAgICAgICB0YWJJdGVtLmVhY2goZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5yZW1vdmVDbGFzcygnYWN0aXZlLXRhYi1wYXJlbnQnKTtcclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBpZiAoISR0aGlzLmhhc0NsYXNzKGFjdGl2ZU5hdikpIHtcclxuICAgICAgICAgICAgLy8gdGFiXHJcbiAgICAgICAgICAgIHRhYkl0ZW0ucmVtb3ZlQ2xhc3MoYWN0aXZlTmF2KTtcclxuICAgICAgICAgICAgJHRoaXMuYWRkQ2xhc3MoYWN0aXZlTmF2KTtcclxuXHJcbiAgICAgICAgICAgIC8vIGZvciBwYXJlbnRcclxuICAgICAgICAgICAgaWYgKHBhcmVudF9hY3RpdmUpIHtcclxuICAgICAgICAgICAgICAgICR0aGlzLnBhcmVudCgpLmFkZENsYXNzKCdhY3RpdmUtdGFiLXBhcmVudCcpO1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAvLyB0YWIgY29udGVudFxyXG4gICAgICAgICAgICAkKHRhYkNvbnRlbnRzKS5yZW1vdmVDbGFzcyhhY3RpdmVDb250ZW50KS5oaWRlKCk7XHJcbiAgICAgICAgICAgICQodGFiQ29udGVudElkKS5hZGRDbGFzcyhhY3RpdmVDb250ZW50KS5mYWRlSW4oJ3Nob3cnKTtcclxuICAgICAgICB9XHJcblxyXG4gICAgfSk7XHJcbn07XHJcblxyXG4vKiAgPT09PT09PT09PT09PT09PT09PT09PT09PT0gY2xpY2sgVG9nZ2xlIGZ1Y250aW9uID09PT09PT09PT09PT09PT09PT09PT09PT09PT0gKi9cclxuJC5mbi5jdXN0b21DbGlja1RvZ2dsZSA9IGZ1bmN0aW9uIChjb250ZW50LCBmYWRlID0gZmFsc2UpIHtcclxuICAgIHZhciBjbGlja2VyID0gdGhpcztcclxuICAgIHZhciBuZXdDb250ZW50ID0gJChjb250ZW50KTtcclxuICAgIG5ld0NvbnRlbnQuc2xpZGVVcCgpO1xyXG4gICAgY2xpY2tlci5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgaWYgKGZhZGUgPT0gdHJ1ZSkge1xyXG4gICAgICAgICAgICBuZXdDb250ZW50LnN0b3AoKS5mYWRlVG9nZ2xlKCdzaG93Jyk7XHJcbiAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgbmV3Q29udGVudC5zdG9wKCkuc2xpZGVUb2dnbGUoJ3Nob3cnKTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxufTtcclxuXHJcblxyXG4gIC8qID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT0gSW1hZ2UgQXZlcmFnZSBDb2xvciBQaWNrIFJlcGxhY2UgRmlyc3QgTGF0ZXIgQmFja2dyb3VuZCBDb2xvciA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PSAqL1xyXG4gIGZ1bmN0aW9uIGdldEF2ZXJhZ2VSR0IoaW1nRWwpIHtcclxuICAgICAgICBcclxuICAgIHZhciBibG9ja1NpemUgPSA1LCAvLyBvbmx5IHZpc2l0IGV2ZXJ5IDUgcGl4ZWxzXHJcbiAgICAgICAgZGVmYXVsdFJHQiA9IHtyOjAsZzowLGI6MH0sIC8vIGZvciBub24tc3VwcG9ydGluZyBlbnZzXHJcbiAgICAgICAgY2FudmFzID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnY2FudmFzJyksXHJcbiAgICAgICAgY29udGV4dCA9IGNhbnZhcy5nZXRDb250ZXh0ICYmIGNhbnZhcy5nZXRDb250ZXh0KCcyZCcpLFxyXG4gICAgICAgIGRhdGEsIHdpZHRoLCBoZWlnaHQsXHJcbiAgICAgICAgaSA9IC00LFxyXG4gICAgICAgIGxlbmd0aCxcclxuICAgICAgICByZ2IgPSB7cjowLGc6MCxiOjB9LFxyXG4gICAgICAgIGNvdW50ID0gMDtcclxuICAgIGlmICghY29udGV4dCkge1xyXG4gICAgICAgIHJldHVybiBkZWZhdWx0UkdCO1xyXG4gICAgfVxyXG4gICAgXHJcbiAgICBoZWlnaHQgPSBjYW52YXMuaGVpZ2h0ID0gaW1nRWwubmF0dXJhbEhlaWdodCB8fCBpbWdFbC5vZmZzZXRIZWlnaHQgfHwgaW1nRWwuaGVpZ2h0O1xyXG4gICAgd2lkdGggPSBjYW52YXMud2lkdGggPSBpbWdFbC5uYXR1cmFsV2lkdGggfHwgaW1nRWwub2Zmc2V0V2lkdGggfHwgaW1nRWwud2lkdGg7XHJcbiAgICBcclxuICAgIGNvbnRleHQuZHJhd0ltYWdlKGltZ0VsLCAwLCAwKTtcclxuICAgIC8vIGNvbnNvbGUubG9nKGNvbnRleHQuZHJhd0ltYWdlKGltZ0VsLCAwLCAwKSk7XHJcbiAgICB0cnkge1xyXG4gICAgICAgIGRhdGEgPSBjb250ZXh0LmdldEltYWdlRGF0YSgwLCAwLCB3aWR0aCwgaGVpZ2h0KTtcclxuICAgIH0gY2F0Y2goZSkge1xyXG4gICAgICAgIC8vIC8qIHNlY3VyaXR5IGVycm9yLCBpbWcgb24gZGlmZiBkb21haW4gKi9hbGVydCgneCcpO1xyXG4gICAgICAgIHJldHVybiBkZWZhdWx0UkdCO1xyXG4gICAgfVxyXG4gICAgXHJcbiAgICBsZW5ndGggPSBkYXRhLmRhdGEubGVuZ3RoO1xyXG4gICAgXHJcbiAgICB3aGlsZSAoIChpICs9IGJsb2NrU2l6ZSAqIDQpIDwgbGVuZ3RoICkge1xyXG4gICAgICAgICsrY291bnQ7XHJcbiAgICAgICAgcmdiLnIgKz0gZGF0YS5kYXRhW2ldO1xyXG4gICAgICAgIHJnYi5nICs9IGRhdGEuZGF0YVtpKzFdO1xyXG4gICAgICAgIHJnYi5iICs9IGRhdGEuZGF0YVtpKzJdO1xyXG4gICAgfVxyXG4gICAgXHJcbiAgICAvLyB+fiB1c2VkIHRvIGZsb29yIHZhbHVlc1xyXG4gICAgcmdiLnIgPSB+fihyZ2Iuci9jb3VudCk7XHJcbiAgICByZ2IuZyA9IH5+KHJnYi5nL2NvdW50KTtcclxuICAgIHJnYi5iID0gfn4ocmdiLmIvY291bnQpO1xyXG4gICAgcmV0dXJuIHJnYjsgXHJcbn1cclxuXHJcbiQuZm4uZ2V0SW1hZ2VDb2xvciA9IGZ1bmN0aW9uKCkge1xyXG4gICAgJCh0aGlzKS5lYWNoKCBmdW5jdGlvbigpIHtcclxuICAgICAgICB2YXIgJHRoaXMgPSAkKHRoaXMpO1xyXG4gICAgICAgIHZhciBpbWdTZWxlY3QgPSAkdGhpcy5maW5kKCcuaXRlbS1pbWcgYSBpbWcnKTtcclxuICAgICAgICAvLyBjb25zb2xlLmxvZyhpbWdTZWxlY3QpO1xyXG4gICAgICAgIGltZ1NlbGVjdC5tYXAoZnVuY3Rpb24oaW5kZXgsIGl0ZW0pIHtcclxuICAgICAgICAgICAgdmFyIHJnYiA9IGdldEF2ZXJhZ2VSR0IoaXRlbSk7XHJcbiAgICAgICAgICAgIC8vIGNvbnNvbGUubG9nKGl0ZW0pO1xyXG4gICAgICAgICAgICAvLyBjb25zb2xlLmxvZygnaW5kZXggJywgaW5kZXggLCAnICcsICdyZ2IoJytyZ2IucisnLCcrcmdiLmcrJywnK3JnYi5iKycpJyk7XHJcbiAgICAgICAgICAgICR0aGlzLmZpbmQoJy5maXJzdC1sZXR0ZXInKS5jc3MoJ2JhY2tncm91bmQnLCAncmdiKCcrcmdiLnIrJywnK3JnYi5nKycsJytyZ2IuYisnKScpO1xyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcbn07IiwiLyogPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09IERvY3VtZW50IFJlYWR5ID09PT09PT09PT09PT09PT09PT09PT09PT09PSAqL1xyXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbiAoKSB7XHJcbiAgICAvLyBHbG9iYWwgVmFyaWFibGVzXHJcbiAgICB2YXIgJHdpbmRvdyA9ICQod2luZG93KTtcclxuXHJcbiAgICAvLyBpbmxpbmUgdG8gYmFja2dyb3VuZCBpbWFnZVxyXG4gICAgJCgnW2RhdGEtYmctaW1hZ2VdJykuZWFjaChmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgdmFyIGltZyA9ICQodGhpcykuZGF0YSgnYmctaW1hZ2UnKTtcclxuICAgICAgICAkKHRoaXMpLmNzcyh7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICd1cmwoJyArIGltZyArICcpJyxcclxuICAgICAgICB9KTsgLy8gLnJlbW92ZUF0dHIoJ2RhdGEtYmctaW1hZ2UnKVxyXG4gICAgfSk7XHJcbiAgICAkKCdbZGF0YS1iZy1jb2xvcl0nKS5lYWNoKGZ1bmN0aW9uICgpIHtcclxuICAgICAgICB2YXIgY29sb3IgPSAkKHRoaXMpLmRhdGEoJ2JnLWNvbG9yJyk7XHJcbiAgICAgICAgJCh0aGlzKS5jc3Moe1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiBjb2xvcixcclxuICAgICAgICB9KTsgLy8gLnJlbW92ZUF0dHIoJ2RhdGEtYmctY29sb3InKVxyXG4gICAgfSk7XHJcblxyXG4gICAgLyogPT09PT09PT09PT09PT09PT09PT09PT0gTmF2YmFyIHN0aWNreSA9PT09PT09PT09PT09PT09PT09PT09PSAqLyBcclxuICAgIHZhciBoZWFkZXJOYXZiYXJXcmFwID0gJCgnLmltLWhlYWRlci1zdGlja3ktanMnKTtcclxuICAgIHZhciBuYXZiYXJPZmZzZXRUb3AgPSBoZWFkZXJOYXZiYXJXcmFwLm9mZnNldCgpLnRvcDtcclxuICAgIHZhciBuYXZiYXJDbGludEhlaWdodCA9IGhlYWRlck5hdmJhcldyYXAuaGVpZ2h0KCk7XHJcblxyXG4gICAgLy8gY29uc29sZS5sb2coaGVhZGVyTmF2YmFyV3JhcEVsZW1lbnQpO1xyXG4gICAgLy8gY29uc29sZS5sb2cobmF2YmFyU2Nyb2xsSGVpZ2h0KTtcclxuICAgIC8vIGNvbnNvbGUubG9nKG5hdmJhckNsaW50SGVpZ2h0KTtcclxuICAgIC8vIGNvbnNvbGUubG9nKGhlYWRlck5hdmJhcldyYXAuaGVpZ2h0KCkpO1xyXG5cclxuXHJcbiAgICAkd2luZG93Lm9uKCdzY3JvbGwnLCBmdW5jdGlvbiAoKSB7XHJcblx0XHRpZiggJHdpbmRvdy5zY3JvbGxUb3AoKSA+IG5hdmJhck9mZnNldFRvcCl7XHJcbiAgICAgICAgICAgIGhlYWRlck5hdmJhcldyYXAuY3NzKCdoZWlnaHQnLCBuYXZiYXJDbGludEhlaWdodCkuY2hpbGRyZW4oKS5hZGRDbGFzcygnaW0tZml4ZWQtc3RpY2t5Jyk7XHJcblx0XHR9IGVsc2Uge1xyXG5cdFx0XHRoZWFkZXJOYXZiYXJXcmFwLmNoaWxkcmVuKCkucmVtb3ZlQ2xhc3MoJ2ltLWZpeGVkLXN0aWNreScpO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG4gICAgXHJcbiAgICAvLyAkKCdib2R5Jykub24oJ3Jlc2l6ZScsIGZ1bmN0aW9uKCkge1xyXG4gICAgLy8gICAgIGlmIChkb2N1bWVudC5ib2R5LmNsaWVudEhlaWdodCA+IGRvY3VtZW50LmJvZHkuY2xpZW50SGVpZ2h0IHx8IGRvY3VtZW50LmJvZHkuY2xpZW50SGVpZ2h0IDwgZG9jdW1lbnQuYm9keS5jbGllbnRIZWlnaHQpIHtcclxuICAgIC8vICAgICAgICAgY29uc29sZS5sb2coXCJ3aW5kb3cgUmVzaXplXCIsICBkb2N1bWVudC5ib2R5LmNsaWVudEhlaWdodCk7XHJcbiAgICAvLyAgICAgfVxyXG4gICAgLy8gICAgIGNvbnNvbGUubG9nKFwiZG9jdW1lbnRcIiwgIGRvY3VtZW50LmJvZHkuY2xpZW50SGVpZ2h0KTtcclxuICAgIC8vIH0pO1xyXG4gICAgLy8gLy8gY29uc29sZS5sb2coXCJ3aW5kb3cgaGVpZ2h0XCIsICAkd2luZG93LmhlaWdodCgpKTtcclxuICAgIC8vIGNvbnNvbGUubG9nKFwiZG9jdW1lbnRcIiwgIGRvY3VtZW50LmJvZHkuY2xpZW50SGVpZ2h0KTtcclxuICAgIC8qIC0tLS0tLS0tLS0tLS0tLS0tLSBNb2JpbGUgU2lkZWJhciBNYW51IC0tLS0tLS0tLS0tLS0tLS0gKi9cclxuICAgIHZhciBBY2NvcmRpb24gPSBmdW5jdGlvbihlbCwgbXVsdGlwbGUpIHtcclxuICAgICAgICB0aGlzLmVsID0gZWwgfHwge307XHJcblxyXG4gICAgICAgIHRoaXMubXVsdGlwbGUgPSBtdWx0aXBsZSB8fCBmYWxzZTtcclxuXHJcbiAgICAgICAgJCgnLmRyb3Bkb3dubGluaycpLnBhcmVudCgpLmFkZENsYXNzKCdjYXJldC1kcm9wZG93bicpO1xyXG4gICAgICAgIHZhciBkcm9wZG93bmxpbmsgPSB0aGlzLmVsLmZpbmQoJy5kcm9wZG93bmxpbmsnKTtcclxuICAgICAgICBkcm9wZG93bmxpbmsub24oJ2NsaWNrJywge1xyXG4gICAgICAgICAgICAgICAgZWw6IHRoaXMuZWwsXHJcbiAgICAgICAgICAgICAgICBtdWx0aXBsZTogdGhpcy5tdWx0aXBsZVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICB0aGlzLmRyb3Bkb3duKTtcclxuICAgIH07XHJcblxyXG4gICAgQWNjb3JkaW9uLnByb3RvdHlwZS5kcm9wZG93biA9IGZ1bmN0aW9uKGUpIHtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgdmFyICRlbCA9IGUuZGF0YS5lbCxcclxuICAgICAgICAgICAgJHRoaXMgPSAkKHRoaXMpLFxyXG5cclxuICAgICAgICAgICAgJG5leHQgPSAkdGhpcy5uZXh0KCk7XHJcblxyXG4gICAgICAgICRuZXh0LnNsaWRlVG9nZ2xlKCk7XHJcbiAgICAgICAgJHRoaXMucGFyZW50KCkudG9nZ2xlQ2xhc3MoJ29wZW4nKTtcclxuXHJcbiAgICAgICAgaWYgKCFlLmRhdGEubXVsdGlwbGUpIHtcclxuICAgICAgICAgICAgLy8gU2hvdyBvbmx5IG9uZSBtZW51IGF0IHRoZSBzYW1lIHRpbWVcclxuICAgICAgICAgICAgJGVsLmZpbmQoJy5zdWJtZW51SXRlbXMnKS5ub3QoJG5leHQpLnNsaWRlVXAoKS5wYXJlbnQoKS5yZW1vdmVDbGFzcygnb3BlbicpO1xyXG4gICAgICAgIH1cclxuICAgIH07XHJcblxyXG4gICAgdmFyIGFjY29yZGlvbiA9IG5ldyBBY2NvcmRpb24oJCgnLmltLW1vYmlsZS1tZW51LWpzJyksIGZhbHNlKTtcclxuXHJcbiAgICAkKCcuaW0tbW9iaWxlLW1lbnUtY2FsbGVyLWpzJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB2YXIgbWFzayA9ICc8ZGl2IGNsYXNzPVwibWFzay1vdmVybGF5XCI+JztcclxuXHJcbiAgICAgICAgJCgnYm9keScpLnRvZ2dsZUNsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgICAkKG1hc2spLmhpZGUoKS5hcHBlbmRUbygnYm9keScpLmZhZGVJbignZmFzdCcpO1xyXG4gICAgICAgICQoJy5tYXNrLW92ZXJsYXksIC5pbS1tb2JpbGUtbWVudS1jbG9zZS1qcycpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICAkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICAgICAkKCcubWFzay1vdmVybGF5JykuZmFkZU91dCgpLnJlbW92ZSgpO1xyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcblxyXG4gICAgLyogLS0tLS0tLS0tLS0tLS0tLS0tIE1vYmlsZSBTaWRlYmFyIE1lbnUgLS0tLS0tLS0tLS0tLS0tLSAqL1xyXG4gICAgdmFyIGFjY29yZGlvbk9mZmNhbnZhcyA9IG5ldyBBY2NvcmRpb24oJCgnLmltLW9mZmNhbnZhcy1tZW51LWpzJyksIGZhbHNlKTtcclxuICAgICQoJy5pbS1vZmZjYW52YXMtYnRuLWpzJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB2YXIgbWFzayA9ICc8ZGl2IGNsYXNzPVwibWFzay1vdmVybGF5XCI+JztcclxuICAgICAgICAkKCdib2R5JykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICQobWFzaykuaGlkZSgpLmFwcGVuZFRvKCdib2R5JykuZmFkZUluKCdmYXN0Jyk7XHJcbiAgICAgICAgJCgnLm1hc2stb3ZlcmxheSwgLmltLW9mZmNhbnZhcy1tZW51LWNsb3NlLWpzJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICQoJ2JvZHknKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgICAgICQoJy5tYXNrLW92ZXJsYXknKS5mYWRlT3V0KCkucmVtb3ZlKCk7XHJcbiAgICAgICAgfSk7XHJcbiAgICB9KTtcclxuXHJcbiAgICAvKiAtLS0tLS0tLS0tLS0tLS0tLS0gY29tcGFyZSBTaWRlYmFyIE1lbnUgLS0tLS0tLS0tLS0tLS0tLSAqL1xyXG4gICAgJCgnLmltLWNvbXBhcmUtcG9wLWJ0bi1qcycpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpIHtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgdmFyIG1hc2sgPSAnPGRpdiBjbGFzcz1cIm1hc2stb3ZlcmxheVwiPic7XHJcbiAgICAgICAgJCgnYm9keScpLnRvZ2dsZUNsYXNzKCdjb21wYXJlLXNpZGViYXItYWN0aXZlJyk7XHJcbiAgICAgICAgJChtYXNrKS5oaWRlKCkuYXBwZW5kVG8oJ2JvZHknKS5mYWRlSW4oJ2Zhc3QnKTtcclxuICAgICAgICAkKCcubWFzay1vdmVybGF5LCAuaW0tY29tcGFyZS1zaWRlYmFyLWNsb3NlLWpzJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICQoJ2JvZHknKS5yZW1vdmVDbGFzcygnY29tcGFyZS1zaWRlYmFyLWFjdGl2ZScpO1xyXG4gICAgICAgICAgICAkKCcubWFzay1vdmVybGF5JykuZmFkZU91dCgpLnJlbW92ZSgpO1xyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcblxyXG4gICAgLyogPT09PT09PT09PT09PT09PT09PT0gY2xpY2sgdG9nZ2xlIGZ1bmN0aW9uID09PT09PT09PT09PT09PT09PT09ICovXHJcbiAgICAvLyBMYW5ndWFnZSBDbGlja1xyXG4gICAgdmFyIGxhbmdDbGlja2VyID0gJCgnLmhlYWRlci1sYW5nLWpzJyk7XHJcbiAgICBsYW5nQ2xpY2tlci5jdXN0b21DbGlja1RvZ2dsZSgnLmhlYWRlci1sYW5nLXdyYXAtanMnKTtcclxuICAgIFxyXG4gICAgLy8gRm9ybSBDbGljayBGdWNudGlvblxyXG4gICAgdmFyIHNlYXJjaENsaWNrZXIgPSAkKCcuaGVhZGVyLXNlYXJjaC1pY29uLWpzJyk7XHJcbiAgICBzZWFyY2hDbGlja2VyLm9uKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAkKHRoaXMpLnRvZ2dsZUNsYXNzKCdzaG93Jyk7XHJcbiAgICAgICAgJCgnLmhlYWRlci1zZWFyY2gtZm9ybS13cmFwLWpzJykuYW5pbWF0ZSh7XHJcbiAgICAgICAgICAgd2lkdGg6ICd0b2dnbGUnIFxyXG4gICAgICAgIH0sIDcwMCk7XHJcbiAgICB9KTtcclxuICAgIC8vIHNlYXJjaENsaWNrZXIuY3VzdG9tQ2xpY2tUb2dnbGUoJy5oZWFkZXItc2VhcmNoLWZvcm0td3JhcC1qcycsIHtcclxuICAgIC8vICAgICBmYWRlOiB0cnVlLFxyXG4gICAgLy8gfSk7XHJcbiAgICBcclxuXHJcbiAgICAvKiBBZHMgUG9wIFVwIEhpZGluZyAqL1xyXG4gICAgdmFyIGFkc1BvcFJlbW92ZUJ1dHRvbiA9ICQoJy5pbS1wb3B1cC1hZHMgLnJlbW92ZV9idG4nKTtcclxuICAgIGFkc1BvcFJlbW92ZUJ1dHRvbi5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgJCgnLmltLXBvcHVwLWFkcycpLnNsaWRlVXAoJ3Nob3cnKTtcclxuICAgIH0pO1xyXG5cclxuICAgIC8vIC8qIEJlbmNobWFyayBUYWIgKi9cclxuICAgIHZhciBiZW5jaG1hcmtDYXRJdGVtID0gJCgnLmJlbmNobWFyay1jYXRlZ29yeS1qcyBsaSBhJyk7XHJcbiAgICBiZW5jaG1hcmtDYXRJdGVtLmN1c3RvbVRhYignLmJlYWNobWFyay1wcm9kdWN0LWl0ZW0tanMnKTtcclxuXHJcbiAgICB2YXIgcnVuaW5nUHJvZHVjdENhdEl0ZW0gPSAkKCcuaW0tcnVuaW5nLXRhYi1uYXZiYXItbGlzdC1qcyBsaSBhJyk7XHJcbiAgICBydW5pbmdQcm9kdWN0Q2F0SXRlbS5jdXN0b21UYWIoJy5pbS1ydW5pbmctdGFiLWl0ZW0tanMnKTtcclxuXHJcbiAgICAvKiBQcm9kdWN0IERldGFpbCBUYWIgKi9cclxuICAgIC8vIHZhciBwcm9kdWN0RGV0YWxzVGFiID0gJCgnLmltLXRhYjItbmF2YmFyLWpzIGxpIGEnKTtcclxuICAgIC8vIHByb2R1Y3REZXRhbHNUYWIuY3VzdG9tVGFiKCcuaW0tdGFiMi1pdGVtcy1qcycpO1xyXG4gICAgJCgnLmltLXByaWNlLWhpc3RvcnktbWFya2V0IGxpIGEnKS5jdXN0b21UYWIoJy5pbS1wcmljZS1mdWxsLWNoYXJ0LWNvbnRlbnQgLmltLXByaWNlLWZ1bGwtY2hhcnQtaXRlbScpO1xyXG4gICAgJCgnLmltLXByaWNlLWZpbHRlci10aW1lIGxpIGEnKS5jdXN0b21UYWIoJy5pbS1wcmljZS1oaXN0b3J5LWNoYXJ0LWNvbnRlbnQgLmltLXByaWNlLWhpc3RvcnktY2hhcnQnKTtcclxuICAgICQoJy5pbS1mZWF0dXJlLXByb2R1Y3QtMi1uYXZiYXItanMgbGkgYScpLmN1c3RvbVRhYignLmltLWZlYXR1cmUtMi10YWItY29udGVudC1qcyAucHJvZHVjdC1pdGVtJyk7XHJcbiAgICAvLy8vIEZlYXR1cmUgUHJvZHVjdCBjbGlja1xyXG4gICAgJCgnLmltLWZlYXR1cmUtdGFiLW5hdmJhci1qcyBsaSBhJykuY3VzdG9tVGFiKCcuaW0tZmVhdHVyZS10YWItY29udGVudCAuY29udGVudC1pdGVtJywgZnVuY3Rpb24oKSB7dmFyIHBhcmVudF9hY3RpdmUgPSB0cnVlO30pO1xyXG4gICAgLy8vLyBDb21hcHJlIHByb2R1Y3Qgc2lkZWJhclxyXG4gICAgJCgnLmltLWNvbXBhcmUtc2lkZWJhci1uYXZiYXItanMgbGkgYScpLmN1c3RvbVRhYignLmltLWNvbXBhcmUtdGFiLWNvbnRhY3QtanMgLnRhYi1pdGVtJyk7XHJcblxyXG5cclxuICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PSBTdGFyIENvdW50aW5nXHJcbiAgICB2YXIgcmFuZ2VTbGlkZXIgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgdmFyIHNsaWRlciA9ICQoJy5pbS1yYW5nZS1zbGlkZXInKSxcclxuICAgICAgICAgICAgcmFuZ2UgPSAkKCcuaW0tcmFuZ2Utc2xpZGVyLXJhbmdlJyksXHJcbiAgICAgICAgICAgIHZhbHVlID0gJCgnLmltLXJhbmdlLXNsaWRlci12YWx1ZScpO1xyXG5cclxuICAgICAgICBzbGlkZXIuZWFjaChmdW5jdGlvbiAoKSB7XHJcblxyXG4gICAgICAgICAgICB2YWx1ZS5lYWNoKGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgICAgIHZhciB2YWx1ZSA9ICQodGhpcykucHJldigpLmF0dHIoJ3ZhbHVlJyk7XHJcbiAgICAgICAgICAgICAgICAkKHRoaXMpLmh0bWwodmFsdWUpO1xyXG4gICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgIHJhbmdlLm9uKCdpbnB1dCcsIGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgICAgICQodGhpcykubmV4dCh2YWx1ZSkuaHRtbCh0aGlzLnZhbHVlKTtcclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfSk7XHJcbiAgICB9O1xyXG4gICAgcmFuZ2VTbGlkZXIoKTtcclxuXHJcbiAgICAvLyBGaWx0ZXJpbmcgSnNcclxuICAgIHZhciBmaWx0ZXJJdGVtID0gJCgnLmZpbHRlci1mb3ItdmlldyBidXR0b24nKTtcclxuICAgIGZpbHRlckl0ZW0ub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgdmFyICR0aGlzID0gJCh0aGlzKTtcclxuICAgICAgICBmaWx0ZXJJdGVtLm5vdCgkdGhpcykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgIGlmICgkdGhpcy5oYXNDbGFzcygnaW0tZ3JpZC1maWx0ZXItanMnKSkge1xyXG4gICAgICAgICAgICAkdGhpcy5hZGRDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgICAgICQoJy5pbS1mb3Itdmlldy1qcycpLnJlbW92ZUNsYXNzKCdpbS1saXN0LXZpZXcnKS5hZGRDbGFzcygnaW0tZ3JpZC12aWV3Jyk7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGVsc2UgaWYoJHRoaXMuaGFzQ2xhc3MoJ2ltLWxpc3QtZmlsdGVyLWpzJykpIHtcclxuICAgICAgICAgICAgJHRoaXMuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICAgICAkKCcuaW0tZm9yLXZpZXctanMnKS5yZW1vdmVDbGFzcygnaW0tZ3JpZC12aWV3JykuYWRkQ2xhc3MoJ2ltLWxpc3QtdmlldycpO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG5cclxuXHJcbiAgICB2YXIgY291bnRlckpzID0gJCgnLmNvdW50LWpzJyk7XHJcbiAgICAvLyBjb3VudGVySnMuZWFjaChmdW5jdGlvbiAoKSB7XHJcbiAgICAvLyAgICAgLy8gUGx1Z2luIE5hbWUgQ291bnRlciBKc1xyXG4gICAgLy8gICAgICQodGhpcykuY291bnRlclVwKHtcclxuICAgIC8vICAgICAgICAgZGVsYXk6IDEwLFxyXG4gICAgLy8gICAgICAgICB0aW1lOiAyMDAwXHJcbiAgICAvLyAgICAgfSk7XHJcbiAgICAvLyB9KTtcclxuXHJcbiAgICB2YXIgc3RhaWNreVNpZGViYXIgPSAgJCgnLndpZGdldC1zdGlja3knKTtcclxuICAgIHN0YWlja3lTaWRlYmFyLnN0aWNrX2luX3BhcmVudCh7XHJcbiAgICAgICAgb2Zmc2V0X3RvcDogNzUsXHJcbiAgICB9KTtcclxuXHJcblxyXG5cclxuICAgIC8qID09PT09PT09PT09PT09PT09PT09PT0gUHJvZHVjdCByZXZpZXcgUHJvZ3Jlc3MgYmFyID09PT09PT09PT09PT09PT09PT09PT0gKi9cclxuICAgIC8qIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tIEJvb3RzdHJhcCBQcm9ncmVzc0JhciAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tICovXHJcbiAgICB2YXIgd2F5cG9pbnRzID0gJCgnLnByb2dyZXNzLWJhcicpLndheXBvaW50KGZ1bmN0aW9uIChkaXJlY3Rpb24pIHtcclxuICAgICAgICAkKCcucHJvZ3Jlc3MgLnByb2dyZXNzLWJhcicpLnByb2dyZXNzYmFyKHtcclxuICAgICAgICAgICAgZGlzcGxheV90ZXh0OiAnZmlsbCdcclxuICAgICAgICB9KTtcclxuICAgICAgICAkKCcucHJvZ3Jlc3MgLnByb2dyZXNzLWJhcicpLnByb2dyZXNzYmFyKHtcclxuICAgICAgICAgICAgZGlzcGxheV90ZXh0OiAnZmlsbCdcclxuICAgICAgICB9KTtcclxuXHJcbiAgICB9LCB7XHJcbiAgICAgICAgb2Zmc2V0OiAnMTQwJSdcclxuICAgIH0pO1xyXG5cclxuICAgICQoXCIuaW0tY291bnRpbmctcHJvZ3Jlc3NcIikua25vYih7XHJcbiAgICAgICAgd2lkdGg6ICcyMCcsXHJcbiAgICAgICAgaGVpZ2h0OiAnMjAnLFxyXG4gICAgICAgIGJnQ29sb3I6ICcjZDdkN2Q3JyxcclxuICAgICAgICBmZ0NvbG9yOiAnIzAxYmQxYicsXHJcbiAgICAgICAgcmVhZE9ubHk6IHRydWUsXHJcbiAgICAgICAgbGluZUNhcDogJ3JvdW5kJyxcclxuICAgIH0pO1xyXG5cclxuICAgIC8qID09PT09PT09PT09PT09PT09PT09PT09PSBWZW5vIEJveCA9PT09PT09PT09PT09PT09PT09PT09PT09ICovXHJcbiAgICAvLyBWaWRlbyBQb3AgdXBcclxuICAgIHZhciB2aWRlb1BvcFVwVmVub2JveCA9ICQoJy5pbS12aWRlby1wb3AtanMnKTtcclxuICAgIHZpZGVvUG9wVXBWZW5vYm94LnZlbm9ib3goe1xyXG4gICAgICAgIGF1dG9wbGF5OiB0cnVlLFxyXG4gICAgICAgIHNwaW5uZXI6ICdkb3VibGUtYm91bmNlJ1xyXG4gICAgfSk7XHJcbiAgICBcclxuICAgIC8qID09PT09PT09PT09PT09PT09PT09IFNsaWNrIFNsaWRlckFjdGl2ZSA9PT09PT09PT09PT09PT09PT0gKi9cclxuICAgIC8vIFdpZGdldCBUb3AgQ29tbWVudFxyXG4gICAgJCgnLmltLWJhbm5lci1zbGlkZXItanMnKS5zbGljayh7XHJcbiAgICAgICAgLy8gcGx1Z2luIE5hbWU6IFNsaWNrIENhcm91c2VsLCBmb3IgSG9tZSBQcm9kdWN0IGJhbm5lclxyXG4gICAgICAgIGF1dG9wbGF5OiBmYWxzZSxcclxuICAgICAgICBhdXRvcGxheVNwZWVkOiA1MDAwLFxyXG4gICAgICAgIGRvdHM6IGZhbHNlLFxyXG4gICAgICAgIGFycm93czogZmFsc2UsXHJcbiAgICAgICAgaW5maW5pdGU6IHRydWUsXHJcbiAgICAgICAgc3BlZWQ6IDcwMCxcclxuICAgICAgICBzbGlkZXNUb1Nob3c6IDEsXHJcbiAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDEsXHJcbiAgICB9KTtcclxuICAgIFxyXG4gICAgLy8gV2lkZ2V0IFRvcCBDb21tZW50XHJcbiAgICB2YXIgc2lkZWJhckNvbW1lbnRTbGllciA9ICQoJy5pbS13aWRnZXQtdG9wLWNvbW1lbnQtYWN0aXZlLWpzJyk7XHJcbiAgICBzaWRlYmFyQ29tbWVudFNsaWVyLmVhY2goIGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIHNpZGViYXJDb21tZW50U2xpZXIuc2xpY2soe1xyXG4gICAgICAgICAgICBhdXRvcGxheTogdHJ1ZSxcclxuICAgICAgICAgICAgYXV0b3BsYXlTcGVlZDogNTAwMCxcclxuICAgICAgICAgICAgZG90czogdHJ1ZSxcclxuICAgICAgICAgICAgYXJyb3dzOiBmYWxzZSxcclxuICAgICAgICAgICAgaW5maW5pdGU6IHRydWUsXHJcbiAgICAgICAgICAgIHNwZWVkOiA3MDAsXHJcbiAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogMSxcclxuICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDEsXHJcbiAgICAgICAgfSk7XHJcbiAgICB9KTtcclxuXHJcbiAgICAvLyBXaWRnZXQgQ291cG9uXHJcbiAgICB2YXIgc2lkZWJhckNvdXBvblNsaWRlciA9ICQoJy53aWRnZXQtY291cG9uLWFjdGl2ZScpO1xyXG4gICAgc2lkZWJhckNvdXBvblNsaWRlci5lYWNoKCBmdW5jdGlvbigpIHtcclxuICAgICAgICBzaWRlYmFyQ291cG9uU2xpZGVyLnNsaWNrKHtcclxuICAgICAgICAgICAgYXV0b3BsYXk6IHRydWUsXHJcbiAgICAgICAgICAgIGF1dG9wbGF5U3BlZWQ6IDUwMDAsXHJcbiAgICAgICAgICAgIGRvdHM6IGZhbHNlLFxyXG4gICAgICAgICAgICBhcnJvd3M6IHRydWUsXHJcbiAgICAgICAgICAgIHByZXZBcnJvdzogJy53aWRnZXQtY291cG9uLWFycm93cyAuYXJyb3ctcHJldicsXHJcbiAgICAgICAgICAgIG5leHRBcnJvdzogJy53aWRnZXQtY291cG9uLWFycm93cyAuYXJyb3ctbmV4dCcsXHJcbiAgICAgICAgICAgIGluZmluaXRlOiB0cnVlLFxyXG4gICAgICAgICAgICBzcGVlZDogNzAwLFxyXG4gICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDEsXHJcbiAgICAgICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAxLFxyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcblxyXG4gICAgLy8gV2lkZ2V0IENvdXBvblxyXG4gICAgJCgnLndpZGdldC1wcm9zLWFjdGl2ZScpLnNsaWNrKHtcclxuICAgICAgICBhdXRvcGxheTogdHJ1ZSxcclxuICAgICAgICBhdXRvcGxheVNwZWVkOiA1MDAwLFxyXG4gICAgICAgIGRvdHM6IGZhbHNlLFxyXG4gICAgICAgIGFycm93czogdHJ1ZSxcclxuICAgICAgICBwcmV2QXJyb3c6ICcud2lkZ2V0LXByb3MtYXJyb3dzIC5hcnJvdy1wcmV2JyxcclxuICAgICAgICBuZXh0QXJyb3c6ICcud2lkZ2V0LXByb3MtYXJyb3dzIC5hcnJvdy1uZXh0JyxcclxuICAgICAgICBpbmZpbml0ZTogdHJ1ZSxcclxuICAgICAgICBzcGVlZDogNzAwLFxyXG4gICAgICAgIHNsaWRlc1RvU2hvdzogMSxcclxuICAgICAgICBzbGlkZXNUb1Njcm9sbDogMSxcclxuICAgIH0pO1xyXG5cclxuICAgIC8vIFJldmlldyBJdGVtIHNsaWRlclxyXG4gICAgJCgnLnJldmlldy1zbGlkZXItYWN0aXZlJykuc2xpY2soe1xyXG4gICAgICAgIGF1dG9wbGF5OiB0cnVlLFxyXG4gICAgICAgIGF1dG9wbGF5U3BlZWQ6IDUwMDAsXHJcbiAgICAgICAgZmFkZTogdHJ1ZSxcclxuICAgICAgICBkb3RzOiBmYWxzZSxcclxuICAgICAgICBhcnJvd3M6IHRydWUsXHJcbiAgICAgICAgcHJldkFycm93OiAnLnJldmlldy1hcnJvd3MgLmFycm93LXByZXYnLFxyXG4gICAgICAgIG5leHRBcnJvdzogJy5yZXZpZXctYXJyb3dzIC5hcnJvdy1uZXh0JyxcclxuICAgICAgICBpbmZpbml0ZTogdHJ1ZSxcclxuICAgICAgICBzcGVlZDogNzAwLFxyXG4gICAgICAgIHNsaWRlc1RvU2hvdzogMSxcclxuICAgICAgICBzbGlkZXNUb1Njcm9sbDogMSxcclxuICAgIH0pO1xyXG5cclxuICAgICQoJy5yZXZpZXctc2xpZGVyLTItYWN0aXZlJykuc2xpY2soe1xyXG4gICAgICAgIGF1dG9wbGF5OiB0cnVlLFxyXG4gICAgICAgIGF1dG9wbGF5U3BlZWQ6IDUwMDAsXHJcbiAgICAgICAgZmFkZTogdHJ1ZSxcclxuICAgICAgICBkb3RzOiBmYWxzZSxcclxuICAgICAgICBhcnJvd3M6IHRydWUsXHJcbiAgICAgICAgcHJldkFycm93OiAnLnJldmlldy1hcnJvd3MtMiAuYXJyb3ctcHJldicsXHJcbiAgICAgICAgbmV4dEFycm93OiAnLnJldmlldy1hcnJvd3MtMiAuYXJyb3ctbmV4dCcsXHJcbiAgICAgICAgaW5maW5pdGU6IHRydWUsXHJcbiAgICAgICAgc3BlZWQ6IDcwMCxcclxuICAgICAgICBzbGlkZXNUb1Nob3c6IDEsXHJcbiAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDEsXHJcbiAgICB9KTtcclxuXHJcbiAgICB2YXIgcHJvZHVjdFNsaWRlcldyYXAgPSAkKCcuaW0tcHJvZHVjdC1zbGlkZXItd3JhcC1qcycpO1xyXG4gICAgcHJvZHVjdFNsaWRlcldyYXAuc2xpY2soe1xyXG4gICAgICAgIC8vIHBsdWdpbjogU2xpY2ssIFByb2R1Y3QgU2xpZGVyIGluIEJFU1QgUFJPRFVDVCBQUk9NT1RJT05TIE9GIFRIRSBXRUVLIG9mICdIb21lLVByb2R1Y3QnIHBhZ2VcclxuICAgICAgICBhdXRvcGxheTogdHJ1ZSxcclxuICAgICAgICBhdXRvcGxheVNwZWVkOiA1MDAwLFxyXG4gICAgICAgIGZhZGU6IHRydWUsXHJcbiAgICAgICAgZG90czogZmFsc2UsXHJcbiAgICAgICAgYXJyb3dzOiB0cnVlLFxyXG4gICAgICAgIHByZXZBcnJvdzogJy5pbS1lbC1wcm9kdWN0LXNsaWRlciAuYXJyb3ctcHJldicsXHJcbiAgICAgICAgbmV4dEFycm93OiAnLmltLWVsLXByb2R1Y3Qtc2xpZGVyIC5hcnJvdy1uZXh0JyxcclxuICAgICAgICBpbmZpbml0ZTogdHJ1ZSxcclxuICAgICAgICBzcGVlZDogNzAwLFxyXG4gICAgICAgIHNsaWRlc1RvU2hvdzogMSxcclxuICAgICAgICBzbGlkZXNUb1Njcm9sbDogMSxcclxuICAgICAgICBsYXp5TG9hZDogJ29uZGVtYW5kJyxcclxuICAgIH0pO1xyXG5cclxuICAgICQoJy5pbS1wcm9kdWN0LWZ1bGwtd3JhcC1qcycpLnNsaWNrKHtcclxuICAgICAgICBhdXRvcGxheTogZmFsc2UsXHJcbiAgICAgICAgYXV0b3BsYXlTcGVlZDogNTAwMCxcclxuICAgICAgICAvLyBmYWRlOiB0cnVlLFxyXG4gICAgICAgIGRvdHM6IGZhbHNlLFxyXG4gICAgICAgIGFycm93czogZmFsc2UsXHJcbiAgICAgICAgLy8gcHJldkFycm93OiAnLnJldmlldy1hcnJvd3MtMiAuYXJyb3ctcHJldicsXHJcbiAgICAgICAgLy8gbmV4dEFycm93OiAnLnJldmlldy1hcnJvd3MtMiAuYXJyb3ctbmV4dCcsXHJcbiAgICAgICAgaW5maW5pdGU6IHRydWUsXHJcbiAgICAgICAgc3BlZWQ6IDcwMCxcclxuICAgICAgICBzbGlkZXNUb1Nob3c6IDUsXHJcbiAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDUsXHJcbiAgICAgICAgcmVzcG9uc2l2ZTogW3tcclxuICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDEzOTksXHJcbiAgICAgICAgICAgICAgICBzZXR0aW5nczoge1xyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogNCxcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Njcm9sbDogNFxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICBicmVha3BvaW50OiAxMTk5LFxyXG4gICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDMsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDNcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgYnJlYWtwb2ludDogNzY3LFxyXG4gICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDIsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDJcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgYnJlYWtwb2ludDogNTc1LFxyXG4gICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDEsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDFcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICBdXHJcbiAgICB9KTtcclxuXHJcbiAgICAkKCcuaW0tYmlnLW9mZmVyLWl0ZW0tanMnKS5zbGljayh7XHJcbiAgICAgICAgYXV0b3BsYXk6IHRydWUsXHJcbiAgICAgICAgYXV0b3BsYXlTcGVlZDogNTAwMCxcclxuICAgICAgICAvLyBmYWRlOiB0cnVlLFxyXG4gICAgICAgIGRvdHM6IGZhbHNlLFxyXG4gICAgICAgIGFycm93czogZmFsc2UsXHJcbiAgICAgICAgaW5maW5pdGU6IHRydWUsXHJcbiAgICAgICAgc3BlZWQ6IDcwMCxcclxuICAgICAgICBzbGlkZXNUb1Nob3c6IDEsXHJcbiAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDEsXHJcbiAgICB9KTtcclxuXHJcbiAgICAkKCcuaW0tcHJvZHVjdC1nYWxsZXJ5Jykuc2xpY2soe1xyXG4gICAgICAgIHNsaWRlc1RvU2hvdzogMSxcclxuICAgICAgICBzbGlkZXNUb1Njcm9sbDogMSxcclxuICAgICAgICBhcnJvd3M6IGZhbHNlLFxyXG4gICAgICAgIGluZmluaXRlOiB0cnVlLFxyXG4gICAgICAgIGRvdHM6IGZhbHNlLFxyXG4gICAgICAgIGRyYWdnYWJsZTogZmFsc2UsXHJcbiAgICAgICAgYXV0b3BsYXk6IGZhbHNlLFxyXG4gICAgICAgIGF1dG9wbGF5U3BlZWQ6IDIwMDAsXHJcbiAgICAgICAgYXNOYXZGb3I6ICcuaW0tcHJvZHVjdC1nYWxsZXJ5LXRodW1iJ1xyXG4gICAgfSk7XHJcblxyXG4gICAgJCgnLmltLXByb2R1Y3QtZ2FsbGVyeS10aHVtYicpLnNsaWNrKHtcclxuICAgICAgICBzbGlkZXNUb1Nob3c6IDUsXHJcbiAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDUsXHJcbiAgICAgICAgYXNOYXZGb3I6ICcuaW0tcHJvZHVjdC1nYWxsZXJ5JyxcclxuICAgICAgICBkb3RzOiBmYWxzZSxcclxuICAgICAgICBjZW50ZXJNb2RlOiBmYWxzZSxcclxuICAgICAgICBmb2N1c09uU2VsZWN0OiB0cnVlLFxyXG4gICAgICAgIGFycm93czogZmFsc2UsXHJcbiAgICAgICAgcmVzcG9uc2l2ZTogW3tcclxuICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDc2OCxcclxuICAgICAgICAgICAgICAgIHNldHRpbmdzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgaW5maW5pdGU6IHRydWUsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TaG93OiA0LFxyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAxXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDU3NixcclxuICAgICAgICAgICAgICAgIHNldHRpbmdzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TaG93OiAzLFxyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAxXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgXVxyXG4gICAgfSk7XHJcblxyXG4gICAgLy8gUmV2aWV3cyByYXRpbmdcclxuICAgICQoJy5pbS1yYXRpbmctbWFya2V0LWpzJykuc2xpY2soe1xyXG4gICAgICAgIHNsaWRlc1RvU2hvdzogNixcclxuICAgICAgICBzbGlkZXNUb1Njcm9sbDogNixcclxuICAgICAgICBhcnJvd3M6IGZhbHNlLFxyXG4gICAgICAgIC8vIHByZXZBcnJvdzogJy50ZXN0aV9wcmV2JyxcclxuICAgICAgICAvLyBuZXh0QXJyb3c6ICcudGVzdGlfbmV4dCcsXHJcbiAgICAgICAgLy8gZmFkZTogdHJ1ZSxcclxuICAgICAgICBpbmZpbml0ZTogdHJ1ZSxcclxuICAgICAgICBkb3RzOiBmYWxzZSxcclxuICAgICAgICBhdXRvcGxheTogdHJ1ZSxcclxuICAgICAgICBhdXRvcGxheVNwZWVkOiA0MDAwLFxyXG4gICAgICAgIHJlc3BvbnNpdmU6IFt7XHJcbiAgICAgICAgICAgICAgICBicmVha3BvaW50OiAxMjAwLFxyXG4gICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcclxuICAgICAgICAgICAgICAgICAgICBpbmZpbml0ZTogdHJ1ZSxcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDQsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDRcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgYnJlYWtwb2ludDogOTkyLFxyXG4gICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDMsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDNcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgYnJlYWtwb2ludDogNzY4LFxyXG4gICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcclxuICAgICAgICAgICAgICAgICAgICBpbmZpbml0ZTogdHJ1ZSxcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDIsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDIsXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDU3NixcclxuICAgICAgICAgICAgICAgIHNldHRpbmdzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TaG93OiAxLFxyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAxLFxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgXVxyXG4gICAgfSk7XHJcblxyXG4gICAgLy8gUmV2aWV3cyByYXRpbmdcclxuICAgICQoJy5pbS1yYXRpbmctbWFya2V0LWpzLXJldmlldycpLnNsaWNrKHtcclxuICAgICAgICBzbGlkZXNUb1Nob3c6IDYsXHJcbiAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDYsXHJcbiAgICAgICAgYXJyb3dzOiBmYWxzZSxcclxuICAgICAgICBpbmZpbml0ZTogdHJ1ZSxcclxuICAgICAgICBkb3RzOiBmYWxzZSxcclxuICAgICAgICBhdXRvcGxheTogdHJ1ZSxcclxuICAgICAgICBhdXRvcGxheVNwZWVkOiA0MDAwLFxyXG4gICAgICAgIHJlc3BvbnNpdmU6IFt7XHJcbiAgICAgICAgICAgICAgICBicmVha3BvaW50OiAxMjAwLFxyXG4gICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcclxuICAgICAgICAgICAgICAgICAgICBpbmZpbml0ZTogdHJ1ZSxcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDQsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDRcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgYnJlYWtwb2ludDogOTkyLFxyXG4gICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDMsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDNcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgYnJlYWtwb2ludDogNzY4LFxyXG4gICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcclxuICAgICAgICAgICAgICAgICAgICBpbmZpbml0ZTogdHJ1ZSxcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDIsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDIsXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDU3NixcclxuICAgICAgICAgICAgICAgIHNldHRpbmdzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TaG93OiAxLFxyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAxLFxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgXVxyXG4gICAgfSk7XHJcblxyXG4gICAgLy8gUmV2aWV3cyByYXRpbmdcclxuICAgICQoJy5pbS1wYXJ0bmVyLXNsaWRlci13cmFwLWpzJykuc2xpY2soe1xyXG4gICAgICAgIC8vLy8gICdTbGljayBTbGlkZXInIEZvciBQYXJ0bmVyIFNsaWRlclxyXG4gICAgICAgIHNsaWRlc1RvU2hvdzogNixcclxuICAgICAgICBzbGlkZXNUb1Njcm9sbDogNixcclxuICAgICAgICBhcnJvd3M6IHRydWUsXHJcbiAgICAgICAgcHJldkFycm93OiAnLnBhcnRuZXItc2xpZGVyLXByZXYnLFxyXG4gICAgICAgIG5leHRBcnJvdzogJy5wYXJ0bmVyLXNsaWRlci1uZXh0JyxcclxuICAgICAgICAvLyBmYWRlOiB0cnVlLFxyXG4gICAgICAgIGluZmluaXRlOiB0cnVlLFxyXG4gICAgICAgIGRvdHM6IGZhbHNlLFxyXG4gICAgICAgIGF1dG9wbGF5OiB0cnVlLFxyXG4gICAgICAgIGF1dG9wbGF5U3BlZWQ6IDQwMDAsXHJcbiAgICAgICAgc3BlZWQ6IDcwMCxcclxuICAgICAgICByZXNwb25zaXZlOiBbe1xyXG4gICAgICAgICAgICAgICAgYnJlYWtwb2ludDogMTIwMCxcclxuICAgICAgICAgICAgICAgIHNldHRpbmdzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgaW5maW5pdGU6IHRydWUsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TaG93OiA0LFxyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2Nyb2xsOiA0XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDk5MixcclxuICAgICAgICAgICAgICAgIHNldHRpbmdzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TaG93OiAzLFxyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAzXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDc2OCxcclxuICAgICAgICAgICAgICAgIHNldHRpbmdzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgaW5maW5pdGU6IHRydWUsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TaG93OiAyLFxyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAyLFxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICBicmVha3BvaW50OiA1NzYsXHJcbiAgICAgICAgICAgICAgICBzZXR0aW5nczoge1xyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogMSxcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Njcm9sbDogMSxcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIF1cclxuICAgIH0pO1xyXG5cclxuICAgIC8qID09PT09PT09PT09PT09PT09PT09PT09IFByb2R1Y3QgQ29tcGFyZSA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PSAqL1xyXG4gICAgJCgnLmltLWNvbXBhcmUtcHJvZHVjdC1qcycpLnNsaWNrKHtcclxuICAgICAgICBzbGlkZXNUb1Nob3c6IDQsXHJcbiAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDQsXHJcbiAgICAgICAgYXJyb3dzOiBmYWxzZSxcclxuICAgICAgICBpbmZpbml0ZTogZmFsc2UsXHJcbiAgICAgICAgZG90czogZmFsc2UsXHJcbiAgICAgICAgYXV0b3BsYXk6IHRydWUsXHJcbiAgICAgICAgYXV0b3BsYXlTcGVlZDogNDAwMCxcclxuICAgICAgICByZXNwb25zaXZlOiBbXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDEyMDAsXHJcbiAgICAgICAgICAgICAgICBzZXR0aW5nczoge1xyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogMyxcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Njcm9sbDogM1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICBicmVha3BvaW50OiA5OTIsXHJcbiAgICAgICAgICAgICAgICBzZXR0aW5nczoge1xyXG4gICAgICAgICAgICAgICAgICAgIGluZmluaXRlOiB0cnVlLFxyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogMixcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Njcm9sbDogMixcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgYnJlYWtwb2ludDogNTc2LFxyXG4gICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDEsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDEsXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICBdXHJcbiAgICB9KTtcclxuICAgICQoJy5pbS1jb21wYXJlLW1hcmtldC1qcycpLnNsaWNrKHtcclxuICAgICAgICBzbGlkZXNUb1Nob3c6IDQsXHJcbiAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDQsXHJcbiAgICAgICAgYXJyb3dzOiB0cnVlLFxyXG4gICAgICAgIHByZXZBcnJvdzogJy5tYXJrZXQtY29tcGFyZS1hcnJvd3MgLmFycm93LXByZXYnLFxyXG4gICAgICAgIG5leHRBcnJvdzogJy5tYXJrZXQtY29tcGFyZS1hcnJvd3MgLmFycm93LW5leHQnLFxyXG4gICAgICAgIGluZmluaXRlOiBmYWxzZSxcclxuICAgICAgICBkb3RzOiBmYWxzZSxcclxuICAgICAgICBhdXRvcGxheTogZmFsc2UsXHJcbiAgICAgICAgYXV0b3BsYXlTcGVlZDogNDAwMCxcclxuICAgICAgICByZXNwb25zaXZlOiBbXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDEyMDAsXHJcbiAgICAgICAgICAgICAgICBzZXR0aW5nczoge1xyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogMyxcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Njcm9sbDogM1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICBicmVha3BvaW50OiA5OTIsXHJcbiAgICAgICAgICAgICAgICBzZXR0aW5nczoge1xyXG4gICAgICAgICAgICAgICAgICAgIGluZmluaXRlOiB0cnVlLFxyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogMixcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Njcm9sbDogMixcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgYnJlYWtwb2ludDogNTc2LFxyXG4gICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDEsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDEsXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICBdXHJcbiAgICB9KTtcclxuXHJcbiAgICAvLyBGb3IgaGVpZ2h0IE1hdGNoaW5nXHJcbiAgICAkLmZuLlNBTUVfSEVJR0hUID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgdmFyIHNlbGVjdG9yID0gdGhpcztcclxuICAgICAgICB2YXIgaGVpZ2h0cyA9IFtdO1xyXG4gICAgICAgIC8vIFNhdmUgdGhlIGhlaWdodHMgb2YgZXZlcnkgZWxlbWVudCBpbnRvIGFuIGFycmF5XHJcbiAgICAgICAgc2VsZWN0b3IuZWFjaChmdW5jdGlvbigpe1xyXG4gICAgICAgIHZhciBoZWlnaHQgPSAkKHRoaXMpLmhlaWdodCgpO1xyXG4gICAgICAgIGhlaWdodHMucHVzaChoZWlnaHQpO1xyXG4gICAgICAgIH0pO1xyXG4gICAgICAgIC8vIEdldCB0aGUgYmlnZ2VzdCBoZWlnaHRcclxuICAgICAgICB2YXIgbWF4SGVpZ2h0ID0gTWF0aC5tYXguYXBwbHkobnVsbCwgaGVpZ2h0cyk7XHJcbiAgICAgICAgLy8gU2V0IHRoZSBtYXhIZWlnaHQgdG8gZXZlcnkgc2VsZWN0ZWQgZWxlbWVudFxyXG4gICAgICAgIHNlbGVjdG9yLmVhY2goZnVuY3Rpb24oKXtcclxuICAgICAgICAkKHRoaXMpLmhlaWdodChtYXhIZWlnaHQpO1xyXG4gICAgICAgIH0pOyBcclxuICAgIH07XHJcblxyXG4gICAgLy8gQ29tcGFyZSBjaGFydCB0YWJsZSByb3cgbWFrZSBlcXVhbCBoZWlnaHQuXHJcbiAgICB2YXIgdG90YWxSb3cgPSAkKCcuY29tcGFyZS10aXRsZSBsaScpLmxlbmd0aDtcclxuICAgIGZvciAodmFyIGkgPSAwOyBpIDw9IHRvdGFsUm93OyBpKyspIHtcclxuICAgICAgICAkKCcudGFibGUtcm93LScraSkuU0FNRV9IRUlHSFQoKTsgXHJcbiAgICB9XHJcbiAgICAkKHdpbmRvdykucmVzaXplKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgZm9yICh2YXIgaSA9IDA7IGkgPD0gdG90YWxSb3c7IGkrKykge1xyXG4gICAgICAgICAgICAkKCcudGFibGUtcm93LScraSkuU0FNRV9IRUlHSFQoKTtcdFxyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG5cclxuICAgIC8qID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT0gIEJ5IEpxdWVyeSBVaSA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PSAqL1xyXG4gICAgLy8gPT09PSBGaWx0ZXIgUGFnZSBOdW1iZXJcclxuICAgIHZhciB1aU51bWJlckpzID0gJCggXCIubnVtYmVyLWpzXCIgKTtcclxuICAgIHVpTnVtYmVySnMuc2VsZWN0bWVudSgpLnNlbGVjdG1lbnUoXCJtZW51V2lkZ2V0XCIpLmFkZENsYXNzKCBcImltLWZpbHRlci1kcm9wZG93bi1tYW51XCIgKTtcclxuICAgIFxyXG4gICAgJCggXCIuZGF0ZS1qc1wiICkuc2VsZWN0bWVudSgpLnNlbGVjdG1lbnUoXCJtZW51V2lkZ2V0XCIpLmFkZENsYXNzKCBcImltLWZpbHRlci1kYXRlLWRyb3Bkb3duLW1hbnVcIiApO1xyXG4gICAgJCggXCIuaW0taGVhZGVyLWZvcm0tc2VsZWN0LWpzXCIgKS5zZWxlY3RtZW51KCkuc2VsZWN0bWVudShcIm1lbnVXaWRnZXRcIikuYWRkQ2xhc3MoXCJpbS1oZWFkZXItZm9ybS1zZWxlY3QtZHJvcGRvd25cIik7XHJcblxyXG4gICAgLy8gQmlnIFNlYXJjaCBcclxuICAgICQoIFwiLmltLWJpZy1zZWFyY2gtc2VsZWN0LWpzXCIgKS5zZWxlY3RtZW51KCkuc2VsZWN0bWVudShcIm1lbnVXaWRnZXRcIikuYWRkQ2xhc3MoXCJpbS1iaWctc2VhcmNoLXNlbGVjdC1kcm9wZG93blwiKTtcclxuXHJcblxyXG4gICAgLy8gV2lkZ2V0IEZpbHRlclxyXG4gICAgJChcIi5pbS1maWx0ZXItbWFya2V0LWxpc3QtanNcIikuc2VsZWN0YWJsZSgpO1xyXG4gICAgJChcIi5pbS1maWx0ZXItY29sb3ItbGlzdC1qc1wiKS5zZWxlY3RhYmxlKCk7XHJcbiAgICBcclxuICAgIC8vIF9fcHJpY2VcclxuICAgIC8vICQoJy5maWx0ZXItcHJpY2Utd3JhcCAucHJpY2UtcmFuZ2UnKS5oaWRlKCk7XHJcblxyXG4gICAgJCgnLndpZGdldC1maWx0ZXItcHJpY2Utc3VibWl0JykuaGlkZSgpO1xyXG5cclxuICAgICQoXCIud2lkZ2V0LWZpbHRlci1taW4tcHJpY2UsIC53aWRnZXQtZmlsdGVyLW1heC1wcmljZVwiKS5vbignY2hhbmdlJywgZnVuY3Rpb24gKCkge1xyXG5cclxuICAgICQoJy53aWRnZXQtZmlsdGVyLXByaWNlLXN1Ym1pdCcpLnNob2UoKTtcclxuICAgICAgICB2YXIgbWluX3ByaWNlX3JhbmdlID0gcGFyc2VJbnQoJChcIi53aWRnZXQtZmlsdGVyLW1pbi1wcmljZVwiKS52YWwoKSk7XHJcblxyXG4gICAgICAgIHZhciBtYXhfcHJpY2VfcmFuZ2UgPSBwYXJzZUludCgkKFwiLndpZGdldC1maWx0ZXItbWF4LXByaWNlZVwiKS52YWwoKSk7XHJcblxyXG4gICAgICAgIGlmIChtaW5fcHJpY2VfcmFuZ2UgPiBtYXhfcHJpY2VfcmFuZ2UpIHtcclxuICAgICAgICAkKCcud2lkZ2V0LWZpbHRlci1tYXgtcHJpY2UnKS52YWwobWluX3ByaWNlX3JhbmdlKTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICQoXCIuaW0tcHJpY2UtZmlsdGVyLXJhbmdlLWpzXCIpLnNsaWRlcih7XHJcbiAgICAgICAgdmFsdWVzOiBbbWluX3ByaWNlX3JhbmdlLCBtYXhfcHJpY2VfcmFuZ2VdXHJcbiAgICAgICAgfSk7XHJcbiAgICAgICAgXHJcbiAgICB9KTtcclxuXHJcblxyXG4gICAgJChcIi53aWRnZXQtZmlsdGVyLW1pbi1wcmljZSwgLndpZGdldC1maWx0ZXItbWF4LXByaWNlXCIpLm9uKFwicGFzdGUga2V5dXBcIiwgZnVuY3Rpb24gKCkgeyAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBcclxuXHJcbiAgICAgICAgJCgnLndpZGdldC1maWx0ZXItcHJpY2Utc3VibWl0Jykuc2hvdygpO1xyXG5cclxuICAgICAgICB2YXIgbWluX3ByaWNlX3JhbmdlID0gcGFyc2VJbnQoJChcIi53aWRnZXQtZmlsdGVyLW1pbi1wcmljZVwiKS52YWwoKSk7XHJcblxyXG4gICAgICAgIHZhciBtYXhfcHJpY2VfcmFuZ2UgPSBwYXJzZUludCgkKFwiLndpZGdldC1maWx0ZXItbWF4LXByaWNlXCIpLnZhbCgpKTtcclxuICAgICAgICBcclxuICAgICAgICBpZihtaW5fcHJpY2VfcmFuZ2UgPT0gbWF4X3ByaWNlX3JhbmdlKXtcclxuXHJcbiAgICAgICAgICAgIG1heF9wcmljZV9yYW5nZSA9IG1pbl9wcmljZV9yYW5nZSArIDEwMDtcclxuICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICQoXCIud2lkZ2V0LWZpbHRlci1taW4tcHJpY2VcIikudmFsKG1pbl9wcmljZV9yYW5nZSk7XHRcdFxyXG4gICAgICAgICAgICAkKFwiLndpZGdldC1maWx0ZXItbWF4LXByaWNlXCIpLnZhbChtYXhfcHJpY2VfcmFuZ2UpO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJChcIi5pbS1wcmljZS1maWx0ZXItcmFuZ2UtanNcIikuc2xpZGVyKHtcclxuICAgICAgICB2YWx1ZXM6IFttaW5fcHJpY2VfcmFuZ2UsIG1heF9wcmljZV9yYW5nZV1cclxuICAgICAgICB9KTtcclxuXHJcbiAgICB9KTtcclxuXHJcblxyXG4gICAgJChmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgJChcIi5pbS1wcmljZS1maWx0ZXItcmFuZ2UtanNcIikuc2xpZGVyKHtcclxuICAgICAgICByYW5nZTogdHJ1ZSxcclxuICAgICAgICBvcmllbnRhdGlvbjogXCJob3Jpem9udGFsXCIsXHJcbiAgICAgICAgbWluOiAwLFxyXG4gICAgICAgIG1heDogMTAwMDAsXHJcbiAgICAgICAgdmFsdWVzOiBbMCwgMTAwMDBdLFxyXG4gICAgICAgIHN0ZXA6IDEwMCxcclxuXHJcbiAgICAgICAgc2xpZGU6IGZ1bmN0aW9uIChldmVudCwgdWkpIHtcclxuICAgICAgICAgICAgaWYgKHVpLnZhbHVlc1swXSA9PSB1aS52YWx1ZXNbMV0pIHtcclxuICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBcclxuICAgICAgICAgICAgJChcIi53aWRnZXQtZmlsdGVyLW1pbi1wcmljZVwiKS52YWwodWkudmFsdWVzWzBdKTtcclxuICAgICAgICAgICAgJChcIi53aWRnZXQtZmlsdGVyLW1heC1wcmljZVwiKS52YWwodWkudmFsdWVzWzFdKTtcclxuICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICQoXCIud2lkZ2V0LWZpbHRlci1taW4tcHJpY2VcIikudmFsKCQoXCIuaW0tcHJpY2UtZmlsdGVyLXJhbmdlLWpzXCIpLnNsaWRlcihcInZhbHVlc1wiLCAwKSk7XHJcbiAgICAgICAgJChcIi53aWRnZXQtZmlsdGVyLW1heC1wcmljZVwiKS52YWwoJChcIi5pbS1wcmljZS1maWx0ZXItcmFuZ2UtanNcIikuc2xpZGVyKFwidmFsdWVzXCIsIDEpKTtcclxuXHJcbiAgICB9KTtcclxuXHJcbiAgICB2YXIgY3VycmVudE1pblByaWNlID0gJCgnLndpZGdldC1maWx0ZXItbWluLXByaWNlJykudmFsKCk7XHJcbiAgICB2YXIgY3VycmVudE1heFByaWNlID0gJCgnLndpZGdldC1maWx0ZXItbWF4LXByaWNlJykudmFsKCk7XHJcbiAgICBjb25zb2xlLmxvZyhjdXJyZW50TWluUHJpY2UpO1xyXG5cclxuICAgICQoXCIubWluLXByaWNlXCIpLnRleHQoY3VycmVudE1pblByaWNlKTtcclxuICAgICQoXCIubWF4LXByaWNlXCIpLnRleHQoY3VycmVudE1heFByaWNlKTtcclxuICAgIFxyXG4gICAgJChcIi5pbS1wcmljZS1maWx0ZXItcmFuZ2UtanNcIikub24oJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICQoXCIubWluLXByaWNlXCIpLnRleHQoY3VycmVudE1pblByaWNlKTtcclxuICAgICAgICAkKFwiLm1heC1wcmljZVwiKS50ZXh0KGN1cnJlbnRNYXhQcmljZSk7XHJcbiAgICB9KTtcclxuXHJcbiBcclxuXHJcblxyXG4gICAgLyogPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PSBJbWFnZSBBdmVyYWdlIENvbG9yIFBpY2sgUmVwbGFjZSBGaXJzdCBMYXRlciBCYWNrZ3JvdW5kIENvbG9yID09PT09PT09PT09PT09PT09PT09PT09PT09PT09ICovXHJcblxyXG4gICAgLy8gSG9tZSBSZXZpZXcgUGFnZSBSZXZpZXcgSXRlbSBcclxuICAgIHZhciBob21lUmV2aWV3SXRlbSA9ICQoJy5pbS1yZXZpZXctY29udGVudCAucmV2aWV3LWl0ZW0td3JhcCAucmV2aWV3LWl0ZW0nKTtcclxuXHJcbiAgICAvLyBSZXZpZXcgUGFnZVxyXG4gICAgdmFyIHJldmlld1Jldmlld0l0ZW0gPSAgJCgnLmltLWdyaWQtdmlldyAucmV2aWV3LXJvdyAucmV2aWV3LWl0ZW0nKTtcclxuXHJcbiAgICAvLyBTaW5nbGUgU2xpZGVyIFxyXG4gICAgdmFyIHNpbmdlbFByb2R1Y3RTbGlkZXIgPSAgJCgnLmltLWVsLXByb2R1Y3Qtc2xpZGVyIC5wcm9kdWN0LXNsaWRlci13cmFwIC5zbGlkZXItaXRlbScpO1xyXG5cclxuXHJcbiAgICBob21lUmV2aWV3SXRlbS5nZXRJbWFnZUNvbG9yKCk7XHJcbiAgICBzaW5nZWxQcm9kdWN0U2xpZGVyLmdldEltYWdlQ29sb3IoKTtcclxuICAgIHJldmlld1Jldmlld0l0ZW0uZ2V0SW1hZ2VDb2xvcigpO1xyXG5cclxufSk7XHJcblxyXG52YXIgeCwgaSwgaiwgc2VsRWxtbnQsIGEsIGIsIGM7XHJcbi8qbG9vayBmb3IgYW55IGVsZW1lbnRzIHdpdGggdGhlIGNsYXNzIFwiY3VzdG9tLXNlbGVjdFwiOiovXHJcbnggPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5Q2xhc3NOYW1lKFwic2VsZWN0LWxhYmVsLWpzXCIpO1xyXG5mb3IgKGkgPSAwOyBpIDwgeC5sZW5ndGg7IGkrKykge1xyXG4gIHNlbEVsbW50ID0geFtpXS5nZXRFbGVtZW50c0J5VGFnTmFtZShcInNlbGVjdFwiKVswXTtcclxuICAvKmZvciBlYWNoIGVsZW1lbnQsIGNyZWF0ZSBhIG5ldyBESVYgdGhhdCB3aWxsIGFjdCBhcyB0aGUgc2VsZWN0ZWQgaXRlbToqL1xyXG4gIGEgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KFwiRElWXCIpO1xyXG4gIGEuc2V0QXR0cmlidXRlKFwiY2xhc3NcIiwgXCJzZWxlY3Qtc2VsZWN0ZWRcIik7XHJcbiAgYS5pbm5lckhUTUwgPSBzZWxFbG1udC5vcHRpb25zW3NlbEVsbW50LnNlbGVjdGVkSW5kZXhdLmlubmVySFRNTDtcclxuICB4W2ldLmFwcGVuZENoaWxkKGEpO1xyXG4gIC8qZm9yIGVhY2ggZWxlbWVudCwgY3JlYXRlIGEgbmV3IERJViB0aGF0IHdpbGwgY29udGFpbiB0aGUgb3B0aW9uIGxpc3Q6Ki9cclxuICBiID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudChcIkRJVlwiKTtcclxuICBiLnNldEF0dHJpYnV0ZShcImNsYXNzXCIsIFwic2VsZWN0LWl0ZW1zIHNlbGVjdC1oaWRlXCIpO1xyXG4gIGZvciAoaiA9IDE7IGogPCBzZWxFbG1udC5sZW5ndGg7IGorKykge1xyXG4gICAgLypmb3IgZWFjaCBvcHRpb24gaW4gdGhlIG9yaWdpbmFsIHNlbGVjdCBlbGVtZW50LFxyXG4gICAgY3JlYXRlIGEgbmV3IERJViB0aGF0IHdpbGwgYWN0IGFzIGFuIG9wdGlvbiBpdGVtOiovXHJcbiAgICBjID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudChcIkRJVlwiKTtcclxuICAgIGMuaW5uZXJIVE1MID0gc2VsRWxtbnQub3B0aW9uc1tqXS5pbm5lckhUTUw7XHJcbiAgICBjLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCBmdW5jdGlvbihlKSB7XHJcbiAgICAgICAgLyp3aGVuIGFuIGl0ZW0gaXMgY2xpY2tlZCwgdXBkYXRlIHRoZSBvcmlnaW5hbCBzZWxlY3QgYm94LFxyXG4gICAgICAgIGFuZCB0aGUgc2VsZWN0ZWQgaXRlbToqL1xyXG4gICAgICAgIHZhciB5LCBpLCBrLCBzLCBoO1xyXG4gICAgICAgIHMgPSB0aGlzLnBhcmVudE5vZGUucGFyZW50Tm9kZS5nZXRFbGVtZW50c0J5VGFnTmFtZShcInNlbGVjdFwiKVswXTtcclxuICAgICAgICBoID0gdGhpcy5wYXJlbnROb2RlLnByZXZpb3VzU2libGluZztcclxuICAgICAgICBmb3IgKGkgPSAwOyBpIDwgcy5sZW5ndGg7IGkrKykge1xyXG4gICAgICAgICAgaWYgKHMub3B0aW9uc1tpXS5pbm5lckhUTUwgPT0gdGhpcy5pbm5lckhUTUwpIHtcclxuICAgICAgICAgICAgcy5zZWxlY3RlZEluZGV4ID0gaTtcclxuICAgICAgICAgICAgaC5pbm5lckhUTUwgPSB0aGlzLmlubmVySFRNTDtcclxuICAgICAgICAgICAgeSA9IHRoaXMucGFyZW50Tm9kZS5nZXRFbGVtZW50c0J5Q2xhc3NOYW1lKFwic2FtZS1hcy1zZWxlY3RlZFwiKTtcclxuICAgICAgICAgICAgZm9yIChrID0gMDsgayA8IHkubGVuZ3RoOyBrKyspIHtcclxuICAgICAgICAgICAgICB5W2tdLnJlbW92ZUF0dHJpYnV0ZShcImNsYXNzXCIpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIHRoaXMuc2V0QXR0cmlidXRlKFwiY2xhc3NcIiwgXCJzYW1lLWFzLXNlbGVjdGVkXCIpO1xyXG4gICAgICAgICAgICBicmVhaztcclxuICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgaC5jbGljaygpO1xyXG4gICAgfSk7XHJcbiAgICBiLmFwcGVuZENoaWxkKGMpO1xyXG4gIH1cclxuICB4W2ldLmFwcGVuZENoaWxkKGIpO1xyXG4gIGEuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIGZ1bmN0aW9uKGUpIHtcclxuICAgICAgLyp3aGVuIHRoZSBzZWxlY3QgYm94IGlzIGNsaWNrZWQsIGNsb3NlIGFueSBvdGhlciBzZWxlY3QgYm94ZXMsXHJcbiAgICAgIGFuZCBvcGVuL2Nsb3NlIHRoZSBjdXJyZW50IHNlbGVjdCBib3g6Ki9cclxuICAgICAgZS5zdG9wUHJvcGFnYXRpb24oKTtcclxuICAgICAgY2xvc2VBbGxTZWxlY3QodGhpcyk7XHJcbiAgICAgIHRoaXMubmV4dFNpYmxpbmcuY2xhc3NMaXN0LnRvZ2dsZShcInNlbGVjdC1oaWRlXCIpO1xyXG4gICAgICB0aGlzLmNsYXNzTGlzdC50b2dnbGUoXCJzZWxlY3QtYXJyb3ctYWN0aXZlXCIpO1xyXG4gICAgfSk7XHJcbn1cclxuZnVuY3Rpb24gY2xvc2VBbGxTZWxlY3QoZWxtbnQpIHtcclxuICAvKmEgZnVuY3Rpb24gdGhhdCB3aWxsIGNsb3NlIGFsbCBzZWxlY3QgYm94ZXMgaW4gdGhlIGRvY3VtZW50LFxyXG4gIGV4Y2VwdCB0aGUgY3VycmVudCBzZWxlY3QgYm94OiovXHJcbiAgdmFyIHgsIHksIGksIGFyck5vID0gW107XHJcbiAgeCA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlDbGFzc05hbWUoXCJzZWxlY3QtaXRlbXNcIik7XHJcbiAgeSA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlDbGFzc05hbWUoXCJzZWxlY3Qtc2VsZWN0ZWRcIik7XHJcbiAgZm9yIChpID0gMDsgaSA8IHkubGVuZ3RoOyBpKyspIHtcclxuICAgIGlmIChlbG1udCA9PSB5W2ldKSB7XHJcbiAgICAgIGFyck5vLnB1c2goaSk7XHJcbiAgICB9IGVsc2Uge1xyXG4gICAgICB5W2ldLmNsYXNzTGlzdC5yZW1vdmUoXCJzZWxlY3QtYXJyb3ctYWN0aXZlXCIpO1xyXG4gICAgfVxyXG4gIH1cclxuICBmb3IgKGkgPSAwOyBpIDwgeC5sZW5ndGg7IGkrKykge1xyXG4gICAgaWYgKGFyck5vLmluZGV4T2YoaSkpIHtcclxuICAgICAgeFtpXS5jbGFzc0xpc3QuYWRkKFwic2VsZWN0LWhpZGVcIik7XHJcbiAgICB9XHJcbiAgfVxyXG59XHJcbi8qaWYgdGhlIHVzZXIgY2xpY2tzIGFueXdoZXJlIG91dHNpZGUgdGhlIHNlbGVjdCBib3gsXHJcbnRoZW4gY2xvc2UgYWxsIHNlbGVjdCBib3hlczoqL1xyXG5kb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgY2xvc2VBbGxTZWxlY3QpOyIsIi8qID09PT09PT09PT09PT09PT09PT09PT09IFByb2R1Y3QgUmV2aWV3IENoYXJ0IEJnIFJlZCA9PT09PT09PT09PT09PT09PT09PT09PT09PSAqL1xyXG5cclxudmFyIGJhckNoYXJ0SG9yaXpvbnRhbCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCIuYmFyLWNoYXJ0LWhvcml6b250YWxcIik7XHJcblxyXG5pZihiYXJDaGFydEhvcml6b250YWwpIHtcclxuICAgIHZhciBiYXJDaGFydEhvcml6b250YWwgPSBiYXJDaGFydEhvcml6b250YWwuZ2V0Q29udGV4dCgnMmQnKTtcclxuICAgIG5ldyBDaGFydChiYXJDaGFydEhvcml6b250YWwsIHtcclxuICAgICAgICB0eXBlOiAnaG9yaXpvbnRhbEJhcicsXHJcbiAgICAgICAgYmFja2dyb3VuZENvbG9yOiAnIzAwMDAwMCcsXHJcbiAgICAgICAgcmVzcG9uc2l2ZTogdHJ1ZSxcclxuICAgICAgICBkYXRhOiB7XHJcbiAgICAgICAgICAgIGxhYmVsczogW1wiTUFDQk9PSyBQUk9cIiwgXCJNQUNCT09LIEFJUlwiLCBcIlNVUkVGQUtFIFBST1wiLCBcIkxFTk9WTyBDQk9PS1wiLCBcIk5BVkJJQSBTSEVJTERcIiwgXCJIUCBTdHJlYW1cIixcclxuICAgICAgICAgICAgICAgIFwiU3VwZXJub2IgUHJvXCIsIFwiQWlyIFBhZCA0XCJcclxuICAgICAgICAgICAgXSxcclxuICAgICAgICAgICAgZGF0YXNldHM6IFt7XHJcbiAgICAgICAgICAgICAgICBsYWJlbDogXCJcIixcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmRDb2xvcjogXCJyZ2JhKDAsMCwwLCAuNVwiLFxyXG4gICAgICAgICAgICAgICAgZGF0YTogWzE1LCAxNCwgMTMsIDExLCA5LCA3LCA1LCAzLCAxNl0sXHJcbiAgICAgICAgICAgICAgICBib3JkZXJXaWR0aDogMVxyXG4gICAgICAgICAgICB9XVxyXG4gICAgICAgIH0sXHJcbiAgICAgICAgb3B0aW9uczoge1xyXG4gICAgICAgICAgICAvLyBcdGxlZ2VuZDogeyBkaXNwbGF5OiBmYWxzZSB9LFxyXG4gICAgICAgICAgICAvLyBcdHRpdGxlOiB7XHJcbiAgICAgICAgICAgIC8vIFx0XHRkaXNwbGF5OiB0cnVlLFxyXG4gICAgICAgICAgICAvLyBcdFx0dGV4dDogJ1ByZWRpY3RlZCB3b3JsZCBwb3B1bGF0aW9uIChtaWxsaW9ucykgaW4gMjA1MCdcclxuICAgICAgICAgICAgLy8gXHR9XHJcbiAgICAgICAgICAgIGxlZ2VuZDoge1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmFsc2VcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgc2NhbGVzOiB7XHJcbiAgICAgICAgICAgICAgICB5QXhlczogW3tcclxuICAgICAgICAgICAgICAgICAgICB0aWNrczoge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBmb250Q29sb3I6IFwiIzAwMDAwMFwiLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICBmb250U2l6ZTogMTQsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHN0ZXBTaXplOiAxLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICBiZWdpbkF0WmVybzogdHJ1ZSxcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XSxcclxuICAgICAgICAgICAgICAgIHhBeGVzOiBbe1xyXG4gICAgICAgICAgICAgICAgICAgIHRpY2tzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGZvbnRDb2xvcjogXCIjMDAwMDAwXCIsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGZvbnRTaXplOiAxNSxcclxuICAgICAgICAgICAgICAgICAgICAgICAgc3RlcFNpemU6IDEsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJlZ2luQXRaZXJvOiB0cnVlXHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfV1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG59O1xyXG5cclxuXHJcblxyXG4vKiA9PT09PT09PT09PT09PT09PT09PT09PSBQcm9kdWN0IENoYXJ0IFRhYiBDaGFydHMgPT09PT09PT09PT09PT09PT09PT09PT09PT0gKi9cclxuLy8gID09PT09PT09PT0gRXBheVxyXG52YXIgY3R4ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJpbS1jaGFydC1lcGF5LWNhbGxlci0xXCIpO1xyXG5pZihjdHgpe1xyXG4gICAgdmFyIGN0eCA9IGN0eC5nZXRDb250ZXh0KCcyZCcpO1xyXG4gICAgdmFyIG15Q2hhcnQgPSBuZXcgQ2hhcnQoY3R4LCB7XHJcbiAgICAgICAgdHlwZTogJ2xpbmUnLFxyXG4gICAgICAgIGRhdGE6IHtcclxuICAgICAgICAgICAgbGFiZWxzOiBbXCIyMDA4XCIsIFwiMjAxMFwiLCBcIjIwMTJcIiwgXCIyMDE0XCIsIFwiMjAxNlwiLCBcIjIwMThcIl0sXHJcbiAgICAgICAgICAgIGRhdGFzZXRzOiBbe1xyXG4gICAgICAgICAgICAgICAgbGFiZWw6ICdQUklDRSBDSEFSVCcsXHJcbiAgICAgICAgICAgICAgICBkYXRhOiBbMTIsIDE5LCAzLCA1LCAyLCAzXSxcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmRDb2xvcjogW1xyXG4gICAgICAgICAgICAgICAgICAgICdyZ2JhKDI1NSwgOTksIDEzMiwgMC4yKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoNTQsIDE2MiwgMjM1LCAwLjIpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSgyNTUsIDIwNiwgODYsIDAuMiknLFxyXG4gICAgICAgICAgICAgICAgICAgICdyZ2JhKDc1LCAxOTIsIDE5MiwgMC4yKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMTUzLCAxMDIsIDI1NSwgMC4yKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMjU1LCAxNTksIDY0LCAwLjIpJ1xyXG4gICAgICAgICAgICAgICAgXSxcclxuICAgICAgICAgICAgICAgIGJvcmRlckNvbG9yOiBbXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMjU1LDk5LDEzMiwxKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoNTQsIDE2MiwgMjM1LCAxKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMjU1LCAyMDYsIDg2LCAxKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoNzUsIDE5MiwgMTkyLCAxKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMTUzLCAxMDIsIDI1NSwgMSknLFxyXG4gICAgICAgICAgICAgICAgICAgICdyZ2JhKDI1NSwgMTU5LCA2NCwgMSknXHJcbiAgICAgICAgICAgICAgICBdLFxyXG4gICAgICAgICAgICAgICAgYm9yZGVyV2lkdGg6IDFcclxuICAgICAgICAgICAgfV1cclxuICAgICAgICB9LFxyXG4gICAgICAgIG9wdGlvbnM6IHtcclxuICAgICAgICAgICAgbGVnZW5kOiB7XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBmYWxzZVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBzY2FsZXM6IHtcclxuICAgICAgICAgICAgICAgIHlBeGVzOiBbe1xyXG4gICAgICAgICAgICAgICAgICAgIHRpY2tzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJlZ2luQXRaZXJvOnRydWVcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbn07XHJcblxyXG5cclxudmFyIGN0eCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiaW0tY2hhcnQtZXBheS1jYWxsZXItMlwiKTtcclxuaWYoY3R4KXtcclxuICAgIHZhciBjdHggPSBjdHguZ2V0Q29udGV4dCgnMmQnKTtcclxuICAgIHZhciBteUNoYXJ0ID0gbmV3IENoYXJ0KGN0eCwge1xyXG4gICAgICAgIHR5cGU6ICdsaW5lJyxcclxuICAgICAgICBkYXRhOiB7XHJcbiAgICAgICAgICAgIGxhYmVsczogW1wiMjAwOFwiLCBcIjIwMTBcIiwgXCIyMDEyXCIsIFwiMjAxNFwiLCBcIjIwMTZcIiwgXCIyMDE4XCJdLFxyXG4gICAgICAgICAgICBkYXRhc2V0czogW3tcclxuICAgICAgICAgICAgICAgIGxhYmVsOiAnIyBvZiBWb3RlcycsXHJcbiAgICAgICAgICAgICAgICBkYXRhOiBbMTIsIDE5LCAzLCA1LCAyLCAzXSxcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmRDb2xvcjogW1xyXG4gICAgICAgICAgICAgICAgICAgICdyZ2JhKDI1NSwgOTksIDEzMiwgMC4yKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoNTQsIDE2MiwgMjM1LCAwLjIpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSgyNTUsIDIwNiwgODYsIDAuMiknLFxyXG4gICAgICAgICAgICAgICAgICAgICdyZ2JhKDc1LCAxOTIsIDE5MiwgMC4yKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMTUzLCAxMDIsIDI1NSwgMC4yKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMjU1LCAxNTksIDY0LCAwLjIpJ1xyXG4gICAgICAgICAgICAgICAgXSxcclxuICAgICAgICAgICAgICAgIGJvcmRlckNvbG9yOiBbXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMjU1LDk5LDEzMiwxKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoNTQsIDE2MiwgMjM1LCAxKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMjU1LCAyMDYsIDg2LCAxKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoNzUsIDE5MiwgMTkyLCAxKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMTUzLCAxMDIsIDI1NSwgMSknLFxyXG4gICAgICAgICAgICAgICAgICAgICdyZ2JhKDI1NSwgMTU5LCA2NCwgMSknXHJcbiAgICAgICAgICAgICAgICBdLFxyXG4gICAgICAgICAgICAgICAgYm9yZGVyV2lkdGg6IDFcclxuICAgICAgICAgICAgfV1cclxuICAgICAgICB9LFxyXG4gICAgICAgIG9wdGlvbnM6IHtcclxuICAgICAgICAgICAgbGVnZW5kOiB7XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBmYWxzZVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBzY2FsZXM6IHtcclxuICAgICAgICAgICAgICAgIHlBeGVzOiBbe1xyXG4gICAgICAgICAgICAgICAgICAgIHRpY2tzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJlZ2luQXRaZXJvOnRydWVcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbn07XHJcblxyXG5cclxuLy8gPT09PT09PT09PT09PSBVbGlleHByZXNzXHJcbnZhciBjdHggPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImltLWNoYXJ0LXVsaWV4cHJlc3MtY2FsbGVyLTFcIik7XHJcbmlmKGN0eCl7XHJcbiAgICB2YXIgY3R4ID0gY3R4LmdldENvbnRleHQoJzJkJyk7XHJcbiAgICB2YXIgbXlDaGFydCA9IG5ldyBDaGFydChjdHgsIHtcclxuICAgICAgICB0eXBlOiAnbGluZScsXHJcbiAgICAgICAgZGF0YToge1xyXG4gICAgICAgICAgICBsYWJlbHM6IFtcIjIwMDhcIiwgXCIyMDEwXCIsIFwiMjAxMlwiLCBcIjIwMTRcIiwgXCIyMDE2XCIsIFwiMjAxOFwiXSxcclxuICAgICAgICAgICAgZGF0YXNldHM6IFt7XHJcbiAgICAgICAgICAgICAgICBsYWJlbDogJ1BSSUNFIENIQVJUJyxcclxuICAgICAgICAgICAgICAgIGRhdGE6IFsxMiwgMTksIDMsIDUsIDIsIDNdLFxyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZENvbG9yOiBbXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMjU1LCA5OSwgMTMyLCAwLjIpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSg1NCwgMTYyLCAyMzUsIDAuMiknLFxyXG4gICAgICAgICAgICAgICAgICAgICdyZ2JhKDI1NSwgMjA2LCA4NiwgMC4yKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoNzUsIDE5MiwgMTkyLCAwLjIpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSgxNTMsIDEwMiwgMjU1LCAwLjIpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSgyNTUsIDE1OSwgNjQsIDAuMiknXHJcbiAgICAgICAgICAgICAgICBdLFxyXG4gICAgICAgICAgICAgICAgYm9yZGVyQ29sb3I6IFtcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSgyNTUsOTksMTMyLDEpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSg1NCwgMTYyLCAyMzUsIDEpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSgyNTUsIDIwNiwgODYsIDEpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSg3NSwgMTkyLCAxOTIsIDEpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSgxNTMsIDEwMiwgMjU1LCAxKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMjU1LCAxNTksIDY0LCAxKSdcclxuICAgICAgICAgICAgICAgIF0sXHJcbiAgICAgICAgICAgICAgICBib3JkZXJXaWR0aDogMVxyXG4gICAgICAgICAgICB9XVxyXG4gICAgICAgIH0sXHJcbiAgICAgICAgb3B0aW9uczoge1xyXG4gICAgICAgICAgICBsZWdlbmQ6IHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZhbHNlXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHNjYWxlczoge1xyXG4gICAgICAgICAgICAgICAgeUF4ZXM6IFt7XHJcbiAgICAgICAgICAgICAgICAgICAgdGlja3M6IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYmVnaW5BdFplcm86dHJ1ZVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1dXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9KTtcclxufTtcclxuXHJcblxyXG52YXIgY3R4ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJpbS1jaGFydC11bGlleHByZXNzLWNhbGxlci0yXCIpO1xyXG5pZihjdHgpe1xyXG4gICAgdmFyIGN0eCA9IGN0eC5nZXRDb250ZXh0KCcyZCcpO1xyXG4gICAgdmFyIG15Q2hhcnQgPSBuZXcgQ2hhcnQoY3R4LCB7XHJcbiAgICAgICAgdHlwZTogJ2xpbmUnLFxyXG4gICAgICAgIGRhdGE6IHtcclxuICAgICAgICAgICAgbGFiZWxzOiBbXCIyMDA4XCIsIFwiMjAxMFwiLCBcIjIwMTJcIiwgXCIyMDE0XCIsIFwiMjAxNlwiLCBcIjIwMThcIl0sXHJcbiAgICAgICAgICAgIGRhdGFzZXRzOiBbe1xyXG4gICAgICAgICAgICAgICAgbGFiZWw6ICcjIG9mIFZvdGVzJyxcclxuICAgICAgICAgICAgICAgIGRhdGE6IFsxMiwgMTksIDMsIDUsIDIsIDNdLFxyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZENvbG9yOiBbXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMjU1LCA5OSwgMTMyLCAwLjIpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSg1NCwgMTYyLCAyMzUsIDAuMiknLFxyXG4gICAgICAgICAgICAgICAgICAgICdyZ2JhKDI1NSwgMjA2LCA4NiwgMC4yKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoNzUsIDE5MiwgMTkyLCAwLjIpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSgxNTMsIDEwMiwgMjU1LCAwLjIpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSgyNTUsIDE1OSwgNjQsIDAuMiknXHJcbiAgICAgICAgICAgICAgICBdLFxyXG4gICAgICAgICAgICAgICAgYm9yZGVyQ29sb3I6IFtcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSgyNTUsOTksMTMyLDEpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSg1NCwgMTYyLCAyMzUsIDEpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSgyNTUsIDIwNiwgODYsIDEpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSg3NSwgMTkyLCAxOTIsIDEpJyxcclxuICAgICAgICAgICAgICAgICAgICAncmdiYSgxNTMsIDEwMiwgMjU1LCAxKScsXHJcbiAgICAgICAgICAgICAgICAgICAgJ3JnYmEoMjU1LCAxNTksIDY0LCAxKSdcclxuICAgICAgICAgICAgICAgIF0sXHJcbiAgICAgICAgICAgICAgICBib3JkZXJXaWR0aDogMVxyXG4gICAgICAgICAgICB9XVxyXG4gICAgICAgIH0sXHJcbiAgICAgICAgb3B0aW9uczoge1xyXG4gICAgICAgICAgICBsZWdlbmQ6IHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZhbHNlXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHNjYWxlczoge1xyXG4gICAgICAgICAgICAgICAgeUF4ZXM6IFt7XHJcbiAgICAgICAgICAgICAgICAgICAgdGlja3M6IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYmVnaW5BdFplcm86dHJ1ZVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1dXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9KTtcclxufTtcclxuXHJcbiJdfQ==
