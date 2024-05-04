<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$unique_id = 'penci-widget-calendar--' . rand( 1000, 100000 );

$title = $el_class = $el_id = $options = '';
$output = '';
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}
extract( $atts );

$options = explode( ',', $options );
if ( in_array( 'dropdown', $options ) ) {
	$atts['dropdown'] = true;
}
if ( in_array( 'count', $options ) ) {
	$atts['count'] = true;
}

$el_class = $this->getExtraClass( $el_class );


$type = 'WP_Widget_Calendar';

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( $class ) ), 'penci_wp_widget_calendar', $atts ) );
$args  = Penci_Framework_Helper::penci_get_widget_args( $atts, $unique_id, $class );

global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	the_widget( $type, $atts, $args );
	$output .= ob_get_clean();

	echo $output;
}

$id_widget_calendar = '#' . $unique_id;
$css_custom = Penci_Helper_Shortcode::get_general_css_custom( $id_widget_calendar, $atts );

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'block_title',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
	'template'     => $id_widget_calendar . ( $atts['style_block_title'] ? '.' . $atts['style_block_title'] : '' ) . ' .penci-block__title{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
