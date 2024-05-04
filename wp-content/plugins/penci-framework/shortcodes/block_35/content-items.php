<?php

$block35_i     = 1;
$block35_items = '';
$count_post    = $query_slider->post_count;

while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	global $post;

	$img_size_big   = ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-760-570';
	$img_size_small = ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320';

	$img_size              = $block35_i == 1 ? $img_size_big : $img_size_small;
	$block_35_title_length = $block35_i == 1 ? '120' : '55';
	$block_35_class_icon   = $block35_i == 1 ? 'icon_pos_right' : 'small-size-icon';

	if ( 1 == $block35_i ) {
		$id_trim_word = 'post_big_title_length';
	} elseif ( 4 == $block35_i ) {
		$id_trim_word = 'post_small_title_length';
	} else {
		$id_trim_word = 'post_standard_title_length';
	}

	if ( $block35_i == 2 ) {
		$block35_items .= '<div class="penci-wapper-items">';
	}

	$block35_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item__' . $block35_i, get_the_ID() ) ) . '">';
	$block35_items .= Penci_Helper_Shortcode::get_image_holder( array(
		'image_size' => $img_size,
		'class'      => 'penci-gradient',
		'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
		'class_icon' => $block_35_class_icon,
	) );
	$block35_items .= '<div class="penci_post_content">';
	$block35_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts[$id_trim_word] );
	$block35_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author', 'view' ) );
	$block35_items .= $block35_i != 1 ? Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] ) : '';

	if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
		$block35_items .= penci_more_link();
	}

	$block35_items .= '</div>';
	$block35_items .= '</article>';

	$block35_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block35_i,
		'code'       => $content,
	) );

	if ( $block35_i == 3 || ( 3 > $count_post && 1 < $count_post && $block35_i == $count_post ) ) {
		$block35_items .= '</div>';
	}



	$block35_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block35_items , $atts );