<?php
$block25_i = 1;
$items     = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item__' . $block25_i, get_the_ID() ) ) . '">';
	$items .= '<div class="penci_post_thumb">';
	$items .= Penci_Helper_Shortcode::get_image_holder(  array(
		'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-280-186',
		'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
		'class_icon' => 'medium-size-icon',
		'image_type' => $atts['image_type']
	) );
	$items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat', 'review' ), $atts, false );
	$items .= '</div>';
	$items .= '<div class="penci_post_content">';
	$items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
	$items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment', 'view' ), $atts, true, array( 'author' ) );

	if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
		$items .= penci_more_link();
	}

	$items .= '</div>';
	$items .= '</article>';

	$items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block25_i,
		'code'       => $content,
	) );

	$block25_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $items, $atts );