<?php

$group_color = 'Color';
$shotcode_id = 'block_10';

$color_post_date = array(
	array(
		'type'             => 'colorpicker',
		'heading'          => esc_html__( 'Border post title color', 'penci-framework' ),
		'param_name'       => 'border_post_title_color',
		'group'            => $group_color,
		'edit_field_class' => 'vc_col-sm-6',
	),
	array(
		'type'             => 'textfield',
		'param_name'       => 'heading_post_date_color_settings',
		'heading'          => esc_html__( 'Post Date Settings', 'penci-framework' ),
		'value'            => '',
		'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
		'group'            => $group_color,
	),
	array(
		'type'             => 'colorpicker',
		'heading'          => esc_html__( 'Post Date Background', 'penci-framework' ),
		'param_name'       => 'meta_bg',
		'group'            => $group_color,
		'edit_field_class' => 'vc_col-sm-6',
	),
	array(
		'type'             => 'colorpicker',
		'heading'          => esc_html__( 'Post Date color', 'penci-framework' ),
		'param_name'       => 'meta_color',
		'group'            => $group_color,
		'edit_field_class' => 'vc_col-sm-6',
	),
	array(
		'type'             => 'colorpicker',
		'heading'          => esc_html__( 'Post Date hover color', 'penci-framework' ),
		'param_name'       => 'meta_hover_color',
		'group'            => $group_color,
		'edit_field_class' => 'vc_col-sm-6',
	)
);

// Shortcode settings
return array(
	'name'    => esc_html__( 'Block 10', 'penci-framework' ),
	'weight'  => 879,
	'params'  => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query(),
		Penci_Framework_Shortcode_Params::block_title(),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings' ) ),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'standard' => 12 ) ),
		Penci_Framework_Shortcode_Params::block_option_pag( array( 'limit_loadmore' => 10, 'pagination' => 0, 'hide_pag_position' => 1 ) ),
		Penci_Framework_Shortcode_Params::filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id ),
		$color_post_date,
		Penci_Framework_Shortcode_Params::block_option_color_ajax_loading(),
		Penci_Framework_Shortcode_Params::block_option_color_filter_text(),
		Penci_Framework_Shortcode_Params::block_option_color_pagination(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'block_title',
				'title'        => esc_html__( 'Block title settings', 'penci-framework' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
				'font-size'    => '18px',
			)
		),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_meta_typography',
				'heading'          => esc_html__( 'Post date settings', 'penci-framework' ),
				'value'            => '',
				'group'            => 'Typo',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'penci_google_fonts',
				'heading'    => '',
				'param_name' => 'post_meta_fonts',
				'value'      => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'group'      => 'Typo',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_title',
				'title'        => esc_html__( 'Post title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '14px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo_pagination(),
		Penci_Framework_Shortcode_Params::ajax_filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::block_option_infeed_ad()
	),
	'js_view' => 'VcPenciShortcodeView',
);