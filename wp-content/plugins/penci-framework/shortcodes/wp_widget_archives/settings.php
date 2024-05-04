<?php

$group_filter = 'Filter';
$group_color  = 'Color';

// Shortcode settings
return array(
	'category'      => esc_html__( 'PenNews WP Widget', 'penci-framework' ),
	'name'   => 'WP ' . __( 'Archives' ),
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title( array( 'block_title_default' => __( 'Archives' ) ) ),
		array(
			array(
				'type' => 'checkbox',
				'heading' => __( 'Display options', 'penci-framework' ),
				'param_name' => 'options',
				'value' => array(
					//__( 'Dropdown', 'penci-framework' ) => 'dropdown',
					__( 'Show Count Posts', 'penci-framework' ) => 'count',
				),
				'description' => __( 'Select display options for archives.', 'penci-framework' ),

			),
		),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings', 'hide_enable_stiky' ) ),
		Penci_Framework_Shortcode_Params::block_option_block_title(  ),
		Penci_Framework_Shortcode_Params::color_params( 'penci_widget_archive', false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_title_css',
				'heading'          => esc_html__( 'Link colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Link color', 'penci-framework' ),
				'param_name'       => 'link_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Link hover color', 'penci-framework' ),
				'param_name'       => 'link_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( ' Post counts color', 'penci-framework' ),
				'param_name'       => 'post_counts',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_note_custom_fonts(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'block_title',
				'title'        => esc_html__( 'Block title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
				'font-size'    => '18px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'link_cat',
				'title'        => esc_html__( 'Link settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		)
	)
);