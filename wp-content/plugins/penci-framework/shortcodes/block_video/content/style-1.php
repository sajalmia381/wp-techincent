<?php
$i = 1;
$first_item = $first_item_info = $items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	if( 'video' != get_post_format() ) {
		continue;
	}
	$video = get_post_meta( get_the_ID(), '_format_video_embed', true );
	$url = function_exists( 'penci_pennews_get_youtube_link' ) ? penci_pennews_get_youtube_link( $video ) : '';

	if ( $i == 1 ) {
		$class_first_item = 'block_video_first_item penci-big-icon';
		$class_first_item .= ! empty( $atts['show_title_ab_img'] ) ? ' penci-title-ab-img' : '';

		$first_item .= '<article  class="' . join( ' ', penci_get_post_class( $class_first_item, get_the_ID() ) ) . '">';
		$first_item .= '<div class="penci_post_thumb">';
		$first_item .= Penci_Helper_Shortcode::get_image_holder( array( 'image_size' => 'penci-big-thumbnail' ) );
		$first_item .= $url ? '<a class="penci-popup-video" href="' . esc_html( $url ) . '">' : '';
		$first_item .= Penci_Framework_Helper::icon_post_format( $atts['hide_format_icons'] );
		$first_item .= $url ? '</a>' : '';
		$first_item .= '</div> <div class="penci_post_content">';
		$first_item .= '<h3 class="penci__post-title"><a href="' . get_the_permalink() . '">' . penci_trim_post_title( get_the_ID(), $atts['post_big_title_length'] ) . '</a></h3>';
		$first_item .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts );
		$first_item .= '</div></article>';

		$first_item_info .= '<article  class="' . join( ' ', penci_get_post_class( 'block_video_first_item block_video_first_item_info', get_the_ID() ) ) . '">';
		$first_item_info .= '<div class="penci_post_content">';
		$first_item_info .= '<h3 class="penci__post-title"><a href="' . get_the_permalink() . '">' . penci_trim_post_title( get_the_ID(), $atts['post_standard_title_length'] ) . '</a></h3>';
		$first_item_info .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'comment' ), $atts );
		$first_item_info .= '</div></article>';
	}
	else {
		$items .= '<div  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
		$items .= '<div class="penci_post_thumb">';
		$items .= Penci_Helper_Shortcode::get_image_holder( array( 'image_size' => 'penci-big-thumbnail' ) );
		$items .= $url ? '<a class="penci-popup-video" href="' . esc_html( $url ) . '">' : '';
		$items .= Penci_Framework_Helper::icon_post_format( $atts['hide_format_icons'],'small-size-icon' );
		$items .= $url ? '</a>' : '';
		$items .= '</div>';
		$items .= '</div>';
	}

	$i ++;
}
wp_reset_postdata();

$output = '<div class="penci-block_content__items">';
$output .= $first_item . '<div class="block_video_items">' . $items . '</div>';
$output .= '</div>';
$output .= $first_item_info;

return $output;