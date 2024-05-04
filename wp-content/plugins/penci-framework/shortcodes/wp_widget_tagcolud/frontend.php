<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$unique_id = 'penci-widget-tagcloud--' . rand( 1000, 100000 );

$title = $taxonomy = $el_class = $el_id = '';

$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}
extract( $atts );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( $class ) ), 'penci_wp_widget_tagcolud', $atts ) );

$args  = Penci_Framework_Helper::penci_get_widget_args( $atts, $unique_id, $class );

$type = 'WP_Widget_Tag_Cloud';

global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	the_widget( $type, $atts, $args );
	$output = ob_get_clean();

	echo $output;
} 

$id_tagcloud = '#' . $unique_id;
$css_custom = Penci_Helper_Shortcode::get_general_css_custom( $id_tagcloud, $atts );
if ( $atts['tag_color'] ) : $css_custom .= sprintf( '%s .tagcloud a{ color:%s; }', $id_tagcloud,$atts['tag_color'] ); endif;
if ( $atts['tag_bgcolor'] ) : $css_custom .= sprintf( '%s .tagcloud a{ background-color:%s; }', $id_tagcloud, $atts['tag_bgcolor'] ); endif;
if ( $atts['tag_border_color'] ) : $css_custom .= sprintf( '%s .tagcloud a{ border-color:%s; }', $id_tagcloud, $atts['tag_border_color'] ); endif;
if ( $atts['tag_hcolor'] ) : $css_custom .= sprintf( '%s .tagcloud a:hover{ color:%s; }', $id_tagcloud, $atts['tag_hcolor'] ); endif;
if ( $atts['tag_hbgcolor'] ) : $css_custom .= sprintf( '%s .tagcloud a:hover{ background-color:%s;border-color:%s; }', $id_tagcloud, $atts['tag_hbgcolor'], $atts['tag_hbgcolor'] ); endif;


$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'block_title',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
	'template'     => $id_tagcloud . ( $atts['style_block_title'] ? '.' . $atts['style_block_title'] : '' ) . ' .penci-block__title{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'tag',
	'font-size'    => '10px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_tagcloud . ' .tagcloud a{ %s !important; }',
), $atts
);


if ( ! empty( $atts[ 'tag_font_size' ] ) && $atts[ 'tag_font_size' ] != '10px' ) {
	$css_custom .= $id_tagcloud . ' .tagcloud a { font-size:' . strip_tags( $atts[ 'tag_font_size' ] ) . ' !important; }';
}


if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
