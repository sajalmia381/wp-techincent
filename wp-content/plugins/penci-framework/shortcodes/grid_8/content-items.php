<?php
$grid8_i = $grid8_count = 1;
$grid8_items = '';

while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if( $grid8_count == 1 ) {
		$grid8_items .= '<div class="penci-block-wrapper-item">';
		$grid8_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item-' . $grid8_count, get_the_ID() ) ) . '">';
		$grid8_items .='<div class="penci-post-item__inner">';
		$grid8_items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
			'image_size'  => Penci_Helper_Shortcode::get_image_size_by_type( 'penci-thumb-760-570',  $atts['image_type'] ),
			'class'       => 'penci-gradient',
			'show_icon'   => ! $atts['hide_icon_post_format'],
			'size_icon'   => ' icon_pos_right medium-size-icon',
			'hide_review' => $atts['hide_review_piechart'],
		) );
		$grid8_items .= '<div class="penci_post_content">';
		$grid8_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_big_title_length'] );
		$grid8_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment' ), $atts,true, array( 'author','view' ) );
		$grid8_items .= '</div></div></article>';
		$grid8_items .= '<div class="penci-vc-grid-scroll">';
	}else {
		$grid8_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item-' . $grid8_count, get_the_ID() ) ) . '">';
		$grid8_items .='<div class="penci-post-item__inner">';
		$grid8_items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
			'image_size'  =>  Penci_Helper_Shortcode::get_image_size_by_type( 'penci-thumb-480-320',  $atts['image_type'] ),
			'class'       => 'penci-gradient',
			'show_icon'   => ! $atts['hide_icon_post_format'],
			'size_icon'   => ' icon_pos_right medium-size-icon',
			'hide_review' => $atts['hide_review_piechart'],
		) );
		$grid8_items .= '<div class="penci_post_content">';
		$grid8_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
		$grid8_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment' ), $atts,true, array( 'author','view' ) );
		$grid8_items .= '</div></div></article>';
	}

	if ( $grid8_count == 6 || $grid8_i == $query_slider->post_count ) {
		$grid8_items .= '</div></div>';
		$grid8_count   = 0;
	}

	$grid8_count ++;
	$grid8_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $grid8_items , $atts );
