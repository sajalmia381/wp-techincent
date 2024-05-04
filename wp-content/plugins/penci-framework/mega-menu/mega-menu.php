<?php
/*
 * wp_nav_menu( array(
 *		'container'      => '',
 *		'theme_location' => 'menu-1',
 *		'fallback_cb'    => 'penci_menu_fallback',
 *		'walker'         => class_exists( 'Penci_Walker_Nav_Menu' ) ? new Penci_Walker_Nav_Menu() : ''
 *	) );
 */

if( ! function_exists( 'penci_mega_get_tax_support' ) ) {
	function penci_mega_get_tax_support(){
		$default = array( 'category', 'post_tag', 'portfolio-category', 'product_cat', 'product_tag' );

		$tax = penci_get_theme_mod( 'penci_mega_tax' );
		if( ! $tax ){
			return $default;
		}

		$tax = str_replace( ' ', '', $tax );
		$tax = array_filter( explode( ',', $tax . ',' ) );

		return array_merge( $default, $tax );
	}
}

require_once dirname( __FILE__ ) . '/main-menu.php';
require_once dirname( __FILE__ ) . '/walker_nav_menu.php';
require_once dirname( __FILE__ ) . '/menu-render.php';
require_once dirname( __FILE__ ) . '/ajax-filter.php';
