<?php
$block13_i      = 1;
$block13_items  = '';
$block_13_total = $query_slider->post_count;

while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$block13_class = 'penci-small-item';
	$trim_word     = 'post_standard_title_length';
	$image_size    = ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-480-320';

	if ( $block13_i < 3 && ( ! isset( $styleAction ) || ( isset( $styleAction ) && 'load_more' != $styleAction ) ) ) {
		$block13_class = 'penci-big-item';
		$trim_word     = 'post_big_title_length';

		$image_size = ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320';
	}

	if ( $block13_i == 3 && ( ! isset( $styleAction ) || ( isset( $styleAction ) && 'load_more' != $styleAction ) ) ) {
		$block13_items .= '<div class="block13-small-items">';
	}

	$block13_items .= '<article  class="' . join( ' ', penci_get_post_class( $block13_class, get_the_ID() ) ) . '">';
	$block13_items .= '<div class="penci_post_thumb">';
	$block13_items .= Penci_Helper_Shortcode::get_image_holder( array(
		'image_size' => $image_size,
		'class_icon' => 'small-size-icon',
		'image_type' => $atts['image_type'],
		'show_icon'  => ! $atts['hide_icon_post_format'],
	) );
	$block13_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat', 'review' ), $atts, false );
	$block13_items .= '</div> <div class="penci_post_content">';
	$block13_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts[ $trim_word ] );
	$block13_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment','view' ), $atts, true, array( 'author' ) );

	if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
		$block13_items .= penci_more_link();
	}

	$block13_items .= '</div></article>';

	if ( $block13_i == $block_13_total &&  $block13_i >= 3 && ( ! isset( $styleAction ) || ( isset( $styleAction ) && 'load_more' != $styleAction ) ) ) {
		$block13_items .= '</div>';
	}

	$block13_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block13_i,
		'code'       => $content,
	) );

	$block13_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block13_items, $atts );