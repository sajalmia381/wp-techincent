<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(  ! class_exists( 'Penci_Gutenberg_Button' ) ):
class Penci_Gutenberg_Button {

	public function render( $attributes, $content ) {
		$param = ' wpblock="true"';
		if( $attributes ){
			foreach ( (array)$attributes as $k => $v ){
				if( $v && 'content' != $k ){
					$param .= ' ' . $k . '="' . $v . '"';
				}
			}
		}

		return do_shortcode( '[penci_button' . $param . ']' . ( $attributes['content'] ? $attributes['content'] : '' ) . '[/penci_button]' );
	}
	public function attributes() {
		$options = array(
			'content' => array(
				'type'    => 'string',
				'default' => esc_html__( 'Add text...', 'penci-framework' ),
			),
			'link' => array(
				'type'      => 'string',
				'source'    => 'attribute',
				'selector'  => 'a',
				'attribute' => 'href',
				'default' => '#',
			),
			'size'  => array(
				'type'    => 'string',
				'default' => ''
			),
			'icon' => array(
				'type'    => 'string',
				'default' => 'fa fa-address-book'
			),
			'icon_position' => array(
				'type'    => 'string',
				'default' => 'left'
			),
			'align' => array(
				'type'    => 'string',
				'default' => ''
			),
			'full' => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'target' => array(
				'type'     => 'string',
			),
			'nofollow' => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'id'  => array(
				'type'    => 'string',
			),
			'class' => array(
				'type'    => 'string',
				'default' => ''
			),
			'margin_bottom' => array(
				'type'    => 'string',
			),
			'text_color'  => array(
				'type' => 'string',
			),
			'background'  => array(
				'type' => 'string',
			),
			'text_hover_color'  => array(
				'type' => 'string',
			),
			'hover_bgcolor'  => array(
				'type' => 'string',
			),
		);

		return $options;
	}
}
endif;