<?php
$items = '';
foreach ( $images as $i => $image ) {

	$items .= '<div class="penci-gal-item">';
	$items .= Penci_Helper_Shortcode::get_image_holder_gal( $image, 'penci-thumb-480-320' );
	$items .= '<span class="penci__gallery-caption"><span>' . Penci_Helper_Shortcode::get_image_alt( $image ) . '</span></span>';
	$items .= '</div>';
}

$data = ' data-items="2"';
$data .= ' data-auto="' . ( ! empty( $atts['auto_play'] ) ? 1 : 0 ) . '"';
$data .= ' data-autotime="' . ( ! empty( $atts['auto_time'] ) ? $atts['auto_time'] : 4000 ) . '"';
$data .= ' data-speed="' . ( ! empty( $atts['speed'] ) ? $atts['speed'] : 600 ) . '"';
$data .= ' data-loop="' . ( ! empty( $atts['loop'] ) ? 1 : 0 ) . '"';
$data .= ' data-dots="0"';
$data .= ' data-nav="1"';
$data .= 'data-style="grid5"';
$data .= ' data-autowidth="0"';

return '<div class="penci-owl-carousel-slider penci-fadeInUp  popup-gallery-slider penci-owl-carousel-style"'. $data .'> '. $items.'</div>';