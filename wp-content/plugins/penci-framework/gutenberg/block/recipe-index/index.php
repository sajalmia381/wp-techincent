<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(  ! class_exists( 'Penci_Gutenberg_Recipe_Index' ) ):
class Penci_Gutenberg_Recipe_Index {

	public function render( $attributes, $content ) {
		if( ! class_exists( 'Penci__Recipe_Add_Custom_Metabox_Class' ) ){
			$mess = esc_html__( 'Please active Penci Recipe plugin', 'penci-framework' );
			return  Penci_Gutenberg::message( 'Penci Recipe', $mess );
		}

		$param = ' wpblock="true"';
		if( $attributes ){
			foreach ( (array)$attributes as $k => $v ){
				if( in_array( $k , array( 'display_title','display_cat','primary_cat','display_date','display_image','cat_link' ) ) ){
					$param .= ' ' . $k . '="' . ( $v ? 'yes' : 'no' ) . '"';
				}elseif( $v ){
					$param .= ' ' . $k . '="' . $v . '"';
				}
			}
		}

		return do_shortcode( '[penci_index' . $param . ']' ) . '<!--endpenci-block-->';
	}
	public function attributes() {
		$options = array(
			'title'         => array(
				'type'    => 'string',
				'default' => esc_html__( 'Recipe Index Title', 'penci-framework' ),
			),
			'cat'           => array(
				'type'    => 'string',
				'default' => '',
			),
			'numbers_posts' => array(
				'type'    => 'number',
				'default' => '3',
			),
			'columns'       => array(
				'type'    => 'string',
				'default' => '3',
			),
			'display_title' => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'display_cat'   => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'primary_cat'   => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'display_date'  => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'display_image' => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'image_size'    => array(
				'type'    => 'string',
				'default' => 'landscape',
			),
			'cat_link'      => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'cat_link_text' => array(
				'type'    => 'string',
				'default' => esc_html__( 'View All', 'penci-framework' ),
			),
		);

		return $options;
	}
}
endif;