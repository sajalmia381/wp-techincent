<?php

$group_filter = 'Filter';
$group_color  = 'Color';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Popular Categories', 'penci-framework' ),
	'weight' => 828,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title( ),
		Penci_Framework_Shortcode_Params::block_option_limit( 6 ),
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Categories type', 'penci-framework' ),
				'param_name' => 'cat_type',
				'value'      => array(
					__( 'Popular categories by number posts', 'penci-framework' )   => 'default',
					__( 'Popular categories sort by name A->Z', 'penci-framework' ) => 'alphabetical_order',
				),
				'std'        => 'default',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Show count posts', 'penci-framework' ),
				'param_name'       => 'count',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Show hierarchy', 'penci-framework' ),
				'param_name'       => 'hierarchical',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Uncategorized category', 'penci-framework' ),
				'param_name'       => 'hide_uncat',
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::color_params( 'popular_categories', false ),
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
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Link color', 'penci-framework' ),
				'param_name' => 'link_color',
				'group'      => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Link hover color', 'penci-framework' ),
				'param_name' => 'link_hover_color',
				'group'      => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( ' Post counts color', 'penci-framework' ),
				'param_name' => 'post_counts',
				'group'      => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings','hide_enable_stiky' ) ),
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