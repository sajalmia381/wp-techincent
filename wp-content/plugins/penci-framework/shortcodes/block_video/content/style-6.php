<?php
$i          = 1;
$first_item = '';
$items      = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$video = get_post_meta( get_the_ID(), '_format_video_embed', true );
	$url   =  function_exists( 'penci_pennews_get_youtube_link' ) ? penci_pennews_get_youtube_link( $video ) : '';
	$url   =  function_exists( 'penci_pennews_get_youtube_link' ) ? penci_pennews_get_youtube_link( $video ) : '';

	$items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
	$items .= '<div class="penci_post_thumb">';
	$items .= Penci_Helper_Shortcode::get_image_holder( array() );
	$items .= $url ? '<a class="penci-popup-video" href="' . esc_html( $url ) . '">' : '';
	$items .= Penci_Framework_Helper::icon_post_format( $atts['hide_format_icons'] );
	$items .= $url ? '</a>' : '';
	$items .= '</div>';
	$items .= '<h3 class="penci__post-title"><a href="' . get_the_permalink() . '">' . penci_trim_post_title( get_the_ID(), $atts['post_standard_title_length'] ) . '</a></h3>';
	$items .= '</article>';

	$i ++;
}
wp_reset_postdata();

return $first_item . '<div class="block_video_items">' . $items . '</div>';