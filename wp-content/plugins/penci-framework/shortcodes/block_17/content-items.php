<?php
$block17_i     = 1;
$block17_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if ( $block17_i < 3 && ( ! isset( $styleAction ) || ( isset( $styleAction ) && 'load_more' != $styleAction ) ) ) {

		$block17_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item-' . $block17_i . ' penci-post-big-item', get_the_ID() ) ) . '">';
		$block17_items .= '<div class="penci-post-item__inner">';
		$block17_items .= '<div class="penci_post_thumb">';
		$block17_items .= Penci_Helper_Shortcode::get_image_holder( array(
			'image_size' => ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-480-320',
			'class'      => 'penci-gradient',
			'show_icon'  => ! $atts['hide_icon_post_format'],
			'class_icon' => 'small-size-icon icon_pos_right',
			'image_type' => $atts['image_type']
		) );
		$block17_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat', 'review' ), $atts, false );
		$block17_items .= '</div>';
		$block17_items .= '<div class="penci_post_content">';
		$block17_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_big_title_length'] );
		$block17_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment', 'view' ), $atts, true, array( 'author' ) );
		$block17_items .= '</div>';
		$block17_items .= '</div>';
		$block17_items .= Penci_Helper_Shortcode::get_excrept( $atts['fpost_excrept_length'], ! $atts['fshow_excrept'] );
		$block17_items .= '</article>';

		$block17_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
			'before'     => '<div class="penci-infeed_ad penci-post-item penci-post-big-item">',
			'order_ad'   => $atts['infeed_ads__order'],
			'order_post' => $block17_i,
			'code'       => $content,
		) );

	} else {
		$img_pos_class = 'right' == $atts['thumb_pos'] ? ' penci_mobj-image-right' : '';

		$block17_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item-' . $block17_i . ' penci-post-normal-item', get_the_ID() ) ) . '">';
		$block17_items .= '<div class="penci_media_object ' . $img_pos_class . '">';
		if ( empty( $atts['hide_thumb'] ) ):
			$block17_items .= '<div class="penci_post_thumb penci_mobj__img">';
			$block17_items .= Penci_Helper_Shortcode::get_image_holder( array(
				'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-280-186',
				'show_icon'  => ! $atts['hide_icon_post_format'],
				'class_icon' => 'small-size-icon',
				'image_type' => $atts['image_type']
			) );
			$block17_items .= Penci_Helper_Shortcode::get_post_meta( array( 'review' ), $atts, false );
			$block17_items .= '</div>';
		endif;
		$block17_items .= '<div class="penci_post_content penci_mobj__body">';
		$block17_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
		$block17_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
		$block17_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment', 'view' ), $atts, true, array( 'author' ) );
		$block17_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );

		if ( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ) {
			$block17_items .= penci_more_link();
		}

		$block17_items .= '</div></div></article>';

		$block17_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
			'order_ad'   => $atts['infeed_ads__order'],
			'order_post' => $block17_i,
			'code'       => $content,
		) );
	}

	$block17_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block17_items , $atts );
