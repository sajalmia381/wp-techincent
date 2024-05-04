<?php
$grid5_i = 1;
$grid5_count = 1;

$grid5s_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$img_size  = 'penci-thumb-480-320';
	$grid5_title_length = 'post_standard_title_length';
	$grid5_class_item = 'penci-item-small';

	if(  $grid5_count < 4 ) {
		$grid5_title_length = 'post_big_title_length';
		$grid5_class_item = 'penci-item-medium';

	}

	$grid5_post = '<article  class="' . join( ' ', penci_get_post_class( 'penci_post_thumb penci-post-item-' . $grid5_count . ' ' . $grid5_class_item, get_the_ID() ) ) . '">';
	$grid5_post .='<div class="penci-post-item__inner">';
	$grid5_post .= Penci_Helper_Shortcode::get_image_holder_pre( array(
		'image_size'  =>  Penci_Helper_Shortcode::get_image_size_by_type( $img_size,  $atts['image_type'] ),
		'class'       => 'penci-gradient',
		'show_icon'   => ! $atts['hide_icon_post_format'],
		'size_icon'   => 'icon_pos_right',
		'hide_review' => $atts['hide_review_piechart'],
	) );
	$grid5_post .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
	$grid5_post .= '<div class="penci_post_content">';
	$grid5_post .= Penci_Helper_Shortcode::get_markup_title_post(  $atts[$grid5_title_length] );
	$grid5_post .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author','view' ) );
	$grid5_post .= '</div></div></article>';

	if ( $grid5_count == 1 ) {
		$grid5s_items .= '<div class="penci-block_content__items_inner">';
		$grid5s_items .= $grid5_post;
		$grid5s_items .= '<div class="penci-vc-grid-scroll">';
	} else {
		$grid5s_items .= $grid5_post;
	}

	if ( $grid5_count == 7 || $grid5_i == $query_slider->post_count ) {
		$grid5s_items .= '</div></div>';
		$grid5_count   = 0;
	}

	$grid5_count ++;
	$grid5_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $grid5s_items , $atts );