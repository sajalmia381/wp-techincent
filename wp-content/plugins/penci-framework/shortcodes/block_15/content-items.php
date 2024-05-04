<?php

$block15_i = 1;
$block15_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$img_pos_class = 'right' == $atts['thumb_pos'] ? ' penci_mobj-image-right' : '';

	$block15_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
	$block15_items .= '<div class="penci_media_object ' . $img_pos_class . '">';
	if( empty( $atts['hide_thumb'] ) ):
	$block15_items .= '<div class="penci-post-order penci_mobj__img">';
	$block15_items .= sprintf("%' 02d", $block15_i );;
	$block15_items .= '</div>';
	endif;
	$block15_items .= '<div class="penci_post_content penci_mobj__body">';
	$block15_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
	$block15_items .= Penci_Helper_Shortcode::get_post_meta( array( 'view','comment' ), $atts, true, array( 'author','date' ) );
	$block15_items .= '</div></div></article>';

	$block15_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block15_i,
		'code'       => $content,
	) );

	$block15_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block15_items , $atts );