<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$el_class = $width = $el_id = $css = $class_layout = $order = '';
$output   = '';
$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( ! empty( $width ) ) {
	Penci_Global_Blocks::set_col_width( $width );

} else {
	Penci_Global_Blocks::set_col_width( '1/1' );
}

$layout_columns = Penci_Global_Blocks::get_class_columns( );
$pre_width = str_replace( '/', '', $width );
if( isset( $layout_columns[$order]['class_layout'] ) &&  isset( $layout_columns[$order]['width'] )  && $pre_width == $layout_columns[$order]['width']  ){
	$class_layout = $layout_columns[$order]['class_layout'];
}else{
	$class_layout = 'penci-wide-content';
}

$css_classes = array( $this->getExtraClass( $el_class ) );
$css_class   = implode( ' ', array_filter( $css_classes ) );

if ( vc_shortcode_custom_css_has_property( $css, array( 'border', 'background', ) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}

if ( ( ( '1/3' == $width && false === strpos( 'penci-col-4', $class_layout ) ) || '1/4' == $width ) ) {
	$class_layout = 'widget-area ' . $class_layout;
} else {
	$class_layout = 'penci-content-main ' . $class_layout;

}

$output .= sprintf( '<div %s class="%s %s" role="complementary">',
	! empty( $el_id ) ? 'id="' . esc_attr( $el_id ) . '"' : '',
	$class_layout,
	esc_attr( trim( $css_class ) ),
	esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) )
);

$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
echo $output;

