<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

Penci_Global_Blocks::set_is_inner_row( true );
Penci_Global_Blocks::set_is_container( false );

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $equal_height
 * @var $content_placement
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row_Inner
 */
$el_class = $equal_height = $content_placement = $css = $el_id ='';
$penci_el_pos = $penci_el_width_custom = $penci_el_translatey = $penci_el_zindex = '';
$disable_element = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if( ! $show_on_shortcode ) {
	return;
}

extract( $atts );

$unique = rand( 1000, 100000000 );

$el_class = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'wpb_row',
	//deprecated
	'vc_inner_' . $unique,
	'vc_inner',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= $after_output;

$vc_row_custom_css = '';
if ( $penci_el_width_custom ) {
	$vc_row_custom_css .= '@media (min-width: 768px){.vc_inner_' . $unique . ' { max-width: ' . esc_attr( $penci_el_width_custom ) . 'px; } }';

	if( 'left' == $penci_el_pos ) {
		$vc_row_custom_css .= '.vc_inner_' . $unique . ' { float: left; }';
	}elseif( 'right' == $penci_el_pos ){
		$vc_row_custom_css .= '.vc_inner_' . $unique . ' { float: right; }';
	}else{
		$vc_row_custom_css .= '@media (min-width: 768px){.vc_inner_' . $unique . ' { position: relative; left: 50%; transform: translateX( -50% ); }}';
		$vc_row_custom_css .= '@media (min-width: 960px){.vc_column-gap-30.vc_inner_' . $unique . ' { margin-left: 0; margin-right: 0; }}';
	}
}

if ( isset( $atts['penci_el_translatey'] ) && $atts['penci_el_translatey'] ) {
	$csstranslate = 'transform: translateY( ' . esc_attr( $atts['penci_el_translatey'] ) . ' )';

	$vc_row_custom_css .= '@media (min-width: 960px) {.vc_inner_' . $unique . '{ position:relative;';

	if ( 'center' == $penci_el_pos ) {
		$vc_row_custom_css .= 'left: 50%;';

		if ( $csstranslate ) {
			$csstranslate = 'transform: translate( -50%, ' . esc_attr( $atts['penci_el_translatey'] ) . ' )';;
		} else {
			$csstranslate = 'transform: translateX( -50% )';
		}
	}

	if ( $csstranslate ) {
		$vc_row_custom_css .= $csstranslate;
	}

	$vc_row_custom_css .= ' } }';

	if ( 'center' == $penci_el_pos ) {
		$vc_row_custom_css .= '@media (min-width: 960px){ .vc_column-gap-30.vc_inner_' . $unique . '{margin-left: 0; margin-right: 0; } }';
	}
}
if( isset( $atts['penci_el_zindex'] ) && ( $atts['penci_el_zindex'] || 0 == $atts['penci_el_zindex'] ) ) {
	$vc_row_custom_css .= '.vc_inner_' . $unique . '{ z-index:' . esc_attr(  $atts['penci_el_zindex'] ) . '; }';
}elseif( isset( $atts['penci_el_translatey'] ) && $atts['penci_el_translatey'] ) {
	$vc_row_custom_css .= '.vc_inner_' . $unique . '{ z-index:99; }';
}

if( $vc_row_custom_css ) {
	$output .= '<style>';
	$output .= $vc_row_custom_css;
	$output .= '</style>';
}

echo $output;
