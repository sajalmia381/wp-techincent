<?php

if( 1 == $column_number ) {
	$block4_i = 1;
	$block4_first_item = '';
	$block4_items = '';
	while ( $query_slider->have_posts() ) {
		$query_slider->the_post();

		if ( $block4_i == 1 && ( ! isset( $styleAction ) || (  isset( $styleAction ) && 'load_more' != $styleAction ) ) ) {

			$block4_first_item .= '<article  class="' . join( ' ', penci_get_post_class( 'block4_first_item', get_the_ID() ) ) . '">';
			$block4_first_item .= '<div class="penci_post_thumb">';

			$block4_first_item .= Penci_Helper_Shortcode::get_image_holder( array(
				'image_size' => $atts['big_image_size'] ? $atts['big_image_size'] : 'penci-thumb-480-320',
				'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
				'class_icon' => 'small-size-icon',
				'image_type' => $atts['image_type']
			) );
			$block4_first_item .= function_exists( 'penci_get_social_share' ) ? penci_get_social_share( false, true ) : '';
			$block4_first_item .= '</div> <div class="penci_post_content">';
			$block4_first_item .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_big_title_length'] );
			$block4_first_item .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment' ), $atts, true, array( 'author','view' ) );
			$block4_first_item .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );

			if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
				$block4_first_item .= penci_more_link();
			}

			$block4_first_item .= '</div></article>';
		}
		else {
			$image_size = Penci_Helper_Shortcode::get_image_size_by_type( 'penci-thumb-280-186', $atts['image_type'] );

			$block4_items .= '<article  class="' . join( ' ', penci_get_post_class( ( isset( $styleAction ) && 'load_more' == $styleAction ) ? 'block4_item_loadmore' : '', get_the_ID() ) ) . '"><div class="penci_media_object">';
			if( empty( $atts['hide_thumb'] ) ):
				$block4_items .= Penci_Helper_Shortcode::get_image_holder(array(
					'image_size' => $atts['image_size'] ? $atts['image_size'] : 'penci-thumb-280-186',
					'class'      => 'penci_mobj__img',
					'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
					'class_icon' => 'small-size-icon',
					'image_type' => $atts['image_type']
				) );
			endif;
			$block4_items .= '<div class="penci_post_content penci_mobj__body">';
			$block4_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
			$block4_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment' ), $atts, true, array( 'author','view' ) );
			$block4_items .= '</div></div></article>';
		}

		$block4_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
			'order_ad'   => $atts['infeed_ads__order'],
			'order_post' => $block4_i,
			'code'       => $content,
		) );

		$block4_i ++;
	}
	wp_reset_postdata();

	return Penci_Helper_Shortcode::pre_output_content_items( $block4_first_item . '<div class="block4_items">' . $block4_items .  '</div>' , $atts );
}else{
	$block4_i = 1;
	$block4_first_item = '';
	$block4_items = '';
	while ( $query_slider->have_posts() ) {
		$query_slider->the_post();

		if ( ( $block4_i == 1 || $block4_i == 2 ) && ( ! isset( $styleAction ) || (  isset( $styleAction ) && 'load_more' != $styleAction ) ) ) {

			$block4_first_item .= '<article  class="' . join( ' ', penci_get_post_class( 'block4_first_item penci-col-6', get_the_ID() ) ) . '">';
			$block4_first_item .= '<div class="penci_post_thumb">';
			$block4_first_item .= Penci_Helper_Shortcode::get_image_holder( array(
				'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
				'class_icon' => 'small-size-icon',
				'image_type' => $atts['image_type']
			) );
			$block4_first_item .= function_exists( 'penci_get_social_share' ) ? penci_get_social_share( false, true ) : '';
			$block4_first_item .= '</div> <div class="penci_post_content">';
			$block4_first_item .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_big_title_length'] );
			$block4_first_item .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment' ), $atts, true, array( 'author','view' ) );
			$block4_first_item .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );

			if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
				$block4_first_item .= penci_more_link();
			}

			$block4_first_item .= '</div></article>';
		}
		else {

			$block4_items_class = 'penci-col-6';
			$block4_items_class .= ( isset( $styleAction ) && 'load_more' == $styleAction ) ? ' block4_item_loadmore' : '';

			$block4_items .= '<article  class="' . join( ' ', penci_get_post_class( $block4_items_class, get_the_ID() ) ) . '"><div class="penci_media_object">';
			if( empty( $atts['hide_thumb'] ) ):
				$block4_items .= Penci_Helper_Shortcode::get_image_holder(array(
					'image_size' => 'penci-thumb-280-186',
					'class'      => 'penci_mobj__img',
					'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
					'class_icon' => 'small-size-icon',
					'image_type' => $atts['image_type']
				) );
			endif;
			$block4_items .= '<div class="penci_post_content penci_mobj__body">';
			$block4_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
			$block4_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','comment' ), $atts, true, array( 'author','view' ) );
			$block4_items .= '</div></div></article>';
		}

		$block4_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
			'order_ad'   => $atts['infeed_ads__order'],
			'order_post' => $block4_i,
			'code'       => $content,
		) );

		$block4_i ++;
	}
	wp_reset_postdata();

	return Penci_Helper_Shortcode::pre_output_content_items( '<div class="penci-row">' . $block4_first_item . '</div><div class="block4_items penci-row">' . $block4_items .  '</div>' , $atts );
}

