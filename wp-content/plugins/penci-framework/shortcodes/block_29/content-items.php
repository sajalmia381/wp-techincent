<?php
$block29_i           = 1;
$block21_first_items = '';
$block21_items       = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();


	if ( $block29_i < 4 ) {

		$title_length  = $block29_i == 1 ? 'post_big_title_length' : 'post_standard_title_length';
		$class_iconb29 = $block29_i == 1 ? 'icon_pos_right' : 'icon_pos_right small-size-icon';

		$img_size_big   = ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-760-570';
		$img_size_small = ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-245-163';

		$img_size            = $block29_i == 1 ? $img_size_big : $img_size_small;
		$block21_first_items .= '<article  class="' . join( ' ', penci_get_post_class( 'block_29_first_item penci-post-item-' . $block29_i, get_the_ID() ) ) . '">';
		$block21_first_items .= '<div class="penci-post-item-inner-relative">';
		$block21_first_items .= '<div class="penci_post_thumb">';
		$block21_first_items .= Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => $img_size,
			'class'      => 'penci-gradient',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'class_icon' => $class_iconb29,
			'image_type' => $atts['image_type']
		) );
		$block21_first_items .= '</div> <div class="penci_post_content">';
		$block21_first_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts[$title_length] );
		$block21_first_items .= $block29_i == 1 ? Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author','view' ) ) : '';
		$block21_first_items .= '</div></div></article>';
	} else {
		$block21_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
		$block21_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_small_title_length'] );
		$block21_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author','view' ) );
		$block21_items .= '</article>';
	}

	$block29_i ++;
}
wp_reset_postdata();


return Penci_Helper_Shortcode::pre_output_content_items( '<div class="penci_media_object"> <div class="block_29_first_items">' . $block21_first_items . '</div><div class="block_29_items">' . $block21_items . '</div></div>' , $atts );