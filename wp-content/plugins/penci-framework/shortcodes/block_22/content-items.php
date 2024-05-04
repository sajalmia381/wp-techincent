<?php
$block22_i     = 1;
$block22_items = '';
$block22_count = 1;
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$img_size_big   = ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-760-570';
	$img_size_small = ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320';

	$img_size  = ( $block22_i == 1 ) ? $img_size_big : $img_size_small;
	$trim_word = ( $block22_i == 1 ) ? 'post_big_title_length' : 'post_standard_title_length';

	$block22_class = 'penci_post_thumb penci-post-item-' . $block22_i;
	$styleAction   = isset( $styleAction ) ? $styleAction : '';

	if ( ( ( empty( $styleAction ) || 'next_prev' == $styleAction ) && $block22_i > 1 ) || ( 'load_more' == $styleAction ) ) {
		$block22_class .= ' penci-post-item-small';
	}

	if ( empty( $atts['hide_review_piechart'] ) && function_exists( 'penci_display_piechart_review_html' ) && ! $atts['hide_icon_post_format'] ) {
		$block22_class .= ' penci_post_piechart_review';
	}

	$block22_items .= '<article  class="' . join( ' ', penci_get_post_class( $block22_class, get_the_ID() ) ) . '">';

	$block22_items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
		'image_size'  => $img_size,
		'class'       => 'penci-gradient',
		'show_icon'   => ! $atts['hide_icon_post_format'],
		'size_icon'   => 'icon_pos_right medium-size-icon',
		'hide_review' => $atts['hide_review_piechart'],
		'size_review' => ( $block22_i == 1 ) ? 'normal' : 'small',
		'image_type' => isset( $atts['image_type'] ) ? $atts['image_type'] : ''
	) );

	$block22_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
	$block22_items .= '<div class="penci_post_content">';
	$block22_items .= $block22_i > 1 ? Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author', 'view' ) ) : '';
	$block22_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts[$trim_word] );
	$block22_items .= $block22_i == 1 ? Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author', 'view' ) ) : '';
	$block22_items .= '</div></article>';

	$block22_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block22_items , $atts );