<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Soledad_VC_Portfolio {

	function __construct() {
		add_action( 'init', array( $this, 'integrate' ) );
	}

	/**
	 * Integrate elements  into VC interface
	 */
	public function integrate() {
		if ( ! defined( 'WPB_VC_VERSION' ) || ! class_exists( 'Penci_Framework' ) ) {
			return;
		}

		$icon = defined( 'PENCI_ADDONS_URL' ) ? PENCI_ADDONS_URL . '/assets/img/vc-portfolio.png' : '';

		$video_url = class_exists( 'Penci_Shortcode_Settings' ) ? Penci_Shortcode_Settings::get_link_video('portfolio') : '';

		$group_color = 'Color';
		// Portfolio
		vc_map( array(
			'name'        => esc_html__( 'Portfolio', 'penci-framework' ),
			'description' => esc_html__( 'Display Your Portfolio', 'penci-framework' ),
			'base'        => 'portfolio',
			'class'       => '',
			'controls'    => 'full',
			'icon'        => $icon,
			'category'    => 'PenNews',
			'weight'      => 700,
			'params' => array_merge(
				array(
					array(
						'type'        => 'loop',
						'heading'     => 'Portfolio Items',
						'param_name'  => 'build_query',
						'settings'    => array(
							'size'      => array( 'value' => 12, 'hidden' => false ),
							'post_type' => array( 'value' => 'portfolio', 'hidden' => false )
						),
						'description' => 'Create WordPress loop, to populate content from your site.'
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Portfolio Type', 'penci-framework' ),
						'value'       => array(
							esc_html__( 'Masonry', 'penci-framework' ) => 'masonry',
							esc_html__( 'Grid', 'penci-framework' )    => 'grid',
						),
						'param_name'  => 'style',
						'admin_label' => true,
						'std'        => 'masonry',
					),
					array(
						'type'       => 'penci_only_number',
						'param_name' => 'space_item',
						'heading'    => esc_html__( 'Custom spacing between portfolio item', 'penci-framework' ),
						'value'      => '',
						'std'        => '',
						'suffix'     => 'px',
						'min'        => 1,
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Item Style', 'penci-framework' ),
						'value'      => array(
							'Text Overlay'     => 'text_overlay',
							'Text Below Image' => 'below_img'
						),
						'param_name' => 'item_style',
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Number Columns', 'penci-framework' ),
						'value'      => array(
							esc_html__( '1 Column', 'penci-framework' )  => '1',
							esc_html__( '2 Columns', 'penci-framework' ) => '2',
							esc_html__( '3 Columns', 'penci-framework' ) => '3',
							esc_html__( '4 Columns', 'penci-framework' ) => '4',
							esc_html__( '5 Columns', 'penci-framework' ) => '5',
							esc_html__( '6 Columns', 'penci-framework' ) => '6',
						),
						'param_name' => 'column',
						'std'        => '3',
						'dependency' => array( 'element' => 'style', 'value' => array( 'masonry', 'grid' ) )
					),
					array(
						'type'       => 'dropdown',
						'heading'    => __( 'Image Type', 'penci-framework' ),
						'param_name' => 'image_type',
						'value'      => array(
							__( 'Square', 'penci-framework' )    => 'square',
							__( 'Vertical', 'penci-framework' )  => 'vertical',
							__( 'Landscape', 'penci-framework' ) => 'landscape',
						),
						'std'        => 'landscape',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Effect portfolio items',
						'param_name'  => '_effect',
						'std'         => 'slidenfade-one',
						'value'       => array(
							esc_html__( 'None', 'penci-framework' )                        => 'none',
							esc_html__( 'Fade', 'penci-framework' )                        => 'fade',
							esc_html__( 'Slide and Fade', 'penci-framework' )              => 'slidenfade',
							esc_html__( 'Zoom In', 'penci-framework' )                     => 'zoom',
							esc_html__( 'Fade (one by one)', 'penci-framework' )           => 'fade-one',
							esc_html__( 'Slide and Fade (one by one)', 'penci-framework' ) => 'slidenfade-one',
							esc_html__( 'Zoom In (one by one)', 'penci-framework' )        => 'zoom-one',
						),
						'description' => 'Reveal effect for portfolio items.'
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Display Filter?', 'penci-framework' ),
						'value'      => array(
							'Yes' => 'true',
							'No'  => 'false'
						),
						'param_name' => 'filter',
					),
					array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Disable subcategory filtering', 'penci-framework' ),
						'param_name'       => 'dis_subcat_filter',
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Only show categories select on filter', 'penci-framework' ),
						'param_name'       => 'only_cat_select',
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__( 'All Portfolio Text', 'penci-framework' ),
						'param_name' => 'all_text',
						'std'        => esc_html__( 'All', 'penci-framework' ),
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Pagination:', 'penci-framework' ),
						'param_name' => 'style_pag',
						'std'        => '',
						'value'      => array(
							esc_html__( '- No pagination -', 'penci-framework' ) => '',
							esc_html__( 'Show More button', 'penci-framework' )  => 'showmore',
							///esc_html__( 'Numeric Pagination', 'penci-framework' ) => 'numeric',
							esc_html__( 'Load More Button', 'penci-framework' )  => 'load_more',
							esc_html__( 'Infinite Load', 'penci-framework' )     => 'infinite',
						)
					),

					array(
						'type'       => 'vc_link',
						'heading'    => esc_html__( 'More link.', 'penci-framework' ),
						'param_name' => 'more_link',
						'dependency' => array( 'element' => 'style_pag', 'value' => array( 'showmore' ) ),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__( 'Custom Number Posts for Each Time Load More Posts', 'penci-framework' ),
						'param_name' => 'numbermore',
						'std'        => 6,
						'dependency' => array( 'element' => 'style_pag', 'value' => array( 'load_more', 'infinite' ) )
					),

					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Page Navigation Alignment', 'penci-framework' ),
						'value'      => array(
							esc_html__( 'Left', 'pennews' )   => 'left',
							esc_html__( 'Center', 'pennews' ) => 'center',
							esc_html__( 'Right', 'pennews' )  => 'right',
						),
						'std'        => 'center',
						'param_name' => 'pag_pos',
					),
					array(
						'type'       => 'penci_only_number',
						'param_name' => 'readmore_bwidth',
						'heading'    => esc_html__( 'Custom border width for load more button', 'penci-framework' ),
						'value'      => '',
						'std'        => '',
						'suffix'     => 'px',
						'min'        => 1,
						'dependency' => array( 'element' => 'style_pag', 'value' => array( 'load_more', 'infinite','showmore' ) )
					),
					array(
						'type'       => 'penci_only_number',
						'param_name' => 'readmore_margin_top',
						'heading'    => esc_html__( 'Custom margin top for load more button', 'penci-framework' ),
						'value'      => '',
						'std'        => '',
						'suffix'     => 'px',
						'min'        => 1,
						'dependency' => array( 'element' => 'style_pag', 'value' => array( 'load_more', 'infinite','showmore' ) )
					),
					array(
						'type'             => 'textfield',
						'param_name'       => 'heading_extra_settings',
						'heading'          => esc_html__( 'Extra settings', 'penci-framework' ),
						'value'            => '',
						'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Disable Lazyload', 'penci-framework' ),
						'value' => array(
							esc_html__( 'Default', 'pennews' ) => '',
							esc_html__( 'Yes', 'pennews' )  => 'yes',
							esc_html__( 'No', 'pennews' ) => 'no',
						),
						'std'        => '',
						'param_name' => 'pfl_dis_lazyload_img',
					),
					array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Disable Background', 'penci-framework' ),
						'param_name'       => 'dis_bg_block',
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Hide Categories', 'penci-framework' ),
						'param_name'       => 'hide_cat',
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Extra Class', 'penci-framework' ),
						'param_name'  => 'class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'penci-framework' ),
					),
					array(
						'type'             => 'textfield',
						'param_name'       => 'notification',
						'heading'          => "<span style='display: block;'><a href='" . esc_url( $video_url ) . "' target='_blank' style='text-decoration: none;''>" . esc_html__( "Watch Video Tutorial", "ultimate_vc" ) . " &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;float: right;margin-top: -5px;text-decoration: none;'></span></a></span>",
						'value'            => "",
						'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
					),
					// Color
					array(
						'type'             => 'textfield',
						'param_name'       => 'pfl_filter_css',
						'heading'          => esc_html__( 'Filter colors', 'penci-framework' ),
						'value'            => '',
						'group'            => $group_color,
						'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Filter item color', 'penci-framework' ),
						'param_name'       => 'pfl_filter_color',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Filter item hover or active color', 'penci-framework' ),
						'param_name'       => 'pfl_filter_hcolor',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Filter slash(/) color', 'penci-framework' ),
						'param_name'       => 'pfl_filter_slash_color',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),
					// portfolio color
					array(
						'type'             => 'textfield',
						'param_name'       => 'portfolio_css',
						'heading'          => esc_html__( 'Portfolio colors', 'penci-framework' ),
						'value'            => '',
						'group'            => $group_color,
						'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Portfolio Title Color', 'penci-framework' ),
						'param_name'       => 'pfl_title_color',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Portfolio Title Hover Color', 'penci-framework' ),
						'param_name'       => 'pfl_title_hcolor',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Portfolio Categories Color', 'penci-framework' ),
						'param_name'       => 'pfl_cat_color',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Portfolio Categories Hover Color', 'penci-framework' ),
						'param_name'       => 'pfl_cat_hcolor',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Portfolio Overlay Hover Color', 'penci-framework' ),
						'param_name'       => 'pfl_overlay_color',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Portfolio Overlay Hover Opacity', 'penci-framework' ),
						'value'      => array(
							'' => '',
							'0.05' => '0.05',
							'0.1'  => '0.1',
							'0.15' => '0.15',
							'0.2'  => '0.2',
							'0.25' => '0.25',
							'0.3'  => '0.3',
							'0.35' => '0.35',
							'0.4'  => '0.4',
							'0.45' => '0.45',
							'0.5'  => '0.5',
							'0.55' => '0.55',
							'0.6'  => '0.6',
							'0.65' => '0.65',
							'0.7'  => '0.7',
							'0.75' => '0.75',
							'0.8'  => '0.8',
							'0.85' => '0.85',
							'0.9'  => '0.9',
							'0.95' => '0.95',
							'1'    => '1',
						),
						'std'        => 'center',
						'param_name' => 'pfl_overlay_opacity',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),

					array(
						'type'             => 'textfield',
						'param_name'       => 'readmore_css',
						'heading'          => esc_html__( 'Read more button colors', 'penci-framework' ),
						'value'            => '',
						'group'            => $group_color,
						'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Text color', 'penci-framework' ),
						'param_name'       => 'readmore_text_color',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Background color', 'penci-framework' ),
						'param_name'       => 'readmore_bg_color',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Border color', 'penci-framework' ),
						'param_name'       => 'readmore_border_color',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Text hover color', 'penci-framework' ),
						'param_name'       => 'readmore_text_hcolor',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Border hover color', 'penci-framework' ),
						'param_name'       => 'readmore_border_hcolor',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					),array(
						'type'             => 'colorpicker',
						'heading'          => esc_html__( 'Background  hover color', 'penci-framework' ),
						'param_name'       => 'readmore_bg_hcolor',
						'group'            => $group_color,
						'edit_field_class' => 'vc_col-sm-6',
					)
				),
				Penci_Framework_Shortcode_Params::block_option_typo(
					array(
						'prefix'       => 'pfl_filter',
						'title'        => esc_html__( 'Portfolio filter settings' ),
						'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
						'font-size'    => '',
					)
				),
				Penci_Framework_Shortcode_Params::block_option_typo(
					array(
						'prefix'       => 'pfl_title',
						'title'        => esc_html__( 'Portfolio title settings' ),
						'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
						'font-size'    => '20px',
					)
				),
				Penci_Framework_Shortcode_Params::block_option_typo(
					array(
						'prefix'       => 'pfl_cat',
						'title'        => esc_html__( 'Portfolio categories settings' ),
						'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
						'font-size'    => '12px',
					)
				),

				Penci_Framework_Shortcode_Params::block_option_typo(
					array(
						'prefix'       => 'pflbig_title',
						'title'        => esc_html__( 'Portfolio title of big item settings' ),
						'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
						'font-size'    => '20px',
						'dependency'   => array( 'element' => 'style', 'value' => array( 'mix' ) )
					)
				),
				Penci_Framework_Shortcode_Params::block_option_typo(
					array(
						'prefix'       => 'pflbig_cat',
						'title'        => esc_html__( 'Portfolio categories of big item settings' ),
						'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
						'font-size'    => '12px',
						'dependency'   => array( 'element' => 'style', 'value' => array( 'mix' ) )
					)
				),
				array(
					array(
						'type'       => 'css_editor',
						'heading'    => esc_html__( 'CSS Box', 'penci-framework' ),
						'param_name' => 'css',
						'group'      => esc_html__( 'Design Options', 'penci-framework' ),
					)
				)
			)
		) );
	}

	public function animationStyles() {
		$styles = array(
			esc_html__( '-- Default --', 'penci-framework' ) => 'fadeInPortfolio',
			__( 'None', 'penci-framework' )                  => 'none',
			__( 'Bounce', 'penci-framework' )                => 'bounce',
			__( 'flash', 'penci-framework' )                 => 'flash',
			__( 'pulse', 'penci-framework' )                 => 'pulse',
			__( 'rubberBand', 'penci-framework' )            => 'rubberBand',
			__( 'shake', 'penci-framework' )                 => 'shake',
			__( 'swing', 'penci-framework' )                 => 'swing',
			__( 'tada', 'penci-framework' )                  => 'tada',
			__( 'wobble', 'penci-framework' )                => 'wobble',

			__( 'bounceIn', 'penci-framework' )       => 'bounceIn',
			__( 'bounceInDown', 'penci-framework' )   => 'bounceInDown',
			__( 'bounceInLeft', 'penci-framework' )   => 'bounceInLeft',
			__( 'bounceInRight', 'penci-framework' )  => 'bounceInRight',
			__( 'bounceInUp', 'penci-framework' )     => 'bounceInUp',
			__( 'bounceOut', 'penci-framework' )      => 'bounceOut',
			__( 'bounceOutDown', 'penci-framework' )  => 'bounceOutDown',
			__( 'bounceOutLeft', 'penci-framework' )  => 'bounceOutLeft',
			__( 'bounceOutRight', 'penci-framework' ) => 'bounceOutRight',
			__( 'bounceOutUp', 'penci-framework' )    => 'bounceOutUp',

			__( 'fadeIn', 'penci-framework' )         => 'fadeIn',
			__( 'fadeInDown', 'penci-framework' )     => 'fadeInDown',
			__( 'fadeInDownBig', 'penci-framework' )  => 'fadeInDownBig',
			__( 'fadeInLeft', 'penci-framework' )     => 'fadeInLeft',
			__( 'fadeInLeftBig', 'penci-framework' )  => 'fadeInLeftBig',
			__( 'fadeInRight', 'penci-framework' )    => 'fadeInRight',
			__( 'fadeInRightBig', 'penci-framework' ) => 'fadeInRightBig',
			__( 'fadeInUp', 'penci-framework' )       => 'fadeInUp',
			__( 'fadeInUpBig', 'penci-framework' )    => 'fadeInUpBig',

			__( 'fadeOut', 'penci-framework' )         => 'fadeOut',
			__( 'fadeOutDown', 'penci-framework' )     => 'fadeOutDown',
			__( 'fadeOutDownBig', 'penci-framework' )  => 'fadeOutDownBig',
			__( 'fadeOutLeft', 'penci-framework' )     => 'fadeOutLeft',
			__( 'fadeOutLeftBig', 'penci-framework' )  => 'fadeOutLeftBig',
			__( 'fadeOutRight', 'penci-framework' )    => 'fadeOutRight',
			__( 'fadeOutRightBig', 'penci-framework' ) => 'fadeOutRightBig',
			__( 'fadeOutUp', 'penci-framework' )       => 'fadeOutUp',
			__( 'fadeOutUpBig', 'penci-framework' )    => 'fadeOutUpBig',

			__( 'flip', 'penci-framework' )    => 'flip',
			__( 'flipInX', 'penci-framework' )    => 'flipInX',
			__( 'flipInY', 'penci-framework' )    => 'flipInY',
			__( 'flipOutX', 'penci-framework' )    => 'flipOutX',
			__( 'flipOutY', 'penci-framework' )    => 'flipOutY',

			__( 'lightSpeedIn', 'penci-framework' )    => 'lightSpeedIn',
			__( 'lightSpeedOut', 'penci-framework' )    => 'lightSpeedOut',

			__( 'rotateIn', 'penci-framework' )    => 'rotateIn',
			__( 'rotateInDownLeft', 'penci-framework' )    => 'rotateInDownLeft',
			__( 'rotateInDownRight', 'penci-framework' )    => 'rotateInDownRight',
			__( 'rotateInUpLeft', 'penci-framework' )    => 'rotateInUpLeft',
			__( 'rotateInUpRight', 'penci-framework' )    => 'rotateInUpRight',

			__( 'zoomIn', 'penci-framework' )      => 'zoomIn',
			__( 'zoomInDown', 'penci-framework' )  => 'zoomInDown',
			__( 'zoomInLeft', 'penci-framework' )  => 'zoomInLeft',
			__( 'zoomInRight', 'penci-framework' ) => 'zoomInRight',
			__( 'zoomInUp', 'penci-framework' )    => 'zoomInUp',
			__( 'zoomOut', 'penci-framework' )    => 'zoomOut',
			__( 'zoomOutDown', 'penci-framework' )    => 'zoomOutDown',
			__( 'zoomOutLeft', 'penci-framework' )    => 'zoomOutLeft',
			__( 'zoomOutRight', 'penci-framework' )    => 'zoomOutRight',
			__( 'zoomOutUp', 'penci-framework' )    => 'zoomOutUp',
			__( 'slideInDown', 'penci-framework' )    => 'slideInDown',
			__( 'slideInLeft', 'penci-framework' )    => 'slideInLeft',
			__( 'slideInRight', 'penci-framework' )    => 'slideInRight',
			__( 'slideInUp', 'penci-framework' )    => 'slideInUp',
			__( 'slideOutDown', 'penci-framework' )    => 'slideOutDown',
			__( 'slideOutLeft', 'penci-framework' )    => 'slideOutLeft',
			__( 'slideOutRight', 'penci-framework' )    => 'slideOutRight',
			__( 'slideOutUp', 'penci-framework' )    => 'slideOutUp',
		);

		/**
		 * Used to override animation style list
		 * @since 4.4
		 */

		return apply_filters( 'vc_param_animation_style_list', $styles );
	}
}

new Soledad_VC_Portfolio();