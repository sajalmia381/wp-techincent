<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Penci_Plugin_Compatibility' ) ):
	class Penci_Plugin_Compatibility {
		public function __construct() {
			add_action( 'after_setup_theme', array( $this,'hook_after_setup_theme' ) );
		}

		public function hook_after_setup_theme() {

			if ( class_exists( 'QuickAdsenseReloaded' ) ) {
				add_filter( 'single_load_more_content', array( $this, 'quads_process_content' ) );
			}
		}

		function quads_process_content( $content ) {
			global $quads_options, $adsArray, $adsArrayCus, $visibleContentAds, $ad_count_widget, $visibleShortcodeAds;


			if ( $visibleContentAds >= quads_get_max_allowed_post_ads( $content ) ) {
				$content = quads_clean_tags( $content );

				return $content;
			}

			$adsArray = quads_get_active_ads();

			if ( $adsArray === 0 ) {
				return $content;
			}

			$content = quads_sanitize_content( $content );

			$content = quads_filter_default_ads( $content );

			/*
			 * Tidy up content
			 */
			//$content = '<!--EmptyClear-->' . $content . "\n" . '<div style="font-size:0px;height:0px;line-height:0px;margin:0;padding:0;clear:both"></div>';
			$content = '<!--EmptyClear-->' . $content . "\n";
			$content = quads_clean_tags( $content, true );

			$content = quads_parse_default_ads( $content );

			$content = quads_parse_quicktags( $content );

			$content = quads_parse_random_quicktag_ads( $content );

			$content = quads_parse_random_ads( $content );

			/* ... That's it. DONE :) ... */
			$content = quads_clean_tags( $content );

			return do_shortcode( $content );
		}
	}
	new Penci_Plugin_Compatibility;
endif;




