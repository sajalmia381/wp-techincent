<?php
$data = ' data-auto="' . ( ! empty( $atts['auto_play'] ) ? 1 : 0 ) . '"';
$data .= ' data-autotime="' . ( ! empty( $atts['auto_time'] ) ? $atts['auto_time'] : 4000 ) . '"';
$data .= ' data-speed="' . ( ! empty( $atts['speed'] ) ? $atts['speed'] : 600 ) . '"';
$data .= ' data-loop="' . ( ! empty( $atts['disable_loop'] ) ? 1 : 0 ) . '"';
$data .= ' data-autowidth="1"';
$data .= ' data-nav="1"';

$class_lazy = function_exists( 'penci_check_lazyload_type' ) ? penci_check_lazyload_type( 'class', null, false ) : '';

$items = $small_thumb = '';
foreach ( $images as $i => $image ) {
	$list_url = Penci_Helper_Shortcode::get_img_info_by_id( $image, array( 'penci-thumb-960-auto', 'large' ) );

	$src_large    = isset( $list_url['large']['img_url'] ) ? $list_url['large']['img_url'] : '';
	$src_thmb_960 = isset( $list_url['penci-thumb-960-auto']['img_url'] ) ? $list_url['penci-thumb-960-auto']['img_url'] : '';
	$caption_img  = isset( $list_url['alt'] ) ? $list_url['alt'] : '';

	$data_src_thmb_960 = '';
	if ( function_exists( 'penci_check_lazyload_type' ) ) {
		$data_src_thmb_960 = penci_check_lazyload_type( 'src', $src_thmb_960, false );
	}

	$items .= '<div class="penci-gal-item">';
	$items .= sprintf( '<a class="penci-image-holder%s" data-src="%s" href="%s" title="%s"></a>',
		$class_lazy, $data_src_thmb_960, $src_large, $caption_img );
	$items .= $caption_img ? '<span class="penci__gallery-caption"><span>' . $caption_img . '</span></span>' : '';
	$items .= '</div>';
}
$output = '<div class="penci-slider-sync penci-fadeInUp" ' . $data . '>';
$output .= '<div class="penci-big_items penci-big_thumbs  penci-owl-carousel-style popup-gallery-slider">' . $items . '</div>';
$output .= '<div class="penci-small_items penci-small_thumbs  penci-owl-carousel-style">' . $small_thumb . '</div>';
$output .= '</div>';
return $output;
