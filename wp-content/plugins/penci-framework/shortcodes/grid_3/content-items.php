<?php
$grid3_i = 0;
$items   = '';
$count   = 0;
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$grid3_i ++;
	$count ++;

	if ( $count == 1 ) {
		$items .= '<div class="penci-grid-3-items">';
	}

	if ( $count == 2 && $query_slider->post_count > 1 ) {
		$items .= '<div class="penci-grid-3-item">';
	}

	$img_size     = $count > 1 ? 'penci-thumb-480-320' : 'penci-thumb-760-570';
	$id_trim_word = $count > 1 ? 'post_standard_title_length' : 'post_big_title_length';


	$items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-gradient penci-post-item-' . $count, get_the_ID() ) ) . '">';
	$items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
			'image_size'  => Penci_Helper_Shortcode::get_image_size_by_type( $img_size,  $atts['image_type'] ),
			'class'       => 'penci-gradient',
			'show_icon'   => ! $atts['hide_icon_post_format'],
			'size_icon'   => 'icon_pos_right',
			'hide_review' => $atts['hide_review_piechart'],
		) );
	$items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
	$items .= '<div class="penci-slide-overlay">';
	$items .= '<a class="overlay-link" href="' . get_the_permalink() . '"></a>';
	$items .= '<div class="penci_post_content"><div class="feat-text ">';
	$items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts[$id_trim_word] );
	$items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author','view' ) );
	$items .= '</div></div></div>';
	$items .= '</article>';

	if ( ( $count == 3 || $grid3_i == $query_slider->post_count ) && $query_slider->post_count >= 2 ) {
		$items .= '</div>';
	}

	if ( $count == 3 || $grid3_i == $query_slider->post_count ) {
		$items .= '</div>';
		$count = 0;
	}

}
wp_reset_postdata();


return Penci_Helper_Shortcode::pre_output_content_items(  $items , $atts );