<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'penci_top_post_cat_layout' ) ):
	add_action( 'pennews/top-post-cat/layout', 'penci_top_post_cat_layout', 10, 2 );
	function penci_top_post_cat_layout( $cat_top_pstyle, $query_cat_grid ) {
		include dirname( __FILE__ ) . "/layout-{$cat_top_pstyle}.php";
	}
endif;