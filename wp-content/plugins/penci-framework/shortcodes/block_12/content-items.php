<?php
$block12_items = '';
$block12_i = 1;

$image_size = ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-280-186';

if( class_exists( 'Mobile_Detect' ) ) {
	$detect = new Mobile_Detect;

	if ( $detect->isMobile() ) {
		$image_size = 'penci-thumb-480-320';
	}
}

while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$img_pos_class = 'right' == $atts['thumb_pos'] ? ' penci_mobj-image-right' : '';

	$block12_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '"><div class="penci_media_object ' . $img_pos_class . '">';
	if( empty( $atts['hide_thumb'] ) ) :
	$block12_items .= '<div class="penci_mobj__img">';
	$block12_items .= Penci_Helper_Shortcode::get_image_holder(  array(
		'image_size' => $image_size,
		'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
		'class_icon' => 'small-size-icon',
		'image_type' => $atts['image_type']
	)  );

	$block12_items .= Penci_Helper_Shortcode::get_post_meta( array( 'review' ), $atts, false );
	$block12_items .= '</div>';
	endif;
	$block12_items .= '<div class="penci_post_content penci_mobj__body">';
	$block12_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
	$block12_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
	$block12_items .= Penci_Helper_Shortcode::get_post_meta( array( 'author','date','comment' ), $atts, true, array( 'view' ) );
	$block12_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );

	if ( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ) {
		$block12_items .= penci_more_link();
	}

	$block12_items .= '</div></div></article>';

	$block12_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block12_i,
		'code'       => $content,
	) );

	$block12_i ++;
}
wp_reset_postdata();


return Penci_Helper_Shortcode::pre_output_content_items( $block12_items , $atts );