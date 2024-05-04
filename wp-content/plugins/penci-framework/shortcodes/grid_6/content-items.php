<?php
$grid6_i = $grid6_count = 1;
$grid6_items = $grid6_scroll = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if ( $grid6_count == 1 ) {
		$grid6_items .= '<div class="penci-block_content__wapper">';
		$grid6_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item-' . $grid6_count , get_the_ID() ) ) . '">';
		$grid6_items .='<div class="penci-post-item__inner">';
		$grid6_items .= '<div class="penci_post_thumb">';
		$grid6_items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
			'image_size'  =>  Penci_Helper_Shortcode::get_image_size_by_type( 'penci-thumb-760-570',  $atts['image_type'] ),
			'class'       => 'penci-gradient',
			'show_icon'   => ! $atts['hide_icon_post_format'],
			'size_icon'   => 'icon_pos_right',
			'hide_review' => $atts['hide_review_piechart'],
		) );
		$grid6_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
		$grid6_items .= '</div> <div class="penci_post_content">';
		$grid6_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_big_title_length'] );
		$grid6_items .= '<div class="penci_post-meta">';
		$grid6_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date' ), $atts, false, array( 'author','view' ) );
		$grid6_items .= function_exists( 'penci_get_comment_count' ) && empty( $atts['hide_comment_first'] ) ? penci_get_comment_count( false ) : '';
		$grid6_items .= '</div>';
		$grid6_items .= '</div></div></article>';
	}else {

		$img_size           = 'penci-thumb-480-320';
		$grid6_title_length = 'post_small_title_length';
		$id_hide_comment    = 'hide_comment_small';

		if ( $grid6_count < 4 ) {
			$grid6_title_length = 'post_standard_title_length';
			$id_hide_comment    = 'hide_comment_medium';
		}

		$grid6_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci_post_thumb penci-post-item-' . $grid6_count, get_the_ID() ) ) . '">';
		$grid6_items .='<div class="penci-post-item__inner">';
		$grid6_items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
			'image_size'  => Penci_Helper_Shortcode::get_image_size_by_type( $img_size,  $atts['image_type'] ),
			'class'       => 'penci-gradient',
			'show_icon'   => ! $atts['hide_icon_post_format'],
			'size_icon'   => 'icon_pos_right',
			'hide_review' => $atts['hide_review_piechart'],
		) );

		$grid6_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
		$grid6_items .= '<div class="penci_post_content">';
		$grid6_items .= '<div class="penci_post-meta">';
		$grid6_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date' ), $atts, false );
		$grid6_items .= function_exists( 'penci_get_comment_count' ) && empty( $atts[ $id_hide_comment ] ) ? penci_get_comment_count( false ) : '';
		$grid6_items .= '</div>';
		$grid6_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts[$grid6_title_length] );
		$grid6_items .= '</div></div></article>';
	}

	if ( $grid6_count == 6 || $grid6_i == $query_slider->post_count ) {
		$grid6_items .= '</div>';
		$grid6_count   = 0;
	}

	$grid6_count ++;
	$grid6_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $grid6_items , $atts );