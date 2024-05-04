<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! function_exists( 'penci_iframe_shortcode' ) ) {
	function penci_iframe_shortcode( $atts, $content )
	{
		$atts = shortcode_atts( array(
			'align'   => '',
			'height'  => '',
			'mwidth'  => '',
			'mtop'    => '',
			'mbottom' => ''

		), $atts, 'iframe' );

		$style = '';

		if( $atts['align'] ) {
			$style .= 'text-align: ' . esc_attr( $atts['align'] ) . ';';
		}

		if( $atts['mtop'] ){
			$style .= 'margin-top: ' . esc_attr( $atts['mtop'] ) . 'px;';
		}

		if( $atts['mbottom'] ){
			$style .= 'margin-bottom: ' . esc_attr( $atts['mbottom'] ) . 'px;';
		}

		if( $style ) {
			$style = ' style="' . $style . '"';
		}
		$output = '<div class="penci-iframe"' . $style . '>';
		$output .= '<div class="penci-iframe-inner" style="width: 100%;' . ( $atts['mwidth'] ? 'max-width: ' . esc_attr( $atts['mwidth'] ) . 'px; display: inline-block;' : '' ) . '">';
		$output .= '<iframe style="width: 100%;' . ( $atts['height'] ? ' height:' . $atts['height'] . 'px;' : ''  ) . '" src="' . $content . '"></iframe>';

		$output .= '</div></div>';



		return $output;
	}
}

