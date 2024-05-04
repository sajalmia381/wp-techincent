<?php
$block20_items = '';
$block20_i     = 1;
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$block20_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
	$block20_items .= '<div class="penci_media_object' . ( $block20_i % 2 == 0 ? ' penci_mobj-image-right' : '' ) . '">';
	$block20_items .= '<div class="penci_post_thumb penci_mobj__img">';
	$block20_items .= Penci_Helper_Shortcode::get_image_holder(  array(
		'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320',
		'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
		'image_type' => $atts['image_type']
	) );
	$block20_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat','review' ), $atts, false );
	$block20_items .= '</div>';
	$block20_items .= '<div class="penci_post_content penci_mobj__body">';
	$block20_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
	$block20_items .= Penci_Helper_Shortcode::get_post_meta( array( 'author', 'date', 'view' ), $atts, true, array( 'comment' ) );
	$block20_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );

	if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
		$block20_items .= penci_more_link();
	}

	$block20_items .= '</div></div></article>';

	$block20_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block20_i,
		'code'       => $content,
	) );

	$block20_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block20_items , $atts );