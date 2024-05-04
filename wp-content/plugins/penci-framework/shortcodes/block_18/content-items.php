<?php
$block18_i     = 1;
$block18_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$block18_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item__' . $block18_i , get_the_ID() ) ) . '">';
	$block18_items .= '<div class="penci_post_thumb">';
	$block18_items .= Penci_Helper_Shortcode::get_image_holder(  array(
		'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320',
		'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
		'class_icon' => 'small-size-icon',
		'image_type' => $atts['image_type']
	)  );
	$block18_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat','review' ), $atts, false );
	$block18_items .= '</div>';
	$block18_items .= '<div class="penci_post_content">';
	$block18_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
	$block18_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment','view' ), $atts, true, array( 'author' ) );

	if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
		$block18_items .= penci_more_link();
	}

	$block18_items .= '</div>';
	$block18_items .= '</article>';

	$block18_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block18_i,
		'code'       => $content,
	) );

	$block18_i ++;
}
wp_reset_postdata();


return Penci_Helper_Shortcode::pre_output_content_items( $block18_items , $atts );