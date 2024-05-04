<?php
$i     = 1;
$block14_items = '';

while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$block14_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item__' . $i , get_the_ID() ) ) . '">';
	$block14_items .= '<div class="penci_post_thumb">';
	$block14_items .= Penci_Helper_Shortcode::get_image_holder(  array(
		'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320',
		'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
		'image_type' => $atts['image_type']
	)   );
	$block14_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat','review' ), $atts, false );
	$block14_items .= '</div>';
	$block14_items .= '<div class="penci_post_content">';
	$block14_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
	$block14_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment','view' ), $atts,true, array( 'author' ) );
	$block14_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );

	if ( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ) {
		$block14_items .= penci_more_link();
	}

	$block14_items .= '</div>';
	$block14_items .= '</article>';

	$block14_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $i,
		'code'       => $content,
	) );

	$i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block14_items , $atts );