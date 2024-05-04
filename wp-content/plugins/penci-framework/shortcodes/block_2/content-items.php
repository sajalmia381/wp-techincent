<?php
$block2_i = 1;
$block2_items = '';
$block2_count = 1;


while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if ( $block2_count == 1 ) {
		$image_size = Penci_Helper_Shortcode::get_image_size_by_type( 'penci-thumb-480-320', $atts['image_type'] );

		$block2_items .= '<div class="penci-block-wrapper-item">';
		$block2_items .= '<article  class="' . join( ' ', penci_get_post_class( 'block2_first_item', get_the_ID() ) ) . '">';
		$block2_items .= '<div class="penci_post_thumb">';
		$block2_items .= Penci_Helper_Shortcode::get_image_holder( array(
			'image_size' => $atts['big_image_size'] ? $atts['big_image_size'] : 'penci-thumb-480-320',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'class_icon' => 'medium-size-icon',
		) );
		$block2_items .= function_exists( 'penci_get_social_share' ) ? penci_get_social_share( false, true ) : '';
		$block2_items .= '</div> <div class="penci_post_content">';
		$block2_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_big_title_length'] );
		$block2_items .= Penci_Helper_Shortcode::get_post_meta( array( 'author','date','comment','view' ), $atts );

		$excrept = function_exists( 'penci_content_limit' ) ? penci_content_limit( $atts['post_excrept_length'], $more = '...', false ) : '';
		$block2_items .= $excrept && empty( $atts['hide_excrept'] ) ? '<div class="penci-post-excerpt">' . $excrept . '</div>' : '';

		if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
			$block2_items .= penci_more_link();
		}
		$block2_items .= '</div></article>';
		$block2_items .= '<div class="block2_items">';
	}
	else {
		$image_size = Penci_Helper_Shortcode::get_image_size_by_type( 'penci-thumb-280-186', $atts['image_type'] );
		$block2_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '"><div class="penci_media_object">';
		$block2_items .= Penci_Helper_Shortcode::get_image_holder( array(
			'image_size' => $atts['image_size'] ? $atts['image_size'] : 'penci-thumb-280-186',
			'class'      => 'penci_mobj__img',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'class_icon' => 'small-size-icon',
		) );
		$block2_items .= '<div class="penci_post_content penci_mobj__body">';
		$block2_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
		$block2_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment','view' ), $atts );
		$block2_items .= '</div></div></article>';
	}

	$block2_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block2_i,
		'code'       => $content,
	) );

	if ( ( $block2_count == 5 && $atts['turn_on_loop_item']  ) || $block2_i == $query_slider->post_count ) {
		$block2_items .= '</div></div>';
		$block2_count = 0;
	}


	$block2_count ++;
	$block2_i ++;
}

wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block2_items , $atts );