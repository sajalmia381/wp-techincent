<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'penci_get_post_class' ) ) {
	function penci_get_post_class( $class = '', $post_id = null ) {

		$classes = array();

		if ( $class ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_map( 'esc_attr', $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		if ( ! $post_id ) {
			return $classes;
		}

		$classes[] = 'hentry';
		$classes[] = 'penci-post-item';

		$classes = array_map( 'esc_attr', $classes );

		return array_unique( $classes );
	}
}