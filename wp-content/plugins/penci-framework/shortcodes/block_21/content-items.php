<?php
$block21_i     = 1;
$block21_count = 1;
$block21_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if ( $block21_count == 1 ) {
		$block21_items .= '<div class="penci-block-wrapper-item">';
		$block21_items .= '<article  class="' . join( ' ', penci_get_post_class( 'block_21_first_item', get_the_ID() ) ) . '">';
		$block21_items .= '<div class="penci_post_thumb">';
		$block21_items .= Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-480-320',
			'class'      => 'penci-gradient',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'class_icon' => 'icon_pos_right',
			'image_type' => $atts['image_type']
		) );
		$block21_items .= '</div> <div class="penci_post_content">';
		$block21_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_big_title_length'] );
		$block21_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author','view' ) );
		$block21_items .= '</div></article>';
		$block21_items .= '<div class="block_21_items">';
	} else {
		$block21_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '"><div class="penci_media_object">';
		$block21_items .= Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-280-186',
			'class'      => 'penci_mobj__img',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'class_icon' => 'small-size-icon',
			'image_type' => $atts['image_type']
		) );
		$block21_items .= '<div class="penci_post_content penci_mobj__body">';
		$block21_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
		$block21_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author', 'view' ) );
		$block21_items .= '</div></div></article>';
	}

	$block21_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block21_i,
		'code'       => $content,
	) );

	if ( $block21_count == 4 || $block21_i == $query_slider->post_count ) {
		$block21_items .= '</div></div>';
		$block21_count  = 0;
	}

	$block21_count ++;
	$block21_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block21_items , $atts );