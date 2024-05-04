<?php
$block6_i = 1;
$block6_items = '';

while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$image_size = Penci_Helper_Shortcode::get_image_size_by_type( 'penci-thumb-280-186', $atts['image_type'] );

	$block6_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
	$block6_items .= '<div class="penci_media_object ' . ( 'right' == $atts['thumb_pos'] ? 'penci_mobj-image-right' : '' ) . '">';

	if( empty( $atts['hide_thumb'] ) ) {

		if ( isset( $atts['replace_feat_author'] ) && $atts['replace_feat_author'] ) {
			$block6_items .= Penci_Helper_Shortcode::replace_featured_img_to_author_avatar( array(
				'class'      => 'penci_mobj__img',
				'image_type' => $atts['image_type']
			) );
		} else {
			$block6_items .= Penci_Helper_Shortcode::get_image_holder( array(
				'image_size' => $atts['image_size'] ? $atts['image_size'] : 'penci-thumb-280-186',
				'class'      => 'penci_mobj__img',
				'show_icon'  => ! $atts['hide_icon_post_format'],
				'class_icon' => 'small-size-icon',
				'image_type' => $atts['image_type']
			) );
		}
	}

	$block6_items .= '<div class="penci_post_content penci_mobj__body">';
	$block6_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
	$block6_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment' ), $atts, true, array( 'author','view' ) );

	$block6_items .= '</div></div></article>';

	$block6_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block6_i,
		'code'       => $content,
	) );

	$block6_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block6_items , $atts );
