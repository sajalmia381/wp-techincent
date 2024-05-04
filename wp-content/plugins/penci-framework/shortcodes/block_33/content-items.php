<?php
$block33_i     = 0;
$block33_count = 0;
$block33_items = '';


while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$block33_i ++;
	$block33_count ++;



	if( $atts['turn_on_loop_item'] ){
		if( $block33_count == 1 ) {
			$block33_items .= '<div class="penci-block_content__item turn_on_loop_item">';
		}

		if ( $block33_count == 1 ) {
			$block33_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci_media_object block33_big_item', get_the_ID() ) ) . '">';
			$block33_items .= '<div class="penci_post_thumb penci_mobj__img">';
			$block33_items .= Penci_Helper_Shortcode::get_image_holder(  array(
				'image_size' => ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-480-320',
				'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
				'image_type' => $atts['image_type']
			) );
			$block33_items .= Penci_Helper_Shortcode::get_post_meta( array( 'review','cat' ), $atts, false );
			$block33_items .= function_exists( 'penci_get_social_share' ) ? penci_get_social_share( false, true ) : '';
			$block33_items .= '</div> <div class="penci_post_content penci_mobj__body">';
			$block33_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_big_title_length'] );
			$block33_items .= Penci_Helper_Shortcode::get_post_meta( array( 'author', 'date', 'comment','view' ), $atts );
			$block33_items .= Penci_Helper_Shortcode::get_excrept( $atts['big_post_excrept_length'], $atts['hide_excrept_big_post'] );

			if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
				$block33_items .= penci_more_link();
			}

			$block33_items .= '</div></article>';
		} else {
			$block33_items .= '<article  class="' . join( ' ', penci_get_post_class( 'block33_small_item penci-post-item-' . $block33_count, get_the_ID() ) ) . '">';
			$block33_items .= '<div class="penci_post_thumb">';
			$block33_items .= Penci_Helper_Shortcode::get_image_holder(  array(
				'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320',
				'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
				'image_type' => $atts['image_type']
			) );
			$block33_items .= Penci_Helper_Shortcode::get_post_meta( array( 'review','cat' ), $atts, false );
			$block33_items .= '</div>';
			$block33_items .= '<div class="penci_post_content">';
			$block33_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
			$block33_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment','view' ), $atts );
			$block33_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );

			if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
				$block33_items .= penci_more_link();
			}

			$block33_items .= '</div></article>';
		}


		if ( $block33_count == 5 || $block33_i  == $query_slider->post_count ) {
			$block33_count = 0;
			$block33_items .= '</div>';
		}
	}else {
		if ( $block33_count == 1 && ( ! isset( $styleAction ) || ( isset( $styleAction ) && 'load_more' != $styleAction ) ) ) {
			$block33_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci_media_object block33_big_item', get_the_ID() ) ) . '">';
			$block33_items .= '<div class="penci_post_thumb penci_mobj__img">';
			$block33_items .= Penci_Helper_Shortcode::get_image_holder(  array(
				'image_size' => ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-480-320',
				'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
				'image_type' => $atts['image_type']
			)  );
			$block33_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
			$block33_items .= function_exists( 'penci_get_social_share' ) ? penci_get_social_share( false, true ) : '';
			$block33_items .= '</div> <div class="penci_post_content penci_mobj__body">';
			$block33_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_big_title_length'] );
			$block33_items .= Penci_Helper_Shortcode::get_post_meta( array( 'author', 'date', 'comment','view' ), $atts );
			$block33_items .= Penci_Helper_Shortcode::get_excrept( $atts['big_post_excrept_length'], $atts['hide_excrept_big_post'] );

			if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
				$block33_items .= penci_more_link();
			}

			$block33_items .= '</div></article>';
		} else {
			$block33_items .= '<article  class="' . join( ' ', penci_get_post_class( 'block33_small_item penci-post-item-' . $block33_count, get_the_ID() ) ) . '">';
			$block33_items .= '<div class="penci_post_thumb">';
			$block33_items .= Penci_Helper_Shortcode::get_image_holder( array(
				'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320',
				'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
				'image_type' => $atts['image_type']
			) );
			$block33_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
			$block33_items .= '</div>';
			$block33_items .= '<div class="penci_post_content">';
			$block33_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
			$block33_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment','view' ), $atts );
			$block33_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );

			if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
				$block33_items .= penci_more_link();
			}

			$block33_items .= '</div></article>';
		}
	}

	$block33_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block33_i,
		'code'       => $content,
	) );
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block33_items , $atts );