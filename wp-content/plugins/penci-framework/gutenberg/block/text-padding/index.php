<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(  ! class_exists( 'Penci_Gutenberg_Text_Padding' ) ):
	class Penci_Gutenberg_Text_Padding {

		public function render( $attributes, $content ) {

			$output =  '<div class="' . ( isset( $attributes['classstyle'] ) ? $attributes['classstyle'] : '' ) . '">' . $content . '</div>';

			return $output;
		}
		public static function attributes() {
			$options = array(
				'content' => array(
					'type'   => 'array',
					'source' => 'children',
					'selector' => 'div',
					'default' => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.','penci-framework' )

				),
				'classstyle' => array(
					'type' => 'string',
					'default' => 'penci-tpadding-1'
				)
			);

			return $options;
		}
	}
endif;