<?php
/**
 * Shortcode settings base class.
 */

/**
 * Shortcode settings base class.
 */
class Penci_Shortcode_Settings {
	/**
	 * Shortcode tag
	 * @var string
	 */
	protected $shortcode;

	/**
	 * Shortcode settings.
	 * @var array
	 */
	protected $settings;

	/**
	 * Constructor.
	 *
	 * @param string $shortcode Shortcode tag.
	 * @param array $settings Shortcode settings.
	 */
	public function __construct( $shortcode, $settings ) {
		$this->shortcode = $shortcode;
		$this->settings  = $settings;

		add_action( 'vc_before_init', array( $this, 'init' ) );
		//add_filter( 'vc_shortcode_output', array( $this, 'shortcode_output' ),10,3 );
	}

	public function shortcode_output($output, $obj, $attr)  {
		
		if( is_admin() ) {
			return $output;
		}

		$show_only 		= filter_input( INPUT_GET, 'show_only' );
		$current_paged  = Penci_Pagination::get_current_paged();

		if( !$show_only || ! $current_paged ) {
			return $output;
		}

		$base = $obj->settings('base');	
		$show = array('vc_row','vc_column','vc_row_inner','vc_column_inner','penci_container','penci_column','penci_container_inner','penci_column_inner','vc_section' );

		if( in_array( $base, $show ) ) {
			return $output;
		}

		$block_id = isset( $attr['block_id'] ) ? $attr['block_id'] : '';

		if( $block_id != $show_only ) {
			$output = '';
		}

		return $output;
	}

	/**
	 * Register shortcode.
	 */
	public function init() {
		// Default shortcode settings
		$settings = wp_parse_args( $this->settings, array(
			'base'          => "penci_{$this->shortcode}",
			'class'         => '',
			'icon'          => PENCI_ADDONS_URL . "shortcodes/{$this->shortcode}/icon.png",
			'category'      => 'PenNews',
			'html_template' => PENCI_ADDONS_DIR . "shortcodes/{$this->shortcode}/frontend.php",
			'params'        => array(),
			'name'          => '',
			'weight'        => 700,
		) );

		$shortcode_name   = $settings['name'];

		if( 'sliders' == $this->shortcode ) {
			$settings['name'] = esc_html__( 'Featured ', 'penci-framework' ) . $shortcode_name;
		}else{
			$settings['name'] = esc_html__( 'Penci ', 'penci-framework' ) . $shortcode_name;
		}

		if( ! function_exists( 'bos_searchbox_retrieve_all_user_options' ) && 'bos_searchbox' == $this->shortcode  ) {
			return;
		}

		if( ! defined( 'MC4WP_VERSION' ) && 'mailchimp' == $this->shortcode  ) {
			return;
		}

		$list_unseting = array( 'penci_sliders','container_inner', 'container', 'column', 'column_inner' );

		if ( ! in_array( $this->shortcode, $list_unseting ) ) {
			$settings['controls'] = 'full';
			$settings['params'][] = array(
				'type'             => 'textfield',
				'param_name'       => 'heading_extra_settings',
				'heading'          => esc_html__( 'Extra settings', 'penci-framework' ),
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			);
			$settings['params'][] = vc_map_add_css_animation( false );

			// Always add CSS options and extra CSS class.
			$settings['params'][] = array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'CSS Box', 'penci-framework' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design Options', 'penci-framework' ),
			);
			$settings['params'][] = array(
				'type'       => 'hidden',
				'param_name' => 'block_id',
				'settings'   => array( 'auto_generate' => true )
			);
		}

		$settings['params'][] = array(
			'type'             => 'checkbox',
			'heading'          => esc_html__( 'Show on Desktop', 'penci-framework' ),
			'param_name'       => 'penci_show_desk',
			'std'              => 'Yes',
			'edit_field_class' => 'vc_col-sm-4',
			'group'            => esc_html__( 'Responsive', 'penci-framework' ),
			'value'            => array( esc_html__( 'Yes', 'penci-framework' ) => true ),
		);
		$settings['params'][] = array(
			'type'             => 'checkbox',
			'heading'          => esc_html__( 'Show on Tablet', 'penci-framework' ),
			'param_name'       => 'penci_show_tablet',
			'std'              => 'Yes',
			'edit_field_class' => 'vc_col-sm-4',
			'group'            => esc_html__( 'Responsive', 'penci-framework' ),
			'value'            => array( esc_html__( 'Yes', 'penci-framework' ) => true ),
		);
		$settings['params'][] = array(
			'type'             => 'checkbox',
			'heading'          => esc_html__( 'Show on Mobile', 'penci-framework' ),
			'param_name'       => 'penci_show_mobile',
			'std'              => 'Yes',
			'edit_field_class' => 'vc_col-sm-4',
			'group'            => esc_html__( 'Responsive', 'penci-framework' ),
			'value'            => array( esc_html__( 'Yes', 'penci-framework' ) => true ),
		);

		$settings['params'][] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra Class', 'penci-framework' ),
			'param_name'  => 'class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'penci-framework' ),
		);

		if ( $video_url = self::get_link_video( $this->shortcode ) ) :
			$settings['params'][] = array(
				'type'             => 'textfield',
				'param_name'       => 'notification',
				'heading'          => "<span style='display: block;'><a href='" . esc_url( $video_url ) . "' target='_blank' style='text-decoration: none;''>" . esc_html__( "Watch Video Tutorial", "ultimate_vc" ) . " &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;float: right;margin-top: -5px;text-decoration: none;'></span></a></span>",
				'value'            => "",
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			);
		endif;

		vc_map( $settings );
	}


	/**
	 * Get link video tutorial of shortcode
	 *
	 * @param $shortcode
	 *
	 * @return string
	 */
	public static function get_link_video( $shortcode ) {

		$link = 'https://www.youtube.com/watch?v=bsZ7YYusAjQ&list=PL1PBMejQ2VTwTTycCaTHQ2UTLjL9V_7ZG';

		if ( 'portfolio' == $shortcode ) {
			$link = esc_url( 'https://www.youtube.com/watch?v=ZK4vU3UjMAU&list=PL1PBMejQ2VTwTTycCaTHQ2UTLjL9V_7ZG&index=4' );
		}

		return $link;
	}
}




