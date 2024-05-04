<?php
$block28_items      = '';
$block28_i          = 1;
$block28_first_item = '';
$hide_border = $query_slider->post_count > 1 ? '' : ' hide-border';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$img_pos_class = 'right' == $atts['thumb_pos'] ? ' penci_mobj-image-right' : '';

	if ( $block28_i == 1 && ( ! isset( $styleAction ) || (  isset( $styleAction ) && 'load_more' != $styleAction ) ) ) {
		$block28_first_item .= '<article  class="' . join( ' ', penci_get_post_class( ' block28_first_item' . $img_pos_class . $hide_border , get_the_ID() ) ) . '">';
		$block28_first_item .= '<div class="penci_media_object">';
		$block28_first_item .= '<div class="penci_post_thumb penci_mobj__img">';
		$block28_first_item .= Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => ! empty( $atts['big_image_size'] ) ? $atts['big_image_size'] : 'penci-thumb-480-320',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'image_type' => $atts['image_type']
		) );
		$block28_first_item .= function_exists( 'penci_get_social_share' ) ? penci_get_social_share( false, true ) : '';
		$block28_first_item .= '</div> <div class="penci_post_content penci_mobj__body">';
		$block28_first_item .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_big_title_length'] );
		$block28_first_item .= Penci_Helper_Shortcode::get_post_meta( array( 'author', 'date', 'comment' ), $atts, true, array( 'view' ) );
		$block28_first_item .= Penci_Helper_Shortcode::get_excrept( $atts['big_post_excrept_length'], $atts['hide_excrept_big_post'] );
		if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
			$block28_first_item .= penci_more_link();
		}
		$block28_first_item .= '</div></div></article>';
	} else {
		$block28_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
		$block28_items .= '<div class="penci_media_object ' . $img_pos_class . '">';
		if( empty( $atts['hide_thumb'] ) ):
		$block28_items .= Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-280-186',
			'class'      => 'penci_mobj__img',
			'show_icon'  => ! $atts[ 'hide_icon_post_format' ],
			'class_icon' => 'small-size-icon',
			'image_type' => $atts['image_type']
		) );
		endif;
		$block28_items .= '<div class="penci_post_content penci_mobj__body">';
		$block28_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
		$block28_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
		$block28_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment','view' ), $atts, true, array( 'author' )  );
		$block28_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );

		if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
			$block28_items .= penci_more_link();
		}

		$block28_items .= '</div></div></article>';
	}

	$block28_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block28_i,
		'code'       => $content,
	) );

	$block28_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block28_first_item . '<div class="block28_items">' . $block28_items . '</div>' , $atts );