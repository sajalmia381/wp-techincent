<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Penci_Custom_VC' ) ):
	class Penci_Custom_VC {
		public function __construct() {
			if ( ! defined( 'WPB_VC_VERSION' ) || is_admin() ) {
				return;
			}
			add_filter( 'vc_shortcodes_css_class', array( $this, 'shortcodes_css_class' ), 10, 2 );
		}


		function shortcodes_css_class( $class, $tag ) {
			if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
				$class = str_replace( 'vc_row-fluid', 'vc_row-fluid penci-pb-row', $class );
			}
			if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
				$class = preg_replace( '/vc_col-sm-(\d{1,2})/', 'vc_col-sm-$1 penci-col-$1', $class );
			}

			return $class;
		}
	}
endif;


