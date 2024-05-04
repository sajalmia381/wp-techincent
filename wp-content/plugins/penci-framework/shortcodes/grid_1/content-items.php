<?php
$items = '';
$grid1_i = 0;
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$post_thumbnail = Penci_Framework_Helper:: post_thumbnail( array(
		'post'   => get_the_ID(),
		'size'   => 'medium',
		'echo'   => false,
	) );

	$style = "background-image: url( {$post_thumbnail} );";


	$items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci_post_thumb penci-grid-item', get_the_ID() ) ) . '">';
	$items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
		'image_size'  => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320',
		'class'       => 'penci-gradient',
		'show_icon'   => ! $atts['hide_icon_post_format'],
		'size_icon'   => 'small-size-icon icon_pos_right',
		'hide_review' => $atts['hide_review_piechart'],
		'image_type' => $atts['image_type']
	) );
	$items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts );
	$items .= '<div class="penci_post_content">';
	$items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
	$items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment', 'view' ), $atts, true, array( 'author' ) );
	$items .= '</div>';
	$items .= '</article>';

	$grid1_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $items , $atts );