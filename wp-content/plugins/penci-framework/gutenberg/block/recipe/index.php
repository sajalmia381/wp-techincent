<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(  ! class_exists( 'Penci_Gutenberg_Recipe' ) ):
class Penci_Gutenberg_Recipe {

	public function render( $attributes, $content ) {

		$post_ID = ( isset( $attributes['postID'] ) && $attributes['postID'] ) ? $attributes['postID'] : get_the_ID();
		
		if( ! $post_ID ){
			return esc_html__( 'Empty post id, Enter post Id' );
		}

		if( ! class_exists( 'Penci__Recipe_Add_Custom_Metabox_Class' ) ){
			$mess = esc_html__( 'Please active Penci Recipe plugin', 'penci-framework' );
			return  Penci_Gutenberg::message( 'Penci Recipe', $mess );
		}

		$shortcode = penci_pennews_recipe_shortcode_function( array( 'id' => $post_ID ) );
		$shortcode .= '<!--endpenci-block-->';
		return $shortcode;
	}
	public function attributes() {
		$post_id = isset( $_GET['post'] ) ? $_GET['post'] : '';

		$options = array(
			'postID' => array(
				'type' => 'string',
				'default' =>  $post_id,
			) 
		);

		return $options;
	}
}
endif;