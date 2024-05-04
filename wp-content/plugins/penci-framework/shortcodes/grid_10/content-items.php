<?php
$grid10_items = '';
$grid10_i     = 0;
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$grid10_items .= '<article  class="' . join( ' ', penci_get_post_class( isset( $class ) ? $class : '', get_the_ID() ) ) . '">';
	$grid10_items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
		'image_size'  => Penci_Helper_Shortcode::get_image_size_by_type( 'penci-thumb-480-320',  $atts['image_type'] ),
		'class'       => '',
		'show_icon'   => ! $atts['hide_icon_post_format'],
		'size_icon'   => 'icon_pos_right medium-size-icon',
		'hide_review' => $atts['hide_review_piechart'],
	) );
	$grid10_items .= '<div class="penci_post_content">';
	$grid10_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author','view' ) );
	$grid10_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
	$grid10_items .= '</div></article>';

	$grid10_i ++;
}
wp_reset_postdata();


return Penci_Helper_Shortcode::pre_output_content_items( $grid10_items , $atts );