<?php

add_filter( 'get_the_archive_title', 'penci_get_the_archive_title', 9999 );

if ( ! function_exists( 'penci_get_the_archive_title' ) ) {
	function penci_get_the_archive_title( $title ) {

		$hide_prefix = penci_get_theme_mod( 'archive_hide_prefix_page_title' ) ? penci_get_theme_mod( 'archive_hide_prefix_page_title' ) : false;

		if ( is_category() ) {
			$title = ! $hide_prefix ? penci_get_tran_setting( 'penci_prefix_ar_title_cat' ) . ' ' : '';
			$title .= single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = ! $hide_prefix ? penci_get_tran_setting( 'penci_prefix_ar_title_tag' ) . ' ' : '';
			$title .= single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = ! $hide_prefix ? penci_get_tran_setting( 'penci_prefix_ar_title_auhor' ) . ' ' : '';
			$title .= '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_year() ) {
			$title = ! $hide_prefix ? penci_get_tran_setting( 'penci_prefix_ar_title_year' ) . ' ' : '';
			$title .= get_the_date( 'Y' );
		} elseif ( is_month() ) {
			$title = ! $hide_prefix ? penci_get_tran_setting( 'penci_prefix_ar_title_month' ) . ' ' : '';
			$title .= get_the_date( 'F Y' );
		} elseif ( is_day() ) {
			$title = ! $hide_prefix ? penci_get_tran_setting( 'penci_prefix_ar_title_day' ) . ' ' : '';
			$title .= get_the_date( 'F j, Y' );
		} elseif ( is_post_type_archive() ) {
			$title = ! $hide_prefix ? penci_get_tran_setting( 'penci_prefix_ar_title_archive' ) . ' ' : '';
			$title .= post_type_archive_title( '', false );
		} elseif ( is_tax() ) {
			$tax   = get_taxonomy( get_queried_object()->taxonomy );
			$title = ! $hide_prefix ? $tax->labels->singular_name . ': ' : '';
			$title .= single_term_title( '', false );
		}

		return $title;
	}
}

add_filter( 'style_loader_src', 'penci_remove_ver_fonts_google', 9999, 2 );

/**
 * Function to remove version numbers
 */
if ( ! function_exists( 'penci_remove_ver_fonts_google' ) ) {
	function penci_remove_ver_fonts_google( $src, $handle ) {

		if ( 'penci-fonts' != $handle ) {
			return $src;
		}
		if ( strpos( $src, 'ver=' ) ) {
			$src = remove_query_arg( 'ver', $src, $handle );
		}

		return $src;
	}
}

if ( ! function_exists( 'penci_file_get_contents' ) ) {
	function penci_file_get_contents( $filename, $use_include_path = false, $context = null, $offset = 0, $maxlen = null ) {
		return file_get_contents( $filename, $use_include_path, $context, $offset, $maxlen );
	}
}

if ( ! function_exists( 'penci_force_balance_tags' ) ) {
	function penci_force_balance_tags( $text ) {
		return force_balance_tags( $text );
	}
}

if ( ! function_exists( 'penci_balanceTags' ) ) {
	function penci_balanceTags( $text, $force = false ) {
		return balanceTags( $text, $force );
	}
}

if ( ! function_exists( 'penci_get_server_value' ) ) {
	function penci_get_server_value( $key ) {
		return isset( $_SERVER[$key] ) ? $_SERVER[$key] : '';
	}
}

if ( ! function_exists( 'penci_add_excerpt_to_pages' ) ):
	add_action( 'init', 'penci_add_excerpt_to_pages' );
	function penci_add_excerpt_to_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}
endif;