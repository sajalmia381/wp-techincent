<?php
/* ------------------------------------------------------- */
/* Blockquote
/* ------------------------------------------------------- */
if ( ! function_exists( 'penci_blockquote_shortcode' ) ) {
	function penci_blockquote_shortcode( $atts, $content ) {

		extract( shortcode_atts( array(
			'style' =>    '',
			'author'      => '',
			'align'       => 'none',
			'font_weight' => '',
			'font_style'  => '',
			'uppercase'   => '',
			'text_size'   => '',
		), $atts ) );


		$author_html = '';
		if ( $author ): $author_html = '<div class="author"><span>' . $author . '</span></div>'; endif;

		$style_attr = '';
		if( $font_weight ):
			$style_attr .= 'font-weight:' . $font_weight . ';';
		endif;
		if( $font_style ):
			$style_attr .= 'font-style:' . $font_style . ';';
		endif;

		if( $uppercase == 'false' ){
			$style_attr .= 'text-transform: none;';
		}elseif( $uppercase == 'true' ){
			$style_attr .= 'text-transform: uppercase;';
		}

		$unique_id = 'penci-pullqoute' . '__' . rand( 1000, 100000000 );

		$return = '<blockquote id="' . $unique_id . '" class="penci-pullqoute ' . esc_attr( $style ) . ' align' . esc_attr( $align ) . '" ' . (  $style_attr ? 'style="'  . $style_attr .  '"' : ''  ) . '>' . $content . $author_html . '</blockquote>';

		if( $text_size ) {
			$return .= '<style>';
			$return .= '#' . $unique_id . ',#' . $unique_id . ' p{ font-size:' . $text_size . 'px; }';
			$return .= '</style>';
		}

		return $return;
	}
}