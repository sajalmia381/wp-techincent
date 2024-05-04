<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (  ! function_exists( 'penci_reponsive_add_class_css' ) ) {
	add_filter( 'vc_shortcodes_css_class', 'penci_reponsive_add_class_css',10,3 );
	function penci_reponsive_add_class_css( $class_to_filter, $tag, $atts ) {
		$devices    = Penci_Responsive_Design_Helper::get_devices();
		$shortcodes = Penci_Responsive_Design_Helper::get_shortcodes();

		if ( $shortcodes && $devices && in_array($tag, $shortcodes ) ) {
			foreach ( $devices as $id => $device ){
				if(isset($atts[ $id ]) && !empty($atts[ $id ])) {
					$class_to_filter .= vc_shortcode_custom_css_class( $atts[ $id ], ' ' );
				}
			}
		}

		if( isset( $atts['penci_show_desk'] ) && ! $atts['penci_show_desk'] ){
			$class_to_filter .= ' penci-hidden-desk';
		}

		if( isset( $atts['penci_show_tablet'] ) && ! $atts['penci_show_tablet'] ){
			$class_to_filter .= ' penci-hidden-tablet';
		}

		if( isset( $atts['penci_show_mobile'] ) && ! $atts['penci_show_mobile'] ){
			$class_to_filter .= ' penci-hidden-mobile';
		}

		return $class_to_filter;
	}
}
