<?php
$gal_images = '';
$i     = 0;
$count = 0;
$items = '';
$total_img = is_array( $images ) ? count( (array)$images ) : 0;
foreach ( $images as $i => $image ) {
	$count ++;
	$i ++;

	$items .= '<div class="penci-gal-item">';
	$items .= Penci_Helper_Shortcode::get_image_holder_gal( $image, 'penci-thumb-auto-400', false );
	$items .= '<span class="penci__gallery-caption"><span>' . Penci_Helper_Shortcode::get_image_alt( $image ) . '</span></span>';
	$items .= '</div>';
}

$data = ' data-items="3"';
$data .= ' data-auto="' . ( ! empty( $atts['auto_play'] ) ? 1 : 0 ) . '"';
$data .= ' data-autotime="' . ( ! empty( $atts['auto_time'] ) ? $atts['auto_time'] : 4000 ) . '"';
$data .= ' data-speed="' . ( ! empty( $atts['speed'] ) ? $atts['speed'] : 600 ) . '"';
$data .= ' data-loop="' . ( ! empty( $atts['loop'] ) ? 1 : 0 ) . '"';
$data .= ' data-dots="0"';
$data .= ' data-nav="1"';
$data .= ' data-magrin="4"';
$data .= 'data-style="grid2"';
$data .= ' data-autowidth="1"';

return '<div class="penci-owl-carousel-slider penci-fadeInUp popup-gallery-slider  penci-owl-carousel-style"'. $data .'> '. $items.'</div>';