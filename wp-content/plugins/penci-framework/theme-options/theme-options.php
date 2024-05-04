<?php
class PenNew_Theme_Option {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'mb_settings_pages', array( $this, 'settings_pages' ) );

		// Register meta boxes and fields for settings page
		add_filter( 'rwmb_meta_boxes', array( $this, 'register_options' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		// Add hooks
		add_action( 'load-appearance_page_theme-options', array( $this, 'reset' ) );

		add_action( 'mb_settings_page_submit_buttons', array( $this, 'add_button_reset' ) );

		add_action( 'admin_bar_menu', array( $this,'admin_bar_menu' ), 50 );

	}

	/**
	 * Add admin bar menu
	 * @global      $menu , $submenu, $wp_admin_bar
	 * @return      void
	 */
	function admin_bar_menu() {
		global $menu, $submenu, $wp_admin_bar;

		if ( ! is_super_admin() || ! is_admin_bar_showing() ) {
			return;
		}
		$args = array(
			'id'    => 'pennew-theme-option',
			'title' => '<span class="ab-icon dashicons-portfolio"></span>' . esc_html( 'Pennew Options', 'edupro' ),
			'href'  => admin_url( 'themes.php?page=theme-options' ),
			'meta'  => array( 'class' => 'pennew-theme-option' )
		);
		$wp_admin_bar->add_node( $args );
	}

	public function add_button_reset() {
		submit_button( esc_html__( 'Reset Settings', 'edupro' ), 'delete', 'edupro-reset-settings', false );
	}

	/**
	 * Enqueue style theme
	 */
	public function admin_enqueue_scripts() {
		//wp_enqueue_style( 'edupro-theme-options', get_template_directory_uri() . '/css/admin.css', '', '1.0.0' );
	}

	/**
	 *
	 * Add setting page
	 *
	 * @param $settings_pages
	 *
	 * @return array
	 */
	public function settings_pages( $settings_pages ) {
		$settings_pages[] = array(
			'id'            => 'theme-options',
			'option_name'   => 'theme_mods_' . get_template(),
			'menu_title'    => esc_html__( 'Theme Options', 'edupro' ),
			'parent'        => 'themes.php',
			'icon_url'      => 'dashicons-images-alt',
			'submenu_title' => esc_html__( 'Settings', 'edupro' ),
			'style'         => 'no-boxes',
			'columns'       => 1,
			'tabs'          => array(
				'general'        => esc_html__( 'General', 'edupro' ),
			),
			// Tab style: 'default', 'box' or 'left'. Optional
        	'tab_style' => 'box',
			'position'      => 68,
		);

		return $settings_pages;
	}

	/**
	 * Add option
	 *
	 * @param $meta_boxes
	 *
	 * @return array
	 */
	public function register_options( $meta_boxes ) {
		$pattern = PENCI_ADDONS_DIR . '/theme-options/*.php';
		$files = array_map( 'basename', glob( $pattern ) );
		$files = array_diff( $files, array( 'default.php', 'theme-options.php' ) );
		foreach ( $files as $file ) {
			$meta_boxes[] = include $file;
		}

		return $meta_boxes;
	}

	/**
	 * Get list font size
	 *
	 * @return array
	 */
	public static function list_font_size() {

		$font_size = range( 0, 48 );
		foreach ( $font_size as $k => $v ) {

			$font_size[ $k ] = $v . ' px';
		}

		return $font_size;
	}


	function reset() {
		if ( empty( $_POST['edupro-reset-settings'] ) ) {
			return;
		}

		edupro_get_setting_default( '', true );
	}
}

new PenNew_Theme_Option;