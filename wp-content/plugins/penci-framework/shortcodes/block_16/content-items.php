<?php
$block16_count = $block16_i = 1;
$block16_items = '';

while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$img_size     =  ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320';
	$class_icon   = 'small-size-icon';
	$trim_word    = 'post_standard_title_length';
	$image_holder = '';
	$p_class      = 'penci-medium-item';
	if ( 1 == $block16_count && ( ! isset( $styleAction ) || ( isset( $styleAction ) && 'load_more' != $styleAction ) ) ) {
		$img_size     = ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-760-570';
		$class_icon   = 'icon_pos_right';
		$image_holder = 'penci-gradient';
		$p_class      = 'penci-big-item';
		$trim_word    = 'post_big_title_length';

		if ( ! $atts['big_post_text_below'] ) {
			$p_class .= ' big-post-text-above';
		}

	}

	$p_class .= ' penci-post-item__' . $block16_i;

	$block16_items .= '<article  class="' . join( ' ', penci_get_post_class( $p_class, get_the_ID() ) ) . '">';
	$block16_items .= '<div class="penci-post-item__inner">';
	$block16_items .= '<div class="penci_post_thumb">';
	$block16_items .= Penci_Helper_Shortcode::get_image_holder(  array(
		'image_size' => $img_size,
		'class'      => $image_holder,
		'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
		'class_icon' => $class_icon,
		'image_type' => $atts['image_type']
	)  );
	$block16_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat', 'review' ), $atts, false );
	$block16_items .= '</div>';
	$block16_items .= '<div class="penci_post_content">';
	$block16_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts[$trim_word] );
	$block16_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment', 'view' ), $atts, true, array( 'author' ) );

	if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
		$block16_items .= penci_more_link();
	}

	$block16_items .= '</div></div></article>';

	$block16_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block16_i,
		'code'       => $content,
	) );

	$block16_count ++;
	$block16_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block16_items , $atts );