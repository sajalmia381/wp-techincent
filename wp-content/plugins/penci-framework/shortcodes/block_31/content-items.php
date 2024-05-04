<?php
$block30_items = '';
$block31_i = 1;
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$post_id = get_the_ID();

	if(  1 == $block31_i && ( $atts['turn_on_loop_item'] || ! isset( $styleAction ) || ( isset( $styleAction ) && 'load_more' != $styleAction ) ) ) {

		$block30_items .= '<article  class="' . join( ' ', penci_get_post_class( 'block31_big_item', $post_id ) ) . '">';
		$block30_items .= '<div class="penci_post_thumb">';
		$block30_items .= Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-760-570',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
		) );
		$block30_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
		$block30_items .= '</div> <div class="penci_post_content">';
		$block30_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_big_title_length'] );
		$block30_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment', 'review','view' ), $atts, true, array( 'author' ) );


		if ( empty( $atts['hide_excrept'] ) ) {

			if ( has_excerpt( $post_id ) ) {
				$block30_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_big_excrept_length'], false );
			} else {
				$content_p                 = apply_filters( 'the_content', get_the_content() );
				$content_strip_shortcode = wpautop( strip_shortcodes( $content_p ) );
				$content_strip_tag       = wp_kses( $content_strip_shortcode, array( 'p' => array() ) );

				$block30_items .= '<div class="penci-post-excerpt">';
				$block30_items .= force_balance_tags( html_entity_decode( wp_trim_words( htmlentities( $content_strip_tag ), $atts['post_big_excrept_length'] ) ) );
				$block30_items .= '</div>';
			}
		}

		if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
			$block30_items .= penci_more_link();
		}

		$block30_items .= '</div></article>';
	}
	else{
		$img_pos_class = 'right' == $atts['thumb_pos'] ? ' penci_mobj-image-right' : '';

		$block30_items .= '<article  class="' . join( ' ', penci_get_post_class( 'block31_medium_item', $post_id ) ) . '">';
		$block30_items .= '<div class="penci_media_object ' . $img_pos_class . '">';
		if( empty( $atts['hide_thumb'] ) ):
			$block30_items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
				'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-280-186',
				'class'       => 'penci_post_thumb penci_mobj__img',
				'show_icon'   => ! $atts['hide_icon_post_format'],
				'size_icon'   => 'icon_pos_right',
				'hide_review' => $atts['hide_review_piechart'],
			) );
		endif;
		$block30_items .= '<div class="penci_post_content penci_mobj__body">';
		$block30_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
		$block30_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
		$block30_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment','view' ), $atts, true, array( 'author' ) );
		$block30_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );

		if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
			$block30_items .= penci_more_link();
		}

		$block30_items .= '</div></div></article>';
	}

	if ( ( $block31_i == 3 && $atts['turn_on_loop_item']  ) ) {
		$block31_i = 0;
	}

	$block30_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block31_i,
		'code'       => $content,
	) );

	$block31_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block30_items , $atts );