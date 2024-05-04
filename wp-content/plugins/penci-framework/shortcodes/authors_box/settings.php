<?php

$group_filter = 'Filter';
$group_color  = 'Color';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Authors Box', 'penci-framework' ),
	'weight' => 820,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title(),
		array(
			array(
				'type'        => 'autocomplete',
				'heading'     => __( 'User roles', 'penci-framework' ),
				'param_name'  => 'user_roles',
				'settings'    => array(
					'multiple'       => true,
					'sortable'       => true,
					'min_length'     => 1,
					'no_hide'        => true,
					'groups'         => false,
					'unique_values'  => true,
					'display_inline' => true,
					'values'         => Penci_Framework_Helper::get_roles(),
				),
				'description' => __( 'Filter by role, add one or more user roles, separate them with a comma.', 'penci-framework' ) . Penci_Framework_Helper::get_roles( true ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Sort by:', 'penci-framework' ),
				'param_name' => 'sort_by',
				'value'      => array(
					__( 'Sort by name', 'penci-framework' ) => '',
					__( 'Sort by post count', 'penci-framework' )  => 'post_count',
				)
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Count Post', 'penci-framework' ),
				'param_name'       => 'hide_count_post',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Number of Users', 'penci-framework' ),
				'param_name'  => 'author_limit',
				'value'        => 10,
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Count Comments', 'penci-framework' ),
				'param_name'       => 'hide_count_comment',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Description', 'penci-framework' ),
				'param_name'       => 'hide_desc',
				'edit_field_class' => 'vc_col-sm-6',
				'value'            => array( __( 'Yes', 'penci-framework' ) => 'yes' ),
				'std'              => 'yes',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Contact Info', 'penci-framework' ),
				'param_name'       => 'hide_contact_info',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Custom Description Length:', 'penci-framework' ),
				'param_name' => 'post_desc_length',
				'std'        => 20,
				'dependency' => array( 'element' => 'hide_desc', 'is_empty' => true ),
			)
		),
		Penci_Framework_Shortcode_Params::color_params( 'authors_box', false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'color_authors_css',
				'heading'          => esc_html__( 'Author box colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Username color', 'penci-framework' ),
				'param_name'       => 'authorbox_username_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Username hover color', 'penci-framework' ),
				'param_name'       => 'authorbox_username_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Comments and Count Posts text color', 'penci-framework' ),
				'param_name'       => 'authorbox_comment_post_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Comments and Count Posts background color', 'penci-framework' ),
				'param_name'       => 'authorbox_comment_post_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Social media color', 'penci-framework' ),
				'param_name'       => 'authorbox_social_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Social media hover color', 'penci-framework' ),
				'param_name'       => 'authorbox_social_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Description color', 'penci-framework' ),
				'param_name'       => 'authorbox_desc_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array( 'element' => 'hide_desc', 'is_empty' => true ),
			),
		),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::block_option_note_custom_fonts(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'block_title',
				'title'        => esc_html__( 'Block title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
				'font-size'    => '18px',
			)
		)
	)
);