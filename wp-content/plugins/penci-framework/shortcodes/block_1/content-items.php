<?php
$block1_i = 1;
$block1_first_item = '';
$block1_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$img_pos_class = 'right' == $atts['thumb_pos'] ? ' penci_mobj-image-right' : '';

	if ( $block1_i == 1 ) {
		$block1_first_item .= '<article  class="' . join( ' ', penci_get_post_class( 'penci_media_object block1_first_item ' . $img_pos_class, get_the_ID() ) ) . '">';
		$block1_first_item .= '<div class="penci_post_thumb penci_mobj__img">';
		$block1_first_item .=  Penci_Helper_Shortcode::get_image_holder( array(
			'image_size' => ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-480-320',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'class_icon' => 'lager-size-icon',
			'image_type' => $atts['image_type']
		) );
		$block1_first_item .= function_exists( 'penci_get_social_share' ) ? penci_get_social_share( false, true ) : '';
		$block1_first_item .= '</div> <div class="penci_post_content penci_mobj__body">';
		$block1_first_item .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_big_title_length']);
		$block1_first_item .= Penci_Helper_Shortcode::get_post_meta( array( 'author','date','comment' ), $atts );

		$excrept = function_exists( 'penci_content_limit' ) ? penci_content_limit( $atts['post_excrept_length'], $more = '...', false ) : '';
		$block1_first_item .= $excrept && ! empty( $atts['show_excrept'] ) ? '<div class="penci-post-excerpt">' . $excrept . '</div>' : '';

		if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
			$block1_first_item .= penci_more_link();
		}

		$block1_first_item .= '</div></article>';
	}
	else {
		$image_size = Penci_Helper_Shortcode::get_image_size_by_type( 'penci-thumb-280-186', $atts['image_type'] );
		$block1_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
		$block1_items .= '<div class="penci_media_object ' . $img_pos_class . '">';

		if ( empty( $atts['hide_thumb'] ) ) {
			$block1_items .= Penci_Helper_Shortcode::get_image_holder( array(
				'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-280-186',
				'class'      => 'penci_mobj__img',
				'show_icon'  => ! $atts['hide_icon_post_format'],
				'class_icon' => 'small-size-icon',
				'image_type' => $atts['image_type']
			) );
		}
		$block1_items .= '<div class="penci_post_content penci_mobj__body">';
		$block1_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
		$block1_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment','view' ), $atts );
		$block1_items .= '</div></div></article>';
	}

	$block1_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block1_i,
		'code'       => $content,
	) );

	$block1_i ++;
}

return Penci_Helper_Shortcode::pre_output_content_items( $block1_first_item . '<div class="block1_items">' . $block1_items . '</div>' , $atts );
