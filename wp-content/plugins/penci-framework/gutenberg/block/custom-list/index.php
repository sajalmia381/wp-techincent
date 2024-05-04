<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(  ! class_exists( 'Penci_Gutenberg_Custom_List' ) ):
class Penci_Gutenberg_Custom_List {

	public function render( $attributes ) {
		return '<div style="height: ' . ( isset( $attributes['height'] ) ? $attributes['height'] : '0' ) . 'px;"></div>';
	}
	public function attributes() {
		$options = array(
			'height' => array(
				'type'    => 'number',
				'default' => 100
			)
		);

		return $options;
	}
}
endif;