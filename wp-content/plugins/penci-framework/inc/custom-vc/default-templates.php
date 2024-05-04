<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Penci_Add_Default_Templates_VC' ) ):
	class Penci_Add_Default_Templates_VC {
		public function __construct() {
			add_action( 'vc_load_default_templates_action', array( $this, 'add_default_templates' ) );
		}

		public function add_default_templates() {
			$data                 = array();
			$data['name']         = __( 'Home page', 'my-text-domain' );
			$data['weight']       = 0;
			$data['image_path']   = preg_replace( '/\s/', '%20', plugins_url( 'images/custom_template_thumbnail.jpg', __FILE__ ) );
			$data['custom_class'] = 'template_home_1';
			$data['content']      = <<<CONTENT
        [vc_row][vc_column width="1/2"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/2"][vc_message color="alert-info" style="rounded"]I am message box. Click edit button to change this text.[/vc_message][/vc_column][/vc_row]
CONTENT;

			vc_add_default_templates( $data );
		}

		/**
		 * Content demo home 1
		 */
		public function get_content_home_1() {

		}
	}
endif;

new Penci_Add_Default_Templates_VC;