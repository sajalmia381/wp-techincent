<?php
$block30_i = 1;
$block30_first_item = '';
$block30_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$img_pos_class = 'right' == $atts['thumb_pos'] ? ' penci_mobj-image-right' : '';

	if ( $block30_i == 1 && ( ! isset( $styleAction ) || (  isset( $styleAction ) && 'load_more' != $styleAction ) )  ) {
		$block30_first_item .= '<article  class="' . join( ' ', penci_get_post_class( 'block30_first_item', get_the_ID() ) ) . '">';
		$block30_first_item .= Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-760-570',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'class_icon' => 'icon_pos_right',
		) );
		$block30_first_item .= '<div class="penci_post_content">';
		$block30_first_item .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_big_title_length'] );
		$block30_first_item .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment','view' ), $atts, true, array( 'author' ) );
		$block30_first_item .= '</div></article>';
	}
	else {
		$block30_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
		$block30_items .= '<div class="penci_media_object' . $img_pos_class . '">';
		if( empty( $atts['hide_thumb'] ) ):
		$block30_items .= Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-280-186',
			'class'      => 'penci_mobj__img',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'class_icon' => 'small-size-icon',
			'image_type' => $atts['image_type']
		) );
		endif;
		$block30_items .= '<div class="penci_post_content penci_mobj__body">';
		$block30_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
		$block30_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment','view' ), $atts, true, array( 'author' ) );
		$block30_items .= '</div></div></article>';
	}

	$block30_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block30_i,
		'code'       => $content,
	) );

	$block30_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block30_first_item . '<div class="block30_items">' . $block30_items . '</div>' , $atts );