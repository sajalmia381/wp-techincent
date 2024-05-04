<?php
$block24_i     = $block24count = 0;
$block24_items = '';

$has_close_div = false;
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$block24_i ++;
	$block24count ++;

	if ( ( $block24count == 2 && ( ! isset( $styleAction ) || ( isset( $styleAction ) && 'load_more' != $styleAction ) ) ) ||
	     ( $block24count == 1 && isset( $styleAction ) && 'load_more' == $styleAction )
	) {
		$block24_items .= '<div class="block24_items">';

		$has_close_div = true;
	}

	$img_size              = ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320';
	$block24_class_item    = 'penci-post-item-' . $block24count;
	$block24_title_length  = 'post_standard_title_length';
	$block_24_image_holder = '';
	$class_icon            = '';

	if ( $block24count == 1 && ( ! isset( $styleAction ) || ( isset( $styleAction ) && 'load_more' != $styleAction ) ) ) {
		$block24_title_length  = 'post_big_title_length';
		$img_size              = ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-760-570';
		$block_24_image_holder = 'penci-gradient';

		$block24_class_item .= ' block24_big_item';
		$class_icon         = 'icon_pos_right';
	}


	$block24_items .= '<article  class="' . join( ' ', penci_get_post_class( $block24_class_item, get_the_ID() ) ) . '">';
	$block24_items .= '<div class="penci_post_thumb">';
	$img_size = Penci_Helper_Shortcode::get_image_size_by_type( $img_size,  $atts['image_type'] );
	$block24_items .= Penci_Helper_Shortcode::get_image_holder_pre(
		array(
			'image_size'  => $img_size,
			'class'       => $block_24_image_holder,
			'show_icon'   => ! $atts['hide_icon_post_format'],
			'size_icon'   => $class_icon,
			'hide_review' => $atts['hide_review_piechart'],
			'image_type' => isset( $atts['image_type'] ) ? $atts['image_type'] : ''
		)
	);

	$block24_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
	$block24_items .= '</div><div class="penci_post_content">';
	$block24_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts[ $block24_title_length ] );
	$block24_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment', 'view' ), $atts, true ,array( 'author' ) );

	if( $block24count > 1 || ( isset( $styleAction ) && 'load_more' == $styleAction ) ) {
		$block24_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );
	}

	if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
		$block24_items .= penci_more_link();
	}

	$block24_items .= '</div></article>';

	$block24_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block24_i,
		'code'       => $content,
	) );

	if ( $block24count == 5 || ( $block24_i == $query_slider->post_count && $has_close_div ) ) {
		$block24_items .= '</div>';
		$block24count  = 0;
	}

}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block24_items , $atts );