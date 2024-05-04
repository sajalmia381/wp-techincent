<?php
$block3_i     = 1;
$block3_items = '';
$block3_count = 1;

while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if ( $block3_count == 1 ) {

		$block3_items .= '<div class="penci-block-wrapper-item">';
		$block3_items .= '<article  class="' . join( ' ', penci_get_post_class( 'block3_first_item penci-big-icon', get_the_ID() ) ) . '">';
		$block3_items .= '<div class="penci_post_thumb">';

		$block3_items .= Penci_Helper_Shortcode::get_image_holder( array(
			'image_size' => $atts['big_image_size'] ? $atts['big_image_size'] : 'penci-thumb-480-320',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'class_icon' => 'lager-size-icon',
			'image_type' => $atts['image_type']
		) );

		$block3_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat','review' ), $atts, false );
		$block3_items .= '</div> <div class="penci_post_content">';
		$block3_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_big_title_length'] );
		$block3_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment','view' ), $atts, true, array( 'author' ) );
		$excrept = function_exists( 'penci_content_limit' ) ? penci_content_limit( $atts['post_excrept_length'], $more = '...', false ) : '';
		$block3_items .= $excrept && ! empty( $atts['show_excrept'] ) ? '<div class="penci-post-excerpt">' . $excrept . '</div>' : '';

		if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
			$block3_items .= penci_more_link();
		}

		$block3_items .= '</div></article>';
		$block3_items .= '<div class="block3_items">';
	}
	else {

		$block3_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
		$block3_items .= '<div class="penci_post_thumb">';
		$block3_items .= Penci_Helper_Shortcode::get_image_holder( array(
			'image_size' => $atts['image_size'] ? $atts['image_size'] : 'penci-thumb-480-320',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'image_type' => $atts['image_type']
		) );
		$block3_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat','review' ), $atts, false );
		$block3_items .= '</div>';
		$block3_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
		$block3_items .= '</article>';
	}

	$block3_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block3_i,
		'code'       => $content,
	) );

	if ( ( $block3_count == 3 && $atts['turn_on_loop_item'] ) || $block3_i == $query_slider->post_count ) {
		$block3_items .= '</div></div>';
		$block3_count = 0;
	}

	$block3_i ++;
	$block3_count++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block3_items , $atts );

