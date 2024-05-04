<?php
$i            = 1;
$first_item   = '';
$second_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$video = get_post_meta( get_the_ID(), '_format_video_embed', true );
	$url   = function_exists( 'penci_pennews_get_youtube_link' ) ? penci_pennews_get_youtube_link( $video ) : '';

	$imgsize = 'penci-thumb-480-320';
	$item    = '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item-' . $i, get_the_ID() ) ) . '">';
	$item    .= '<div class="penci_post_thumb">';

	$item    .= Penci_Helper_Shortcode::get_image_holder(  array(
		'image_size' => 'penci-thumb-480-320',
		'class'      => ( $i < 3 ? 'penci-gradient' : '' )
	) );
	$item    .= $url ? '<a class="penci-popup-video" href="' . esc_html( $url ) . '">' : '';
	$item    .= Penci_Framework_Helper::icon_post_format( $atts['hide_format_icons'], ( $i < 3 ? 'lager-size-icon' : '' ) );
	$item    .= $url ? '</a>' : '';
	if ( $i < 3 ):
		$item .= '<h3 class="penci__post-title"><a href="' . get_the_permalink() . '">' . penci_trim_post_title( get_the_ID(), $atts['post_standard_title_length'] ) . '</a></h3>';
	endif;
	$item .= '</div>';
	$item .= '</article>';

	if ( $i < 3 ) {
		$first_item .= $item;
	} else {
		$second_items .= $item;
	}

	$i ++;
}
wp_reset_postdata();

return '<div class="first-items">' . $first_item . '</div><div class="second-items block_video_items">' . $second_items . '</div>';
