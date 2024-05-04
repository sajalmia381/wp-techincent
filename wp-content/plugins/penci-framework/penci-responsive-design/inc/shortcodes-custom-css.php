<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Penci_Responsive_VC_CustomCSS' ) ) {
	class Penci_Responsive_VC_CustomCSS {
		public static $shortcodes;
		public static $devices;
		public static $shortcodes_custom_css;

		function __construct() {
			add_action( 'init', array( $this, 'init' ) );
			add_action( 'save_post', array( $this, 'buildShortcodesCustomCss' ), 11 );

		}

		public function init() {
			self::$shortcodes = Penci_Responsive_Design_Helper::get_shortcodes();
			self::$devices    = Penci_Responsive_Design_Helper::get_devices();
		}

		public function buildShortcodesCustomCss( $post_id ) {
			$post = get_post( $post_id );

			$shortcodes_custom_css = get_post_meta( $post_id, '_wpb_shortcodes_custom_css', true );

			if ( ( isset( $_POST['wp-preview'] ) && 'dopreview' === $_POST['wp-preview'] ) ) {
				$parent_id                   = wp_get_post_parent_id( $post_id );
				$shortcodes_custom_css = get_post_meta( $parent_id, '_wpb_shortcodes_custom_css', true );
			}

			$css = apply_filters( 'penci_base_build_shortcodes_custom_css', self::parseShortcodesCustomCss( $post->post_content, $shortcodes_custom_css ) );

			if ( empty( $css ) ) {
				delete_post_meta( $post_id, '_wpb_shortcodes_custom_css' );
			} else {
				update_post_meta( $post_id, '_wpb_shortcodes_custom_css', $css );
			}
		}

		public static function parseShortcodesCustomCss( $content, $css ) {

			if ( ! self::$shortcodes ) {
				return $css;
			}
			if ( ! preg_match( '/\s*(\.[^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $content ) ) {
				return $css;
			}

			$devices = self::$devices;

			WPBMap::addAllMappedShortcodes();
			preg_match_all( '/' . get_shortcode_regex() . '/', $content, $shortcodes );

			$shortcodes_2 = isset( $shortcodes[2] ) ? $shortcodes[2] : array();
			$shortcodes_5 = isset( $shortcodes[5] ) ? $shortcodes[5] : array();

			foreach ( (array) $shortcodes_2 as $index => $tag ) {
				if ( ! in_array( $tag, self::$shortcodes ) ) {
					continue;
				}

				$shortcode         = WPBMap::getShortCode( $tag );
				$shortcodes_3index = isset( $shortcodes[3][ $index ] ) ? $shortcodes[3][ $index ] : '';
				$attr_array        = shortcode_parse_atts( trim( $shortcodes_3index ) );

				if ( isset( $shortcode['params'] ) && ! empty( $shortcode['params'] ) ) {

					foreach ( $shortcode['params'] as $param ) {

						if ( isset( $param['type'] ) &&
						     'css_editor' === $param['type'] &&
						     isset( $attr_array[ $param['param_name'] ] ) &&
						     array_key_exists( $param['param_name'], $devices ) ) {

							$breakpoint = isset( $devices[ $param['param_name'] ]['breakpoint'] ) ? $devices[ $param['param_name'] ]['breakpoint'] : '';

							$res_css = $breakpoint . '{ ';
							$res_css .= $attr_array[ $param['param_name'] ];
							$res_css .= '}';

							vc_shortcode_custom_css_class( $attr_array[ $param['param_name'] ], ' ' );
							$css = str_replace( $attr_array[ $param['param_name'] ], $res_css, $css );
						}
					}
				}
			}

			foreach ( $shortcodes_5 as $shortcode_content ) {
				$css = self::parseShortcodesCustomCss( $shortcode_content, $css );
			}

			return $css;
		}
	}
}