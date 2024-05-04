<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

extract( $atts );

list( $atts, $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'advanced_carousel' );

$class = 'penci-block-vc penci-google-map';

$width     = intval( $map_width ) ? $map_width : '100%';
$height    = intval( $map_height ) ? $map_height : '400px';

$atts['map_zoom']   = intval( $map_zoom ? $map_zoom : 8 );
$atts['marker_img'] = wp_get_attachment_url( $marker_img );

$option = htmlentities( json_encode( $atts ), ENT_QUOTES, "UTF-8" );

printf( '<div style="width:%s;height:%s" id="%s" class="%s" data-map_options="%s"></div>', $width, $height, $unique_id, $class, $option );