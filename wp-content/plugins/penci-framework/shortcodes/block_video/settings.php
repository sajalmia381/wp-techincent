<?php
$shotcode_id = 'block_video';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Block Video', 'penci-framework' ),
	'weight' => 820,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query( '', array(
			'size'      => array( 'value' => 5, 'hidden' => true ),
			'post_type' => array( 'value' => 'post', 'hidden' => false )
		)),
		Penci_Framework_Shortcode_Params::block_title(),
		array(
			array(
				'type'        => 'penci_image_select',
				'heading'     => esc_html__( 'Style', 'penci-framework' ),
				'param_name'  => 'style',
				'admin_label' => true,
				'std'         => 'style-1',
				'options'     => array(
					'style-1' => PENCI_ADDONS_URL . 'assets/img/video/style-1.png',
					'style-2' => PENCI_ADDONS_URL . 'assets/img/video/style-2.png',
					'style-3' => PENCI_ADDONS_URL . 'assets/img/video/style-3.png',
					'style-4' => PENCI_ADDONS_URL . 'assets/img/video/style-4.png',
					'style-5' => PENCI_ADDONS_URL . 'assets/img/video/style-5.png',
					'style-6' => PENCI_ADDONS_URL . 'assets/img/video/style-6.png',
					'style-7' => PENCI_ADDONS_URL . 'assets/img/video/style-7.png',
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Show title above image', 'penci-framework' ),
				'param_name' => 'show_title_ab_img',
				'dependency' => array( 'element' => 'style', 'value' => 'style-1' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Enable Auto Play Slider For Style 7', 'penci-framework' ),
				'param_name' => 'auto_play',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Disable Slider Loop', 'penci-framework' ),
				'param_name' => 'disable_loop',
				'dependency' => array( 'element' => 'style', 'value' => 'style-7' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Slider Auto Time (at x seconds)', 'penci-framework' ),
				'param_name' => 'auto_time',
				'std'        => 4000,
				'dependency' => array( 'element' => 'style', 'value' => 'style-7' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Slider Speed (at x seconds)', 'penci-framework' ),
				'param_name' => 'speed',
				'std'        => 600,
				'dependency' => array( 'element' => 'style', 'value' => 'style-7' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Disable dots navigation.', 'penci-framework' ),
				'param_name' => 'show_dots',
				'std'        => true,
				'dependency' => array( 'element' => 'style', 'value' => 'style-7' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Show next/prev buttons', 'penci-framework' ),
				'param_name' => 'show_nav',
				'std'        => false,
				'dependency' => array( 'element' => 'style', 'value' => 'style-7' ),
			),
		),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		Penci_Framework_Shortcode_Params::block_option_trim_word( array(  'standard' => 12, 'big' => 20 ) ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'comment', 'date' ) ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'heading_ajax_pagination_settings',
				'heading'          => 'Pagination settings',
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Pagination:', 'penci-framework' ),
				'param_name' => 'style_pag',
				'std'        => 'next_prev',
				'value'      => array(
					esc_html__( '- No pagination -', 'penci-framework' ) => '',
					esc_html__( 'Next Prev ajax', 'penci-framework' )    => 'next_prev',
				)
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Hide Post Format Icons', 'penci-framework' ),
				'param_name' => 'hide_format_icons',
			)
		),
		Penci_Framework_Shortcode_Params::filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::block_option_color_meta( array( 'element' => 'style', 'value' => array( 'style-1' ) ) ),
		Penci_Framework_Shortcode_Params::block_option_color_ajax_loading(),
		Penci_Framework_Shortcode_Params::block_option_typo_heading(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_title',
				'title'        => esc_html__( 'Post title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => ''
			) ),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_meta',
				'title'        => esc_html__( 'Post meta settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '12px',
				'dependency'   => array( 'element' => 'style', 'value' => array( 'style-1' ) )
			)
		)
	)
);