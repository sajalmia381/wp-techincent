<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(  ! class_exists( 'Penci_Gutenberg_Review' ) ):
class Penci_Gutenberg_Review {

	public function render( $attributes, $content ) {
		$post_ID = ( isset( $attributes['postID'] ) && $attributes['postID'] ) ? $attributes['postID'] : get_the_ID();
		
		if( ! $post_ID ){
			return esc_html__( 'Empty post id, Enter post Id' );
		}

		if( ! class_exists( 'Penci_Reivew_Template' ) ){
			$mess = esc_html__( 'Please active Penci Review plugin', 'penci-framework' );
			return  Penci_Gutenberg::message( 'Penci Review', $mess );
		}

		return do_shortcode( '[penci_review id="' . $post_ID . '" wpblock="true"]' ) . '<!--endpenci-block-->';
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