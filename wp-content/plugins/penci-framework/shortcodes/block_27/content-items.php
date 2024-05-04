<?php
$block27_i = 1;
$block27_count = 1;
$block27_items = '';
$block_27_total = $query_slider->post_count;
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if ( $block27_count == 1 ) {
		$block27_items .= '<div class="penci-block_content__items ' . ( $block_27_total > 2  ? 'has-3items' : '' ) . '">';
		$block27_items .= '<div class="block27_items">';
	}

	if ( $block27_count == 3 ) {
		$block27_items .= '<article  class="' . join( ' ', penci_get_post_class( 'block27_last_item', get_the_ID() ) ) . '">';
		$block27_items .= '<div class="penci_post_item_content">';
		$block27_items .= '<div class="penci_post_thumb">';
		$block27_items .= Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-480-320',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
		)  );
		$block27_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat','review' ), $atts, false );
		$block27_items .= '</div> <div class="penci_post_content">';
		$block27_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
		$block27_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment','view' ), $atts,true, array( 'author' ) );
		$block27_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );
		$block27_items .= '</div>';
		$block27_items .= '</div></article>';
	} else {
		$block27_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
		$block27_items .= '<div class="penci_post_thumb">';
		$block27_items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
			'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320',
			'show_icon'   => ! $atts['hide_icon_post_format'],
			'size_icon'   => 'icon_pos_right',
			'hide_review' => $atts['hide_review_piechart'],
		) );
		$block27_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
		$block27_items .= '</div> <div class="penci_post_content">';
		$block27_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
		$block27_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment','view' ), $atts,true, array( 'author' ) );
		$block27_items .= '</div></article>';
	}

	if ( $block27_count == 2 || ( $block27_i == $block_27_total && $block27_count < 3 ) ) {
		$block27_items .= '</div>';
	}

	if ( $block27_count == 3 || $block27_i == $block_27_total ) {
		$block27_items .= '</div>';
		$block27_count = 0;
	}

	$block27_count ++;
	$block27_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block27_items , $atts );