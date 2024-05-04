<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

Penci_Global_Blocks::set_is_inner_container( true );

$el_class          = $css = $el_id = $el_width = '';
$el_disable_sticky = $output = '';

$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
};
extract( $atts );

$el_class      = $this->getExtraClass( $el_class );
$css_classes   = array( 'el_class' => $el_class, 'class' => $class );

$css_classes[] = vc_shortcode_custom_css_class( $css );
if ( 'yes' !== $el_disable_sticky ) {
	$css_classes[] = 'penci_vc_sticky_sidebar';
	$css_classes[] = 'penci-con_innner';
}

// Explode shortcode  penci column inner
$explode_content = array_filter( explode( '[/penci_column_inner]', $content . '[/penci_column_inner]' ) );
$layout_container = '';
if ( isset( $_GET['vc_editable'] ) && 'true' == $_GET['vc_editable'] ) {
	$container_layout = array_filter( explode( '_', $atts['container_layout'] . '_' ) );
	$count_col        = count( (array)$container_layout );

	$layout_container = '';

	$first_col = isset( $container_layout[0] ) ? $container_layout[0] : '';
	$last_col  = isset( $container_layout[1] ) ? $container_layout[1] : '';

	if( '13' == $first_col ) {
		$css_classes[]    = 'penci-con_innner-sidebar-left';
		$class_container_main = 'penci_column_inner-main';
	}elseif( '23' == $first_col ){
		$css_classes[]    = 'penci-con_innner-sidebar-right';
		$class_container_main = 'penci_column_inner-main';
	}else {
		$css_classes[] = 'penci-two-column';
		$class_container_main = 'penci-two-column-item';
	}
}else{
	$count_col       = count( (array)$explode_content );
	$first_col = isset( $explode_content[0] ) ? $explode_content[0] : '';
	$last_col  = isset( $explode_content[1] ) ? $explode_content[1] : '';

	if ( false !== strpos( $first_col, '[penci_column_inner width="1/3"' ) ) {
		$css_classes[]    = 'penci-con_innner-sidebar-left';
		$class_container_main = 'penci_column_inner-main';
	} elseif ( false !== strpos( $first_col, '[penci_column_inner width="2/3"' ) ) {
		$css_classes[]    = 'penci-con_innner-sidebar-right';
		$class_container_main = 'penci_column_inner-main';
	} else {
		$css_classes[] = 'penci-two-column';
		$class_container_main = 'penci-two-column-item';
	}
}

// Move shortcode content main to the end
foreach ( $explode_content as $k => $column_inner ) {
	if ( false !== strpos( $column_inner, '[penci_column_inner width="2/3"' ) ) {

		$item_move = $explode_content[ $k ];
		unset( $explode_content[ $k ] );
		array_unshift( $explode_content, $item_move );
		break;
	}
}

// Fix shortcode
foreach ( $explode_content as $k => $column_inner ) {

	$pre_column_inner = $column_inner;

	if ( false !== strpos( $column_inner, '[penci_column_inner width="1/2"' ) || false !== strpos( $column_inner, '[penci_column_inner width="2/3"' ) ) {
		$pre_column_inner = str_replace( '[penci_column_inner', '[penci_column_inner class_layout="' . $class_container_main . '"', $column_inner );
	}

	if ( false !== strpos( $column_inner, '[penci_column_inner width="1/3"' ) ) {
		$pre_column_inner = str_replace( '[penci_column_inner', '[penci_column_inner class_layout="widget-area-1"', $column_inner );
	}

	if ( false === strpos( $column_inner, '[/penci_column_inner]' ) ) {
		$pre_column_inner .= '[/penci_column_inner]';
	}

	$explode_content[ $k ] = $pre_column_inner;
}


if ( isset( $_GET['vc_editable'] ) && 'true' == $_GET['vc_editable'] ) {
	$explode_content = $content;
}else{
	$explode_content = implode( '', array_filter( $explode_content ) );
}

// Build attributes for wrapper
$el_id         = ! empty( $el_id ) ? 'id="' . esc_attr( $el_id ) . '"' : '';

$_css_classes = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $css_classes ) ) ), 'penci_container_inner', $atts ) );

$wrapper_class = 'class="' . $_css_classes . '"';

$output .= '<div ' . $el_id . $wrapper_class . '>';
$output .= '<div class="penci-container__content">';
$output .= wpb_js_remove_wpautop( $explode_content );
$output .= '</div>';
$output .= '</div>';

echo $output;
