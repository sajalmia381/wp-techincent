<?php

$block36_i     = 1;
$block36_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$piechart = '';

	if ( empty( $atts['hide_post_review'] ) && function_exists( 'penci_display_piechart_review_html' ) ) {
		$piechart = penci_display_piechart_review_html(
			get_the_ID(),
			'big',
			false,
			array(
				'trackcolor'    => isset( $atts['review_pro_color'] ) ? $atts['review_pro_color'] : '',
				'color_running' => isset( $atts['review_pro_runcolor'] ) ? $atts['review_pro_runcolor'] : '',
			),
			true
		);
	}

	$img_pos_class = 'right' == $atts['thumb_pos'] ? ' penci_mobj-image-right' : '';

	$block36_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
	$block36_items .= '<div class="penci_media_object' . $img_pos_class . '">';
	$block36_items .= $piechart ? '<div class="penci_mobj__img" >' . $piechart . '</div>' : '';
	$block36_items .= '<div class="penci_post_content penci_mobj__body">';
	$block36_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
	$block36_items .= Penci_Helper_Shortcode::get_post_meta( array( 'date','view', 'comment' ), $atts, true, array( 'author' ) );
	$block36_items .= '</div></div></article>';

	$block36_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block36_i,
		'code'       => $content,
	) );

	$block36_i ++;
}
wp_reset_postdata();


return Penci_Helper_Shortcode::pre_output_content_items( $block36_items , $atts );