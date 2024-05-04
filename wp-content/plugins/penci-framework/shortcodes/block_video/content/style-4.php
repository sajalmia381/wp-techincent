<?php
$i     = $count = 0;
$items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$video = get_post_meta( get_the_ID(), '_format_video_embed', true );
	$url   = function_exists( 'penci_pennews_get_youtube_link' ) ? penci_pennews_get_youtube_link( $video ) : '';

	$image_size = 'penci-thumb-480-320';
	$i ++;
	$count ++;

	$class_icon = 'small-size-icon';
	$class_item = '';
	if ( $count == 1 ) {
		$items .= '<div class="penci-video-wrapper-item">';
		$items .= '<div class="penci-video-item penci-video-item-' . ( $i % 5 ) . '">';
	}

	if ( $count == 3 ) {
		$image_size = 'penci-thumb-760-570';
		$class_item = 'penci-big-icon';
		$class_icon = '';
	}

	$items .= '<article  class="' . join( ' ', penci_get_post_class( $class_item, get_the_ID() ) ) . '">';
	$items .= '<div class="penci_post_thumb">';

	if ( 'video' == get_post_format() ) {
		$items .= Penci_Helper_Shortcode::get_image_holder( array( 'image_size' => $image_size ) );
	}

	$items  .= $url ? '<a class="penci-popup-video" href="' . esc_html( $url ) . '">' : '';
	$items .= Penci_Framework_Helper::icon_post_format( $atts['hide_format_icons'], $class_icon );
	$items .= $url ? '</a>' : '';
	$items .= '</div>';
	$items .= '</article>';

	if ( $i % 5 == 2 || $i % 5 == 3 ) {
		$items .= '</div><div class="penci-video-item penci-video-item-' . ( $i % 5 ) . '">';
	}
	if ( $count == 5 || $i == $query_slider->post_count ) {
		$items .= '</div></div>';
		$count = 0;
	}
}
wp_reset_postdata();

return $items;
