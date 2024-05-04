<?php

if( 1 == $column_number ) {

	$block11_i          = 1;
	$block11_first_item = '';
	$block11_items      = '';
	while ( $query_slider->have_posts() ) {
		$query_slider->the_post();


		if ( $block11_i == 1 && ( ! isset( $styleAction ) || ( isset( $styleAction ) && 'load_more' != $styleAction ) ) ) {
			$block11_first_item .= '<article  class="' . join( ' ', penci_get_post_class( 'block11_first_item', get_the_ID() ) ) . '">';
			$block11_first_item .= '<div class="penci-post-item__inner">';
			$block11_first_item .= Penci_Helper_Shortcode::get_image_holder(  array(
				'image_size' =>  ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-480-320',
				'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
				'class_icon' => 'small-size-icon',
				'image_type' => $atts['image_type']
			)  );
			$block11_first_item .= '<div class="penci_post_content">';
			$block11_first_item .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_big_title_length'] );
			$block11_first_item .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment', 'review' ), $atts, true, array( 'author','view' ) );

			if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
				$block11_first_item .= penci_more_link();
			}

			$block11_first_item .= '</div></div></article>';
		} else {
			$block11_items .= '<article class="' . join( ' ', penci_get_post_class( ( isset( $styleAction ) && 'load_more' == $styleAction ) ? 'block11_item_loadmore' : '', get_the_ID() ) ) . '"><div class="penci_media_object">';
			if ( empty( $atts['hide_thumb'] ) ):
				$block11_items .= Penci_Helper_Shortcode::get_image_holder(  array(
					'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-280-186',
					'class'      => 'penci_mobj__img',
					'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
					'class_icon' => 'small-size-icon',
					'image_type' => $atts['image_type']
				)  );
			endif;
			$block11_items .= '<div class="penci_post_content penci_mobj__body">';
			$block11_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
			$block11_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author','view' ) );
			$block11_items .= '</div></div></article>';
		}

		$block11_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
			'before'     => '<div class="penci-infeed_ad penci-post-item"><div class="ppenci_media_object">',
			'after'      => '</div></div>',
			'order_ad'   => $atts['infeed_ads__order'],
			'order_post' => $block11_i,
			'code'       => $content,
		) );

		$block11_i ++;
	}
	wp_reset_postdata();

	return Penci_Helper_Shortcode::pre_output_content_items( $block11_first_item . '<div class="block11_items">' . $block11_items . '</div>', $atts );
}else{
	$block11_i = 1;
	$block11_first_item = '';
	$block11_items = '';
	while ( $query_slider->have_posts() ) {
		$query_slider->the_post();

		if ( ( $block11_i == 1 || $block11_i == 2 ) && ( ! isset( $styleAction ) || (  isset( $styleAction ) && 'load_more' != $styleAction ) ) ) {

			$block11_first_item .= '<article  class="' . join( ' ', penci_get_post_class( 'block11_first_item  penci-col-6', get_the_ID() ) ) . '">';
			$block11_first_item .= '<div class="penci-post-item__inner">';
			$block11_first_item .= Penci_Helper_Shortcode::get_image_holder(  array(
				'image_size' => ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-480-320',
				'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
				'class_icon' => 'small-size-icon',
				'image_type' => $atts['image_type']
			)  );
			$block11_first_item .= '<div class="penci_post_content">';
			$block11_first_item .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_big_title_length'] );
			$block11_first_item .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment', 'review' ), $atts, true, array( 'author','view' ) );

			if ( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ) {
				$block11_first_item .= penci_more_link();
			}

			$block11_first_item .= '</div></div></article>';
		}
		else {

			$block11_items_class = 'penci-col-6';
			$block11_items_class .= ( isset( $styleAction ) && 'load_more' == $styleAction ) ? ' block11_item_loadmore' : '';

			$block11_items .= '<article  class="' . join( ' ', penci_get_post_class( $block11_items_class, get_the_ID() ) ) . '"><div class="penci_media_object">';
			if ( empty( $atts['hide_thumb'] ) ):
				$block11_items .= Penci_Helper_Shortcode::get_image_holder(  array(
					'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-280-186',
					'class'      => 'penci_mobj__img',
					'show_icon'  => ! $atts['hide_icon_post_format'],
					'class_icon' => 'small-size-icon',
					'image_type' => $atts['image_type']
				) );
			endif;
			$block11_items .= '<div class="penci_post_content penci_mobj__body">';
			$block11_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
			$block11_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts, true, array( 'author','view' ) );
			$block11_items .= '</div></div></article>';
		}

		$block11_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
			'before'     => '<div class="penci-infeed_ad penci-post-item penci-col-6">',
			'order_ad'   => $atts['infeed_ads__order'],
			'order_post' => $block11_i,
			'code'       => $content,
		) );

		$block11_i ++;
	}
	wp_reset_postdata();

	return Penci_Helper_Shortcode::pre_output_content_items( '<div class="penci-row">' . $block11_first_item . '</div><div class="block11_items penci-row">' . $block11_items .  '</div>' , $atts );

}