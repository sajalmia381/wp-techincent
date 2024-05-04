<?php

$block10_i = 1;
$block10_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();



	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$show_updated = penci_get_theme_mod( 'penci_show_date_updated' );

	$date_day   = ! $show_updated ? get_the_date( 'd' ) : get_the_modified_date( 'd' );
	$date_month = ! $show_updated ? get_the_date( 'M' ) : get_the_modified_date( 'M' );

	$time_string = sprintf( $time_string,
		! $show_updated ? esc_attr( get_the_date( 'c' ) ) : esc_attr( get_the_modified_date( 'c' ) ),
		'<div class="penci-posted-on__day">' . esc_html( $date_day ) . '</div><div class="penci-posted-on__month">' . esc_html( $date_month ) . '</div>',
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'penci-framework' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);


	$block10_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '"><div class="penci_media_object">';
	$block10_items .= '<div class="penci-posted-on penci_mobj__img" >';
	$block10_items .= $posted_on;
	$block10_items .= '</div>';
	$block10_items .= '<div class="penci_post_content penci_mobj__body">';
	$block10_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'] );
	$block10_items .= '</div></div></article>';

	$block10_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $block10_i,
		'code'       => $content,
	) );

	$block10_i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block10_items , $atts );