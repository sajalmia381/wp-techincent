<?php

$block7_items = '';
$block7_i = 1;
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();


	$block7_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
	$block7_items .= '<div class="penci-post-item__inner">';
	$block7_items .='<div class="penci_post_thumb">';
	$block7_items .= Penci_Helper_Shortcode::get_image_holder(  array(
		'image_size' => $atts['image_size'] ? $atts['image_size'] : 'penci-thumb-480-320',
		'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
		'image_type' => $atts['image_type']
	)  );
	if ( ! empty( $atts['show_order_number'] ) ) {
		$block7_items .= '<span class="penci-order-number">' . $block7_i . '</span>';
	}
	/* Display Review Piechart  */
	if( empty( $atts['show_review_piechart'] ) && function_exists('penci_display_piechart_review_html') ) {
		$block7_items .= penci_display_piechart_review_html( get_the_ID(), 'normal', false );
	}
	$block7_items .='</div>';
	$block7_items .= '<div class="penci_post_content">';
	$block7_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
	$block7_items .= Penci_Helper_Shortcode::get_post_meta( array( 'author', 'date','comment' ), $atts, true, array( 'view' ) );

	if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
		$block7_items .= penci_more_link();
	}

	$block7_items .= '</div></div></article>';

	$block7_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block7_i,
		'code'       => $content,
	) );

	$block7_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block7_items , $atts );

