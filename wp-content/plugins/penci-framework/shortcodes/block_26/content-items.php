<?php
$block26_i = 1;
$block26_items = '';
$block26_count = 1;
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();


	if ( $block26_count == 1 ) {
		$block26_items .= '<div class="penci-block-wrapper-item">';
		$block26_items .= '<article  class="' . join( ' ', penci_get_post_class( 'block26_first_item', get_the_ID() ) ) . '">';
		$block26_items .= '<div class="penci_post_thumb">';
		$block26_items .= Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-760-570',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
		) );
		$block26_items .= '</div> <div class="penci_post_content">';
		$block26_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_big_title_length'] );
		$block26_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment','view' ), $atts, true, array( 'author' ) );
		$block26_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );

		if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
			$block26_items .= penci_more_link();
		}

		$block26_items .= '</div></article>';
		$block26_items .= '<div class="block26_items">';
	}
	elseif ( $block26_count == 2 ) {
		$block26_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
		$block26_items .= '<div class="penci_post_thumb">';
		$block26_items .= Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-280-186',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'class_icon' => 'small-size-icon',
		) );
		$block26_items .= '</div> <div class="penci_post_content">';
		$block26_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
		$block26_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment','view' ), $atts, true, array( 'author' ) );
		$block26_items .= '</div></article>';
	}
	else {
		$block26_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
		$block26_items .= '<div class="penci_post_content">';
		$block26_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
		$block26_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment','view' ), $atts, true, array( 'author' ) );
		$block26_items .= '</div></article>';
	}

	$block26_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block26_i,
		'code'       => $content,
	) );

	if ( $block26_i == $query_slider->post_count ) {
		$block26_items .= '</div></div>';
	}

	$block26_count ++;
	$block26_i ++;
}
wp_reset_postdata();


return Penci_Helper_Shortcode::pre_output_content_items( $block26_items , $atts );