<?php
/*
Plugin Name: Penci Pennew Review
Plugin URI: http://pencidesign.com/
Description: Review Shortcode Plugin for PenNews theme.
Version: 4.4
Author: PenciDesign
Author URI: http://themeforest.net/user/pencidesign?ref=pencidesign
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Include files
 */
require_once( dirname( __FILE__ ) . '/inc/functions.php' );
require_once( dirname( __FILE__ ) . '/inc/shortcodes.php' );
require_once( dirname( __FILE__ ) . '/inc/default-options.php' );
require_once( dirname( __FILE__ ) . '/inc/customize.php' );
require_once( dirname( __FILE__ ) . '/inc/reviews-template.php' );
new Penci_Reivew_Template;

require_once( dirname( __FILE__ ) . '/inc/review-ajax.php' );
new Penci_User_Review_Ajax;

require_once( dirname( __FILE__ ) . '/inc/class-review-comment.php' );
require_once( dirname( __FILE__ ) . '/inc/class-manage-review-columns.php' );
require_once( dirname( __FILE__ ) . '/inc/schema-markup.php' );
require_once( dirname( __FILE__ ) . '/inc/metabox.php' );


/**
 * Add admin meta box style
 */
if ( ! function_exists( 'penci_load_admin_metabox_review_style' ) ) {
	function penci_load_admin_metabox_review_style() {
		$screen = get_current_screen();

		if ( in_array( $screen->id, array( 'edit-comments','post','comment' ) ) ) {
			wp_enqueue_media();

			wp_enqueue_style( 'penci_meta_box_review_styles', plugin_dir_url( __FILE__ ) . 'css/admin-css.css' );
			wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_script( 'jquery-recipe-rateyo', plugin_dir_url( __FILE__ ) . 'js/jquery.rateyo.min.js', array( 'jquery' ), '3.0', true );
			wp_enqueue_script( 'penci_meta_box_review', plugin_dir_url( __FILE__ ) . 'js/admin-review.js',  array( 'jquery','jquery-ui-datepicker' ), '3.0', true );

			$normal_fill = get_theme_mod( 'penci_review_rating_normalFill' );
			$rated_fill = get_theme_mod( 'penci_review_rating_ratedFill' );

			wp_localize_script( 'penci_meta_box_review', 'PenciReview', array(
				'WidgetImageTitle'   => esc_html__( 'Select an image', 'penci' ),
				'WidgetImageButton'  => esc_html__( 'Insert into widget', 'penci' ),
				'review_title'   => esc_html__( 'Review Title for Point', 'penci' ),
				'review_number'  => esc_html__( 'Review Number for Point', 'penci' ),
				'review_desc'    => esc_html__( 'Minimum is 1, Maximum is 10. Example: 8', 'penci' ),
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'ajax-nonce' ),
				'normalFill' => $normal_fill ? $normal_fill : '#b9b9b9',
				'ratedFill'  => $rated_fill ? $rated_fill : '#FFCA00'
			) );
		}

	}
}

add_action( 'admin_enqueue_scripts', 'penci_load_admin_metabox_review_style' );

/**
 * Add javascript for review plugin
 */
add_action( 'wp_enqueue_scripts', 'penci_register_review_scripts' );

if ( ! function_exists( 'penci_register_review_scripts' ) ) {
	function penci_register_review_scripts() {
		wp_enqueue_script( 'jquery-penci-piechart', plugin_dir_url( __FILE__ ) . 'js/jquery.easypiechart.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_style( 'penci-oswald', '//fonts.googleapis.com/css?family=Oswald:400', array(), false, 'all' );

		wp_enqueue_script( 'jquery-recipe-rateyo', plugin_dir_url( __FILE__ ) . 'js/jquery.rateyo.min.js', array( 'jquery' ), '3.0', true );

		wp_enqueue_script( 'penci-rateyo-review', plugin_dir_url( __FILE__ ) . 'js/rating_review.js', array( 'jquery' ), '3.0', true );


		$normal_fill = get_theme_mod( 'penci_review_rating_normalFill' );
		$rated_fill = get_theme_mod( 'penci_review_rating_ratedFill' );

		$localize_script = array(
			'postID'     => get_the_ID(),
			'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
			'nonce'      => wp_create_nonce( 'ajax-nonce' ),
			'normalFill' => $normal_fill ? $normal_fill : '#b9b9b9',
			'ratedFill'  => $rated_fill ? $rated_fill : '#FFCA00'
		);

		wp_localize_script( 'penci-rateyo-review', 'PENCI', $localize_script );


	}
}
