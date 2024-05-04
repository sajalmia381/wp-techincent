<?php
$i = 1;

$items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$video = get_post_meta( get_the_ID(), '_format_video_embed', true );
	$url   = function_exists( 'penci_pennews_get_youtube_link' ) ? penci_pennews_get_youtube_link( $video ) : '';

	$items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
	$items .= '<div class="penci_post_thumb">';
	$items .= Penci_Helper_Shortcode::get_image_holder( array( 'image_size' => 'penci-thumb-760-570' ) );
	$items .= $url ? '<a class="penci-popup-video" href="' . esc_html( $url ) . '">' : '';
	$items .= Penci_Framework_Helper::icon_post_format( $atts['hide_format_icons'] );
	$items .= $url ? '</a>' : '';
	$items .= '</div> <div class="penci_post_content">';
	$items .= '<h3 class="penci__post-title"><a href="' . get_the_permalink() . '">' . penci_trim_post_title( get_the_ID(), $atts['post_standard_title_length'] ) . '</a></h3>';
	$items .= Penci_Helper_Shortcode::get_post_meta( array( 'author', 'date', 'comment' ), $atts );
	$items .= '</div> </article>';

	$i ++;
}
wp_reset_postdata();

// Data slider
$data = ' data-items="1"';
$data .= ' data-auto="' . ( ! empty( $atts['auto_play'] ) ? 1 : 0 ) . '"';
$data .= ' data-autotime="' . ( ! empty( $atts['auto_time'] ) ? $atts['auto_time'] : 4000 ) . '"';
$data .= ' data-speed="' . ( ! empty( $atts['speed'] ) ? $atts['speed'] : 600 ) . '"';
$data .= ' data-loop="' . ( ! empty( $atts['disable_loop'] ) ? 1 : 0 ) . '"';
$data .= ' data-dots="' . ( empty( $atts['show_dots'] ) ? 1 : 0 ) . '"';
$data .= ' data-nav="' . ( ! empty( $atts['show_nav'] ) ? 1 : 0 ) . '"';
$data .= 'data-style="grid7"';
$data .= ' data-autowidth="0"';
$data .= ' data-video="1"';

return '<div class="block_video_items penci-owl-carousel-slider  penci-owl-carousel-style" ' . $data . '>' . $items . '</div>';