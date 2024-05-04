<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Penci_Responsive_Design_Helper' ) ) {
	class Penci_Responsive_Design_Helper {

		public static $shortcodes;

		public function __construct(){
			add_action( 'init', array( $this, 'init' ) );
		}

		public function init(){
			self::$shortcodes = self::get_shortcodes();
		}

		public static function get_devices() {
			static $devices;
			$devices = Penci_Responsive_Design::get_devices_default();

			return $devices;
		}


		public static function get_shortcodes(){
			return $shortcodes = array(
				'vc_row',
				'vc_column',
				'vc_row_inner',
				'vc_column_inner',
				'vc_empty_space',
				'penci_ad_box',
				'penci_advanced_carousel',
				'penci_authors_box',
				'penci_authors_box_2',
				'penci_block_video',
				'penci_column',
				'penci_column_inner',
				'penci_container',
				'penci_container_inner',
				'penci_count_down',
				'penci_counter_up',
				'penci_facebook_page',
				'penci_fancy_heading',
				'penci_image_box',
				'penci_image_gallery',
				'penci_info_box',
				'penci_instagram',
				'penci_latest_tweets',
				'penci_login_form',
				'penci_mailchimp',
				'penci_map',
				'penci_news_ticker',
				'penci_opening_hours',
				'penci_pricing_item',
				'penci_progress_bar',
				'penci_single_video',
				'penci_social_counter',
				'penci_social_media',
				'penci_text_block',
				'penci_vc_button',
				'penci_weather',
				'penci_bos_searchbox',
				'penci_recent_review'
			);
		}
	}
}