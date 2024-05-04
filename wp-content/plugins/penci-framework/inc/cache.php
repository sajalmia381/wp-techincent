<?php
/**
 * Cache
 */
if( ! class_exists( 'Penci_Cache' ) ) {
	/**
	 * Class Penci_Cache
	 */
	class Penci_Cache{

		/**
		 * Get cache users
		 * @return array|bool|mixed
		 */
		public static function get_cache_users() {
			$cache_users = wp_cache_get( 'users', 'pennews' );

			if ( empty( $cache_users ) ) {
				$cache_users = get_users();
				wp_cache_set( 'users', $cache_users, 'pennews' );
			}

			return $cache_users;
		}

		/**
		 * Get cache menu
		 * @return array|bool|mixed
		 */
		public static function get_cache_menu() {
			$cache_menu = wp_cache_get( 'menu', 'pennews' );

			if ( empty( $cache_menu ) ) {
				$cache_menu = wp_get_nav_menus();
				wp_cache_set( 'menu', $cache_menu, 'pennews' );
			}

			return $cache_menu;
		}

		/**
		 * Get cache post type
		 * @return array|bool|mixed
		 */
		public static function get_cache_post_type() {
			$cache_ptype = wp_cache_get( 'post_type', 'pennews' );

			if ( empty( $cache_ptype ) ) {
				$cache_ptype = get_post_types( array(
					'public'  => true,
					'show_ui' => true
				) );

				wp_cache_set( 'post_type', $cache_ptype, 'pennews' );
			}

			return $cache_ptype;
		}

		/**
		 * Get cache tags
		 * @return array|bool|mixed
		 */
		public static function get_cache_tags() {
			$cache_tags = wp_cache_get( 'tags', 'pennews' );

			if ( empty( $cache_tags ) ) {
				$cache_tags = get_categories( array( 'hide_empty' => 0 ) );
				wp_cache_set( 'tags', $cache_tags, 'pennews' );
				self::add_cache_terms( $cache_tags );
			}

			return $cache_tags;
		}

		public static function get_cache_terms( $taxonomy ) {
			$cache_terms = wp_cache_get( $taxonomy, 'pennews' );

			if ( empty( $cache_cats ) ) {
				$cache_terms = get_terms( array(
					'taxonomy'   => $taxonomy,
					'hide_empty' => true,
				) );
				wp_cache_set( $taxonomy, $cache_terms, 'pennews' );
			}

			return $cache_terms;
		}

		/**
		 * Get cache categories
		 * @return array|bool|mixed
		 */
		public static function get_cache_categories() {
			$cache_cats = wp_cache_get( 'categories', 'pennews' );

			if ( empty( $cache_cats ) ) {
				$cache_cats = get_categories( array( 'hide_empty' => 0 ) );
				wp_cache_set( 'categories', $cache_cats, 'pennews' );
				self::add_cache_terms( $cache_cats );
			}

			return $cache_cats;
		}

		/**
		 * Get cache terms
		 * @param $terms
		 */
		public static function add_cache_terms( $terms ) {
			if ( empty( $terms ) ) {
				return;
			}

			foreach ( ( array ) $terms as $term ) {
				wp_cache_add( $term->term_id, $term, 'terms' );
			}
		}
	}
}