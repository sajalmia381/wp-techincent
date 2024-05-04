<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(  ! class_exists( 'Penci_Gutenberg_Blockquote' ) ):
class Penci_Gutenberg_Blockquote {

	public function render( $attributes, $content ) {

		$param = ' wpblock="true"';
		if( $attributes ){
			foreach ( (array)$attributes as $k => $v ){
				if( $v && 'content' != $k ){
					$param .= ' ' . $k . '="' . $v . '"';
				}
			}
		}

		return do_shortcode( '[penci_blockquote ' . $param . ']' . ( $attributes['content'] ? $attributes['content'] : '' ) . '[/penci_blockquote]' );
	}
	public function attributes() {
		$options = array(
			'content' => array(
				'type'    => 'string',
				'default' => esc_html__( 'Add Quote Content...', 'penci-framework' ),
			),
			'author'  => array(
				'type'    => 'string',
				'default' => esc_html__( 'Add Quote Author...', 'penci-framework' ),
			),
			'style' => array(
				'type'    => 'string',
				'default' => ''
			),
			'align' => array(
				'type'    => 'none',
				'default' => ''
			),
			'font_weight' => array(
				'type'    => 'string',
				'default' => ''
			),
			'font_style' => array(
				'type'    => 'string',
				'default' => ''
			),
			'uppercase' => array(
				'type'    => 'string',
				'default' => ''
			),
			'text_size' => array(
				'type'    => 'string',
				'default' => ''
			),
		);

		return $options;
	}
}
endif;