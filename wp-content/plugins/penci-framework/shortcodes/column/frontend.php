<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$el_class = $width = $el_id = $css =  $class_layout = '';
$output   = '';
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}
extract( $atts );

if ( ! empty( $width ) ) {
	Penci_Global_Blocks::set_col_width_container( $width );

} else {
	Penci_Global_Blocks::set_col_width_container( '1/1' );
}

$css_classes = array( $this->getExtraClass( $el_class ) );

if ( vc_shortcode_custom_css_has_property( $css, array( 'border', 'background', ) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $css_classes ) ) ), 'penci_column', $atts ) );

$class_layout = $class_layout ? $class_layout : ' no-class_layout';
if ( ( ( '1/3' == $width && false === strpos( 'penci-col-4', $class_layout ) ) || '1/4' == $width ) ) {
	$class_layout = 'widget-area ' . $class_layout;
} else {
	$class_layout = 'penci-content-main ' . $class_layout;
}

$output .= sprintf( '<div %s class="%s %s" role="complementary"><div class="theiaStickySidebar">',
	! empty( $el_id ) ? 'id="' . esc_attr( $el_id ) . '"' : '',
	$class_layout,
	esc_attr( trim( $css_class ) ),
	esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) )
);

$output .= wpb_js_remove_wpautop( $content );
$output .= '</div></div>';
echo $output;
