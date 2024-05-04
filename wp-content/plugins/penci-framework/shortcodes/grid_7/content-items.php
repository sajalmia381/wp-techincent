<?php
$query_slider = Penci_Pre_Query::do_query( $atts );
if ( ! $query_slider->have_posts() ) {
	return;
}

$items = '';
$grid7_i = 0;
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci_post_thumb', get_the_ID() ) ) . '">';
	$items .='<div class="penci-post-item__inner">';
	$items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
			'image_size'  => ! empty( $atts['image_size'] ) ? $atts['image_size'] :  'penci-thumb-480-645',
			'class'       => 'penci-gradient',
			'show_icon'   => ! $atts['hide_icon_post_format'],
			'size_icon'   => 'icon_pos_right medium-size-icon',
			'hide_review' => $atts['hide_review_piechart'],
			'image_type' => $atts['image_type']
		) );
	$items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
	$items .= '<div class="penci-slide-overlay">';
	$items .= '<a class="overlay-link" href="' . get_the_permalink() . '"></a>';
	$items .= '<div class="penci_post_content"><div class="feat-text ">';
	$items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );

	if ( function_exists( 'penci_get_post_date' ) && empty( $atts['hide_post_date'] ) ||
		function_exists( 'penci_get_comment_count' ) && empty( $atts['hide_comment'] )
	) :
		$items .= '<div class="penci_post-meta">';

		if( function_exists( 'penci_get_post_author' ) && isset( $atts['show_author'] ) && $atts['show_author'] ){
			$items .= penci_get_post_author( false, false );
		}
		$items .= function_exists( 'penci_get_post_date' ) && empty( $atts['hide_post_date'] ) ? penci_get_post_date( false ) : '';
		$items .= function_exists( 'penci_get_comment_count' ) && empty( $atts['hide_comment'] ) ? penci_get_comment_count( false ) : '';

		if( isset( $atts['show_count_view'] ) && $atts['show_count_view'] ){
			$items .= penciframework_get_post_countview( get_the_ID(), false );
		}

		$items .= '</div>';
	endif;
	$items .= '</div></div></div></div>';
	$items .= '</article>';

	$grid7_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $items , $atts );