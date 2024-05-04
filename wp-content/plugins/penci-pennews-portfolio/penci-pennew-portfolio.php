<?php
/*
Plugin Name: Penci Pennews Portfolio
Plugin URI: http://pencidesign.com/
Description: Portfolio Plugin for PenNews theme.
Version: 2.4
Author: PenciDesign
Author URI: http://themeforest.net/user/pencidesign?ref=pencidesign
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PENCI_PORTFOLIO__DIR', plugin_dir_path( __FILE__ ) );
define( 'PENCI_PORTFOLIO__URL', plugin_dir_url( __FILE__ ) );

if ( ! class_exists( 'Penci_Portfolio' ) ):
	class Penci_Portfolio {
		private static $instance;

		public static function get_instance() {
			if ( null == self::$instance ) {
				self::$instance = new Penci_Portfolio();
			}
			return self::$instance;
		}

		/**
		 * Initializes the plugin by setting filters and administration functions.
		 */
		private function __construct() {
			$this->load_files();

			add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );
			add_action( 'init', array( $this, 'register_portfolio_post_type' ) );
			add_action( 'init', array( $this, 'register_portfolio_category' ) );
			add_filter( 'single_template', array( $this, 'register_portfolio_single' ) );
			add_filter( 'template_include', array( $this, 'register_portfolio_categories' ) );
			add_action( 'pre_get_posts', array( $this, 'portfolio_custom_posts_per_page' ) );
		}

		public function load_files() {
			include_once( 'inc/portfolio.php' );
			include_once( 'inc/shortcode-vc.php' );
			include_once( 'inc/helper.php' );
			include_once( 'inc/metabox.php' );
		}


		public function load_text_domain() {
			load_plugin_textdomain( 'pencidesign', false, PENCI_PORTFOLIO__DIR . '/languages/' );
		}

		public function register_portfolio_post_type() {
			$labels = array(
				'name' => _x( 'Portfolio', 'post type general name', 'pencidesign' ),
				'singular_name' => _x( 'Portfolio', 'post type singular name', 'pencidesign' ),
				'add_new' => __( 'Add New', 'pencidesign' ),
				'add_new_item' => __( 'Add New Project', 'pencidesign' ),
				'edit_item' => __( 'Edit Project', 'pencidesign' ),
				'new_item' => __( 'New Project', 'pencidesign' ),
				'all_items' => __( 'All Projects', 'pencidesign' ),
				'view_item' => __( 'View Portfolio', 'pencidesign' ),
				'search_items' => __( 'Search Portfolio', 'pencidesign' ),
				'not_found' => __( 'No projects found', 'pencidesign' ),
				'not_found_in_trash' => __( 'No projects found in Trash', 'pencidesign' ),
				'parent_item_colon' => '',
				'menu_name' => _x( 'Portfolio', 'post type general name', 'pencidesign' ),
			);

			$slug = get_theme_mod( 'penci_pfl_custom_catslug' ) ? get_theme_mod( 'penci_pfl_custom_catslug' ) : 'portfolio';

			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_rest'       => true,
				'query_var'          => Pennew_Portfolio_Helper::get_slug(),
				'rewrite'            => array(
					'slug'       => Pennew_Portfolio_Helper::get_slug(),
					'with_front' => true,
					'feeds'      => true,
					'pages'      => true,
				),
				'capability_type'    => 'page',
				'map_meta_cap'       => true,
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'menu_icon'          => 'dashicons-portfolio',
				'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'comments' )

			);

			register_post_type( 'portfolio', $args );

		}

		/**
		 * Register Portfolio Categories
		 */
		public function register_portfolio_category() {

			$labels = array(
				'name' => _x( 'Portfolio Categories', 'taxonomy general name', 'pencidesign' ),
				'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name', 'pencidesign' ),
				'search_items' => __( 'Search Portfolio Categories', 'pencidesign' ),
				'all_items' => __( 'All Portfolio Categories', 'pencidesign' ),
				'parent_item' => __( 'Parent Portfolio Category', 'pencidesign' ),
				'parent_item_colon' => __( 'Parent Portfolio Category:', 'pencidesign' ),
				'edit_item' => __( 'Edit Portfolio Category', 'pencidesign' ),
				'update_item' => __( 'Update Portfolio Category', 'pencidesign' ),
				'add_new_item' => __( 'Add New Portfolio Category', 'pencidesign' ),
				'new_item_name' => __( 'New Portfolio Category Name', 'pencidesign' ),
				'menu_name' => __( 'Portfolio Category', 'pencidesign' )
			);


			$args = array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => Pennew_Portfolio_Helper::get_slug_tax() )
			);

			register_taxonomy( 'portfolio-category', array( 'portfolio' ), $args );
		}


		/**
		 * Register single portfolio template
		 */
		public function register_portfolio_single( $single_template ) {
			global $post;

			if ( $post->post_type == 'portfolio' ) {
				$single_template = dirname( __FILE__ ) . '/inc/single-portfolio.php';
			}

			return $single_template;
		}


		/**
		 *   Register categories portfolio template
		 */
		public function register_portfolio_categories( $template ) {

			if( is_post_type_archive('portfolio') ) {
				$template = dirname( __FILE__ ) . '/inc/taxonomy-portfolio.php';
			}

			if ( is_tax( 'portfolio-category' ) ) {
				$template = dirname( __FILE__ ) . '/inc/taxonomy-portfolio-category.php';
			}
			return $template;
		}


		/**
		 * Custom posts per page portfolio categories listing
		 */

		public function portfolio_custom_posts_per_page( $query ) {
			if ( ! is_admin() && $query->is_main_query() && $query->is_post_type_archive( 'portfolio' ) ) {
				$numpost = get_theme_mod( 'penci_portfolio_cat_showposts' );
				$numpost = $numpost ? $numpost : 12;

				$query->set( 'posts_per_page', $numpost );
			}
		}
	}

	add_action( 'plugins_loaded', array( 'Penci_Portfolio', 'get_instance' ) );
endif; /* End check if class exists */