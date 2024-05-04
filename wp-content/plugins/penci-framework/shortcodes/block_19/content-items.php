<?php
$block19_i     = 1;
$block19_items = '';
$block19_count = 1;
$post_count    = $query_slider->post_count;
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if ( $block19_count == 1 && $post_count > 1 ) {
		$block19_items .= '<div class="penci-block-wrapper-item">';
		$block19_items .= '<div class="penci-wapper-items">';
	}

	$block19_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item__' . $block19_count, get_the_ID() ) ) . '">';
	$block19_items .= '<div class="penci_post_thumb">';
	$block19_items .= Penci_Helper_Shortcode::get_image_holder( array(
		'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320',
		'show_icon'  => ! $atts['hide_icon_post_format'],
		'class_icon' => 'small-size-icon',
		'image_type' => $atts['image_type']
	) );
	$block19_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat', 'review' ), $atts, false );
	$block19_items .= '</div>';
	$block19_items .= '<div class="penci_post_content">';
	$block19_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
	$block19_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author', 'view' ) );
	$block19_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );

	if ( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ) {
		$block19_items .= penci_more_link();
	}

	$block19_items .= '</div>';
	$block19_items .= '</article>';

	if ( $block19_count == 2 ) {
		$block19_items .= '</div>';
	}

	if ( $block19_count == 3 || $block19_count == $query_slider->post_count ) {
		$block19_items .= '</div>';
		$block19_count = 0;
	}

	$block19_count ++;
	$block19_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block19_items, $atts );