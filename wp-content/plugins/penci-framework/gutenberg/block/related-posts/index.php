<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(  ! class_exists( 'Penci_Gutenberg_Related_Posts' ) ):
class Penci_Gutenberg_Related_Posts {

	public function render( $attributes, $content ) {
		$param = ' wpblock="true"';
		if( $attributes ){
			foreach ( (array)$attributes as $k => $v ){
				if( $v ){
					if( 'thumbright' == $k && $v ){
						$v = 'yes';
					}
					$param .= ' ' . $k . '="' . $v . '"';
				}
			}
		}

		return do_shortcode( '[penci_related_posts' . $param . ']' );
	}
	public function attributes() {
		$options = array(
			'title'      => array(
				'type'    => 'string',
				'default' => esc_html__( 'Inline Related Posts','penci-framework' ),
			),
			'number'     => array(
				'type'    => 'number',
				'default' => '4',
			),
			'style'      => array(
				'type'    => 'string',
				'default' => 'list',
			),
			'align'      => array(
				'type'    => 'string',
				'default' => 'none',
			),
			'withids'      => array(
				'type'    => 'string',
			),
			'displayby'  => array(
				'type'    => 'string',
				'default' => 'recent_posts',
			),
			'orderby'    => array(
				'type'    => 'string',
				'default' => 'random',
			),
			'thumbright' => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'background' => array(
				'type'    => 'string',
			),
				'border'     => array(
				'type'    => 'string',
			)
		);

		return $options;
	}
}
endif;