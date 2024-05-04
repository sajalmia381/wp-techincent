<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$title = $number = $el_class = $el_id = '';
$output = '';
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}
extract( $atts );

$unique_id = 'penci-widget-recentcomments--' . rand( 1000, 100000 );

$type = 'WP_Widget_Recent_Comments';

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( $class ) ), 'penci_wp_widget_recentcomments', $atts ) );

$args = Penci_Framework_Helper::penci_get_widget_args( $atts, $unique_id, $class );

global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	the_widget( $type, $atts, $args );
	$output .= ob_get_clean();

	echo $output;
}

$id_recentcomments = '#' . $unique_id;
$css_custom = Penci_Helper_Shortcode::get_general_css_custom( $id_recentcomments, $atts );

if ( $atts['link_color'] ) : $css_custom .= sprintf( '%s.widget_recent_comments li a{ color:%s; }', $id_recentcomments, $atts['link_color'] ); endif;
if ( $atts['link_hover_color'] ) : $css_custom .= sprintf( '%s.widget_recent_comments li a:hover{ color:%s; }', $id_recentcomments, $atts['link_hover_color'] ); endif;
if ( $atts['text_color'] ) : $css_custom .= sprintf( '%s.widget_recent_comments li{ color:%s; }', $id_recentcomments, $atts['text_color'] ); endif;
if ( $atts['item_border_bottom_color'] ) : $css_custom .= sprintf( '%s.widget_recent_comments li{ border-color:%s; }', $id_recentcomments, $atts['item_border_bottom_color'] ); endif;


$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'block_title',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
	'template'     => $id_recentcomments . ( $atts['style_block_title'] ? '.' . $atts['style_block_title'] : '' ) . ' .penci-block__title{ %s }',
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'link_comment',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_recentcomments . '.widget_archive li,' . $id_recentcomments . '.widget_archive li a{ %s }',
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'text_comment',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_recentcomments . '.widget_archive li,' . $id_recentcomments . '.widget_archive li a{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
