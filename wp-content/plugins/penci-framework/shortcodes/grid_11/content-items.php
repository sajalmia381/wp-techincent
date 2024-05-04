<?php
$grid11_i          = 1;
$grid11_first_item = '';
$grid11_items      = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if ( $grid11_i == 1 ) {
		$grid11_first_item .= '<article  class="' . join( ' ', penci_get_post_class( 'penci_media_object grid11_first_item', get_the_ID() ) ) . '">';
		$grid11_first_item .= '<div class="penci_post_thumb penci_mobj__img">';
		$grid11_first_item .= Penci_Helper_Shortcode::get_image_holder_pre( array(
			'image_size'  => Penci_Helper_Shortcode::get_image_size_by_type( 'penci-thumb-760-570',  $atts['image_type'] ),
			'class'       => '',
			'show_icon'   => ! $atts['hide_icon_post_format'],
			'size_icon'   => 'icon_pos_right',
			'hide_review' => $atts['hide_review_piechart'],
		) );
		$grid11_first_item .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
		$grid11_first_item .= function_exists( 'penci_get_social_share' ) ? penci_get_social_share( false, true ) : '';
		$grid11_first_item .= '</div> <div class="penci_post_content penci_mobj__body">';
		$grid11_first_item .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_big_title_length'] );
		$grid11_first_item .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], $atts['hide_excrept'] );
		$grid11_first_item .= Penci_Helper_Shortcode::get_post_meta( array( 'author', 'date', 'comment' ), $atts, true, array( 'view' ) );
		$grid11_first_item .= '</div></article>';
	} else {
		$class = isset( $class ) ? $class : '';
		$grid11_items .= '<article  class="' . join( ' ', penci_get_post_class( $class, get_the_ID() ) ) . '">';
		$grid11_items .= '<div class="penci-post-item__inner">';
		$grid11_items .= '<div class="penci_post_thumb">';
		$grid11_items .= Penci_Helper_Shortcode::get_image_holder_pre( array(
			'image_size'  => Penci_Helper_Shortcode::get_image_size_by_type( 'penci-thumb-480-320',  $atts['image_type'] ),
			'class'       => 'penci-gradient',
			'show_icon'   => ! $atts['hide_icon_post_format'],
			'size_icon'   => 'icon_pos_right',
			'hide_review' => $atts['hide_review_piechart'],

		) );
		$grid11_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), $atts, false );
		$grid11_items .= '</div>';
		$grid11_items .= '<div class="penci_post_content">';
		$grid11_items .= Penci_Helper_Shortcode::get_post_meta( array( 'author', 'date', 'comment' ), $atts, true, array( 'view' ) );
		$grid11_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );
		$grid11_items .= '</div></div></article>';
	}

	$grid11_i ++;

}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items(  $grid11_first_item . '<div class="grid11_items">' . $grid11_items . '</div>' , $atts );
