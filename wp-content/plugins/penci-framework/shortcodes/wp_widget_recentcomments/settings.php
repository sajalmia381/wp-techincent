<?php

$group_filter = 'Filter';
$group_color  = 'Color';

// Shortcode settings
return array(
	'category'      => esc_html__( 'PenNews WP Widget', 'penci-framework' ),
	'name'   => 'WP ' . __( 'Recent Comments' ),
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title( array( 'block_title_default' => __( 'Recent Comments' ) ) ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings','hide_enable_stiky' ) ),
		array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Number of comments', 'penci-framework' ),
				'description' => __( 'Enter number of comments to display.', 'penci-framework' ),
				'param_name' => 'number',
				'value' => 5,
				'admin_label' => true,
			)
		),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		Penci_Framework_Shortcode_Params::color_params( 'penci_recent_comments', false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_title_css',
				'heading'          => esc_html__( 'Extra colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Link comment color', 'penci-framework' ),
				'param_name'       => 'link_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Link comment hover color', 'penci-framework' ),
				'param_name'       => 'link_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Text color', 'penci-framework' ),
				'param_name'       => 'text_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border bottom color', 'penci-framework' ),
				'param_name'       => 'item_border_bottom_color',
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
				'prefix'       => 'link_comment',
				'title'        => esc_html__( 'Link comment settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'text_comment',
				'title'        => esc_html__( 'Text settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		)
	)
);