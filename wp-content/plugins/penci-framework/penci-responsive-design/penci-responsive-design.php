<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PENCI_RESPONSIVE_DESIGN', 'penci-framework' );
define( 'PENCI_RESPONSIVE_DIR', PENCI_ADDONS_DIR . '/penci-responsive-design/' );
define( 'PENCI_RESPONSIVE_URL', PENCI_ADDONS_URL . '/penci-responsive-design/' );

if( ! class_exists( 'Penci_Responsive_Design' ) ) {
	class Penci_Responsive_Design{
		function __construct() {
			add_action( 'vc_before_init', array( $this, 'vc_init' ) );
			$this->vc_init();
		}

		function vc_init(){

			include PENCI_RESPONSIVE_DIR . 'inc/helper.php';
			new Penci_Responsive_Design_Helper;

			include PENCI_RESPONSIVE_DIR . 'inc/shortcodes-custom-css.php';
			new Penci_Responsive_VC_CustomCSS;

			include PENCI_RESPONSIVE_DIR . 'inc/add-class-vc-custom.php';

			include PENCI_RESPONSIVE_DIR . 'inc/add_params.php';
			new Penci_Responsive_VC_Add_Params;
		}

		public static function get_devices_default() {
			$devices = array(
				'penci_css'    => array(
					'name_device' => esc_html__( 'Desktop', PENCI_RESPONSIVE_DESIGN ),
					'breakpoint'  => '@media screen and (min-width: 1025px)'
				),
				'penci_md_css' => array(
					'name_device' => esc_html__( 'Tablet', PENCI_RESPONSIVE_DESIGN ),
					'breakpoint'  => '@media screen and (min-width: 769px) and (max-width: 1024px)'
				),
				'penci_sm_css' => array(
					'name_device' => esc_html__( 'Tablet Small', PENCI_RESPONSIVE_DESIGN ),
					'breakpoint'  => '@media screen and (min-width: 481px) and (max-width: 768px)'
				),
				'penci_xs_css' => array(
					'name_device' => esc_html__( 'Mobile', PENCI_RESPONSIVE_DESIGN ),
					'breakpoint'  => '@media screen and (max-width: 480px)'
				)
			);

			return apply_filters( 'penci_devices_default', $devices );
		}
	}
	new Penci_Responsive_Design;
}
