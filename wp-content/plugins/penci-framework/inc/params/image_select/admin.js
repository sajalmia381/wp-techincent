jQuery( function ( $ ) {
	'use strict';
	$( document ).on( 'click', '.penci-image-select', function () {
		var $this = $( this );

		$this.parent().siblings( '.wpb_vc_param_value' ).attr("value", $this.data( 'value' ) ).change();
		$this.addClass( 'penci-image-select--active' )
		     .siblings().removeClass( 'penci-image-select--active' );
	} );
} );