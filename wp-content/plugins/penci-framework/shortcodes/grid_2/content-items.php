<?php
$grid2_i     = 1;
$grid2_count = 1;
$grid2_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if ( $grid2_count == 1 ) {
		$grid2_items .= '<div class="penci-block-wrapper-item ' . ( $query_slider->post_count > 2 ? 'penci-wrapper-hasitems' : '' )  . '">';
		$grid2_items .= '<article  class="' . join( ' ', penci_get_post_class( 'grid2_first_item', get_the_ID() ) ) . '">';
		$grid2_items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
			'image_size'  => 'penci-thumb-480-645',
			'class'       => 'penci-gradient',
			'show_icon'   => ! $atts['hide_icon_post_format'],
			'size_icon'   => 'small-size-icon icon_pos_right',
			'hide_review' => $atts['hide_review_piechart'],
		) );
		$grid2_items .= '<div class="penci_post_content">';
		$grid2_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts );
		$grid2_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_big_title_length'] );
		$grid2_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author','view' ) );
		$grid2_items .= '</div>';
		$grid2_items .= '</article>';
		$grid2_items .= '<div class="grid2_items">';
	} else {
		$id_trim_word = $grid2_count == 2 ? 'post_standard_title_length' : 'post_small_title_length';
		$image_size   = $grid2_count == 2 ? 'penci-thumb-960-auto' : 'penci-thumb-480-320';

		$grid2_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item', get_the_ID() ) ) . '">';
		$grid2_items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
			'image_size'  => $image_size,
			'class'       => 'penci-gradient',
			'hide_review' => $atts['hide_review_piechart'],
		) );
		$grid2_items .= '<div class="penci_post_content">';
		$grid2_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts );
		$grid2_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts[$id_trim_word] );
		$grid2_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author','view' ) );
		$grid2_items .= '</div>';
		$grid2_items .= '</article>';
	}

	if ( $grid2_count == 4 || $grid2_i == $query_slider->post_count ) {
		$grid2_items .= '</div></div>';
		$grid2_count = 0;
	}

	$grid2_i ++;
	$grid2_count ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $grid2_items , $atts );