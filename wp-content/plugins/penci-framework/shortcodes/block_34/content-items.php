<?php
$block34_i = 1;
$block34_big_item = '';
$block34_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if ( ( $block34_i == 1 || $block34_i == 2 ) && ( ! isset( $styleAction ) || (  isset( $styleAction ) && 'load_more' != $styleAction ) )  ) {
		$block34_big_item .= '<article  class="' . join( ' ', penci_get_post_class( 'block34_big_item penci-post-item-' . $block34_i, get_the_ID() ) ) . '">';
		$block34_big_item .= '<div class="penci-post-item__inner">';
		$block34_big_item .= Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-480-320',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'class_icon' => 'icon_pos_right',
			'image_type' => $atts['image_type']
		) );
		$block34_big_item .= '<div class="penci_post_content">';
		$block34_big_item .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment' ), $atts, true, array( 'author','view' ) );
		$block34_big_item .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_big_title_length'] );
		$block34_big_item .= '</div></div></article>';

		$block34_big_item .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
			'before'     => '<div class="penci-infeed_ad penci-post-item block34_big_item">',
			'order_ad'   => $atts['infeed_ads__order'],
			'order_post' => $block34_i,
			'code'       => $content,
		) );
	}
	else {
		$img_pos_class = 'right' == $atts['thumb_pos'] ? ' penci_mobj-image-right' : '';

		$block34_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
		$block34_items .= '<div class="penci_media_object' . $img_pos_class . '">';
		if( empty( $atts['hide_thumb'] ) ):
		$block34_items .= Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-280-186',
			'class'      => 'penci_mobj__img',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'class_icon' => 'small-size-icon',
			'image_type' => $atts['image_type']
		) );
		endif;
		$block34_items .= '<div class="penci_post_content penci_mobj__body">';
		$block34_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
		$block34_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment' ), $atts, true, array( 'author', 'view' ) );
		$block34_items .= '</div></div></article>';

		$block34_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
			'order_ad'   => $atts['infeed_ads__order'],
			'order_post' => $block34_i,
			'code'       => $content,
		) );
	}


	$block34_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block34_big_item . '<div class="block34_items">' . $block34_items . '</div>' , $atts );