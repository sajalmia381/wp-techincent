<?php
$block23_i     = 1;
$block23_count = 1;
$block23_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if ( $block23_count == 1 ) {
		$block23_items .= '<div class="penci-block-wrapper-item">';
		$block23_items .= '<article  class="' . join( ' ', penci_get_post_class( 'block23_first_item', get_the_ID() ) ) . '">';
		$block23_items .= '<div class="penci_post_thumb">';
		$block23_items .= Penci_Helper_Shortcode::get_image_holder( array(
			'image_size' => ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-480-320',
			'show_icon'  => ! $atts['hide_icon_post_format'],
			'image_type' => $atts['image_type']
		) );
		$block23_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
		$block23_items .= function_exists( 'penci_get_social_share' ) ? penci_get_social_share( false, true ) : '';
		$block23_items .= '</div> <div class="penci_post_content">';
		$block23_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
		$block23_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author', 'view' ) );

		$excrept       = function_exists( 'penci_content_limit' ) ? penci_content_limit( $atts['post_excrept_length'], $more = '...', false ) : '';
		$block23_items .= $excrept && empty( $atts['hide_excrept'] ) ? '<div class="penci-post-excerpt">' . $excrept . '</div>' : '';

		if ( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ) {
			$block23_items .= penci_more_link();
		}

		$block23_items .= '</div></article>';
		$block23_items .= '<div class="block23_items">';

	} else {
		$block23_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
		$block23_items .= '<div class="penci_post_thumb">';
		$block23_items .= Penci_Helper_Shortcode::get_image_holder( array(
			'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-280-186',
			'show_icon'  => ! $atts['hide_icon_post_format'],
			'class_icon' => 'small-size-icon',
			'image_type' => $atts['image_type']
		) );
		$block23_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
		$block23_items .= '</div><div class="penci_post_content">';
		$block23_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );

		if ( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ) {
			$block23_items .= penci_more_link();
		}

		$block23_items .= '</div></article>';
	}

	if ( $block23_count == 5 || $block23_i == $query_slider->post_count ) {
		$block23_items .= '</div></div>';
		$block23_count = 0;
	}

	$block23_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block23_i,
		'code'       => $content,
	) );

	$block23_count ++;
	$block23_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block23_items, $atts );