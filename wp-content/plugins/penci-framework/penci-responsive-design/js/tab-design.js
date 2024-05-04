(
	function ( $ ) {
		'use strict';
		$( 'document' ).ready( function () {
			var editorTab = $( 'a.penci-css-editor-tab' );

			if ( editorTab.length > 0 ) {
				editorTab.on( 'click', function () {
					var $this = $( this ),
						div_active = $this.attr( 'data-tabtarget' ),
						$parent = $this.closest( '.vc_edit-form-tab' ),
						$div_active = $parent.find( '.' + div_active );

					$parent.find( 'a.penci-css-editor-tab' ).removeClass( 'nav-tab-active' );
					$( this ).addClass( 'nav-tab-active' );

					$parent.find( '.penci-css-editor-device' ).removeClass( 'active' ).css( 'display', 'none' );
					$div_active.addClass( 'active' ).fadeIn();

					return false;
				} );
			}
		} );
	}( window.jQuery )
);
