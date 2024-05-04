<?php
$grid4_i     = 1;
$grid4_count = 1;
$grid4_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if ( $grid4_count == 1 ) {
		
	}

	
	$img_size = 'penci-thumb-480-320';
	$grid_4_title_length = 'post_standard_title_length';
	if ( $grid4_count == 1 ) {
		$grid4_items .= '<div class="penci-block-wrapper-item">';
		$img_size = 'penci-thumb-760-570';
		$grid_4_title_length = 'post_big_title_length';
	}

	if ( $grid4_count == 2 ) {
		$grid4_items .= '<div class="grid4_items">';
	}

	$grid4_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item-' . $grid4_count, get_the_ID() ) ) . '">';
	$grid4_items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
			'image_size'  => Penci_Helper_Shortcode::get_image_size_by_type( $img_size,  $atts['image_type'] ),
			'class'       => 'penci-gradient',
			'show_icon'   => ! $atts['hide_icon_post_format'],
			'size_icon'   => 'icon_pos_right',
			'hide_review' => $atts['hide_review_piechart'],
		) );
	$grid4_items .= '<div class="penci_post_content">';
	$grid4_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts[$grid_4_title_length] );
	$grid4_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author','view' ) );
	$grid4_items .= '</div>';
	$grid4_items .= '</article>';

	if ( $grid4_count == 5 || $grid4_i == $query_slider->post_count ) {
		$grid4_items .= '</div></div>';
		$grid4_count = 0;
	}

	$grid4_count ++;
	$grid4_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $grid4_items , $atts );