<?php
$block32_i     = 1;
$block32_items = '';
$block32_count = 1;
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if ( $block32_count == 1 ) {
		$block32_items .= '<div class="penci-block-wrapper-item">';
	}

	$post_meta_2 = '';
	$post_meta   = Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment','view' ), $atts, true, array( 'author' ) );

	$img_size             = ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-480-320';
	$block32_class_icon   = '';
	$id_trim_word = 'post_standard_title_length';
	$block32_class_img    = '';
	$block_32_class = '';

	if( ! isset( $styleAction ) ){
		$styleAction = '';
	}
	if ( ( $block32_count == 1 || $block32_count == 2 ) && ( 'load_more' != $styleAction || ( 'load_more' == $styleAction && $atts['turn_on_loop_item'] ) ) ) {
		$img_size           = ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320';
		$block32_class_icon = 'icon_pos_right';

		$post_meta_2       = $post_meta;
		$post_meta         = '';
		$block32_class_img = 'penci-gradient';

		$id_trim_word = 'post_big_title_length';
		$block_32_class .= ' block32-big-item';
	}

	$block32_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item-' . $block32_count . $block_32_class, get_the_ID() ) ) . '">';
	$block32_items .= '<div class="penci-post-item__inner">';
	$block32_items .= '<div class="penci_post_thumb">';
	$block32_items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
		'image_size'  => Penci_Helper_Shortcode::get_image_size_by_type( $img_size, $atts['image_type'] ),
		'class'       => $block32_class_img,
		'show_icon'   => ! $atts['hide_icon_post_format'],
		'size_icon'   => 'icon_pos_right medium-size-icon',
		'hide_review' => $atts['hide_review_piechart'],
	) );

	$block32_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
	$block32_items .= '</div> <div class="penci_post_content">';
	$block32_items .= $post_meta_2;
	$block32_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts[$id_trim_word] );
	$block32_items .= $post_meta;

	if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
		$block32_items .= penci_more_link();
	}

	$block32_items .= '</div></div></article>';

	if ( $block32_count == 5 || $block32_i == $query_slider->post_count ) {
		$block32_items .= '</div>';
		$block32_count = 0;
	}

	$block32_count ++;
	$block32_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block32_items , $atts );