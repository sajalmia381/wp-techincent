<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

defined( 'IS_PENCI_GUTENBUGERG' ) || define( 'IS_PENCI_GUTENBUGERG', false );

if( ! class_exists( 'Penci_Gutenberg' ) ):
	class Penci_Gutenberg{
		private static $instance;

		public static function get_instance() {
			if ( null === static::$instance ) {
				static::$instance = new static();
			}

			return static::$instance;
		}

		private function __construct() {
			if ( function_exists( 'register_block_type' ) ) {

				add_action( 'enqueue_block_editor_assets',  array( $this, 'enqueue_editor_assets' ) );
				add_action( 'init', array( $this, 'register_block' ) );
				add_filter( 'block_categories_all', array( $this, 'module_category' ) );
				//add_filter( 'theme_mod_penci_disable_lazyload', array( $this, 'disable_lazyload' ) );

				require_once PENCI_ADDONS_DIR . '/gutenberg/block/text-padding/index.php';
				require_once PENCI_ADDONS_DIR . '/gutenberg/block/button/index.php';
				require_once PENCI_ADDONS_DIR . '/gutenberg/block/recipe/index.php';
				require_once PENCI_ADDONS_DIR . '/gutenberg/block/recipe-index/index.php';
				require_once PENCI_ADDONS_DIR . '/gutenberg/block/review/index.php';
				require_once PENCI_ADDONS_DIR . '/gutenberg/block/related-posts/index.php';
				require_once PENCI_ADDONS_DIR . '/gutenberg/block/custom-list/index.php';
				require_once PENCI_ADDONS_DIR . '/gutenberg/block/blockquote/index.php';

				add_action( 'init', array( $this, 'add_hook' ) );
			}
		}

		public function add_hook(){
			global $wp_version;
			if( function_exists('vp_pfui_post_admin_setup') && ( 5 <= $wp_version ) ) {
				require_once PENCI_ADDONS_DIR . '/gutenberg/metaboxes.php';
				add_filter( 'admin_body_class', array( $this,'custom_admin_body_class' ) );
			}
		}

		public function enqueue_editor_assets(){
			if( ! defined( 'PENCI_PENNEWS_VERSION' ) ) {
				return;
			}

			$asset_url     = get_parent_theme_file_uri();
			$theme = wp_get_theme();
			$theme_version = $theme->get( 'Version' );

			wp_register_script( 'lazy', get_template_directory_uri() . '/js/jquery.lazy.min.js', array( 'jquery' ), '1.8.2', true );
			wp_enqueue_style( 'penci-font-awesome',$asset_url . '/css/font-awesome.min.css', '', '4.5.2' );

			if ( ! penci_get_theme_mod( 'penci_disable_default_fonts' ) && function_exists( 'penci_fonts_url' ) ) {
				wp_enqueue_style( 'penci-fonts', penci_fonts_url(), array(), '1.0' );
				$data_fonts = penci_fonts_url( 'earlyaccess' );
				if ( is_array( $data_fonts ) && ! empty( $data_fonts ) ) {
					foreach ( $data_fonts as $fontname ) {
						wp_enqueue_style( 'penci-font-' . $fontname, '//fonts.googleapis.com/earlyaccess/' . esc_attr( $fontname ) . '.css', array(), PENCI_PENNEWS_VERSION );
					}
				}
			}

			wp_enqueue_script( 'penci-gutenberg', plugins_url( 'block.build.js', __FILE__ ), array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'underscore' ), PENCI_PENNEWS_VERSION );

			wp_enqueue_style( 'penci-gutenberg-editor', plugins_url( 'css-editor.css', __FILE__ ), array( 'wp-edit-blocks' ), PENCI_PENNEWS_VERSION );

			if ( function_exists( 'gutenberg_get_jed_locale_data' ) ) {
				wp_add_inline_script(
					'penci-gutenberg',
					sprintf(
						'var penci_gutenberg = { localeData: %s };',
						json_encode( gutenberg_get_jed_locale_data( 'penci-gutenberg' ) )
					),
					'before'
				);
			}
		}

		function register_block() {


			if ( ! function_exists( 'register_block_type' ) ) {
				// Gutenberg is not active.
				return;
			}

			if( is_admin() ) {
				wp_enqueue_style( 'penci-gutenberg', plugins_url( 'style.css', __FILE__ ), array(), PENCI_PENNEWS_VERSION );

				wp_enqueue_style( 'penci-gutenberg-rtl', plugins_url( 'style-rtl.css', __FILE__ ), array( ), PENCI_PENNEWS_VERSION );
			}

			$list_block = self::list_block();

			foreach ( $list_block as $id => $class_name ) {

				$args = array(
					//'style' => 'penci-gutenberg',
				);

				if( $class_name ){
					$class = new $class_name();

					$args['attributes'] = $class->attributes();
					$args['render_callback'] = array( $class, 'render' );
				}

				register_block_type( 'penci-gutenberg/' . $id, $args );
			}
		}

		public function module_category( $categories ) {
			$category = array(
				array(
					'slug'  => 'penci-blocks',
					'title' => esc_html__( 'Penci Blocks', 'jnews-gutenberg' )
				)
			);

			return array_merge( $category, $categories );
		}

		public static function list_block(){
			return array(
				'text-padding'  => 'Penci_Gutenberg_Text_Padding',
				'button'        => 'Penci_Gutenberg_Button',
				'recipe'        => 'Penci_Gutenberg_Recipe',
				'recipe-index'  => 'Penci_Gutenberg_Recipe_Index',
				'review'        => 'Penci_Gutenberg_Review',
				'related-posts' => 'Penci_Gutenberg_Related_Posts',
				'blockquote'    => 'Penci_Gutenberg_Blockquote',
			);
		}

		public static function message( $block_name, $message ){
			$output = '';

			if (is_user_logged_in()){
				$output .= '<div class="penci-gutenberg-missing"><span>' . $block_name . '</span>' . $message . '</div>';
			}

			return $output;
		}
		function disable_lazyload( $value ){
			if( is_admin() ){
				return true;
			}

			return $value;
		}
		function custom_admin_body_class( $classes ) {
			$classes .= 'penci-gutenberg-vp-pfui';

			return $classes;
		}
	}

	Penci_Gutenberg::get_instance();
endif;


