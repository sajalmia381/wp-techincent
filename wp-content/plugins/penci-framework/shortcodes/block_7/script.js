jQuery( function ( $ ) {
	'use strict';

	if ( $().owlCarousel ) {

		$( '.penci-owl-carousel-slider' ).each( function () {
			var $this = $( this ),
				$dataStyle = $this.data( 'style' ),
				$dataAuto = $this.data( 'auto' ),
				$dataAutoTime = $this.data( 'autotime' ),
				$dataSpeed = $this.data( 'speed' ),
				$dataLoop = $this.data( 'loop' ),
				$dataDots = $this.data( 'dots' ),
				$dataNav = $this.data( 'nav' ),
				$autoWidth = false;

			if( 'style-1' === $dataStyle  ) {
				// $autoWidth = true;
				// var $stage = $this.width(),
				// 	$el = $this.find(  '.item' ),
				// 	itemW = $stage / 7;
				//
				// $el.each(function( index, value ) {
				// 	$(this).css( 'width', ( ( index % 2 == 0 ) ? itemW * 2 : itemW ) );
				// });
			}

			var owl_args = {
				loop              : 1 === $dataLoop ? false : true,
				margin            : 0,
				items             : 5,
				navSpeed          : $dataSpeed,
				dotsSpeed         : $dataSpeed,
				nav               : 1 === $dataNav ? true : false,
				dots              : 1 === $dataDots ? true : false,
				navText           : ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
				autoplay          : 1 === $dataAuto ? true : false,
				autoplayTimeout   : 5000,
				autoHeight        : true,
				autoWidth         : $autoWidth,
				autoplayHoverPause: true,
				autoplaySpeed     : $dataAutoTime,
			};

			$this.owlCarousel( owl_args );
		} );

	}	// if owlcarousel
} );
